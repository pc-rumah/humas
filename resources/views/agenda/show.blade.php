@extends('dashboard')

@section('content')
    <div class="card w-100 shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3">
                Permohonan oleh {{ $agenda->nama_pemohon }}
            </h5>

            <div class="row mb-3">
                <div class="col-6 mb-2">
                    <small class="text-muted">Nama Kegiatan</small>
                    <div class="fw-semibold">{{ $agenda->nama_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">No Telp</small>
                    <div class="fw-semibold">{{ $agenda->instansi }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Tanggal Pinjam</small>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($agenda->tanggal_mulai_kegiatan)->format('d F Y') }}
                    </div>
                </div>
                @isset($agenda->tanggal_selesai_pinjam)
                    <div class="col-6 mb-2">
                        <small class="text-muted">Tanggal Kembali</small>
                        <div class="fw-semibold">
                            {{ \Carbon\Carbon::parse($agenda->tanggal_selesai_kegiatan)->format('d F Y') }}
                        </div>
                    </div>
                @endisset
                <div class="col-6 mb-2">
                    <small class="text-muted">Status</small>
                    <div>
                        @switch($agenda->status)
                            @case('menunggu')
                                <span class="badge bg-warning text-dark text-capitalize">{{ $agenda->status }}</span>
                            @break

                            @case('disetujui')
                                <span class="badge bg-success text-dark text-capitalize">{{ $agenda->status }}</span>
                            @break

                            @default
                                <span class="badge bg-secondary text-white">{{ $agenda->status }}</span>
                        @endswitch
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Waktu Mulai Kegiatan</small>
                    <div class="fw-semibold">{{ $agenda->waktu_mulai_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Waktu Selesai Kegiatan</small>
                    <div class="fw-semibold">{{ $agenda->waktu_selesai_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Lokasi Kegiatan</small>
                    <div class="fw-semibold">{{ $agenda->lokasi_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Jenis Dokumentasi</small>
                    <div class="fw-semibold">{{ $agenda->detail_foto }}</div>
                </div>
                @if (isset($agenda->upload_surat))
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $agenda->upload_surat) }}" alt="dokumen" class="img-thumbnail"
                            style="max-width: 200px;">
                        <div class="text-muted small mt-1">Dokumen Pendukung</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
