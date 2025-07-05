@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    <h3 class="card-title fw-semibold mb-4">Edit Kategori</h3>
                    @include('partdash.error')
                    <form action="{{ route('kategorinews.update', $kategorinews) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="nama" class="block font-medium mb-1">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama"
                                value="{{ $kategorinews->nama_kategori }}" class="input form-control input-bordered w-full"
                                placeholder="Masukkan nama kategori" required>
                            @error('nama_kategori')
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
