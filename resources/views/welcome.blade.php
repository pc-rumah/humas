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
                @if ($carousel)
                    @if ($carousel->gambar_1)
                        <div class="swiper-slide">
                            <img style="border: 1px solid white; border-radius: 18px"
                                src="{{ asset('storage/' . $carousel->gambar_1) }}" alt="Slide 1">
                        </div>
                    @endif
                    @if ($carousel->gambar_2)
                        <div class="swiper-slide">
                            <img style="border: 1px solid white; border-radius: 18px"
                                src="{{ asset('storage/' . $carousel->gambar_2) }}" alt="Slide 2">
                        </div>
                    @endif
                    @if ($carousel->gambar_3)
                        <div class="swiper-slide">
                            <img style="border: 1px solid white; border-radius: 18px"
                                src="{{ asset('storage/' . $carousel->gambar_3) }}" alt="Slide 3">
                        </div>
                    @endif
                @endif
            </div>
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
