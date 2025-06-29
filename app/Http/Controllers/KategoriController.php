<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('kategori.index', compact('data'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori|string|max:255',
            'kode_kategori' => 'required|unique:kategori,kode_kategori|max:10',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil ditambah');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|max:10',
        ]);

        Kategori::findOrFail($kategori->id)->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori Berhasil dihapus');
    }
}
