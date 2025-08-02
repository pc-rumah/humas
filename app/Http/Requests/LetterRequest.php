<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pemohon'             => 'required|string|max:255',
            'nama_kegiatan'           => 'required|string|max:255',
            'instansi'                => 'required|string|max:255',
            'tanggal_mulai_kegiatan'  => 'required|date',
            'tanggal_selesai_kegiatan' => 'nullable|date|after_or_equal:tanggal_mulai_kegiatan',
            'waktu_mulai_kegiatan'    => 'required|date_format:H:i',
            'waktu_selesai_kegiatan' => 'nullable|string|max:10',
            'lokasi_kegiatan'         => 'required|string|max:255',
            'detail_foto'             => 'required|string|max:255',
            'upload_surat'            => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:20480',
        ];
    }
}
