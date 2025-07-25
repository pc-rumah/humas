<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Peminjam</th>
                <th>Nama Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Tujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                {{-- Melakukan iterasi (perulangan) untuk setiap data dalam variabel $peminjaman. --}}
                @php
                    $barangList = json_decode($item->barang_dipinjam, true); // mengubah string json menjadi array
                    $daftarBarang = collect($barangList)
                        ->map(function ($barang) {
                            $inventori = \App\Models\Inventory::find($barang['inventori_id']);
                            return ($inventori->nama_barang ?? 'Barang Tidak Ditemukan') .
                                ' (' .
                                $barang['jumlah_pinjam'] .
                                ')';
                        })
                        ->implode(', ');
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $daftarBarang }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->tujuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
