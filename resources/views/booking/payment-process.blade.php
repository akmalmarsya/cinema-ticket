<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Proses Pembayaran - CinemaTicket</title>

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
            margin-bottom: 20px;
        }

        .payment-header {
            text-align: center;
            padding: 25px 15px;
            background: #202c45;
            border: 1px solid #34435e;
            border-radius: 10px;
            margin-bottom: 22px;
        }

        .payment-icon {
            width: 65px;
            height: 65px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: rgba(245,185,66,.13);
            color: #f5b942;
            font-size: 30px;
        }

        .payment-header h2 {
            margin-bottom: 8px;
            font-size: 19px;
        }

        .payment-header p {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
        }

        .amount-box {
            text-align: center;
            padding: 22px;
            background: #202c45;
            border-radius: 10px;
            margin-bottom: 22px;
        }

        .amount-box span {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .amount-box strong {
            display: block;
            color: #f5b942;
            font-size: 29px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 0;
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

        .booking-code {
            padding: 17px;
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
            margin-bottom: 9px;
        }

        .booking-code strong {
            color: #f5b942;
            font-size: 17px;
            overflow-wrap: anywhere;
        }

        .seat-list {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 6px;
        }

        .seat-tag {
            padding: 6px 9px;
            background: #263b63;
            color: #f5b942;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-menunggu {
            color: #f5b942;
            background: rgba(245,185,66,.12);
        }

        .status-gagal {
            color: #f87171;
            background: rgba(239,68,68,.12);
        }

        .notice {
            padding: 17px;
            border-radius: 9px;
            background: rgba(245,185,66,.08);
            border: 1px solid rgba(245,185,66,.3);
            color: #f5b942;
            font-size: 12px;
            line-height: 1.8;
            margin-top: 20px;
        }

        .notice strong {
            display: block;
            margin-bottom: 6px;
        }

        .alert {
            padding: 15px 18px;
            border-radius: 9px;
            font-size: 12px;
            line-height: 1.7;
            margin-top: 20px;
        }

        .alert-success {
            background: rgba(34,197,94,.1);
            border: 1px solid rgba(34,197,94,.35);
            color: #4ade80;
        }

        .alert-danger {
            background: rgba(239,68,68,.1);
            border: 1px solid rgba(239,68,68,.35);
            color: #f87171;
        }

        .error-message {
            color: #f87171;
            font-size: 12px;
            margin-top: 12px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
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
            text-align: center;
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

        .btn-danger {
            background: #7f2934;
            color: white;
        }

        .btn-danger:hover {
            background: #a73542;
        }

        .simulation-buttons {
            display: grid;
            gap: 12px;
            margin-top: 20px;
        }

        .simulation-buttons .btn {
            width: 100%;
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

            .amount-box strong {
                font-size: 24px;
            }
        }
    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>

    {{-- NAVBAR --}}

    @include('layouts.partials.public-navbar')


    <main class="container">

        <a
            href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
            class="back-link"
        >
            &larr; Kembali ke ringkasan pembayaran
        </a>


        <div class="eyebrow">
            PAYMENT PROCESS
        </div>

        <h1>Proses Pembayaran</h1>

        <p class="subtitle">
            Selesaikan simulasi pembayaran untuk mengonfirmasi
            pemesanan tiket CinemaTicket.
        </p>


        {{-- NOTIFIKASI --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif

        @error('pembayaran')

            <div class="alert alert-danger">
                {{ $message }}
            </div>

        @enderror


        <div class="content-grid">

            {{-- KOLOM KIRI --}}

            <div>

                <section class="card">

                    <div class="payment-header">

                        <div class="payment-icon">
                            💳
                        </div>

                        <h2>
                            Konfirmasi Pembayaran
                        </h2>

                        <p>
                            Metode pembayaran yang kamu pilih:
                        </p>

                        <p style="color:#f5b942; font-weight:bold; margin-top:8px;">

                            @switch($pemesanan->pembayaran->metode_pembayaran)

                                @case('transfer_bank')
                                    TRANSFER BANK
                                    @break

                                @case('qris')
                                    QRIS
                                    @break

                                @case('e_wallet')
                                    E-WALLET
                                    @break

                                @default
                                    {{ strtoupper($pemesanan->pembayaran->metode_pembayaran) }}

                            @endswitch

                        </p>

                    </div>


                    <div class="amount-box">

                        <span>Total yang Harus Dibayar</span>

                        <strong>
                            Rp {{ number_format(
                                (float) $pemesanan->total_harga,
                                0,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>


                    <h2>
                        Simulasi Transaksi
                    </h2>

                    <p class="subtitle">
                        Pilih hasil simulasi di bawah ini untuk
                        menguji proses pembayaran aplikasi.
                    </p>


                    @if($pemesanan->pembayaran->status === 'gagal')

                        <div class="alert alert-danger">
                            Pembayaran sebelumnya gagal.
                            Kamu dapat mencoba kembali menggunakan
                            metode pembayaran yang sama.
                        </div>

                    @endif


                    @if($pemesanan->status === 'booking'
                        && $pemesanan->pembayaran->status !== 'berhasil')

                        <div class="simulation-buttons">

                            {{-- SIMULASI BERHASIL --}}

                            <form
                                action="{{ route('booking.payment.simulate', $pemesanan->kode_booking) }}"
                                method="POST"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="hasil"
                                    value="berhasil"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    ✓ Simulasikan Pembayaran Berhasil
                                </button>

                            </form>


                            {{-- SIMULASI GAGAL --}}

                            <form
                                action="{{ route('booking.payment.simulate', $pemesanan->kode_booking) }}"
                                method="POST"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="hasil"
                                    value="gagal"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    ✕ Simulasikan Pembayaran Gagal
                                </button>

                            </form>

                        </div>

                    @else

                        <div class="alert alert-success">
                            Pembayaran telah berhasil diselesaikan.
                        </div>

                    @endif


                    <div class="notice">

                        <strong>Catatan Simulasi</strong>

                        Halaman ini hanya digunakan untuk simulasi
                        pembayaran dalam proyek akademik CinemaTicket.

                        Tidak ada transaksi uang sungguhan dan tidak
                        terhubung dengan bank maupun payment gateway.

                    </div>


                    <div class="actions">

                        <a
                            href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
                            class="btn btn-secondary"
                        >
                            Kembali ke Ringkasan
                        </a>

                        @if($pemesanan->status === 'booking')

                            <a
                                href="{{ route('booking.payment.methods', $pemesanan->kode_booking) }}"
                                class="btn btn-secondary"
                            >
                                Ganti Metode
                            </a>

                        @endif

                    </div>

                </section>

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
                            {{ \Carbon\Carbon::parse(
                                $pemesanan->jadwal->tanggal_tayang
                            )->format('d M Y') }}
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
                            {{ $pemesanan->detailKursis->count() }}
                            Tiket
                        </strong>

                    </div>

                </section>


                <section class="card">

                    <h2>Status Pembayaran</h2>

                    <div class="detail-row">

                        <span>Status Booking</span>

                        <strong>
                            {{ ucfirst($pemesanan->status) }}
                        </strong>

                    </div>


                    <div class="detail-row">

                        <span>Status Pembayaran</span>

                        <strong>

                            <span class="status status-{{ $pemesanan->pembayaran->status }}">

                                {{ ucfirst($pemesanan->pembayaran->status) }}

                            </span>

                        </strong>

                    </div>


                    <div class="detail-row">

                        <span>Kode Referensi</span>

                        <strong>
                            {{ $pemesanan->pembayaran->kode_referensi ?? '-' }}
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