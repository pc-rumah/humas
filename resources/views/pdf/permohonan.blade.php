<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Permohonan Kegiatan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px;
        }
    </style>
</head>

<body>
    <h2>Surat Permohonan Kegiatan</h2>
    <table>
        <tr>
            <td><strong>Nama Pemohon</strong></td>
            <td>{{ $permohonan->nama_pemohon }}</td>
        </tr>
        <tr>
            <td><strong>Bagian Kerja / Prodi</strong></td>
            <td>{{ $permohonan->bagian_kerja }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Kegiatan</strong></td>
            <td>{{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td><strong>Waktu Kegiatan</strong></td>
            <td>{{ $permohonan->waktu_kegiatan }}</td>
        </tr>
        <tr>
            <td><strong>Lokasi Kegiatan</strong></td>
            <td>{{ $permohonan->lokasi_kegiatan }}</td>
        </tr>
    </table>
    <p>Demikian surat permohonan ini dibuat untuk digunakan sebagaimana mestinya.</p>
</body>

</html>
