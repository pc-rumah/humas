@extends('dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card bg-base-100 shadow">
                <div class="card-header p-4 border-b border-base-200">
                    <div class="flex flex-col w-full gap-2">

                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold">Daftar Kategori</h2>
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
                        </div>

                        @include('partdash.alert')
                    </div>
                </div>

                <div class="card-body p-4 overflow-x-auto">
                    <table class="table w-full table-zebra">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Kode Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $kategori)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->kode_kategori }}</td>
                                    <td class="flex gap-2">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>

                                        <button class="btn btn-sm btn-danger btn-delete"
                                            data-url="{{ route('kategori.destroy', $kategori->id) }}"
                                            data-message="Yakin ingin menghapus kategori '{{ $kategori->nama_kategori }}'?">
                                            Hapus
                                        </button>

                                        @include('partdash.modal')
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
