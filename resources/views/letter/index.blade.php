@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            {{-- <a class="btn btn-primary m-1" href="{{ route('letter.create') }}">Tambah Surat</a> --}}
            @include('partdash.alert')
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">#</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Instansi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Waktu</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Lokasi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Detail</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($letter->isEmpty())
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Belum ada data</h6>
                            </td>
                        @else
                            @foreach ($letter as $item)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0 align-middle">
                                        <h6 class="fw-semibold mb-1">{{ $item->nama_pemohon }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->instansi }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d-m-Y') }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->waktu_kegiatan }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->lokasi_kegiatan }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->detail_foto }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex gap-2">
                                            {{-- <a href="{{ route('news.edit', $item) }}"
                                                class="btn btn-warning btn-sm">Edit</a> --}}
                                            @if ($item->upload_surat)
                                                <a href="{{ route('letter.download', $item->id) }}"
                                                    class="btn btn-success btn-sm" target="_blank">
                                                    Download Surat
                                                </a>
                                            @else
                                                <p>Tidak ada surat yang diupload.</p>
                                            @endif

                                            {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-url="{{ route('news.destroy', $item->id) }}"
                                                data-bs-target="#alert-hapus">Hapus</button> --}}
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
