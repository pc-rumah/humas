@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    <h5 class="card-title fw-semibold mb-4">Tambah Agenda</h5>
                    @include('partdash.error')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('agenda.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori_id" id="kategori" class="form-control" required>
                                        <option value="" disabled {{ old('kategori') == '' ? 'selected' : '' }}>Pilih
                                            Kategori
                                        </option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kategori') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_upload" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal_upload" id="tanggal_upload"
                                        value="{{ old('tanggal_upload') }}" class="form-control"
                                        placeholder="Masukkan lokasi" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Waktu Mulai</label>
                                    <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Waktu Selesai</label>
                                    <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai') }}"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Diselenggarakan Oleh</label>
                                    <input type="text" name="organized" value="{{ old('organized') }}"
                                        class="form-control" required>
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
