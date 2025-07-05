<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peminjaman::with(['user', 'inventori'])->get()->map(function ($item) {
            return [
                'peminjam'         => $item->nama_peminjam ?? '-',
                'nama_barang'      => $item->inventori->nama_barang ?? '-',
                'tanggal_pinjam'   => $item->tanggal_pinjam,
                'tanggal_kembali'  => $item->tanggal_kembali,
                'status'           => $item->status,
                'jumlah'           => $item->jumlah_pinjam,
                'catatan'          => $item->catatan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Nama Barang',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Jumlah',
            'Catatan',
        ];
    }
}
