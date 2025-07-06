<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Humas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Header -->
    @include('partwelcome.header')

    <!-- Hero Carousel Section -->
    <section class="hero-carousel">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Office Team Meeting">
                    <div class="slide-content">
                        <div class="container">
                            <h1>Tim Kolaborasi Profesional</h1>
                            <p>Rasakan tim kerja yang lancar dan komunikasi yang efisien dengan layanan hubungan
                                masyarakat kami yang komprehensif.</p>
                            <div class="slide-buttons">
                                <a href="#services" class="btn btn-primary">Memulai</a>
                                <a href="#services" class="btn btn-secondary">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Modern Office Space">
                    <div class="slide-content">
                        <div class="container">
                            <h1>Solusi Ruang Kerja Modern</h1>
                            <p>Menampilkan alur kerja Anda dengan sistem manajemen inventaris dan penyimpanan dokumen
                                kami
                                yang inovatif.</p>
                            <div class="slide-buttons">
                                <a href="/inven" class="btn btn-primary">Inventaris</a>
                                <a href="#services" class="btn btn-secondary">Lihat Layanan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Business Meeting">
                    <div class="slide-content">
                        <div class="container">
                            <h1>Perencanaan Bisnis Strategis</h1>
                            <p>Tetap terorganisasi dengan sistem manajemen agenda dan pembaruan berita kami yang
                                dirancang untuk bisnis modern.</p>
                            <div class="slide-buttons">
                                <a href="/newsagenda" class="btn btn-primary">Lihat Berita & Agenda</a>
                                <a href="/newsagenda" class="btn btn-secondary">Pembaruan Terbaru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2>Layanan Kami</h2>
                <p>Solusi hubungan masyarakat yang komprehensif yang dirancang untuk memperlancar alur kerja Anda dan
                    meningkatkan efisiensi
                </p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon blue">📦</div>
                    <h3>Manajemen Inventaris</h3>
                    <p>Telusuri dan kelola item yang tersedia dengan pelacakan stok secara real-time</p>
                    <a href="/inven" class="learn-more">Detail →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon green">📄</div>
                    <h3>Peminjaman</h3>
                    <p>lacak item yang dipinjam dengan formulir yang mudah digunakan</p>
                    <a href="/pinjam" class="learn-more">Detail →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon orange">✉️</div>
                    <h3>Permintaan Surat</h3>
                    <p>Permintaan surat dan dokumen resmi dengan pemrosesan otomatis</p>
                    <a href="/permohonan" class="learn-more">Detail →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon purple">📰</div>
                    <h3>Berita & Agenda</h3>
                    <p>Tetap dapatkan informasi terkini mengenai berita dan pengumuman terbaru</p>
                    <a href="/newsagenda" class="learn-more">Detail →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Siap untuk Memulai?</h2>
            <p>Rasakan kekuatan manajemen hubungan masyarakat yang efisien. Akses semua layanan kami dari satu platform
                yang mudah digunakan.</p>
            <div class="cta-buttons">
                <a href="/inven" class="btn btn-primary">Inventory</a>
                <a href="/pinjam" class="btn btn-outline">Pinjam Barang</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partwelcome.footer')
</body>

</html>
