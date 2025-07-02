@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    <h5 class="card-title fw-semibold mb-4">Tambah Inventori</h5>
                    @include('partdash.error')
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('inventori.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama
                                        Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang"
                                        value="{{ old('nama_barang') }}" class="form-control"
                                        placeholder="Masukkan nama barang" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_barang" class="form-label">Gambar
                                        Barang</label>
                                    <input type="file" name="gambar_barang" id="gambar_barang" class="form-control"
                                        accept="image/*">
                                </div>
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
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                                        class="form-control" placeholder="Masukkan jumlah" min="1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                                        class="form-control" placeholder="Masukkan lokasi" required>
                                </div>
                                <div>
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="" {{ old('status') == '' ? 'selected' : '' }} disabled>Pilih
                                            Status
                                        </option>
                                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                            Tersedia
                                        </option>
                                        <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>
                                            Dipinjam
                                        </option>
                                        <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak
                                        </option>
                                    </select>
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
