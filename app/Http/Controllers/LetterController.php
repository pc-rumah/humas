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
        return view('letter.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon'     => 'required|string|max:255',
            'instansi'         => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu_kegiatan'   => 'required|string|max:255',
            'lokasi_kegiatan'  => 'required|string|max:255',
            'foto_path'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_path'       => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:20000',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_path')) {
            $fotoPath = $request->file('foto_path')->store('dokumentasi/foto', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video_path')) {
            $videoPath = $request->file('video_path')->store('dokumentasi/video', 'public');
        }

        $permohonan = Letter::create([
            'nama_pemohon'     => $validated['nama_pemohon'],
            'instansi'         => $validated['instansi'],
            'tanggal_kegiatan' => $validated['tanggal_kegiatan'],
            'waktu_kegiatan'   => $validated['waktu_kegiatan'],
            'lokasi_kegiatan'  => $validated['lokasi_kegiatan'],
            'foto_path'        => $fotoPath,
            'video_path'       => $videoPath,
        ]);

        $pdf = Pdf::loadView('pdf.permohonan', ['permohonan' => $permohonan]);

        $pdfFileName = 'surat_permohonan_' . $permohonan->id . '.pdf';
        Storage::disk('public')->put('surat/' . $pdfFileName, $pdf->output());

        $permohonan->update([
            'pdf_path' => 'surat/' . $pdfFileName,
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
        $permohonan = Letter::findOrFail($id);

        if (!$permohonan->pdf_path || !Storage::disk('public')->exists($permohonan->pdf_path)) {
            return abort(404, 'PDF tidak ditemukan.');
        }

        return response()->download(storage_path('app/public/' . $permohonan->pdf_path));
    }
}
