<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-Ticket - CinemaTicket</title>

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

        .container {
            width: min(950px, 90%);
            margin: 45px auto 75px;
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

        .success-alert {
            margin: 25px 0;
            padding: 17px;
            border: 1px solid rgba(34,197,94,.35);
            background: rgba(34,197,94,.08);
            border-radius: 9px;
            color: #4ade80;
            font-size: 12px;
            line-height: 1.7;
        }

        .ticket-card {
            background: #ffffff;
            color: #10172b;
            border-radius: 15px;
            overflow: hidden;
            margin: 28px 0;
            box-shadow: 0 15px 35px rgba(0,0,0,.2);
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .ticket-header {
            background: #10172b;
            color: white;
            padding: 23px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .ticket-brand {
            color: #f5b942;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .ticket-header h2 {
            font-size: 21px;
        }

        .paid-badge {
            background: rgba(34,197,94,.15);
            color: #4ade80;
            border: 1px solid rgba(34,197,94,.4);
            border-radius: 20px;
            padding: 8px 13px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .ticket-body {
            display: grid;
            grid-template-columns: 1fr 245px;
            gap: 25px;
            padding: 28px;
        }

        .ticket-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 23px 18px;
        }

        .info-item small {
            display: block;
            color: #64748b;
            font-size: 10px;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-item strong {
            display: block;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .ticket-code {
            color: #b7791f;
            font-size: 15px !important;
        }

        .seat-highlight {
            display: inline-block;
            padding: 9px 15px;
            background: #fef3c7;
            color: #92400e;
            border-radius: 6px;
            font-size: 19px !important;
        }

        .qr-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            text-align: center;
        }

        .qr-panel small {
            color: #64748b;
            font-size: 10px;
            margin-top: 12px;
            line-height: 1.6;
        }

        .qr-frame {
            background: white;
            padding: 8px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket-footer {
            border-top: 1px dashed #cbd5e1;
            padding: 17px 28px;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin: 30px 0;
        }

        .btn {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            border: none;
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

        footer {
            padding: 25px;
            text-align: center;
            background: #10172b;
            border-top: 1px solid #26344f;
            color: #94a3b8;
            font-size: 12px;
        }

        @media(max-width: 650px) {
            .ticket-body {
                grid-template-columns: 1fr;
            }

            .qr-panel {
                min-height: 240px;
            }

            .ticket-info {
                gap: 18px 12px;
            }

            .ticket-header h2 {
                font-size: 17px;
            }

            .actions {
                flex-direction: column;
            }
        }

        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: white;
                color: #10172b;
            }

            .navbar,
            .page-heading,
            .success-alert,
            .actions,
            footer {
                display: none !important;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .ticket-card {
                box-shadow: none;
                border: 1px solid #cbd5e1;
                margin: 0;
                border-radius: 0;
                break-after: page;
                page-break-after: always;
            }

            .ticket-card:last-child {
                break-after: auto;
                page-break-after: auto;
            }

            .ticket-header {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .paid-badge,
            .qr-panel,
            .seat-highlight {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>

    @include('layouts.partials.public-navbar')


    <main class="container">

        <div class="page-heading">
            <div class="eyebrow">YOUR DIGITAL TICKET</div>

            <h1>E-Ticket CinemaTicket</h1>

            <p class="subtitle">
                Pembayaran berhasil. Berikut tiket elektronik
                untuk setiap kursi yang kamu pesan.
            </p>
        </div>


        <div class="success-alert">
            <strong>✓ Pembayaran terverifikasi!</strong>
            Semua tiket di bawah ini telah diterbitkan.
            Simpan atau cetak tiket sebelum datang ke bioskop.
        </div>


        @foreach($pemesanan->detailKursis as $detail)

            <section class="ticket-card">

                <div class="ticket-header">

                    <div>
                        <div class="ticket-brand">
                            CINEMATICKET
                        </div>

                        <h2>
                            {{ $pemesanan->jadwal->film->judul }}
                        </h2>
                    </div>

                    <span class="paid-badge">
                        PAID / LUNAS
                    </span>

                </div>


                <div class="ticket-body">

                    <div class="ticket-info">

                        <div class="info-item">
                            <small>KODE TIKET</small>

                            <strong class="ticket-code">
                                {{ $detail->kode_tiket }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>KODE BOOKING</small>

                            <strong>
                                {{ $pemesanan->kode_booking }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>NAMA PEMESAN</small>

                            <strong>
                                {{ $pemesanan->nama_pemesan }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>TANGGAL TAYANG</small>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                    $pemesanan->jadwal->tanggal_tayang
                                )->format('d M Y') }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>JAM TAYANG</small>

                            <strong>
                                {{ substr($pemesanan->jadwal->jam_mulai, 0, 5) }}
                                -
                                {{ substr($pemesanan->jadwal->jam_selesai, 0, 5) }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>STUDIO</small>

                            <strong>
                                {{ $pemesanan->jadwal->studio->nama }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>NOMOR KURSI</small>

                            <strong class="seat-highlight">
                                {{ $detail->no_kursi }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <small>HARGA TIKET</small>

                            <strong>
                                Rp {{ number_format(
                                    (float) $detail->harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </strong>
                        </div>

                    </div>


                    <div class="qr-panel">

                        <div class="qr-frame">

                            <x-qr-code
                                :data="route('booking.ticket.show', $detail->kode_tiket)"
                                size="210"
                                color="#10172b"
                                margin="2"
                            />

                        </div>

                        <small>
                            Pindai QR Code untuk membuka
                            halaman verifikasi tiket.
                        </small>

                    </div>

                </div>


                <div class="ticket-footer">

                    <span>
                        Tunjukkan QR Code saat memasuki bioskop.
                    </span>

                    <strong>
                        CINEMATICKET
                    </strong>

                </div>

            </section>

        @endforeach


        <div class="actions no-print">

            <button
                type="button"
                class="btn btn-primary"
                onclick="window.print()"
            >
                Cetak Semua E-Ticket
            </button>

            <a
                href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
                class="btn btn-secondary"
            >
                Kembali ke Ringkasan
            </a>

        </div>

    </main>


    <footer>
        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.
    </footer>

</body>
</html>