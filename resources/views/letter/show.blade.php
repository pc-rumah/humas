@extends('dashboard')

@section('content')
    <div class="card w-100 shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3">
                Permohonan oleh {{ $letter->nama_pemohon }}
            </h5>

            <div class="row mb-3">
                <div class="col-6 mb-2">
                    <small class="text-muted">Nama Kegiatan</small>
                    <div class="fw-semibold">{{ $letter->nama_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Prodi / Instansi</small>
                    <div class="fw-semibold">{{ $letter->instansi }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Tanggal Mulai Kegiatan</small>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($letter->tanggal_mulai_kegiatan)->format('d F Y') }}
                    </div>
                </div>
                @isset($letter->tanggal_selesai_kegiatan)
                    <div class="col-6 mb-2">
                        <small class="text-muted">Tanggal Selesai Kegiatan</small>
                        <div class="fw-semibold">
                            {{ \Carbon\Carbon::parse($letter->tanggal_selesai_kegiatan)->format('d F Y') }}
                        </div>
                    </div>
                @endisset
                <div class="col-6 mb-2">
                    <small class="text-muted">Status</small>
                    <div>
                        @switch($letter->status)
                            @case('menunggu')
                                <span class="badge bg-warning text-dark text-capitalize">{{ $letter->status }}</span>
                            @break

                            @case('disetujui')
                                <span class="badge bg-success text-dark text-capitalize">{{ $letter->status }}</span>
                            @break

                            @default
                                <span class="badge bg-secondary text-white">{{ $letter->status }}</span>
                        @endswitch
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Waktu Mulai Kegiatan</small>
                    <div class="fw-semibold">{{ $letter->waktu_mulai_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Waktu Selesai Kegiatan</small>
                    <div class="fw-semibold">{{ $letter->waktu_selesai_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Lokasi Kegiatan</small>
                    <div class="fw-semibold">{{ $letter->lokasi_kegiatan }}</div>
                </div>
                <div class="col-6 mb-2">
                    <small class="text-muted">Jenis Dokumentasi</small>
                    <div class="fw-semibold">{{ $letter->detail_foto }}</div>
                </div>
                @if (isset($letter->upload_surat))
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $letter->upload_surat) }}" alt="dokumen" class="img-thumbnail"
                            style="max-width: 200px;">
                        <div class="text-muted small mt-1">Dokumen Pendukung</div>
                    </div>
                @endif
                <form action="{{ route('letter.update', $letter->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="menunggu" value="menunggu"
                            {{ $letter->status == 'menunggu' ? 'checked' : '' }}>
                        <label class="form-check-label" for="menunggu">Menunggu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="disetujui" value="disetujui"
                            {{ $letter->status == 'disetujui' ? 'checked' : '' }}>
                        <label class="form-check-label" for="disetujui">Disetujui</label>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm ms-2">Update Status</button>
                </form>

            </div>
        </div>
    </div>
@endsection
