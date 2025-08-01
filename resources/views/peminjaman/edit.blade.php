@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4 overflow-x-auto">
                    @include('partdash.error')
                    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <p><strong>Peminjam:</strong> {{ $peminjaman->nama_peminjam }}</p>
                        <p><strong>Barang:</strong> @php
                            $barangList = json_decode($peminjaman->barang_dipinjam, true);
                            $inventoriMap = \App\Models\Inventory::all()->keyBy('id');
                        @endphp

                            @foreach ($barangList as $barang)
                                <li>
                                    {{ $inventoriMap[$barang['inventori_id']]->nama_barang ?? 'Barang tidak ditemukan' }} -
                                    {{ $barang['jumlah_pinjam'] }} unit
                                </li>
                            @endforeach
                        </p>

                        <div class="mb-2">
                            <label for="status" class="block font-medium mb-1">Status</label>
                            <select name="status" id="status"
                                class="form-control w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="menunggu" {{ $peminjaman->status == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="disetujui" {{ $peminjaman->status == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>
                                    Dikembalikan</option>
                                <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
