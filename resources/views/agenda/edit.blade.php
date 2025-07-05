@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    <h5 class="card-title fw-semibold mb-4">Edit Barang</h5>
                    @include('partdash.error')
                    <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                            <br>
                            <img style="max-width: 20%" src="{{ asset('storage/' . $news->gambar) }}" alt="gambar">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori_id" id="kategori" class="form-control" required>
                                <option value="" disabled
                                    {{ old('kategori_id', $news->kategorinews_id) == '' ? 'selected' : '' }}>Pilih Kategori
                                </option>
                                @foreach ($kategorinews as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_id', $news->kategorinews_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" value="{{ $news->judul }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" required>{{ $news->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                            <input type="date" name="tanggal_upload" id="tanggal_upload"
                                value="{{ $news->tanggal_upload }}" class="form-control" required>
                        </div>
                        <div>
                            <button type="submit"
                                class="btn btn-primary mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
