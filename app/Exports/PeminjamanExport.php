<?php

namespace App\Exports;

use App\Models\Inventory;
use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() //Fungsi ini menghasilkan koleksi data (Collection) yang akan digunakan untuk isi file Excel atau pdf.
    {
        return Peminjaman::all()->map(function ($item) { //Mengambil semua data dari tabel peminjamans dan Melakukan transformasi untuk setiap baris data peminjaman.
            $barangList = json_decode($item->barang_dipinjam, true); //Asumsinya, kolom barang_dipinjam berisi JSON, JSON ini di-decode menjadi array agar bisa diolah.

            $daftarBarang = collect($barangList)->map(function ($barang) {
                $inventori = Inventory::find($barang['inventori_id']);
                return ($inventori->nama_barang ?? 'Barang Tidak Ditemukan') . ' (' . $barang['jumlah_pinjam'] . ')';
            })->implode(', '); //Menggabungkan daftar barang jadi satu string dengan koma.

            return [
                'peminjam'         => $item->nama_peminjam ?? '-',
                'barang_dipinjam'  => $daftarBarang,
                'tanggal_pinjam'   => $item->tanggal_pinjam,
                'tanggal_kembali'  => $item->tanggal_kembali,
                'status'           => $item->status,
            ];
        });
    }


    public function headings(): array
    {
        return [ //Judul ini akan tampil sebagai baris pertama di Excel, sesuai urutan array dari collection().
            'Peminjam',
            'Barang Dipinjam (jumlah)',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Catatan',
        ];
    }
}
