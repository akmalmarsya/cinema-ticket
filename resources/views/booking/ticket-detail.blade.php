<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Tiket - CinemaTicket</title>

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

        .container {
            width: min(650px, 92%);
            margin: 55px auto;
        }

        .card {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 15px;
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding: 30px;
            background: rgba(34,197,94,.08);
            border-bottom: 1px solid #26344f;
        }

        .check {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: rgba(34,197,94,.15);
            color: #4ade80;
            font-size: 30px;
        }

        .header h1 {
            font-size: 23px;
            margin-bottom: 9px;
        }

        .header p {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
        }

        .content {
            padding: 25px;
        }

        .brand {
            color: #f5b942;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .ticket-code {
            background: #202c45;
            border: 1px dashed #f5b942;
            border-radius: 9px;
            padding: 19px;
            text-align: center;
            margin-bottom: 22px;
        }

        .ticket-code small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .ticket-code strong {
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

        .detail-row span {
            color: #94a3b8;
            font-size: 12px;
        }

        .detail-row strong {
            font-size: 12px;
            text-align: right;
        }

        .seat {
            color: #f5b942;
            font-size: 19px !important;
        }

        .valid {
            margin-top: 22px;
            padding: 15px;
            background: rgba(34,197,94,.08);
            border: 1px solid rgba(34,197,94,.35);
            border-radius: 8px;
            color: #4ade80;
            text-align: center;
            font-size: 12px;
            line-height: 1.8;
        }

        .qr {
            display: flex;
            justify-content: center;
            margin: 25px 0;
            padding: 15px;
            background: white;
            border-radius: 10px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
        }

        .btn {
            flex: 1;
            border: none;
            border-radius: 8px;
            padding: 14px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary {
            background: #f5b942;
            color: #10172b;
        }

        .btn-secondary {
            background: #26344f;
            color: white;
        }

        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }

            body {
                background: white;
                color: #10172b;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .card {
                background: white;
                color: #10172b;
                border: 1px solid #cbd5e1;
            }

            .header {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .actions {
                display: none;
            }
        }

        @media(max-width: 500px) {
            .container {
                margin: 25px auto;
            }

            .content {
                padding: 18px;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <main class="container">

        <section class="card">

            <div class="header">

                <div class="check">✓</div>

                <h1>Tiket Valid</h1>

                <p>
                    Tiket ini telah terdaftar dan pembayaran
                    sudah berhasil diverifikasi oleh CinemaTicket.
                </p>

            </div>


            <div class="content">

                <div class="brand">
                    CINEMATICKET
                </div>


                <div class="ticket-code">

                    <small>KODE TIKET</small>

                    <strong>
                        {{ $detailKursi->kode_tiket }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Film</span>

                    <strong>
                        {{ $detailKursi->pemesanan->jadwal->film->judul }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Nama Pemesan</span>

                    <strong>
                        {{ $detailKursi->pemesanan->nama_pemesan }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Kode Booking</span>

                    <strong>
                        {{ $detailKursi->pemesanan->kode_booking }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Tanggal</span>

                    <strong>
                        {{ \Carbon\Carbon::parse(
                            $detailKursi->pemesanan->jadwal->tanggal_tayang
                        )->format('d M Y') }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Jam</span>

                    <strong>
                        {{ substr(
                            $detailKursi->pemesanan->jadwal->jam_mulai,
                            0,
                            5
                        ) }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Studio</span>

                    <strong>
                        {{ $detailKursi->pemesanan->jadwal->studio->nama }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Nomor Kursi</span>

                    <strong class="seat">
                        {{ $detailKursi->no_kursi }}
                    </strong>

                </div>


                <div class="detail-row">

                    <span>Harga Tiket</span>

                    <strong>
                        Rp {{ number_format(
                            (float) $detailKursi->harga,
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </div>


                <div class="qr">

                    <x-qr-code
                        :data="url()->current()"
                        size="210"
                        color="#10172b"
                        margin="2"
                    />

                </div>


                <div class="valid">

                    <strong>✓ PEMBAYARAN TERVERIFIKASI</strong>

                    <br>

                    Tiket ini berstatus valid berdasarkan
                    data pemesanan CinemaTicket.

                </div>


                <div class="actions">

                    <button
                        type="button"
                        class="btn btn-primary"
                        onclick="window.print()"
                    >
                        Cetak Tiket
                    </button>

                    <a
                        href="{{ route(
                            'booking.tickets.index',
                            $detailKursi->pemesanan->kode_booking
                        ) }}"
                        class="btn btn-secondary"
                    >
                        Semua E-Ticket
                    </a>

                </div>

            </div>

        </section>

    </main>

</body>
</html>