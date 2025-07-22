@extends('dashboard')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            {{-- <a class="btn btn-primary m-1" href="{{ route('peminjaman.create') }}">Peminjaman</a> --}}
            <a class="btn btn-secondary m-1" href="{{ route('peminjaman.export') }}">Export PDF</a>
            <a class="btn btn-warning m-1" href="{{ route('peminjaman.export.excel') }}">Export EXCEL</a>
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">-- Status --</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                            Dikembalikan
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="from" value="{{ request('from') }}" class="form-control"
                        placeholder="Dari Tanggal">
                </div>
                <div class="col-md-2">
                    <input type="date" name="to" value="{{ request('to') }}" class="form-control"
                        placeholder="Sampai Tanggal">
                </div>
                <div class="col-md-3">
                    <input type="text" name="barang" value="{{ request('barang') }}" class="form-control"
                        placeholder="Nama Barang">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary">Filter</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
            @include('partdash.alert')
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">#</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Peminjam</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Barang</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Kegiatan</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Pinjam</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Kembali</h6>

                                @if (Auth::user()->hasRole('admin'))
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Belum ada data</h6>
                            </td>
                        @else
                            @foreach ($data as $item)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->nama_peminjam }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            @foreach (json_decode($item->barang_dipinjam, true) as $barang)
                                                <div>
                                                    {{ $inventoriMap[$barang['inventori_id']]->nama_barang ?? 'Barang tidak ditemukan' }}
                                                    ({{ $barang['jumlah_pinjam'] }})
                                                </div>
                                            @endforeach
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $item->nama_kegiatan }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('peminjaman.show', $item) }}"
                                                class="btn btn-warning btn-sm">Detail</a>
                                            @if (Auth::user()->hasRole('admin'))
                                                @if ($item->status != 'dikembalikan')
                                                    <a href="{{ route('peminjaman.edit', $item) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                @else
                                                    <button class="btn btn-warning btn-sm" disabled>Edit</button>
                                                @endif

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-url="{{ route('peminjaman.destroy', $item->id) }}"
                                                    data-bs-target="#alert-hapus">Hapus</button>
                                            @endif
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
