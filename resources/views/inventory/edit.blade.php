@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <h5>Edit Barang</h5>
                <div class="card-body p-4 overflow-x-auto">
                    @include('partdash.error')
                    <form action="{{ route('inventori.update', $inventori) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                        @csrf
                        @method('PUT')
                        <p><strong>Kode Barang:</strong> {{ $inventori->kode_barang }}</p>
                        <div class="mb-2">
                            <label for="nama_barang" class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Nama
                                Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" value="{{ $inventori->nama_barang }}"
                                class="input form-control input-bordered w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Masukkan nama barang" required>
                        </div>
                        <div class="mb-2">
                            <label for="gambar_barang"
                                class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Gambar Barang</label>
                            @isset($inventori->gambar_barang)
                                <img style="max-width: 20%" src="{{ asset('storage/' . $inventori->gambar_barang) }}"
                                    alt="" srcset="">
                            @endisset
                            <input type="file" name="gambar_barang" id="gambar_barang"
                                class="input form-control mt-2 w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                accept="image/*">
                        </div>
                        <div class="mb-2">
                            <label for="kategori"
                                class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Kategori</label>
                            <select name="kategori_id" id="kategori"
                                class="select form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="" disabled
                                    {{ old('kategori_id', $inventori->kategori_id) == '' ? 'selected' : '' }}>
                                    Pilih Kategori
                                </option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_id', $inventori->kategori_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jumlah"
                                class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" value="{{ $inventori->jumlah }}"
                                class="input form-control input-bordered w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Masukkan jumlah" min="1" required>
                        </div>
                        <div class="mb-2">
                            <label for="lokasi"
                                class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" value="{{ $inventori->lokasi }}"
                                class="input form-control input-bordered w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Masukkan lokasi" required>
                        </div>
                        <div>
                            <label for="status"
                                class="block font-medium mb-1 text-gray-700 dark:text-gray-200">Status</label>
                            <select name="status" id="status"
                                class="select form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="" disabled
                                    {{ old('status', $inventori->status) == '' ? 'selected' : '' }}>Pilih Status</option>
                                <option value="tersedia"
                                    {{ old('status', $inventori->status) == 'tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="dipinjam"
                                    {{ old('status', $inventori->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam
                                </option>
                                <option value="rusak"
                                    {{ old('status', $inventori->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>

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
