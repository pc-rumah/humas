@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <h3>Edit Kategori</h3>
                <div class="card-body p-4 overflow-x-auto">
                    @include('partdash.error')
                    <form action="{{ route('kategori.update', $kategori) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="nama" class="block font-medium mb-1">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama" value="{{ $kategori->nama_kategori }}"
                                class="input form-control input-bordered w-full" placeholder="Masukkan nama kategori"
                                required>
                            @error('nama_kategori')
                                <p class="text-error text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kode" class="block font-medium mb-1">Kode Kategori</label>
                            <input type="text" name="kode_kategori" id="kode" value="{{ $kategori->kode_kategori }}"
                                class="input form-control input-bordered w-full" placeholder="Masukkan kode kategori"
                                required>
                            @error('kode_kategori')
                                <p class="text-error text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
