<p>Yth. {{ $peminjaman->nama_peminjam }},</p>

<p>Dengan hormat,
    Saya Fajar Taufik Romandhoni dari Tim Humas Universitas Ngudi Waluyo ingin menginformasikan bahwa permohonan
    peminjaman alat serta permintaan dokumentasi yang telah diajukan telah disetujui.
</p>

<p>
    Kami akan mendukung sepenuhnya pelaksanaan kegiatan tersebut sesuai kebutuhan yang telah disampaikan. Silakan
    menghubungi kami lebih lanjut apabila ada hal-hal teknis yang perlu dikoordinasikan.
</p>

<p>
    Permohonan peminjaman alat <strong>{{ $peminjaman->inventori->nama_barang }}</strong> sejumlah
    {{ $peminjaman->jumlah_pinjam }} unit telah <strong>disetujui</strong>.
</p>

<p>Silakan hubungi kami jika ada pertanyaan lebih lanjut.</p>

<p>Hormat kami, Fajar Taufik Romandhoni<br>
    Tim Humas Universitas Ngudi Waluyo</p>
