<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\News;
use Illuminate\Http\Request;

class ShowNewsAgendaController extends Controller
{
    public function home()
    {
        $news = News::all();
        $agenda = Agenda::all();
        return view('welpage.newsagen', compact('news', 'agenda'));
    }
}
