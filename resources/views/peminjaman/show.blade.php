@extends('dashboard')

@section('content')
    <div class="card w-100 shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3">
                Peminjaman oleh {{ $peminjaman->nama_peminjam }}
            </h5>

            <div class="row mb-3">
                <div class="col-6 mb-2">
                    <small class="text-muted">Nama Barang</small>
                    <div class="fw-semibold">{{ $peminjaman->inventori->nama_barang }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Nama Kegiatan</small>
                    <div class="fw-semibold">{{ $peminjaman->nama_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">No Telp</small>
                    <div class="fw-semibold">{{ $peminjaman->no_telp }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Email</small>
                    <div class="fw-semibold">{{ $peminjaman->email }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Tanggal Pinjam</small>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d F Y') }}
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Tanggal Kembali</small>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d F Y') }}
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Status</small>
                    <div>
                        @switch($peminjaman->status)
                            @case('menunggu')
                                <span class="badge bg-warning text-dark text-capitalize">{{ $peminjaman->status }}</span>
                            @break

                            @case('disetujui')
                                <span class="badge bg-success text-dark text-capitalize">{{ $peminjaman->status }}</span>
                            @break

                            @case('dikembalikan')
                                <span class="badge bg-primary text-white text-capitalize">{{ $peminjaman->status }}</span>
                            @break

                            @default
                                <span class="badge bg-secondary text-white">{{ $peminjaman->status }}</span>
                        @endswitch
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Jumlah</small>
                    <div class="fw-semibold">{{ $peminjaman->jumlah_pinjam }}</div>
                </div>
                <div class="col-12 mb-2">
                    <small class="text-muted">Catatan</small>
                    <div class="fw-semibold">{{ $peminjaman->tujuan }}</div>
                </div>
                @if (isset($peminjaman->ktm))
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $peminjaman->ktm) }}" alt="KTM" class="img-thumbnail"
                            style="max-width: 200px;">
                        <div class="text-muted small mt-1">KTM</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
