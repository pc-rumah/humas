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
                <h1>Letter Request Management</h1>
                <p>Request official letters and documents with automated processing</p>
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
                    <h2>Request Letter</h2>
                    <form class="request-form" id="letterForm" action="{{ route('letter.storeUser') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_pemohon">Nama Pemohon</label>
                            <input type="text" name="nama_pemohon" id="nama_pemohon" class="form-input"
                                placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="form-group">
                            <label for="instansi">Bagian Kerja / Prodi</label>
                            <input type="text" name="instansi" id="instansi" class="form-input"
                                placeholder="Contoh: Teknik Informatika" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                            <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-input"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="waktu_kegiatan">Waktu Kegiatan</label>
                            <input type="text" name="waktu_kegiatan" id="waktu_kegiatan" class="form-input"
                                placeholder="Contoh: 08:00 - 12:00" required>
                        </div>

                        <div class="form-group">
                            <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi_kegiatan" id="lokasi_kegiatan" class="form-input"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="detail_foto">Detail Dokumentasi</label>
                            <input type="text" name="detail_foto" id="detail_foto" class="form-input"
                                placeholder="Deskripsi foto kegiatan" required>
                        </div>

                        <div class="form-group">
                            <label for="upload_surat">Upload Surat (opsional)</label>
                            <input type="file" name="upload_surat" id="upload_surat" class="form-input"
                                accept=".pdf,.doc,.docx,.jpg,.png">
                        </div>

                        <button type="submit" class="btn btn-primary submit-btn">Submit Permohonan</button>
                    </form>

                </div>

                <!-- Request History -->
                <div class="history-container">
                    <h2>Request History</h2>
                    <div class="history-list" id="historyList">
                        @forelse($letter as $item)
                            <div class="history-item">
                                <div class="history-item-details">
                                    <div class="detail-row">
                                        <span class="detail-label">Recipient:</span>
                                        <span class="detail-value">{{ $item->nama_pemohon }}</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Purpose:</span>
                                        <span class="detail-value">{{ $item->instansi }}</span>
                                    </div>
                                    <div class="date-info">
                                        <div class="date-row">
                                            <span class="date-icon">📅</span>
                                            <span>Tanggal Kegiatan:
                                                {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('m/d/Y') }}</span>
                                        </div>
                                        <div class="date-row">
                                            <span class="date-icon">🕒</span>
                                            <span>Waktu Kegiatan
                                                {{ \Carbon\Carbon::parse($item->waktu_kegiatan)->format('m/d/Y') }}</span>
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
                                <p>No letter requests found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
