<header class="header">
    <div class="container">
        <div class="logo" style="display: flex; align-items: center; gap: 8px;">
            <span class="logo-icon">
                <img src="{{ asset('logo.webp') }}" alt="logo" style="width: 32px; height: 32px; object-fit: contain;">
            </span>
            <span class="logo-text">Layanan Humas</span>
        </div>

        <button class="hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Desktop Nav -->
        <nav class="nav">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
            <a href="/inven" class="nav-link {{ Request::is('inven*') ? 'active' : '' }}">Inventaris</a>
            <a href="/pinjam" class="nav-link {{ Request::is('pinjam*') ? 'active' : '' }}">Peminjaman</a>
            <a href="/permohonan" class="nav-link {{ Request::is('permohonan*') ? 'active' : '' }}">Permintaan
                Dokumentasi</a>
            <a href="/newsagenda" class="nav-link {{ Request::is('newsagenda*') ? 'active' : '' }}">Agenda</a>
        </nav>

        <!-- Mobile Nav -->
        <nav class="mobile-nav">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
            <a href="/inven" class="nav-link {{ Request::is('inven*') ? 'active' : '' }}">Inventaris</a>
            <a href="/pinjam" class="nav-link {{ Request::is('pinjam*') ? 'active' : '' }}">Peminjaman</a>
            <a href="/permohonan" class="nav-link {{ Request::is('permohonan*') ? 'active' : '' }}">Permintaan
                Dokumentasi</a>
            <a href="/newsagenda" class="nav-link {{ Request::is('newsagenda*') ? 'active' : '' }}">Agenda</a>
        </nav>
    </div>
</header>
