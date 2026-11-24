<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pemesan - CinemaTicket</title>

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
            padding: 20px 8%;
            min-height: 76px;
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
            width: min(900px, 90%);
            margin: 45px auto 80px;
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
            letter-spacing: 3px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        h1 {
            font-size: 31px;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.8;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 22px;
            margin-top: 30px;
        }

        .card {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 13px;
            padding: 25px;
        }

        .card h2 {
            font-size: 17px;
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            color: #cbd5e1;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            border: 1px solid #34435e;
            border-radius: 8px;
            background: #202c45;
            color: white;
            outline: none;
            font-size: 13px;
        }

        .form-group input:focus {
            border-color: #f5b942;
        }

        .form-group input::placeholder {
            color: #64748b;
        }

        .field-error {
            color: #f87171;
            font-size: 11px;
            margin-top: 7px;
        }

        .help-text {
            color: #64748b;
            font-size: 11px;
            margin-top: 7px;
            line-height: 1.6;
        }

        .summary-item {
            padding: 13px 0;
            border-bottom: 1px solid #26344f;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item small {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            margin-bottom: 7px;
        }

        .summary-item strong {
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .seat-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-top: 5px;
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
            gap: 10px;
            margin-top: 18px;
            padding-top: 17px;
            border-top: 1px solid #34435e;
        }

        .price-row span {
            color: #94a3b8;
            font-size: 12px;
        }

        .price-row strong {
            color: #f5b942;
            font-size: 20px;
        }

        .notice {
            margin-top: 17px;
            padding: 13px;
            border-radius: 8px;
            background: rgba(245,185,66,.09);
            border: 1px solid rgba(245,185,66,.3);
            color: #f5b942;
            font-size: 11px;
            line-height: 1.7;
        }

        .btn-submit {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 8px;
            background: #f5b942;
            color: #10172b;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: #ffd477;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #94a3b8;
            font-size: 12px;
        }

        .btn-back:hover {
            color: #f5b942;
        }

        .alert-error {
            background: rgba(239,68,68,.12);
            border: 1px solid #991b1b;
            color: #f87171;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 12px;
            line-height: 1.7;
        }

        footer {
            padding: 25px;
            text-align: center;
            background: #10172b;
            border-top: 1px solid #26344f;
            color: #94a3b8;
            font-size: 12px;
        }

        @media(max-width:700px) {

            .content-grid {
                grid-template-columns: 1fr;
            }

            .container {
                margin-top: 30px;
            }

            h1 {
                font-size: 26px;
            }

        }

        @media(max-width:500px) {

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

        }

    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>

    {{-- NAVBAR --}}

    @include('layouts.partials.public-navbar')


    <main class="container">

        <a href="{{ route('booking.seats') }}" class="back-link">
            &larr; Kembali ke pemilihan kursi
        </a>


        <div class="eyebrow">
            CUSTOMER INFORMATION
        </div>

        <h1>Data Pemesan</h1>

        <p class="subtitle">
            Lengkapi identitas pemesan untuk menyelesaikan
            proses booking tiket bioskop.
        </p>


        @if($errors->any())

            <div class="alert-error">

                @foreach($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif


        <div class="content-grid">


            {{-- FORM IDENTITAS --}}

            <section class="card">

                <h2>Informasi Pemesan</h2>

                <form
                    action="{{ route('booking.store') }}"
                    method="POST"
                >

                    @csrf

                    <div class="form-group">

                        <label for="nama_pemesan">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="nama_pemesan"
                            value="{{ auth()->user()->name }}"
                            readonly
                            style="cursor: not-allowed; opacity: .8;"
                        >

                        <p class="help-text">
                            Nama pemesan diambil otomatis dari akun CinemaTicket kamu.
                        </p>

                    </div>


                    <div class="form-group">

                        <label for="no_hp">
                            Nomor HP
                        </label>

                        <input
                            type="tel"
                            name="no_hp"
                            id="no_hp"
                            placeholder="Contoh: 081234567890"
                            value="{{ old('no_hp') }}"
                            maxlength="20"
                            minlength="8"
                            pattern="[0-9+() -]{8,20}"
                            inputmode="tel"
                            autocomplete="tel"
                            required
                        >

                        <p class="help-text">
                            Gunakan nomor HP aktif agar informasi
                            pemesanan dapat dihubungi.
                        </p>

                        @error('no_hp')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="notice">

                        Pastikan nama dan nomor HP sudah benar
                        sebelum membuat pemesanan.

                    </div>


                    <button
                        type="submit"
                        class="btn-submit"
                    >
                        Buat Pemesanan →
                    </button>


                    <a
                        href="{{ route('booking.seats') }}"
                        class="btn-back"
                    >
                        Ubah Pilihan Kursi
                    </a>

                </form>

            </section>


            {{-- RINGKASAN PEMESANAN --}}

            <section class="card">

                <h2>Ringkasan Pemesanan</h2>


                <div class="summary-item">

                    <small>Film</small>

                    <strong>
                        {{ $jadwal->film->judul }}
                    </strong>

                </div>


                <div class="summary-item">

                    <small>Tanggal Penayangan</small>

                    <strong>
                        {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}
                    </strong>

                </div>


                <div class="summary-item">

                    <small>Jam Tayang</small>

                    <strong>
                        {{ date('H:i', strtotime($jadwal->jam_mulai)) }}
                        -
                        {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                    </strong>

                </div>


                <div class="summary-item">

                    <small>Studio</small>

                    <strong>
                        {{ $jadwal->studio->nama }}
                        ({{ $jadwal->studio->tipe }})
                    </strong>

                </div>


                <div class="summary-item">

                    <small>Kursi Dipilih</small>

                    <div class="seat-tags">

                        @foreach($selectedSeats as $seat)

                            <span class="seat-tag">
                                {{ $seat }}
                            </span>

                        @endforeach

                    </div>

                </div>


                <div class="summary-item">

                    <small>Jumlah Kursi</small>

                    <strong>
                        {{ $seatCount }} Kursi
                    </strong>

                </div>


                <div class="summary-item">

                    <small>Harga per Tiket</small>

                    <strong>
                        Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}
                    </strong>

                </div>


                <div class="price-row">

                    <span>Total Harga</span>

                    <strong>
                        Rp {{ number_format($totalPrice, 0, ',', '.') }}
                    </strong>

                </div>

            </section>

        </div>

    </main>


    <footer>

        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.

    </footer>

</body>
</html>