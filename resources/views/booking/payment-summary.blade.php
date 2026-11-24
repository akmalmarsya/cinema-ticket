<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ringkasan Pembayaran - CinemaTicket</title>

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

        .booking-code {
            padding: 20px;
            border-radius: 9px;
            background: #202c45;
            border: 1px dashed #f5b942;
            margin-bottom: 22px;
        }

        .booking-code small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .booking-code strong {
            color: #f5b942;
            font-size: 19px;
            overflow-wrap: anywhere;
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

        .seat-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 7px;
        }

        .seat-tag {
            padding: 7px 10px;
            border-radius: 6px;
            background: #263b63;
            color: #f5b942;
            font-size: 11px;
            font-weight: bold;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid #26344f;
        }

        .price-row span {
            color: #94a3b8;
            font-size: 12px;
        }

        .price-row strong {
            font-size: 13px;
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
            margin-bottom: 10px;
        }

        .total-box strong {
            display: block;
            color: #f5b942;
            font-size: 27px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-booking,
        .status-menunggu {
            background: rgba(245,185,66,.12);
            color: #f5b942;
        }

        .status-lunas,
        .status-berhasil {
            background: rgba(34,197,94,.12);
            color: #4ade80;
        }

        .status-gagal,
        .status-dibatalkan,
        .status-kedaluwarsa {
            background: rgba(239,68,68,.12);
            color: #f87171;
        }

        .payment-info {
            padding: 18px;
            border-radius: 9px;
            background: rgba(245,185,66,.08);
            border: 1px solid rgba(245,185,66,.3);
            color: #f5b942;
            font-size: 12px;
            line-height: 1.8;
        }

        .payment-info strong {
            display: block;
            margin-bottom: 6px;
        }

        .payment-method {
            margin-top: 18px;
            padding: 18px;
            background: #202c45;
            border: 1px solid #34435e;
            border-radius: 9px;
        }

        .payment-method small {
            color: #94a3b8;
            font-size: 11px;
        }

        .payment-method strong {
            display: block;
            margin-top: 8px;
            font-size: 13px;
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

            .total-box strong {
                font-size: 23px;
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
            href="{{ route('booking.success', $pemesanan->kode_booking) }}"
            class="back-link"
        >
            &larr; Kembali ke konfirmasi booking
        </a>


        <div class="eyebrow">
            PAYMENT SUMMARY
        </div>

        <h1>Ringkasan Pembayaran</h1>

        <p class="subtitle">
            Periksa kembali informasi pemesanan dan rincian
            pembayaran sebelum melanjutkan ke tahap berikutnya.
        </p>


        <div class="content-grid">

            {{-- KOLOM KIRI --}}

            <div>

                {{-- INFORMASI BOOKING --}}

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

                        <span>Nomor HP</span>

                        <strong>
                            {{ $pemesanan->no_hp }}
                        </strong>

                    </div>


                    <div class="detail-row">

                        <span>Status Booking</span>

                        <strong>

                            <span class="status status-{{ $pemesanan->status }}">
                                {{ ucfirst($pemesanan->status) }}
                            </span>

                        </strong>

                    </div>

                </section>


                {{-- INFORMASI FILM --}}

                <section class="card">

                    <h2>Informasi Penayangan</h2>

                    <div class="detail-row">

                        <span>Judul Film</span>

                        <strong>
                            {{ $pemesanan->jadwal->film->judul }}
                        </strong>

                    </div>


                    <div class="detail-row">

                        <span>Genre</span>

                        <strong>
                            {{ $pemesanan->jadwal->film->genre }}
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
                            {{ date('H:i', strtotime(
                                $pemesanan->jadwal->jam_mulai
                            )) }}
                            -
                            {{ date('H:i', strtotime(
                                $pemesanan->jadwal->jam_selesai
                            )) }}
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

                </section>

            </div>


            {{-- KOLOM KANAN --}}

            <div>

                {{-- RINCIAN HARGA --}}

                <section class="card">

                    <h2>Rincian Pembayaran</h2>

                    <div class="price-row">

                        <span>Harga per Tiket</span>

                        <strong>
                            Rp {{ number_format(
                                (float) $pemesanan->jadwal->harga,
                                0,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>


                    <div class="price-row">

                        <span>Jumlah Tiket</span>

                        <strong>
                            {{ $pemesanan->detailKursis->count() }} Tiket
                        </strong>

                    </div>


                    <div class="price-row">

                        <span>Biaya Tambahan</span>

                        <strong>Rp 0</strong>

                    </div>


                    <div class="total-box">

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

                </section>


                {{-- STATUS PEMBAYARAN --}}

                <section class="card">

                    <h2>Status Pembayaran</h2>

                    @if($pemesanan->pembayaran)

                        <div class="detail-row">

                            <span>Metode Pembayaran</span>

                            <strong>
                                {{ strtoupper(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $pemesanan->pembayaran->metode_pembayaran
                                    )
                                ) }}
                            </strong>

                        </div>

                        <div class="detail-row">

                            <span>Kode Referensi</span>

                            <strong>
                                {{ $pemesanan->pembayaran->kode_referensi ?? '-' }}
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

                    @else

                        <div class="payment-info">

                            <strong>Belum Ada Pembayaran</strong>

                            Kamu sudah berhasil melakukan booking.
                            Silakan lanjutkan ke tahap pemilihan
                            metode pembayaran.

                        </div>

                    @endif

                </section>


                {{-- INFORMASI --}}
                @if(
                    $pemesanan->status === 'lunas'
                    && $pemesanan->pembayaran?->status === 'berhasil'
                )

                    <div class="payment-info">
                        <strong>✓ Pembayaran Berhasil</strong>

                        Pembayaran telah terverifikasi dan pemesanan
                        sudah berstatus lunas. E-ticket kamu sudah
                        tersedia dan dapat dicetak.
                    </div>

                @elseif($pemesanan->pembayaran?->status === 'gagal')

                    <div class="payment-info">
                        <strong>Pembayaran Gagal</strong>

                        Pembayaran belum berhasil. Kamu masih dapat
                        mencoba kembali melalui proses pembayaran.
                    </div>

                @elseif($pemesanan->pembayaran)

                    <div class="payment-info">
                        <strong>Pembayaran Menunggu</strong>

                        Metode pembayaran telah dipilih. Silakan
                        lanjutkan proses pembayaran.
                    </div>

                @else

                    <div class="payment-info">
                        <strong>Belum Ada Pembayaran</strong>

                        Silakan pilih metode pembayaran untuk
                        menyelesaikan transaksi.
                    </div>

                @endif



                {{-- TOMBOL --}}

                
                <div class="actions">

                    <a
                        href="{{ route('booking.success', $pemesanan->kode_booking) }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>


                    @if(
                        $pemesanan->status === 'lunas'
                        && $pemesanan->pembayaran?->status === 'berhasil'
                    )

                        <a
                            href="{{ route('booking.tickets.index', $pemesanan->kode_booking) }}"
                            class="btn btn-primary"
                        >
                            Lihat E-Ticket
                        </a>

                    @elseif($pemesanan->status === 'booking' && $pemesanan->pembayaran)

                        <a
                            href="{{ route('booking.payment.process', $pemesanan->kode_booking) }}"
                            class="btn btn-primary"
                        >
                            Lanjutkan Pembayaran
                        </a>

                    @elseif($pemesanan->status === 'booking')

                        <a
                            href="{{ route('booking.payment.methods', $pemesanan->kode_booking) }}"
                            class="btn btn-primary"
                        >
                            Pilih Metode Pembayaran
                        </a>

                    @endif

                </div>


            </div>

        </div>

    </main>


    <footer>

        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.

    </footer>

</body>
</html>