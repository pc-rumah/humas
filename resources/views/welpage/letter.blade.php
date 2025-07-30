<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter Request Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('landing/letters.css') }}">
</head>

<body>
    <!-- Header -->
    @include('partwelcome.header')

    <!-- Letters Section -->
    <section class="letters-section">
        <div class="container">
            <div class="letters-header">
                <h1>Manajemen Permintaan Dokumentasi</h1>
                <p>Permintaan dokumen resmi dengan pemrosesan otomatis</p>
            </div>

            <div class="letters-content">
                <!-- Request Letter Form -->
                <div class="request-form-container">
                    @if (session('success'))
                        <div class="alert alert-success fade-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Pesan Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger fade-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2>Permintaan Dokumentasi</h2>
                    <form class="request-form" id="letterForm" action="{{ route('letter.storeUser') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_pemohon">Nama Pemohon</label>
                            <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-input"
                                placeholder="Masukkan nama lengkap" value="{{ old('nama_pemohon') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-input"
                                placeholder="Masukkan nama kegiatan" value="{{ old('nama_kegiatan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="instansi">Bagian Kerja / Prodi</label>
                            <input type="text" name="instansi" id="instansi" class="form-input"
                                placeholder="Contoh: Teknik Informatika" value="{{ old('instansi') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_mulai_kegiatan">Tanggal Mulai Kegiatan</label>
                            <input type="date" name="tanggal_mulai_kegiatan" id="tanggal_mulai_kegiatan"
                                class="form-input" value="{{ old('tanggal_mulai_kegiatan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_selesai_kegiatan">Tanggal Selesai Kegiatan (Opsional)</label>
                            <input type="date" name="tanggal_selesai_kegiatan" id="tanggal_selesai_kegiatan"
                                class="form-input" value="{{ old('tanggal_selesai_kegiatan') }}">
                        </div>

                        <div class="form-group">
                            <label for="waktu_kegiatan">Waktu Mulai Kegiatan</label>
                            <input type="time" name="waktu_mulai_kegiatan" id="waktu_mulai_kegiatan"
                                class="form-input" value="{{ old('waktu_mulai_kegiatan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="waktu_selesai_kegiatan">Waktu Selesai Kegiatan</label>
                            <input type="text" name="waktu_selesai_kegiatan" id="waktu_selesai_kegiatan"
                                class="form-input" placeholder="Contoh: 10:00 atau selesai"
                                value="{{ old('waktu_selesai_kegiatan') }}">
                        </div>

                        <div class="form-group">
                            <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                            <input type="text" placeholder="contoh ruang sidang" name="lokasi_kegiatan"
                                id="lokasi_kegiatan" class="form-input" value="{{ old('lokasi_kegiatan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="detail_foto">Jenis Dokumentasi</label>
                            <select name="detail_foto" id="detail_foto" class="form-input" required>
                                <option value="">-- Pilih Dokumentasi --</option>
                                <option value="foto" {{ old('detail_foto') == 'foto' ? 'selected' : '' }}>Dokumentasi
                                    Foto</option>
                                <option value="foto & video"
                                    {{ old('detail_foto') == 'foto&video' ? 'selected' : '' }}>
                                    Dokumentasi Foto & Video</option>
                                <option value="foto, video & berita"
                                    {{ old('detail_foto') == 'foto,video&berita' ? 'selected' : '' }}>Dokumentasi Foto,
                                    Video & Berita</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="upload_surat">Upload Surat (MAX 20MB)
                                <h4 style="font-size: 12px; color:gray; font-weight: normal;">PNG, JPEG, PDF</h4>
                            </label>
                            <input type="file" name="upload_surat" id="upload_surat" class="form-input"
                                accept=".pdf,.doc,.docx,.jpg,.png" required>
                        </div>

                        <button type="submit" class="btn btn-primary submit-btn">Submit Permohonan</button>
                    </form>
                </div>

                <!-- Request History -->
                <div class="history-container">
                    <h2>Riwayat Permintaan Dokumentasi</h2>
                    <div class="history-list" id="historyList">
                        @forelse($letter as $item)
                            <div class="history-item">
                                <div class="history-item-details">
                                    <div class="detail-row">
                                        <span class="detail-label">Nama:</span>
                                        <span class="detail-value">{{ $item->nama_pemohon }}</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Tujuan:</span>
                                        <span class="detail-value">{{ $item->instansi }}</span>
                                    </div>
                                    <div class="date-info">
                                        <div class="date-row">
                                            <span class="date-icon">📅</span>
                                            <span>Tanggal Kegiatan:
                                                {{ \Carbon\Carbon::parse($item->tanggal_mulai_kegiatan)->format('d/m/Y') }}
                                                @isset($item->tanggal_selesai_kegiatan)
                                                    -
                                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai_kegiatan)->format('d/m/Y') }}
                                                @endisset
                                            </span>
                                        </div>
                                        <div class="date-row">
                                            <span class="date-icon">🕒</span>
                                            <span>Waktu Kegiatan
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $item->waktu_mulai_kegiatan)->format('H:i') }}
                                                -
                                                {{ $item->waktu_selesai_kegiatan }}</span>
                                        </div>
                                    </div>
                                    <div class="notes-section">
                                        <div class="notes-label">Lokasi Kegiatan</div>
                                        <div class="notes-text">{{ $item->lokasi_kegiatan }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-history">
                                <div class="empty-history-icon">📄</div>
                                <p>Tidak ada Item.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partwelcome.footer')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messages = document.querySelectorAll(".fade-message");

            messages.forEach(function(msg) {
                // Fade in
                setTimeout(() => msg.classList.add("show"), 100);

                // Fade out after 5 detik
                setTimeout(() => {
                    msg.classList.remove("show");
                    // Hapus elemen dari DOM setelah transisi selesai
                    setTimeout(() => msg.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>
