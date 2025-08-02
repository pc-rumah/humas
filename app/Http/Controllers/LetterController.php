<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterRequest;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{
    public function home()
    {
        $letter = Letter::where('status', 'menunggu')->get();
        return view('welpage.letter', compact('letter'));
    }

    public function index()
    {
        $letter = Letter::where('status', 'menunggu')->paginate(5);
        return view('letter.index', compact('letter'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function storeUser(LetterRequest $request)
    {
        $validated = $request->validated();

        if (
            $request->waktu_selesai_kegiatan &&
            !preg_match('/^\d{2}:\d{2}$/', $request->waktu_selesai_kegiatan) &&
            strtolower($request->waktu_selesai_kegiatan) !== 'selesai'
        ) {
            return back()->withErrors(['waktu_selesai_kegiatan' => 'Format waktu harus HH:MM atau kata "selesai".'])->withInput();
        }

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

        return redirect()->route('letter.home')->with([
            'success' => 'Permohonan berhasil dikirim! anda akan diarahkan ke WhatsApp dalam beberapa detik.',
            'wa_url' => $waUrl,
        ]);
    }

    public function show(Letter $letter)
    {
        return view('letter.show', compact('letter'));
    }

    public function edit(Letter $letter)
    {
        //
    }

    public function update(Request $request, Letter $letter)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,disetujui',
        ]);

        $letter->status = $validated['status'];
        $letter->save();

        return redirect()->back()->with('success', 'Status surat berhasil diperbarui.');
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

        if (!Storage::disk('public')->exists($letter->upload_surat)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($letter->upload_surat, basename($letter->upload_surat));
    }
}
