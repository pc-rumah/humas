<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('landing/news-agenda.css') }}">
</head>

<body>
    @include('partwelcome.header')

    <section class="news-agenda-section">
        <div class="container">
            <div class="page-header">
                <h1>Agenda</h1>
                <p>Informasi Liputan Agenda Humas</p>
            </div>

            <div class="">
                <div class="agenda-section">
                    <div class="section-header">
                        <h2>📅 Agenda Mendatang</h2>
                        <div class="filter-controls">
                            <form method="GET" action="/newsagenda">
                                <select name="filter" id="agendaFilter" class="filter-select"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Waktu</option>
                                    <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Minggu
                                        Ini</option>
                                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan
                                        Ini</option>
                                    <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>Tahun Ini
                                    </option>
                                </select>
                            </form>
                        </div>

                    </div>
                    <div class="agenda-grid" id="agendaGrid">
                        @forelse ($agenda as $item)
                            <div class="agenda-card">
                                <h3 class="agenda-title">{{ $item->nama_pemohon }}</h3>
                                <h3 class="agenda-title">✨ Kegiatan {{ $item->nama_kegiatan }}</h3>
                                <div class="agenda-details">
                                    <div class="agenda-detail">📅 Tanggal Mulai:
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai_kegiatan)->format('d F Y') }}
                                    </div>
                                    @isset($item->tanggal_selesai_kegiatan)
                                        <div class="agenda-detail">📅 Tanggal Selesai:
                                            {{ \Carbon\Carbon::parse($item->tanggal_selesai_kegiatan)->format('d F Y') }}
                                        </div>
                                    @endisset
                                    <div class="agenda-detail">⏰ Waktu Kegiatan: {{ $item->waktu_mulai_kegiatan }} -
                                        {{ $item->waktu_selesai_kegiatan }}
                                    </div>
                                    <div class="agenda-detail">📍 Lokasi Kegiatan: {{ $item->lokasi_kegiatan }}</div>
                                </div>
                                <div class="agenda-footer">
                                    <div class="agenda-organizer">Instansi: {{ $item->instansi }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-state-icon">📅</div>
                                <p>Tidak ada Agenda.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partwelcome.footer')
</body>

</html>
