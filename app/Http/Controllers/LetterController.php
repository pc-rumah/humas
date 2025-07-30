<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{
    public function home()
    {
        $letter = Letter::all();
        return view('welpage.letter', compact('letter'));
    }

    public function index()
    {
        $letter = Letter::all();
        return view('letter.index', compact('letter'));
    }

    public function create()
    {
        // return view('letter.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon'             => 'required|string|max:255',
            'nama_kegiatan'           => 'required|string|max:255',
            'instansi'                => 'required|string|max:255',
            'tanggal_mulai_kegiatan'  => 'required|date',
            'tanggal_selesai_kegiatan' => 'nullable|date|after_or_equal:tanggal_mulai_kegiatan',
            'waktu_mulai_kegiatan'    => 'required|date_format:H:i',
            'waktu_selesai_kegiatan'  => 'required|date_format:H:i',
            'lokasi_kegiatan'         => 'required|string|max:255',
            'detail_foto'             => 'required|string|max:255',
            'upload_surat'            => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:20480',
        ]);

        $uploadPath = null;
        if ($request->hasFile('upload_surat')) {
            $uploadPath = $request->file('upload_surat')->store('surat_uploads', 'public');
        }

        $permohonan = Letter::create([
            'nama_pemohon'             => $validated['nama_pemohon'],
            'nama_kegiatan'            => $validated['nama_kegiatan'],
            'instansi'                 => $validated['instansi'],
            'tanggal_mulai_kegiatan'   => $validated['tanggal_mulai_kegiatan'],
            'tanggal_selesai_kegiatan' => $validated['tanggal_selesai_kegiatan'] ?? null,
            'waktu_mulai_kegiatan'     => $validated['waktu_mulai_kegiatan'],
            'waktu_selesai_kegiatan'   => $validated['waktu_selesai_kegiatan'],
            'lokasi_kegiatan'          => $validated['lokasi_kegiatan'],
            'detail_foto'              => $validated['detail_foto'],
            'upload_surat'             => $uploadPath,
        ]);

        $waNumber = '6283866907175';
        $waText = "Halo, saya sudah mengirim surat permohonan kegiatan atas nama " . $permohonan->nama_pemohon . ". Mohon tindak lanjutnya.";
        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($waText);

        return redirect()->away($waUrl);
    }

    public function show(Letter $letter)
    {
        //
    }

    public function edit(Letter $letter)
    {
        //
    }

    public function update(Request $request, Letter $letter)
    {
        //
    }

    public function destroy(Letter $letter)
    {
        //
    }

    public function download($id)
    {
        $letter = Letter::findOrFail($id);

        if (!$letter->upload_surat) {
            return back()->with('error', 'Tidak ada surat yang diupload.');
        }

        // Pakai disk 'public'
        if (!Storage::disk('public')->exists($letter->upload_surat)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($letter->upload_surat, basename($letter->upload_surat));
    }
}
