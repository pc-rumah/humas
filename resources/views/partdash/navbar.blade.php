<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center py-4 px-6 h-header-height">
            <a href="#" class="b-brand flex items-center gap-3">
                <img src="{{ asset('dash/assets/images/logo-white.svg') }}" class="img-fluid logo logo-lg"
                    alt="logo" />
                <img src="{{ asset('dash/assets/images/favicon.svg') }}" class="img-fluid logo logo-sm" alt="logo" />
            </a>
        </div>
        <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item">
                <li class="pc-item">
                    <a href="/dashboard" class="pc-link">
                        <span class="pc-micon">
                            <i data-feather="home"></i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Konten</label>
                    <i data-feather="feather"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href=" {{ route('inventori.index') }} " class="pc-link">
                        <span class="pc-micon"> <i data-feather="edit"></i></span>
                        <span class="pc-mtext">Inventory</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href=" {{ route('kategori.index') }} " class="pc-link">
                        <span class="pc-micon"> <i data-feather="edit"></i></span>
                        <span class="pc-mtext">Kategori</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href=" {{ route('peminjaman.index') }} " class="pc-link">
                        <span class="pc-micon"> <i data-feather="edit"></i></span>
                        <span class="pc-mtext">Pinjam Barang</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
