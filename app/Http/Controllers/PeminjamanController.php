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
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $peminjaman = Peminjaman::all();
        return view('welpage.peminjaman', compact('peminjaman'));
    }

    public function index(Request $request)
    {
        $query = Peminjaman::with(['inventori', 'user'])->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tanggal pinjam
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tanggal_pinjam', [$request->from, $request->to]);
        }

        // Filter nama barang
        if ($request->filled('barang')) {
            $query->whereHas('inventori', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->barang . '%');
            });
        }

        $data = $query->paginate(10)->withQueryString();

        return view('peminjaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventori = Inventory::where('jumlah', '>', 0)->get();
        return view('peminjaman.create', compact('inventori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventori_id' => 'required|exists:inventori,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'jumlah_pinjam' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $inventory = Inventory::findOrFail($validated['inventori_id']);

        if ($validated['jumlah_pinjam'] > $inventory->jumlah) {
            return back()->withErrors(['jumlah_pinjam' => 'Jumlah pinjam melebihi stok tersedia.']);
        }

        $validated['status'] = 'menunggu';
        $validated['user_id'] = auth()->id();

        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $inventori = Inventory::all();
        return view('peminjaman.edit', compact('peminjaman', 'inventori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:menunggu,disetujui,dikembalikan',
            'catatan' => 'nullable|string',
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
