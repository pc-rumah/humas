<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function home()
    {
        $inventori = Inventory::all();
        $kategori = Kategori::all();
        return view('welpage.inventori', compact('inventori', 'kategori'));
    }

    public function index(Request $request)
    {
        $query = Inventory::query();

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
        $data = $query->paginate(10);

        return view('inventory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view("inventory.create", compact("kategori"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'   => 'required',
            'kategori_id'   => 'required|exists:kategori,id',
            'jumlah'        => 'required|integer|min:0',
            'lokasi'        => 'nullable',
            'status'        => 'required|in:tersedia,dipinjam,rusak',
            'gambar_barang' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $category = Kategori::findOrFail($validated['kategori_id']);
        $count = Inventory::where('kategori_id', $category->id)->count() + 1;
        $kodeBarang = strtoupper($category->kode_kategori) . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

        $validated['kode_barang'] = $kodeBarang;

        if ($request->hasFile('gambar_barang')) {
            $validated['gambar_barang'] = $request->file('gambar_barang')->store('inventori', 'public');
        }

        Inventory::create($validated);

        return redirect()->route('inventori.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventori)
    {
        $kategori = Kategori::all();
        return view('inventory.edit', compact('inventori', 'kategori'));
    }

    public function update(Request $request, Inventory $inventori)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|integer|min:0',
            'lokasi' => 'nullable',
            'status' => 'required|in:tersedia,dipinjam,rusak',
            'gambar_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($request->hasFile('gambar_barang')) {
            if ($inventori->gambar_barang && Storage::disk('public')->exists($inventori->gambar_barang)) {
                Storage::disk('public')->delete($inventori->gambar_barang);
            }
            $validated['gambar_barang'] = $request->file('gambar_barang')->store('inventori', 'public');
        }
        // dd($validated);
        $inventori->update($validated);

        return redirect()->route('inventori.index')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(Inventory $inventori)
    {
        // dd($inventory);
        if ($inventori->gambar_barang && Storage::disk('public')->exists($inventori->gambar_barang)) {
            Storage::disk('public')->delete($inventori->gambar_barang);
        }

        $inventori->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
