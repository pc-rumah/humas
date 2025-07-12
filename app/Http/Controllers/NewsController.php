<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
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

    public function create()
    {
        $kategorinews = KategoriNews::all();
        return view('news.create', compact('kategorinews'));
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $data['user_id'] = Auth::id();

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(News $news)
    {
        $kategorinews = KategoriNews::all();
        return view('news.edit', compact('news', 'kategorinews'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $data['user_id'] = Auth::id();

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(News $news)
    {
        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();
        return back()->with('success', 'Data Berhasil dihapus');
    }
}
