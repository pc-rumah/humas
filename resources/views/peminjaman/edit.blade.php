@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    @include('partdash.error')
                    <h5>Tambah peminjaman barang</h5>
                    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <p><strong>Barang:</strong> {{ $peminjaman->inventori->nama_barang }}</p>
                        <p><strong>Jumlah Pinjam:</strong> {{ $peminjaman->jumlah_pinjam }}</p>

                        <div class="mb-2">
                            <label for="tanggal_pinjam" class="block font-medium mb-1">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('tanggal_pinjam', \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d')) }}"
                                required>
                        </div>

                        <div class="mb-2">
                            <label for="tanggal_kembali" class="block font-medium mb-1">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('tanggal_kembali', \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('Y-m-d')) }}"
                                required>
                        </div>

                        <div class="mb-2">
                            <label for="status" class="block font-medium mb-1">Status</label>
                            <select name="status" id="status"
                                class="select form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="dikembalikan">Dikembalikan
                                </option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="catatan" class="block font-medium mb-1">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Tulis catatan jika ada...">{{ $peminjaman->catatan }}</textarea>
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
