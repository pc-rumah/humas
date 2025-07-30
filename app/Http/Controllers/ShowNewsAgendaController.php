<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\KategoriNews;
use App\Models\Letter;
use App\Models\News;
use Illuminate\Http\Request;

class ShowNewsAgendaController extends Controller
{
    public function home()
    {
        $news = News::all();
        $agenda = Letter::where('status', 'disetujui')->get();
        $kategori = KategoriNews::all();
        return view('welpage.newsagen', compact('news', 'agenda', 'kategori'));
    }
}
