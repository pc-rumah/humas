<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\KategoriNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategorinews = KategoriNews::all();
        return view('news.create', compact('kategorinews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategori_news,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_upload' => 'required|date',
        ]);

        $path = $request->file('gambar')->store('news', 'public');

        News::create([
            'gambar' => $path,
            'kategorinews_id' => $request->kategori_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_upload' => $request->tanggal_upload,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('news.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $kategorinews = KategoriNews::all();
        return view('news.edit', compact('news', 'kategorinews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategori_news,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_upload' => 'required|date',
        ]);

        if ($request->hasFile('gambar')) {
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }

            $path = $request->file('gambar')->store('news', 'public');
            $news->gambar = $path;
        }

        $news->kategorinews_id = $request->kategori_id;
        $news->judul = $request->judul;
        $news->deskripsi = $request->deskripsi;
        $news->tanggal_upload = $request->tanggal_upload;

        $news->user_id = Auth::id();

        $news->save();

        return redirect()->route('news.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
