@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <a class="btn btn-primary m-1" href="{{ route('kategori.create') }}">Tambah Kategori</a>
            @include('partdash.alert')
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">#</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Kategori</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Kode Kategori</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kategori->isEmpty())
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Kategori Belum Ada</h6>
                            </td>
                        @else
                            @foreach ($kategori as $item)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->nama_kategori }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->kode_kategori }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('kategori.edit', $item) }}"
                                            class="btn btn-warning btn-sm me-1">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-url="{{ route('kategori.destroy', $item->id) }}"
                                            data-bs-target="#alert-hapus">Hapus</button>
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
