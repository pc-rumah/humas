<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Inventory;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

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
        $totalDipinjam = DB::table('peminjaman')
            ->where('status', 'disetujui')
            ->sum('jumlah_pinjam');

        $totalTersedia = DB::table('inventori')->sum('jumlah');
        return response()->json([
            'labels' => ['Tersedia', 'Dipinjam'],
            'data' => [($totalTersedia - $totalDipinjam), $totalDipinjam]
        ]);
    }
}
