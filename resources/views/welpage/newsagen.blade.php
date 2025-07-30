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
                            <select id="agendaFilter" class="filter-select">
                                <option value="">Filter</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"> {{ $item->nama_kategori }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="agenda-grid" id="agendaGrid">
                        @forelse ($agenda as $item)
                            <div class="agenda-card {{ strtolower($item->kategorinews->nama_kategori) }}">
                                <div class="agenda-header">
                                    <span
                                        class="agenda-type {{ strtolower($item->kategorinews->nama_kategori) }}">{{ $item->kategorinews->nama_kategori }}</span>
                                </div>
                                <h3 class="agenda-title">{{ $item->judul }}</h3>
                                <p class="agenda-description">{{ $item->deskripsi }}</p>
                                <div class="agenda-details">
                                    <div class="agenda-detail">📅
                                        {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans(null, false, true) }}
                                    </div>
                                    <div class="agenda-detail">⏰ {{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}
                                    </div>
                                    <div class="agenda-detail">📍 {{ $item->lokasi }}</div>
                                </div>
                                <div class="agenda-footer">
                                    <div class="agenda-organizer">👤 Organized by {{ $item->organized }}</div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agendaFilter = document.getElementById('agendaFilter');
            const agendaItems = document.querySelectorAll('#agendaGrid .agenda-card');

            agendaFilter.addEventListener('change', function() {
                const selected = this.value;
                agendaItems.forEach(item => {
                    if (selected === '') {
                        item.style.display = 'block';
                    } else {
                        const categorySpan = item.querySelector('.agenda-type');
                        if (categorySpan && categorySpan.textContent.trim() == getCategoryNameById(
                                selected)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    }
                });
            });

            const kategoriMap = {
                @foreach ($kategori as $item)
                    "{{ $item->id }}": "{{ $item->nama_kategori }}",
                @endforeach
            };

            function getCategoryNameById(id) {
                return kategoriMap[id] || '';
            }
        });
    </script>

</body>

</html>
