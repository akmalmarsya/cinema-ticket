<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Booking Berhasil - CinemaTicket</title>

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
            width: min(700px, 90%);
            margin: 55px auto 80px;
        }

        .success-card {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 15px;
            overflow: hidden;
        }

        .success-header {
            text-align: center;
            padding: 38px 25px;
            background: rgba(34,197,94,.07);
            border-bottom: 1px solid #26344f;
        }

        .success-icon {
            width: 65px;
            height: 65px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: rgba(34,197,94,.15);
            color: #4ade80;
            font-size: 32px;
            font-weight: bold;
        }

        .success-header h1 {
            font-size: 27px;
            margin-bottom: 12px;
        }

        .success-header p {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.8;
        }

        .booking-code {
            margin: 25px;
            padding: 22px;
            text-align: center;
            background: #202c45;
            border: 1px dashed #f5b942;
            border-radius: 10px;
        }

        .booking-code small {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .booking-code strong {
            display: block;
            color: #f5b942;
            font-size: 25px;
            letter-spacing: 2px;
            overflow-wrap: anywhere;
        }

        .booking-code p {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 12px;
            line-height: 1.7;
        }

        .booking-content {
            padding: 5px 25px 28px;
        }

        .booking-content h2 {
            font-size: 17px;
            margin: 18px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 0;
            border-bottom: 1px solid #26344f;
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

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-top: 20px;
        }

        .total-row span {
            color: #94a3b8;
            font-size: 13px;
        }

        .total-row strong {
            color: #f5b942;
            font-size: 23px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-booking {
            background: rgba(245,185,66,.12);
            color: #f5b942;
        }

        .status-lunas {
            background: rgba(34,197,94,.12);
            color: #4ade80;
        }

        .status-cancelled {
            background: rgba(239,68,68,.12);
            color: #f87171;
        }

        .notice {
            margin: 25px;
            padding: 15px;
            border-radius: 8px;
            background: rgba(245,185,66,.08);
            border: 1px solid rgba(245,185,66,.3);
            color: #f5b942;
            font-size: 12px;
            line-height: 1.8;
        }

        .actions {
            display: flex;
            gap: 12px;
            padding: 0 25px 28px;
        }

        .btn {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
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

        @media(max-width:600px) {

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

            .success-header h1 {
                font-size: 23px;
            }

            .booking-code strong {
                font-size: 20px;
            }

            .detail-row {
                gap: 10px;
            }

            .total-row strong {
                font-size: 19px;
            }

            .actions {
                flex-direction: column;
            }

        }

    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>

    {{-- NAVBAR --}}

    @include('layouts.partials.public-navbar')


    <main class="container">

        <div class="success-card">


            {{-- HEADER --}}

            <div class="success-header">

                <div class="success-icon">
                    ✓
                </div>

                <h1>Pemesanan Berhasil!</h1>

                <p>
                    Terima kasih telah melakukan pemesanan
                    tiket di CinemaTicket.
                    Berikut adalah rincian booking kamu.
                </p>

            </div>


            {{-- KODE BOOKING --}}

            <div class="booking-code">

                <small>KODE BOOKING</small>

                <strong>
                    {{ $pemesanan->kode_booking }}
                </strong>

                <p>
                    Simpan kode booking ini untuk proses
                    pembayaran dan pemeriksaan pemesanan.
                </p>

            </div>


            {{-- RINCIAN PEMESANAN --}}

            <div class="booking-content">

                <h2>Informasi Pemesan</h2>


                <div class="detail-row">

                    <span>Nama Pemesan</span>

                    <strong>
                        {{ $pemesanan->nama_pemesan }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Nomor HP</span>

                    <strong>
                        {{ $pemesanan->no_hp }}
                    </strong>

                </div>


                <h2>Informasi Penayangan</h2>


                <div class="detail-row">

                    <span>Film</span>

                    <strong>
                        {{ $pemesanan->jadwal->film->judul }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Tanggal</span>

                    <strong>
                        {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d M Y') }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Jam Tayang</span>

                    <strong>
                        {{ date('H:i', strtotime($pemesanan->jadwal->jam_mulai)) }}
                        -
                        {{ date('H:i', strtotime($pemesanan->jadwal->jam_selesai)) }}
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


                <div class="detail-row">

                    <span>Status Pemesanan</span>

                    <strong>

                        @if($pemesanan->status === 'booking')

                            <span class="status status-booking">
                                Menunggu Pembayaran
                            </span>

                        @elseif($pemesanan->status === 'lunas')

                            <span class="status status-lunas">
                                Lunas
                            </span>

                        @elseif($pemesanan->status === 'dibatalkan')

                            <span class="status status-cancelled">
                                Dibatalkan
                            </span>

                        @elseif($pemesanan->status === 'kedaluwarsa')

                            <span class="status status-cancelled">
                                Kedaluwarsa
                            </span>

                        @endif

                    </strong>

                </div>


                <div class="total-row">

                    <span>Total Pemesanan</span>

                    <strong>
                        Rp {{ number_format((float) $pemesanan->total_harga, 0, ',', '.') }}
                    </strong>

                </div>

            </div>


            {{-- INFORMASI PEMBAYARAN --}}

            @if($pemesanan->status === 'booking')

                <div class="notice">

                    <strong>Informasi:</strong>

                    Pemesanan berhasil dibuat dan berstatus
                    menunggu pembayaran.

                    Silakan simpan kode booking kamu.
                    Fitur pembayaran akan tersedia pada
                    pengembangan Sprint 7.

                </div>

            @endif


            {{-- TOMBOL --}}

            <div class="actions">

                @if($pemesanan->status === 'booking')

                    <a
                        href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
                        class="btn btn-primary"
                    >
                        Lanjutkan Pembayaran
                    </a>

                @endif

                <a
                    href="{{ route('home') }}"
                    class="btn btn-secondary"
                >
                    Kembali ke Beranda
                </a>

            </div>

        </div>

    </main>


    <footer>

        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.

    </footer>

</body>
</html>