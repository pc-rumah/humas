@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Peminjaman oleh {{ $peminjaman->nama_peminjam }}</h5>
                            <p class="mb-2"><strong>Nama Barang:</strong> {{ $peminjaman->inventori->nama_barang }}</p>
                            <p class="mb-2"><strong>Nama Kegiatan:</strong> {{ $peminjaman->nama_kegiatan }}</p>
                            <p class="mb-2"><strong>Tanggal Pinjam:</strong>
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</p>
                            <p class="mb-2"><strong>Tanggal Kembali:</strong>
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}</p>
                            <p class="mb-2"><strong>Status:</strong> {{ $peminjaman->status }}</p>
                            <p class="mb-2"><strong>Jumlah:</strong> {{ $peminjaman->jumlah_pinjam }}</p>
                            <p class="mb-0"><strong>Catatan:</strong> {{ $peminjaman->tujuan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
