<?php

namespace App\Http\Controllers;

use App\Models\Letter;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Letter::where('status', 'disetujui')->paginate(5);
        return view('agenda.index', compact('agenda'));
    }

    public function show(Letter $agenda)
    {
        return view('agenda.show', compact('agenda'));
    }
}
