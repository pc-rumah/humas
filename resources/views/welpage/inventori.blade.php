<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Inventaris</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('landing/inventory.css') }}">
</head>

<body>
    <!-- Header -->
    @include('partwelcome.header')

    <!-- Inventory Section -->
    <section class="inventory-section">
        <div class="container">
            <div class="inventory-header">
                <h1>Manajemen Inventaris</h1>
                <p>Pengelolaan Item yang Tersedia dan Pelacakan Stok Barang secara Real-time</p>
            </div>
            @php
                function getStockStatus($jumlah)
                {
                    if ($jumlah == 0) {
                        return 'out-of-stock';
                    }
                    if ($jumlah <= 2) {
                        return 'low-stock';
                    }
                    return 'in-stock';
                }

                function getStockText($jumlah)
                {
                    if ($jumlah == 0) {
                        return 'Out of Stock';
                    }
                    if ($jumlah <= 2) {
                        return 'Low Stock';
                    }
                    return 'In Stock';
                }
            @endphp
            <!-- Search and Filter -->
            <div class="search-filter-container">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search items..." class="search-input">
                    <span class="search-icon">🔍</span>
                </div>
                <div class="filter-box">
                    <select id="categoryFilter" class="category-select">
                        <option value="">All Categories</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}"> {{ $item->nama_kategori }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Inventory Grid -->
            <div class="inventory-grid" id="inventoryGrid">
                <div class="inventory-grid">
                    @forelse ($inventori as $item)
                        <div class="inventory-item" data-nama="{{ strtolower($item->nama_barang) }}"
                            data-deskripsi="{{ strtolower($item->deskripsi) }}"
                            data-kategori="{{ $item->kategori_id }}">
                            <img src="{{ asset('storage/' . $item->gambar_barang) }}" alt="{{ $item->nama_barang }}"
                                class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <h3 class="item-title">{{ $item->nama_barang }}</h3>
                                    <span
                                        class="stock-badge {{ getStockStatus($item->jumlah) }}">{{ getStockText($item->jumlah) }}</span>
                                </div>
                                <p class="item-description">{{ $item->deskripsi }}</p>
                                <div class="item-details">
                                    <span class="item-category">Kategori: {{ $item->kategori->nama_kategori }}</span>
                                    <span class="item-stock">Stok: {{ $item->jumlah }}</span>
                                </div>
                                <div class="item-condition condition-{{ strtolower($item->status) }}">
                                    <span>Kondisi: {{ $item->status }}</span>
                                    @if ($item->jumlah <= 2 && $item->jumlah > 0)
                                        <span class="warning-icon">⚠️</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="no-results" style="display: none;">
                            <div class="no-results-icon">📦</div>
                            <p>Tidak ada Item</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partwelcome.footer')
    <script>
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const items = document.querySelectorAll('.inventory-item');

        function filterItems() {
            const searchQuery = searchInput.value.toLowerCase().trim();
            const selectedCategory = categoryFilter.value;

            items.forEach(item => {
                const name = item.getAttribute('data-nama');
                const description = item.getAttribute('data-deskripsi');
                const category = item.getAttribute('data-kategori');

                const matchesSearch = name.includes(searchQuery) || description.includes(searchQuery);
                const matchesCategory = selectedCategory === '' || selectedCategory === category;

                if (matchesSearch && matchesCategory) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            checkIfNoResults();
        }

        function checkIfNoResults() {
            const visibleItems = Array.from(items).filter(item => item.style.display !== 'none');
            const noResults = document.querySelector('.no-results');
            if (visibleItems.length === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        }

        searchInput.addEventListener('input', filterItems);
        categoryFilter.addEventListener('change', filterItems);
    </script>

</body>

</html>
