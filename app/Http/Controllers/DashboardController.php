<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Inventory;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function home()
    {
        $total = Inventory::count();
        $totalp = Peminjaman::where('status', 'disetujui')->count();
        $totals = Letter::count();
        $peminjaman = Peminjaman::orderBy('created_at', 'desc')->take(5)->get();
        $surat = Letter::orderBy('created_at', 'desc')->take(5)->get();
        return view('dash', compact('peminjaman', 'total', 'totalp', 'surat', 'totals'));
    }

    public function getChartData()
    {
        $peminjaman = Peminjaman::where('status', 'disetujui')->get();

        $totalDipinjam = 0;
        foreach ($peminjaman as $item) {
            $barangList = json_decode($item->barang_dipinjam, true);

            foreach ($barangList as $barang) {
                $totalDipinjam += $barang['jumlah_pinjam'];
            }
        }

        $totalTersedia = Inventory::sum('jumlah');

        return response()->json([
            'labels' => ['Tersedia', 'Dipinjam'],
            'data' => [($totalTersedia), $totalDipinjam]
        ]);
    }
}
