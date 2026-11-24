<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran - CinemaTicket</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b1020;
            color: white;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 76px;
            padding: 20px 8%;
            background: #10172b;
            border-bottom: 1px solid #26344f;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
        }

        .logo span {
            color: #f5b942;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            color: #cbd5e1;
            font-size: 13px;
        }

        .nav-links a:hover {
            color: #f5b942;
        }

        .container {
            width: min(1000px, 90%);
            margin: 45px auto 75px;
        }

        .back-link {
            display: inline-block;
            color: #f5b942;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .eyebrow {
            color: #f5b942;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 12px;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.8;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 22px;
            margin-top: 30px;
            align-items: start;
        }

        .card {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 13px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 17px;
            margin-bottom: 10px;
        }

        .card-description {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .method-list {
            display: grid;
            gap: 13px;
        }

        .method-option {
            display: block;
            position: relative;
            cursor: pointer;
        }

        .method-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .method-content {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px;
            border: 1px solid #34435e;
            background: #202c45;
            border-radius: 10px;
            transition: .2s;
        }

        .method-option:hover .method-content {
            border-color: #f5b942;
        }

        .method-option input:checked + .method-content {
            border: 2px solid #f5b942;
            background: rgba(245,185,66,.09);
        }

        .method-option input:focus-visible + .method-content {
            outline: 2px solid white;
            outline-offset: 3px;
        }

        .method-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #26344f;
            border-radius: 9px;
            font-size: 23px;
        }

        .method-text {
            flex: 1;
        }

        .method-text strong {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .method-text small {
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.6;
        }

        .radio-indicator {
            width: 19px;
            height: 19px;
            border: 2px solid #64748b;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .method-option input:checked + .method-content .radio-indicator {
            border: 6px solid #f5b942;
        }

        .error-message {
            color: #f87171;
            font-size: 12px;
            margin-top: 12px;
        }

        .booking-code {
            padding: 18px;
            border-radius: 9px;
            background: #202c45;
            border: 1px dashed #f5b942;
            margin-bottom: 20px;
        }

        .booking-code small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .booking-code strong {
            color: #f5b942;
            font-size: 17px;
            overflow-wrap: anywhere;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #26344f;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row span {
            color: #94a3b8;
            font-size: 12px;
        }

        .detail-row strong {
            font-size: 12px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .seat-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 6px;
        }

        .seat-tag {
            padding: 6px 9px;
            border-radius: 5px;
            background: #263b63;
            color: #f5b942;
            font-size: 11px;
            font-weight: bold;
        }

        .total-box {
            margin-top: 20px;
            padding: 20px;
            border-radius: 9px;
            background: #202c45;
        }

        .total-box span {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 9px;
        }

        .total-box strong {
            display: block;
            color: #f5b942;
            font-size: 25px;
        }

        .info-box {
            padding: 16px;
            border-radius: 9px;
            background: rgba(245,185,66,.08);
            border: 1px solid rgba(245,185,66,.3);
            color: #f5b942;
            font-size: 11px;
            line-height: 1.8;
            margin-top: 18px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 6px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: #f5b942;
            color: #10172b;
        }

        .btn-primary:hover {
            background: #ffd477;
        }

        .btn-secondary {
            background: #26344f;
            color: white;
        }

        .btn-secondary:hover {
            background: #34435e;
        }

        footer {
            padding: 25px;
            text-align: center;
            background: #10172b;
            border-top: 1px solid #26344f;
            color: #94a3b8;
            font-size: 12px;
        }

        @media(max-width: 750px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .container {
                margin-top: 30px;
            }

            h1 {
                font-size: 25px;
            }
        }

        @media(max-width: 500px) {
            .navbar {
                padding: 17px 5%;
                flex-wrap: wrap;
                gap: 12px;
            }

            .logo {
                font-size: 20px;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-links a {
                font-size: 11px;
            }

            .card {
                padding: 19px;
            }

            .actions {
                flex-direction: column;
            }

            .method-content {
                padding: 14px;
            }
        }
    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>

    @include('layouts.partials.public-navbar')

    <main class="container">

        <a
            href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
            class="back-link"
        >
            &larr; Kembali ke ringkasan pembayaran
        </a>

        <div class="eyebrow">PAYMENT METHOD</div>

        <h1>Pilih Metode Pembayaran</h1>

        <p class="subtitle">
            Pilih metode pembayaran yang ingin kamu gunakan
            untuk menyelesaikan transaksi pemesanan tiket.
        </p>

        <div class="content-grid">

            {{-- KOLOM KIRI --}}

            <div>

                <form
                    action="{{ route('booking.payment.store-method', $pemesanan->kode_booking) }}"
                    method="POST"
                >

                    @csrf

                    <section class="card">

                        <h2>Metode Pembayaran</h2>

                        <p class="card-description">
                            Silakan pilih salah satu metode pembayaran
                            berikut.
                        </p>

                        <div class="method-list">

                            <label class="method-option">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="transfer_bank"
                                    @checked(old('metode_pembayaran', $pemesanan->pembayaran?->metode_pembayaran) === 'transfer_bank')
                                >

                                <span class="method-content">

                                    <span class="method-icon">
                                        🏦
                                    </span>

                                    <span class="method-text">
                                        <strong>Transfer Bank</strong>
                                        <small>
                                            Pembayaran melalui transfer bank.
                                        </small>
                                    </span>

                                    <span class="radio-indicator"></span>

                                </span>

                            </label>


                            <label class="method-option">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="qris"
                                    @checked(old('metode_pembayaran', $pemesanan->pembayaran?->metode_pembayaran) === 'qris')
                                >

                                <span class="method-content">

                                    <span class="method-icon">
                                        ▦
                                    </span>

                                    <span class="method-text">
                                        <strong>QRIS</strong>
                                        <small>
                                            Pembayaran menggunakan kode QR.
                                        </small>
                                    </span>

                                    <span class="radio-indicator"></span>

                                </span>

                            </label>


                            <label class="method-option">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="e_wallet"
                                    @checked(old('metode_pembayaran', $pemesanan->pembayaran?->metode_pembayaran) === 'e_wallet')
                                >

                                <span class="method-content">

                                    <span class="method-icon">
                                        📱
                                    </span>

                                    <span class="method-text">
                                        <strong>E-Wallet</strong>
                                        <small>
                                            Pembayaran menggunakan dompet digital.
                                        </small>
                                    </span>

                                    <span class="radio-indicator"></span>

                                </span>

                            </label>

                        </div>

                        @error('metode_pembayaran')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                        @error('pembayaran')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="info-box">
                            <strong>Informasi Pembayaran</strong>

                            Sistem CinemaTicket menggunakan simulasi
                            pembayaran untuk keperluan pengujian aplikasi.
                            Tidak ada transaksi uang sungguhan pada tahap ini.
                        </div>

                        <div class="actions">

                            <a
                                href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
                                class="btn btn-secondary"
                            >
                                Kembali
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Simpan Metode
                            </button>

                        </div>

                    </section>

                </form>

            </div>


            {{-- KOLOM KANAN --}}

            <div>

                <section class="card">

                    <h2>Informasi Pemesanan</h2>

                    <div class="booking-code">

                        <small>KODE BOOKING</small>

                        <strong>
                            {{ $pemesanan->kode_booking }}
                        </strong>

                    </div>

                    <div class="detail-row">
                        <span>Nama Pemesan</span>
                        <strong>
                            {{ $pemesanan->nama_pemesan }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Film</span>
                        <strong>
                            {{ $pemesanan->jadwal->film->judul }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Tanggal Tayang</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d M Y') }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Jam Tayang</span>
                        <strong>
                            {{ substr($pemesanan->jadwal->jam_mulai, 0, 5) }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Studio</span>
                        <strong>
                            {{ $pemesanan->jadwal->studio->nama }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Kursi</span>

                        <div class="seat-list">

                            @foreach($pemesanan->detailKursis as $detail)

                                <span class="seat-tag">
                                    {{ $detail->no_kursi }}
                                </span>

                            @endforeach

                        </div>
                    </div>

                    <div class="detail-row">
                        <span>Jumlah Tiket</span>
                        <strong>
                            {{ $pemesanan->detailKursis->count() }} Tiket
                        </strong>
                    </div>

                    <div class="total-box">

                        <span>Total Pembayaran</span>

                        <strong>
                            Rp {{ number_format(
                                (float) $pemesanan->total_harga,
                                0,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>

                </section>

            </div>

        </div>

    </main>

    <footer>
        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>