<p>Yth. {{ $peminjaman->nama_peminjam }},</p>

<p>Dengan hormat,<br>
    Saya Fajar Taufik Romandhoni dari Tim Humas Universitas Ngudi Waluyo ingin menginformasikan bahwa permohonan
    peminjaman alat serta permintaan dokumentasi yang telah diajukan telah disetujui.
</p>

<p>
    Kami akan mendukung sepenuhnya pelaksanaan kegiatan tersebut sesuai kebutuhan yang telah disampaikan. Silakan
    menghubungi kami lebih lanjut apabila ada hal-hal teknis yang perlu dikoordinasikan.
</p>

<p>Permohonan peminjaman alat berikut telah <strong>disetujui</strong>:</p>

<ul>
    @php
        $barangList = json_decode($peminjaman->barang_dipinjam, true);
        $inventoriMap = \App\Models\Inventory::all()->keyBy('id');
    @endphp

    @foreach ($barangList as $barang)
        <li>
            {{ $inventoriMap[$barang['inventori_id']]->nama_barang ?? 'Barang tidak ditemukan' }} -
            {{ $barang['jumlah_pinjam'] }} unit
        </li>
    @endforeach
</ul>

<p>Silakan hubungi kami jika ada pertanyaan lebih lanjut.</p>

<p>Hormat kami,<br>
    Fajar Taufik Romandhoni<br>
    Tim Humas Universitas Ngudi Waluyo</p>
