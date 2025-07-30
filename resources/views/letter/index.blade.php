@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <h5>List Permohonan</h5>
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
                                <h6 class="fw-semibold mb-0">Nama Kegiatan</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Instansi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Waktu</h6>
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
                                    <td class="border-bottom-0 align-middle">
                                        <h6 class="fw-semibold mb-1">{{ $item->nama_kegiatan }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->instansi }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        @if ($item->status === 'menunggu')
                                            <h6 class="fw-semibold mb-1 text-warning">{{ $item->status }}</h6>
                                        @elseif ($item->status === 'disetujui')
                                            <h6 class="fw-semibold mb-1 text-success">{{ $item->status }}</h6>
                                        @endif
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            {{ \Carbon\Carbon::createFromFormat('H:i', $item->waktu_mulai_kegiatan)->format('H:i') }}
                                            -
                                            {{ $item->waktu_selesai_kegiatan }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('letter.show', $item) }}"
                                                class="btn btn-warning btn-sm">Detail</a>
                                            @if ($item->upload_surat)
                                                <a href="{{ route('letter.download', $item->id) }}"
                                                    class="btn btn-success btn-sm" target="_blank">
                                                    Download
                                                </a>
                                            @else
                                                <p>Tidak ada permohonan yang diupload.</p>
                                            @endif
                                        </div>
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
