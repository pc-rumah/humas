@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    <h5 class="card-title fw-semibold mb-4">Tambah peminjaman barang</h5>
                    @include('partdash.error')
                    <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="mb-2">
                            <label for="inventori_id" class="block font-medium mb-1">Barang Inventori</label>
                            <select name="inventori_id" id="inventori_id"
                                class="select form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="" disabled {{ old('inventori_id') ? '' : 'selected' }}>Pilih Barang
                                </option>
                                @foreach ($inventori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('inventori_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_barang }} (Stok = {{ $item->jumlah }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="tanggal_pinjam" class="block font-medium mb-1">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('tanggal_pinjam') }}" required>
                        </div>

                        <div class="mb-2">
                            <label for="tanggal_kembali" class="block font-medium mb-1">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('tanggal_kembali') }}" required>
                        </div>

                        <div class="mb-2">
                            <label for="jumlah" class="block font-medium mb-1">Jumlah Pinjam</label>
                            <input type="number" name="jumlah_pinjam" id="jumlah" min="1"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('jumlah') }}" required>
                        </div>


                        <div class="mb-2">
                            <label for="catatan" class="block font-medium mb-1">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Tulis catatan jika ada...">{{ old('catatan') }}</textarea>
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
