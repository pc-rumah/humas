<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PeminjamanExport;
use Illuminate\Support\Facades\DB;
use App\Mail\PeminjamanDitolakMail;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\PeminjamanDisetujuiMail;
use App\Http\Requests\PeminjamanRequest;

class PeminjamanController extends Controller
{
    public function home()
    {
        $peminjaman = Peminjaman::latest()->get();

        $inventori = Inventory::where('jumlah', '>', 0)
            ->where('status', 'tersedia')
            ->get();

        $inventoriMap = Inventory::all()->keyBy('id');

        return view('welpage.peminjaman', compact('peminjaman', 'inventori', 'inventoriMap'));
    }

    public function index(Request $request)
    {
        $query = Peminjaman::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tanggal_pinjam', [$request->from, $request->to]);
        }

        $data = $query->get();

        if ($request->filled('barang')) {
            $filtered = $data->filter(function ($item) use ($request) {
                $barangList = json_decode($item->barang_dipinjam, true);
                foreach ($barangList as $barang) {
                    $inventori = \App\Models\Inventory::find($barang['inventori_id']);
                    if ($inventori && str_contains(strtolower($inventori->nama_barang), strtolower($request->barang))) {
                        return true;
                    }
                }
                return false;
            });

            $page = request()->get('page', 1);
            $perPage = 10;
            $offset = ($page - 1) * $perPage;
            $data = new \Illuminate\Pagination\LengthAwarePaginator(
                $filtered->slice($offset, $perPage),
                $filtered->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } else {
            $data = $query->paginate(10)->withQueryString();
        }

        $inventoriMap = Inventory::all()->keyBy('id');

        return view('peminjaman.index', compact('data', 'inventoriMap'));
    }

    public function create()
    {
        $inventori = Inventory::where('jumlah', '>', 0)->get();
        return view('peminjaman.create', compact('inventori'));
    }

    public function store(Request $request)
    {
        //
    }

    public function storeUser(PeminjamanRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            $barangList = [];

            foreach ($validated['inventori_id'] as $index => $inventoriId) {
                $jumlahPinjam = $validated['jumlah_pinjam'][$index];

                $inventory = Inventory::findOrFail($inventoriId);

                // Validasi stok tersedia
                if ($jumlahPinjam > $inventory->jumlah) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        "jumlah_pinjam.{$index}" => "Jumlah pinjam melebihi stok tersedia untuk barang: {$inventory->nama_barang}",
                    ]);
                }

                $barangList[] = [
                    'inventori_id' => $inventoriId,
                    'jumlah_pinjam' => $jumlahPinjam,
                ];
            }

            if ($request->hasFile('ktm')) {
                $validated['ktm'] = $request->file('ktm')->store('ktm', 'public');
            }

            if ($request->hasFile('upload_surat')) {
                $validated['upload_surat'] = $request->file('upload_surat')->store('surat', 'public');
            } else {
                $validated['upload_surat'] = null;
            }

            $validated['status'] = 'menunggu';

            Peminjaman::create([
                'nama_peminjam'     => $validated['nama_peminjam'],
                'nama_kegiatan'     => $validated['nama_kegiatan'],
                'ktm'               => $validated['ktm'],
                'upload_surat'      => $validated['upload_surat'],
                'email'             => $validated['email'],
                'no_telp'           => $validated['no_telp'],
                'tanggal_pinjam'    => $validated['tanggal_pinjam'],
                'tanggal_kembali'   => $validated['tanggal_kembali'],
                'status'            => $validated['status'],
                'barang_dipinjam'   => json_encode($barangList),
            ]);
        });

        return back()->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $inventoriMap = Inventory::all()->keyBy('id');

        return view('peminjaman.show', compact('peminjaman', 'inventoriMap'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $inventoriMap = Inventory::all()->keyBy('id');
        return view('peminjaman.edit', compact('peminjaman', 'inventoriMap'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,disetujui,dikembalikan,ditolak',
        ]);

        $oldStatus = $peminjaman->status;
        $newStatus = $validated['status'];

        $barangList = json_decode($peminjaman->barang_dipinjam, true);

        DB::beginTransaction();

        try {
            if ($newStatus === 'disetujui' && $oldStatus !== 'disetujui') {
                foreach ($barangList as $barang) {
                    $inventori = Inventory::findOrFail($barang['inventori_id']);

                    if ($inventori->jumlah < $barang['jumlah_pinjam']) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'status' => 'Stok tidak mencukupi untuk ' . $inventori->nama_barang,
                        ]);
                    }
                }

                foreach ($barangList as $barang) {
                    $inventori = Inventory::find($barang['inventori_id']);
                    $inventori->decrement('jumlah', $barang['jumlah_pinjam']);
                }

                if ($peminjaman->email) {
                    Mail::to($peminjaman->email)->send(new PeminjamanDisetujuiMail($peminjaman));
                }
            }

            if ($newStatus === 'dikembalikan' && $oldStatus !== 'dikembalikan') {
                foreach ($barangList as $barang) {
                    $inventori = Inventory::find($barang['inventori_id']);
                    $inventori->increment('jumlah', $barang['jumlah_pinjam']);
                }
            }

            if ($newStatus === 'ditolak' && $oldStatus !== 'ditolak') {
                if ($peminjaman->email) {
                    Mail::to($peminjaman->email)->send(new PeminjamanDitolakMail($peminjaman));
                }
            }

            $peminjaman->update(['status' => $newStatus]);

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['status' => 'Gagal memperbarui status: ' . $e->getMessage()]);
        }
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'disetujui') {
            $peminjaman->inventori->increment('jumlah', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function exportPDF()
    {
        $peminjaman = Peminjaman::all();

        $pdf = Pdf::loadView('pdf.peminjaman', compact('peminjaman'));

        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'laporan-peminjaman.xlsx');
    }
}
