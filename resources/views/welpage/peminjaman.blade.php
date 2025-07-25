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
                <h1>Manajemen Peminjaman</h1>
                <p>Minta barang dan lacak riwayat peminjaman Anda</p>
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
                    <h2>Barang Permintaan</h2>
                    <form action="{{ route('peminjaman.storeUser') }}" class="request-form" method="POST"
                        id="requestForm" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-input"
                                placeholder="Nama Peminjam" value="{{ old('nama_peminjam') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-input"
                                placeholder="Nama Kegiatan" value="{{ old('nama_kegiatan') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ktm">Upload KTM</label>
                            <input type="file" name="ktm" id="ktm" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No Telp</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-input" placeholder="no_telp"
                                value="{{ old('no_telp') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-input" placeholder="Email"
                                value="{{ old('email') }}" required>
                        </div>

                        <div id="barang-container">
                            <div class="barang-group">
                                <div class="form-group">
                                    <label for="inventori_id[]">Nama Barang</label>
                                    <select name="inventori_id[]" class="form-select" required>
                                        <option value="" disabled selected>Pilih Barang</option>
                                        @foreach ($inventori as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama_barang }} (Stok = {{ $item->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_pinjam[]">Jumlah Pinjam</label>
                                    <input type="number" name="jumlah_pinjam[]" min="1" class="form-input"
                                        required>
                                </div>

                                <br>
                                <button type="button" class="remove-barang btn btn-danger">Hapus</button>
                            </div>
                        </div>

                        <button type="button" id="add-barang" class="btn btn-primary">Tambah Barang</button>

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
                    <h2>Riwayat Permintaan</h2>
                    <div class="history-list">
                        @forelse ($peminjaman as $item)
                            <div class="history-item">
                                <div class="history-item-header">
                                    <h3 class="history-item-title">
                                        @php
                                            $barangList = json_decode($item->barang_dipinjam, true);
                                        @endphp

                                        @foreach ($barangList as $barang)
                                            {{ $inventoriMap[$barang['inventori_id']]->nama_barang ?? 'Barang tidak ditemukan' }}
                                            ({{ $barang['jumlah_pinjam'] }} unit)
                                            <br>
                                        @endforeach

                                    </h3>

                                    <span class="status-badge {{ $item->status }}">
                                        {!! getStatusIcon($item->status) !!} {{ ucfirst($item->status) }}
                                    </span>
                                </div>

                                <div class="history-item-dates">
                                    <span class="date-icon">📅</span>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('m/d/Y') }} -
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('m/d/Y') }}
                                    </span>
                                </div>

                                <div class="history-item-details">
                                    <div class="history-item-purpose">Tujuan: {{ $item->tujuan }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-history">
                                <div class="empty-history-icon">📋</div>
                                <p>Tidak ditemukan riwayat peminjaman.</p>
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
                setTimeout(() => msg.classList.add("show"), 100);

                setTimeout(() => {
                    msg.classList.remove("show");
                    setTimeout(() => msg.remove(), 500);
                }, 5000);
            });
        });

        document.getElementById('add-barang').addEventListener('click', function() {
            let container = document.getElementById('barang-container');
            let newGroup = container.querySelector('.barang-group').cloneNode(true);
            newGroup.querySelectorAll('input, select').forEach(el => el.value = '');
            container.appendChild(newGroup);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                let group = e.target.closest('.barang-group');
                if (document.querySelectorAll('.barang-group').length > 1) {
                    group.remove();
                }
            }
        });
    </script>
</body>

</html>
