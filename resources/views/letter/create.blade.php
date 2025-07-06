@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    <h5 class="card-title fw-semibold mb-4">Tambah Surat</h5>
                    @include('partdash.error')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('letter.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama_pemohon" class="form-label">Nama Pemohon</label>
                                    <input type="text" name="nama_pemohon" id="nama_pemohon"
                                        value="{{ old('nama_pemohon') }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="instansi" class="form-label">Instansi</label>
                                    <input type="text" name="instansi" id="instansi" value="{{ old('instansi') }}"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                                        value="{{ old('tanggal_kegiatan') }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" name="waktu_mulai" id="waktu_mulai"
                                        value="{{ old('waktu_mulai') }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                    <input type="text" name="waktu_selesai" id="waktu_selesai"
                                        value="{{ old('waktu_selesai') }}" class="form-control"
                                        placeholder="Contoh: 12:30 atau selesai" required>
                                </div>

                                <div class="mb-3">
                                    <label for="dokumentasi" class="form-label">Dokumentasi</label>
                                    <input type="file" name="dokumentasi" id="dokumentasi" class="form-control"
                                        accept="image/*" required>
                                </div>

                                <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
