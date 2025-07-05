<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    public function home()
    {
        $peminjaman = Peminjaman::all();
        $inventori = Inventory::where('jumlah', '>', 0)->get();
        return view('welpage.peminjaman', compact('peminjaman', 'inventori'));
    }

    public function index(Request $request)
    {
        $query = Peminjaman::with(['inventori', 'user'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tanggal_pinjam', [$request->from, $request->to]);
        }

        if ($request->filled('barang')) {
            $query->whereHas('inventori', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->barang . '%');
            });
        }

        $data = $query->paginate(10)->withQueryString();

        return view('peminjaman.index', compact('data'));
    }

    public function create()
    {
        $inventori = Inventory::where('jumlah', '>', 0)->get();
        return view('peminjaman.create', compact('inventori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventori_id' => 'required|exists:inventori,id',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tujuan' => 'required|string',
        ]);

        $inventory = Inventory::findOrFail($validated['inventori_id']);

        if ($validated['jumlah_pinjam'] > $inventory->jumlah) {
            return back()->withErrors(['jumlah_pinjam' => 'Jumlah pinjam melebihi stok tersedia.']);
        }

        $validated['status'] = 'menunggu';

        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'inventori_id' => 'required|exists:inventori,id',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tujuan' => 'required|string',
        ]);

        $inventory = Inventory::findOrFail($validated['inventori_id']);

        if ($validated['jumlah_pinjam'] > $inventory->jumlah) {
            return back()->withErrors(['jumlah_pinjam' => 'Jumlah pinjam melebihi stok tersedia.']);
        }

        $validated['status'] = 'menunggu';

        Peminjaman::create($validated);

        return back()->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function show(Peminjaman $peminjaman)
    {
        //
    }

    public function edit(Peminjaman $peminjaman)
    {
        $inventori = Inventory::all();
        return view('peminjaman.edit', compact('peminjaman', 'inventori'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:menunggu,disetujui,dikembalikan',
            'tujuan' => 'required|string',
        ]);

        $oldStatus = $peminjaman->status;
        $peminjaman->update($validated);

        if ($validated['status'] === 'disetujui' && $oldStatus !== 'disetujui') {
            if ($peminjaman->inventori->jumlah < $peminjaman->jumlah_pinjam) {
                return back()->withErrors(['status' => 'Stok barang sudah tidak cukup.']);
            }
            $peminjaman->inventori->decrement('jumlah', $peminjaman->jumlah_pinjam);
        }

        if ($validated['status'] === 'dikembalikan' && $oldStatus !== 'dikembalikan') {
            $peminjaman->inventori->increment('jumlah', $peminjaman->jumlah_pinjam);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
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
