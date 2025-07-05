<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\KategoriNews;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::all();
        return view('agenda.index', compact('agenda'));
    }

    public function create()
    {
        $kategori = KategoriNews::all();
        return view('agenda.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'   => 'required|exists:kategori_news,id',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'tanggal_upload' => 'required|date',
            'waktu_mulai'   => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi'        => 'required|string|max:255',
            'organized'     => 'required|string|max:255',
        ]);

        Agenda::create([
            'kategori_id'   => $validated['kategori_id'],
            'judul'         => $validated['judul'],
            'deskripsi'     => $validated['deskripsi'],
            'tanggal'       => $validated['tanggal_upload'],
            'waktu_mulai'   => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'lokasi'        => $validated['lokasi'],
            'organized'     => $validated['organized'],
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function show(Agenda $agenda)
    {
        //
    }

    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'kategori_id'   => 'required|exists:kategorinews,id',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'tanggal_upload' => 'required|date',
            'waktu_mulai'   => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi'        => 'required|string|max:255',
            'organized'     => 'required|string|max:255',
        ]);

        $agenda->update([
            'kategori_id'   => $validated['kategori_id'],
            'judul'         => $validated['judul'],
            'deskripsi'     => $validated['deskripsi'],
            'tanggal'       => $validated['tanggal_upload'],
            'waktu_mulai'   => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'lokasi'        => $validated['lokasi'],
            'organized'     => $validated['organized'],
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus');
    }
}
