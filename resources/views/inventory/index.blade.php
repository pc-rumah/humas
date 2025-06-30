@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-header p-4 border-b border-base-200">
                    <div class="flex flex-col w-full gap-2">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold">Daftar Barang</h2>
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('inventori.index') }}" method="GET"
                                    class="flex items-center space-x-2">
                                    <input type="text" name="search" placeholder="Cari nama barang..."
                                        value="{{ request('search') }}" class="input form-control input-sm" />
                                    <button type="submit" class="btn btn-sm btn-secondary">Cari</button>
                                    <a href="{{ route('inventori.index') }}" class="btn btn-info btn-sm">Reset</a>
                                </form>

                                <a href="{{ route('inventori.create') }}" class="btn btn-primary btn-sm">Tambah Barang</a>
                            </div>
                        </div>
                        @include('partdash.alert')
                    </div>
                </div>

                <div class="card-body p-4 overflow-x-auto">
                    <table class="table w-full table-zebra">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Gambar Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $inventori)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $inventori->kode_barang }}</td>
                                    <td>{{ $inventori->nama_barang }}</td>
                                    <td class="flex items-center">
                                        @if (isset($inventori->gambar_barang))
                                            <img src="{{ asset('storage/' . $inventori->gambar_barang) }}"
                                                alt="gambar barang" class="w-20 h-20 object-cover rounded" />
                                        @endif
                                    </td>
                                    <td>{{ $inventori->kategori->nama_kategori }}</td>
                                    <td>{{ $inventori->jumlah }}</td>
                                    <td>{{ $inventori->lokasi }}</td>
                                    <td>
                                        @if ($inventori->status == 'tersedia')
                                            <h5 class="text-md text-green-500">{{ ucfirst($inventori->status) }}</h5>
                                        @elseif ($invetori->status == 'dipinjam')
                                            <h5 class="text-md text-yellow-500">{{ ucfirst($inventori->status) }}</h5>
                                        @elseif ($inventori->status == 'rusak')
                                            <h5 class="text md text-red-500">{{ ucfirst($inventori->status) }}</h5>
                                        @endif
                                    </td>
                                    <td class="">
                                        <a href="{{ route('inventori.edit', $inventori->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>

                                        <button class="btn btn-sm btn-danger btn-delete"
                                            data-url="{{ route('inventori.destroy', $inventori->id) }}"
                                            data-message="Yakin ingin menghapus data ini?">
                                            Hapus
                                        </button>

                                        @include('partdash.modal')
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada Data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
