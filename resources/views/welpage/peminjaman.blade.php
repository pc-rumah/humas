<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('landing/borrowing.css') }}">
</head>

<body>
    <!-- Header -->
    @include('partwelcome.header')

    <!-- Borrowing Section -->
    <section class="borrowing-section">
        <div class="container">
            <div class="borrowing-header">
                <h1>Borrowing Management</h1>
                <p>Request items and track your borrowing history</p>
            </div>

            <div class="borrowing-content">
                <!-- Request Item Form -->
                <div class="request-form-container">
                    {{-- Pesan Success --}}
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
                    <h2>Request Item</h2>
                    <form action="{{ route('peminjaman.storeUser') }}" class="request-form" method="POST"
                        id="requestForm">
                        @csrf

                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-input"
                                placeholder="Nama Peminjam" value="{{ old('nama_peminjam') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="inventori_id">Nama Barang</label>
                            <select name="inventori_id" id="inventori_id" class="form-select" required>
                                <option value="" disabled {{ old('inventori_id') ? '' : 'selected' }}>Pilih Barang
                                </option>
                                @foreach ($inventori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('inventori_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_barang }} (Stok = {{ $item->jumlah }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pinjam">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-input"
                                value="{{ old('tanggal_pinjam') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-input"
                                value="{{ old('tanggal_kembali') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah Pinjam</label>
                            <input type="number" name="jumlah_pinjam" id="jumlah" min="1" class="form-input"
                                value="{{ old('jumlah_pinjam') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <textarea name="tujuan" id="tujuan" class="form-textarea" rows="4" required>{{ old('tujuan') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary submit-btn">Submit Request</button>
                    </form>
                </div>

                @php
                    function getStatusIcon($status)
                    {
                        return match ($status) {
                            'approved' => '✅',
                            'returned' => '🔄',
                            'pending' => '⏳',
                            'rejected' => '❌',
                            default => '📋',
                        };
                    }
                @endphp

                <div class="history-container">
                    <h2>Request History</h2>
                    <div class="history-list">
                        @forelse ($peminjaman as $item)
                            <div class="history-item">
                                <div class="history-item-header">
                                    <h3 class="history-item-title">{{ $item->inventori->nama_barang }}</h3>
                                    <span class="status-badge {{ $item->status }}">
                                        {!! getStatusIcon($item->status) !!} {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                                <div class="history-item-dates">
                                    <span class="date-icon">📅</span>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('m/d/Y') }} -
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('m/d/Y') }}</span>
                                </div>
                                <div class="history-item-details">
                                    <div class="history-item-quantity">Quantity: {{ $item->jumlah_pinjam }}</div>
                                    <div class="history-item-purpose">Purpose: {{ $item->tujuan }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-history">
                                <div class="empty-history-icon">📋</div>
                                <p>No borrowing history found.</p>
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
