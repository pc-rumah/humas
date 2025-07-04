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
                    <h2>Request Item</h2>
                    <form class="request-form" id="requestForm">
                        <div class="form-group">
                            <label for="itemName">Item Name</label>
                            <select id="itemName" class="form-select" required>
                                <option value="">Select an item</option>
                                <option value="Laptop Dell Inspiron">Laptop Dell Inspiron</option>
                                <option value="Projector Epson">Projector Epson</option>
                                <option value="Office Chair">Office Chair</option>
                                <option value="Microphone Set">Microphone Set</option>
                                <option value="Whiteboard">Whiteboard</option>
                                <option value="Camera Canon">Camera Canon</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" class="form-input" min="1" max="10"
                                value="1" required>
                        </div>

                        <div class="form-group">
                            <label for="borrowDate">Borrow Date</label>
                            <input type="date" id="borrowDate" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="returnDate">Return Date</label>
                            <input type="date" id="returnDate" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <textarea id="purpose" class="form-textarea" placeholder="Please describe the purpose of borrowing..." rows="4"
                                required></textarea>
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

                <!-- Request History -->
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
                                    <div class="history-item-purpose">Purpose: {{ $item->catatan }}</div>
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

    <!-- Footer -->
    @include('partwelcome.footer')

    <script src="borrowing.js"></script>
</body>

</html>
