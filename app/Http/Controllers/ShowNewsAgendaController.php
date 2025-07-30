<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Agenda;
use App\Models\Letter;
use App\Models\KategoriNews;
use Illuminate\Http\Request;

class ShowNewsAgendaController extends Controller
{
    public function home(Request $request)
    {
        $news = News::all();
        $kategori = KategoriNews::all();

        $agenda = Letter::where('status', 'disetujui');

        $filter = $request->get('filter');
        $now = Carbon::now();

        if ($filter == 'week') {
            $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
            $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

            $agenda->whereBetween('tanggal_mulai_kegiatan', [$startOfWeek, $endOfWeek]);
        } elseif ($filter == 'month') {
            $agenda->whereMonth('tanggal_mulai_kegiatan', $now->month)
                ->whereYear('tanggal_mulai_kegiatan', $now->year);
        } elseif ($filter == 'year') {
            $agenda->whereYear('tanggal_mulai_kegiatan', $now->year);
        }

        $agenda = $agenda->orderBy('tanggal_mulai_kegiatan', 'desc')->get();

        return view('welpage.newsagen', compact('news', 'agenda', 'kategori'));
    }
}
