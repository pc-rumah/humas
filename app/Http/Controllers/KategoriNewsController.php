<?php

namespace App\Http\Controllers;

use App\Models\KategoriNews;
use Illuminate\Http\Request;

class KategoriNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriNews::all();
        return view('kategorinews.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategorinews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_news,nama_kategori|string|max:255',
        ]);

        KategoriNews::create($request->all());
        return redirect()->route('kategorinews.index')->with('success', 'Berhasil Menambah Data');
    }

    public function edit(KategoriNews $kategorinews)
    {
        return view('kategorinews.edit', compact('kategorinews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriNews $kategorinews)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_news,nama_kategori|string|max:255',
        ]);

        $kategorinews->update($request);
        return redirect()->route('kategorinews.index')->with('success', 'Berhasil Mengupdate Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriNews $kategorinews)
    {
        $kategorinews->delete();

        return back()->with('success', 'Berhasil Menghapus Data');
    }
}
