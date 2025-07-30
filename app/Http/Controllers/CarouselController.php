<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function create()
    {
        $carousel = Carousel::first();
        return view('carousel.create', compact('carousel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar_1' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'gambar_2' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'gambar_3' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        ]);

        $carousel = Carousel::first();

        $data = [];

        if ($request->hasFile('gambar_1')) {
            if ($carousel && $carousel->gambar_1) {
                Storage::delete('public/' . $carousel->gambar_1);
            }
            $data['gambar_1'] = $request->file('gambar_1')->store('carousel', 'public');
        }

        if ($request->hasFile('gambar_2')) {
            if ($carousel && $carousel->gambar_2) {
                Storage::delete('public/' . $carousel->gambar_2);
            }
            $data['gambar_2'] = $request->file('gambar_2')->store('carousel', 'public');
        }

        if ($request->hasFile('gambar_3')) {
            if ($carousel && $carousel->gambar_3) {
                Storage::delete('public/' . $carousel->gambar_3);
            }
            $data['gambar_3'] = $request->file('gambar_3')->store('carousel', 'public');
        }

        if ($carousel) {
            $carousel->update($data);
            $message = 'Carousel berhasil diperbarui';
        } else {
            Carousel::create($data);
            $message = 'Carousel berhasil dibuat';
        }

        return redirect()->route('carousel.create')->with('success', $message);
    }
}
