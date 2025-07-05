@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <a class="btn btn-primary m-1" href="{{ route('news.create') }}">Tambah Berita</a>
            @include('partdash.alert')
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">#</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Gambar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Kategori</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Judul</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Deskripsi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Upload</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">User</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($news->isEmpty())
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Belum ada data</h6>
                            </td>
                        @else
                            @foreach ($news as $item)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <img style="width: 80px; height: auto; margin-right: 10px;"
                                            src="{{ asset('storage/' . $item->gambar) }}" alt="gambar">
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->kategorinews->nama_kategori }}</h6>
                                    </td>
                                    <td class="border-bottom-0 align-middle">
                                        <h6 class="fw-semibold mb-1">{{ $item->judul }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->deskripsi }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d-m-Y') }}</h6>
                                    </td>

                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->user->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('news.edit', $item) }}"
                                                class="btn btn-warning btn-sm">Edit</a>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-url="{{ route('news.destroy', $item->id) }}"
                                                data-bs-target="#alert-hapus">Hapus</button>
                                        </div>

                                        @include('partdash.modal')
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
