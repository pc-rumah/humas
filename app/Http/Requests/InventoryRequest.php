<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
            'nama_barang'   => 'required|string|max:255',
            'deskripsi'     => 'nullable|string|max:255',
            'kategori_id'   => 'required|exists:kategori,id',
            'jumlah'        => 'required|integer|min:0',
            'lokasi'        => 'nullable',
            'status'        => 'required|in:tersedia,dipinjam,rusak',
            'gambar_barang' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ];
    }
}
