<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'inventori_id' => 'required|array|min:1',
            'inventori_id.*' => 'required|exists:inventori,id',
            'jumlah_pinjam' => 'required|array|min:1',
            'jumlah_pinjam.*' => 'required|integer|min:1',

            'nama_peminjam' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'no_telp'       => 'required|regex:/^08[0-9]{4,11}$/',
            'ktm'           => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'email'         => 'required|email|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ];
    }
}
