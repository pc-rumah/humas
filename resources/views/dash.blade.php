<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('dash/assets/images/logos/favicon.webp') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('partdash.sidebar')

        <div class="body-wrapper">
            @include('partdash.header')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
                            style="background-color: #ebebeb; color: rgb(0, 0, 0);">
                            <div>
                                <h4 class="text-black-50">Jumlah Barang</h4>
                                <h4 class="fw-bold mb-0">{{ $total }}</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                style="background-color: rgba(255, 0, 0, 0.989); width: 50px; height: 50px;">
                                <i class="fa-solid fa-boxes-stacked" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
                            style="background-color: #ebebeb; color: rgb(0, 0, 0);">
                            <div>
                                <h4 class="text-black-50">Peminjaman</h4>
                                <h4 class="fw-bold mb-0">{{ $totalp }}</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                style="background-color: rgba(117, 212, 131, 0.989); width: 50px; height: 50px;">
                                <i class="fa-solid fa-hand-holding-heart" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="card rounded-3 p-3 d-flex flex-row align-items-center justify-content-between"
                            style="background-color: #ebebeb; color: rgb(0, 0, 0);">
                            <div>
                                <h4 class="text-black-50">Permohonan</h4>
                                <h4 class="fw-bold mb-0">{{ $totals }}</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                style="background-color: rgba(179, 210, 255, 0.989); width: 50px; height: 50px;">
                                <i class="fa-regular fa-handshake" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                    <div class="mb-3 mb-sm-0">
                                        <h5 class="card-title fw-semibold">Grafik Barang</h5>
                                    </div>
                                </div>
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Pengajuan Peminjaman</h5>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Id</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama Kegiatan</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">No HP</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Email</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nama Barang</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Jumlah</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($peminjaman as $item)
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1">{{ $item->nama_peminjam }}</h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">{{ $item->nama_kegiatan }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"> {{ $item->no_telp }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"> {{ $item->email }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-primary rounded-3 fw-semibold">
                                                                {{ $item->status }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        @php
                                                            $barangList = json_decode($item->barang_dipinjam, true);
                                                        @endphp
                                                        <ul class="mb-0 ps-3">
                                                            @foreach ($barangList as $barang)
                                                                @php
                                                                    $inventori = \App\Models\Inventory::find(
                                                                        $barang['inventori_id'],
                                                                    );
                                                                @endphp
                                                                <li>{{ $inventori->nama_barang ?? 'Barang tidak ditemukan' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <ul class="mb-0 ps-3">
                                                            @foreach ($barangList as $barang)
                                                                <li>{{ $barang['jumlah_pinjam'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <h4 class="text-center">Tidak ada data</h4>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4">Permohonan Dokumentasi</h5>
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
                                                    <h6 class="fw-semibold mb-0">Liputan</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Tanggal Mulai Kegiatan</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Waktu Mulai Kegiatan</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($surat as $item)
                                                <tr style="border-bottom: 1px solid #000;">
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1">{{ $item->nama_pemohon }}</h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"> {{ $item->nama_kegiatan }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"> {{ $item->instansi }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"> {{ $item->detail_foto }}</p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                            {{ \Carbon\Carbon::parse($item->tanggal_mulai_kegiatan)->format('d F Y') }}
                                                        </p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"> {{ $item->waktu_mulai_kegiatan }}
                                                        </p>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <h4 class="text-center">Tidak ada data</h4>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dash/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dash/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dash/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dash/assets/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('dash/assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/chart-data')
                .then(response => response.json())
                .then(data => {
                    var options = {
                        chart: {
                            type: 'bar',
                            height: 400
                        },
                        series: [{
                            name: 'Jumlah',
                            data: data.data
                        }],
                        xaxis: {
                            categories: data.labels
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                });
        });
    </script>
</body>

</html>
