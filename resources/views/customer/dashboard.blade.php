<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Customer - CinemaTicket</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #0b1020;
            --surface: #151e33;
            --surface-2: #10172b;
            --border: #26344f;
            --gold: #f5b942;
            --gold-hover: #ffd16a;
            --text: #ffffff;
            --muted: #94a3b8;
            --green: #4ade80;
            --red: #fb7185;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        /* NAVBAR */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 19px 8%;

            background: rgba(16, 23, 43, .97);
            backdrop-filter: blur(12px);

            border-bottom: 1px solid var(--border);
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
            letter-spacing: .5px;
        }

        .logo span {
            color: var(--gold);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-links a {
            color: #cbd5e1;
            font-size: 13px;
            transition: .2s;
        }

        .nav-links a:hover {
            color: var(--gold);
        }

        .logout {
            background: transparent;
            border: 1px solid #34435e;
            border-radius: 7px;
            color: white;
            padding: 10px 16px;
            cursor: pointer;
            transition: .2s;
        }

        .logout:hover {
            border-color: var(--gold);
            color: var(--gold);
        }


        /* MAIN CONTAINER */

        .container {
            width: min(1180px, 90%);
            margin: 38px auto 80px;
        }


        /* WELCOME */

        .welcome {
            position: relative;
            overflow: hidden;

            padding: 36px;

            background:
                linear-gradient(
                    110deg,
                    #263b63,
                    #151e33
                );

            border: 1px solid #34435e;
            border-radius: 15px;

            margin-bottom: 30px;
        }

        .welcome::after {
            content: "";

            position: absolute;

            width: 260px;
            height: 260px;

            border-radius: 50%;

            background: rgba(245,185,66,.07);

            right: -80px;
            top: -110px;

            pointer-events: none;
        }

        .eyebrow {
            color: var(--gold);
            letter-spacing: 3px;
            font-size: 10px;
            margin-bottom: 13px;
            font-weight: bold;
        }

        .welcome h1 {
            font-size: 31px;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .welcome h1 span {
            color: var(--gold);
        }

        .welcome p {
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.8;
            max-width: 600px;
        }

        .welcome-action {
            display: inline-flex;
            align-items: center;

            margin-top: 23px;

            background: var(--gold);
            color: #10172b;

            padding: 12px 19px;
            border-radius: 7px;

            font-size: 12px;
            font-weight: bold;

            transition: .2s;
        }

        .welcome-action:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
        }


        /* FLASH MESSAGE */

        .alert {
            padding: 14px 17px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert.success {
            background: rgba(34,197,94,.12);
            border: 1px solid rgba(34,197,94,.2);
            color: var(--green);
        }

        .alert.error {
            background: rgba(239,68,68,.12);
            border: 1px solid rgba(239,68,68,.2);
            color: #fca5a5;
        }

        .alert.info {
            background: rgba(59,130,246,.12);
            border: 1px solid rgba(59,130,246,.2);
            color: #93c5fd;
        }


        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;

            margin-bottom: 37px;
        }

        .stat-card {
            display: block;

            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 11px;

            padding: 19px;

            transition: .2s;
        }

        .stat-card:hover {
            border-color: var(--gold);
            transform: translateY(-3px);
        }

        .stat-card.active {
            border-color: var(--gold);
            background: #1d2b45;
        }

        .stat-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 13px;
            line-height: 1.5;
        }

        .stat-number {
            font-size: 27px;
            font-weight: bold;
            color: white;
        }

        .stat-card.active .stat-number {
            color: var(--gold);
        }

        .stat-description {
            color: #64748b;
            font-size: 10px;
            margin-top: 7px;
        }


        /* SECTION HEADING */

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 15px;

            margin-bottom: 20px;
        }

        .section-heading h2 {
            font-size: 21px;
            margin-bottom: 7px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 12px;
        }


        /* FILTER TABS */

        .filter-tabs {
            display: flex;
            gap: 9px;

            overflow-x: auto;

            padding-bottom: 12px;
            margin-bottom: 15px;
        }

        .filter-tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            white-space: nowrap;

            padding: 11px 15px;

            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 7px;

            color: #cbd5e1;

            font-size: 11px;
            font-weight: bold;

            transition: .2s;
        }

        .filter-tab:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .filter-tab.active {
            background: var(--gold);
            border-color: var(--gold);
            color: #10172b;
        }

        .filter-count {
            min-width: 19px;
            height: 19px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0 5px;

            background: rgba(148,163,184,.15);
            border-radius: 20px;

            font-size: 10px;
        }

        .filter-tab.active .filter-count {
            background: rgba(16,23,43,.15);
        }


        /* BOOKING CARD */

        .booking-card {
            display: flex;
            gap: 23px;

            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;

            padding: 21px;

            margin-bottom: 16px;

            transition: .2s;
        }

        .booking-card:hover {
            border-color: #425778;
        }


        /* POSTER */

        .poster-wrap {
            width: 105px;
            min-width: 105px;
            height: 150px;

            overflow: hidden;

            background: #0b1020;
            border: 1px solid var(--border);
            border-radius: 8px;
        }

        .poster {
            width: 100%;
            height: 100%;

            object-fit: contain;

            display: block;
        }

        .poster-fallback {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            text-align: center;

            color: var(--gold);
            font-size: 12px;
            font-weight: bold;

            padding: 10px;
        }


        /* BOOKING CONTENT */

        .booking-content {
            flex: 1;
            min-width: 0;
        }

        .booking-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 15px;

            margin-bottom: 17px;
        }

        .movie-title {
            font-size: 18px;
            line-height: 1.4;
            margin-bottom: 7px;
        }

        .booking-code {
            color: var(--muted);
            font-size: 11px;
            overflow-wrap: anywhere;
        }


        /* CATEGORY BADGE */

        .status {
            display: inline-flex;
            align-items: center;

            padding: 7px 11px;

            border-radius: 20px;

            font-size: 9px;
            font-weight: bold;

            white-space: nowrap;
        }

        .status.upcoming {
            background: rgba(59,130,246,.13);
            color: #60a5fa;
        }

        .status.completed {
            background: rgba(34,197,94,.13);
            color: var(--green);
        }

        .status.pending {
            background: rgba(245,185,66,.13);
            color: var(--gold);
        }

        .status.cancelled {
            background: rgba(251,113,133,.13);
            color: var(--red);
        }

        .status.other {
            background: rgba(148,163,184,.13);
            color: #cbd5e1;
        }


        /* BOOKING DETAILS */

        .details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);

            gap: 19px;

            padding: 17px 0;

            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .detail small {
            display: block;

            color: var(--muted);

            font-size: 10px;
            margin-bottom: 8px;
        }

        .detail strong {
            display: block;

            color: #e2e8f0;

            font-size: 12px;
            line-height: 1.6;

            overflow-wrap: anywhere;
        }


        /* SEATS */

        .seat-list {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .seat {
            background: #263b63;
            color: var(--gold);

            border-radius: 5px;

            padding: 5px 8px;

            font-size: 10px;
            font-weight: bold;
        }


        /* BOOKING BOTTOM */

        .booking-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 15px;

            margin-top: 17px;
        }

        .total-label {
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
        }

        .total {
            color: var(--gold);
            font-size: 19px;
            font-weight: bold;
        }

        .action {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--gold);
            color: #10172b;

            padding: 11px 16px;

            border-radius: 7px;

            font-size: 11px;
            font-weight: bold;

            transition: .2s;
        }

        .action:hover {
            background: var(--gold-hover);
            transform: translateY(-2px);
        }

        .action.disabled {
            background: #26344f;
            color: #94a3b8;
            cursor: default;
            transform: none;
        }


        /* EMPTY STATE */

        .empty {
            background: var(--surface);
            border: 1px solid var(--border);

            padding: 65px 20px;

            border-radius: 13px;

            text-align: center;
        }

        .empty-icon {
            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 20px;

            border-radius: 50%;

            background: #263b63;

            color: var(--gold);

            font-size: 25px;
        }

        .empty h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .empty p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;

            max-width: 430px;

            margin: 0 auto 23px;
        }


        /* PAGINATION */

        .pagination {
            margin-top: 25px;
        }


        /* FOOTER */

        footer {
            padding: 26px;

            text-align: center;

            background: var(--surface-2);

            color: var(--muted);

            font-size: 11px;

            border-top: 1px solid var(--border);
        }


        /* RESPONSIVE */

        @media(max-width: 1050px) {

            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }

        }


        @media(max-width: 700px) {

            .navbar {
                padding: 16px 5%;
            }

            .logo {
                font-size: 19px;
            }

            .nav-links {
                gap: 12px;
            }

            .nav-links a {
                font-size: 11px;
            }

            .logout {
                padding: 8px 11px;
                font-size: 11px;
            }

            .container {
                width: 92%;
                margin-top: 25px;
            }

            .welcome {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-number {
                font-size: 23px;
            }

            .booking-card {
                padding: 16px;
                gap: 14px;
            }

            .poster-wrap {
                width: 83px;
                min-width: 83px;
                height: 123px;
            }

            .movie-title {
                font-size: 15px;
            }

            .booking-top {
                flex-direction: column;
                gap: 10px;
            }

            .details {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .booking-bottom {
                align-items: flex-start;
                flex-direction: column;
            }

            .action {
                width: 100%;
            }

        }


        @media(max-width: 430px) {

            .navbar {
                padding: 14px 4%;
            }

            .nav-links {
                gap: 9px;
            }

            .nav-links a {
                font-size: 10px;
            }

            .logo {
                font-size: 16px;
            }

            .welcome {
                padding: 21px;
            }

            .welcome h1 {
                font-size: 22px;
            }

            .section-heading h2 {
                font-size: 18px;
            }

            .booking-card {
                gap: 11px;
                padding: 13px;
            }

            .poster-wrap {
                width: 70px;
                min-width: 70px;
                height: 105px;
            }

            .details {
                grid-template-columns: 1fr 1fr;
            }

            .status {
                font-size: 8px;
            }

        }

    </style>

    @include('layouts.partials.public-navbar-styles')

</head>


<body>


{{-- NAVBAR --}}

@include('layouts.partials.public-navbar')


<main class="container">


    {{-- WELCOME SECTION --}}

    <section class="welcome">

        <div class="eyebrow">
            CUSTOMER DASHBOARD
        </div>

        <h1>
            Halo, <span>{{ auth()->user()->name }}</span>!
        </h1>

        <p>
            Selamat datang kembali di CinemaTicket.

            Kelola semua pemesanan, pantau status pembayaran,
            dan akses tiket bioskopmu kapan saja melalui akun ini.
        </p>

        <a
            href="{{ route('home') }}#film"
            class="welcome-action"
        >
            Jelajahi Film →
        </a>

    </section>


    {{-- FLASH MESSAGE --}}

    @if(session('success'))

        <div class="alert success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert error">
            {{ session('error') }}
        </div>

    @endif


    @if(session('info'))

        <div class="alert info">
            {{ session('info') }}
        </div>

    @endif


    {{-- STATISTICS --}}

    <section class="stats-grid">

        <a
            href="{{ route('customer.dashboard', ['filter' => 'all']) }}"
            class="stat-card {{ $filter === 'all' ? 'active' : '' }}"
        >

            <div class="stat-label">
                Total Pemesanan
            </div>

            <div class="stat-number">
                {{ $filterCounts['all'] }}
            </div>

            <div class="stat-description">
                Semua transaksi
            </div>

        </a>


        <a
            href="{{ route('customer.dashboard', ['filter' => 'upcoming']) }}"
            class="stat-card {{ $filter === 'upcoming' ? 'active' : '' }}"
        >

            <div class="stat-label">
                Upcoming
            </div>

            <div class="stat-number">
                {{ $filterCounts['upcoming'] }}
            </div>

            <div class="stat-description">
                Akan / sedang tayang
            </div>

        </a>


        <a
            href="{{ route('customer.dashboard', ['filter' => 'pending']) }}"
            class="stat-card {{ $filter === 'pending' ? 'active' : '' }}"
        >

            <div class="stat-label">
                Pending Payment
            </div>

            <div class="stat-number">
                {{ $filterCounts['pending'] }}
            </div>

            <div class="stat-description">
                Menunggu pembayaran
            </div>

        </a>


        <a
            href="{{ route('customer.dashboard', ['filter' => 'completed']) }}"
            class="stat-card {{ $filter === 'completed' ? 'active' : '' }}"
        >

            <div class="stat-label">
                Completed
            </div>

            <div class="stat-number">
                {{ $filterCounts['completed'] }}
            </div>

            <div class="stat-description">
                Film sudah selesai tayang
            </div>

        </a>


        <a
            href="{{ route('customer.dashboard', ['filter' => 'cancelled']) }}"
            class="stat-card {{ $filter === 'cancelled' ? 'active' : '' }}"
        >

            <div class="stat-label">
                Cancelled / Expired
            </div>

            <div class="stat-number">
                {{ $filterCounts['cancelled'] }}
            </div>

            <div class="stat-description">
                Transaksi tidak aktif
            </div>

        </a>

    </section>


    {{-- BOOKING HISTORY --}}

    <section>


        <div class="section-heading">

            <div>

                <h2>
                    Riwayat Pemesanan
                </h2>

                <p>
                    Semua transaksi tiket yang terhubung dengan akunmu.
                </p>

            </div>

        </div>


        {{-- FILTER TABS --}}

        @php

            $tabs = [

                'all' => 'Semua',

                'upcoming' => 'Upcoming',

                'pending' => 'Pending Payment',

                'completed' => 'Completed',

                'cancelled' => 'Cancelled',

            ];

        @endphp


        <div class="filter-tabs">

            @foreach($tabs as $key => $label)

                <a
                    href="{{ route('customer.dashboard', ['filter' => $key]) }}"
                    class="filter-tab {{ $filter === $key ? 'active' : '' }}"
                >

                    {{ $label }}

                    <span class="filter-count">
                        {{ $filterCounts[$key] }}
                    </span>

                </a>

            @endforeach

        </div>


        {{-- TRANSACTION LIST --}}

        @forelse($pemesanans as $pemesanan)


            @php

                $jadwal = $pemesanan->jadwal;

                $film = $jadwal?->film;

                $studio = $jadwal?->studio;

                $showAt = $jadwal
                    ? \Carbon\Carbon::parse(
                        $jadwal->tanggal_tayang . ' ' . $jadwal->jam_mulai,
                        'Asia/Jakarta'
                    )
                    : null;

                $showEnd = $jadwal
                    ? \Carbon\Carbon::parse(
                        $jadwal->tanggal_tayang . ' ' . $jadwal->jam_selesai,
                        'Asia/Jakarta'
                    )
                    : null;


                $isCompleted = $showEnd
                    ? $showEnd->lt(now('Asia/Jakarta'))
                    : false;


                $isPaid = (
                    $pemesanan->status === 'lunas'
                    && $pemesanan->pembayaran?->status === 'berhasil'
                );


                /*
                | KATEGORI TRANSAKSI
                */

                $category = match($pemesanan->status) {

                    'lunas' => $isCompleted
                        ? 'completed'
                        : 'upcoming',

                    'booking' => 'pending',

                    'dibatalkan',
                    'kedaluwarsa' => 'cancelled',

                    default => 'other',

                };


                /*
                | LABEL KATEGORI
                */

                $categoryLabel = match($category) {

                    'upcoming' => 'BELUM SELESAI',

                    'completed' => 'SELESAI',

                    'pending' => 'MENUNGGU PEMBAYARAN',

                    'cancelled' => 'TIDAK AKTIF',

                    default => 'LAINNYA',

                };


                /*
                | STATUS PEMBAYARAN
                */

                $paymentLabel = match($pemesanan->status) {

                    'lunas' => 'LUNAS',

                    'booking' => match($pemesanan->pembayaran?->status) {

                        'gagal' => 'PEMBAYARAN GAGAL',

                        'menunggu' => 'MENUNGGU PEMBAYARAN',

                        default => 'BELUM DIBAYAR',

                    },

                    'dibatalkan' => 'DIBATALKAN',

                    'kedaluwarsa' => 'KEDALUWARSA',

                    default => strtoupper($pemesanan->status),

                };


                $seatCount = $pemesanan->detailKursis->count();

                $paymentMethod = $pemesanan->pembayaran?->metode_pembayaran;

            @endphp


            <article class="booking-card">


                {{-- POSTER FILM --}}

                <div class="poster-wrap">

                    @if($film && $film->poster)

                        <img
                            src="{{ asset('storage/' . ltrim($film->poster, '/')) }}"
                            alt="{{ $film->judul }}"
                            class="poster"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >

                        <div
                            class="poster-fallback"
                            style="display:none;"
                        >
                            CINEMA<br>TICKET
                        </div>

                    @else

                        <div class="poster-fallback">
                            CINEMA<br>TICKET
                        </div>

                    @endif

                </div>


                {{-- BOOKING CONTENT --}}

                <div class="booking-content">


                    {{-- TOP --}}

                    <div class="booking-top">

                        <div>

                            <h3 class="movie-title">
                                {{ $film?->judul ?? 'Film tidak tersedia' }}
                            </h3>

                            <div class="booking-code">
                                Booking:
                                {{ $pemesanan->kode_booking }}
                            </div>

                        </div>


                        <span class="status {{ $category }}">

                            {{ $categoryLabel }}

                        </span>

                    </div>


                    {{-- DETAILS --}}

                    <div class="details">


                        <div class="detail">

                            <small>
                                Tanggal Tayang
                            </small>

                            <strong>

                                {{ $jadwal
                                    ? \Carbon\Carbon::parse($jadwal->tanggal_tayang)->locale('id')->translatedFormat('d F Y')
                                    : '-'
                                }}

                            </strong>

                        </div>


                        <div class="detail">

                            <small>
                                Jam Tayang
                            </small>

                            <strong>

                                {{ $jadwal
                                    ? substr($jadwal->jam_mulai, 0, 5) . ' WIB'
                                    : '-'
                                }}

                            </strong>

                        </div>


                        <div class="detail">

                            <small>
                                Studio
                            </small>

                            <strong>
                                {{ $studio?->nama ?? '-' }}
                            </strong>

                        </div>


                        <div class="detail">

                            <small>
                                Nomor Kursi
                            </small>

                            <div class="seat-list">

                                @forelse($pemesanan->detailKursis as $detail)

                                    <span class="seat">
                                        {{ $detail->no_kursi }}
                                    </span>

                                @empty

                                    <strong>-</strong>

                                @endforelse

                            </div>

                        </div>


                        <div class="detail">

                            <small>
                                Jumlah Tiket
                            </small>

                            <strong>
                                {{ $seatCount }} Tiket
                            </strong>

                        </div>


                        <div class="detail">

                            <small>
                                Metode Pembayaran
                            </small>

                            <strong>

                                {{ $paymentMethod
                                    ? strtoupper(str_replace('_', ' ', $paymentMethod))
                                    : '-'
                                }}

                            </strong>

                        </div>


                        <div class="detail">

                            <small>
                                Status Pembayaran
                            </small>

                            <strong>
                                {{ $paymentLabel }}
                            </strong>

                        </div>


                        <div class="detail">

                            <small>
                                Tanggal Pemesanan
                            </small>

                            <strong>

                                {{ $pemesanan->created_at
                                    ? $pemesanan->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i')
                                    : '-'
                                }}

                            </strong>

                        </div>


                    </div>


                    {{-- BOTTOM --}}

                    <div class="booking-bottom">


                        <div>

                            <div class="total-label">
                                Total Pembayaran
                            </div>

                            <div class="total">

                                Rp {{ number_format(
                                    (float) $pemesanan->total_harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>


                        {{-- ACTION BUTTON --}}

                        @if($isPaid)

                            <a
                                href="{{ route('booking.tickets.index', $pemesanan->kode_booking) }}"
                                class="action"
                            >
                                Lihat E-Ticket →
                            </a>


                        @elseif($pemesanan->status === 'booking')

                            <a
                                href="{{ route('booking.payment.summary', $pemesanan->kode_booking) }}"
                                class="action"
                            >
                                Lanjutkan Pembayaran →
                            </a>


                        @elseif(
                            in_array(
                                $pemesanan->status,
                                ['dibatalkan', 'kedaluwarsa']
                            )
                        )

                            <span class="action disabled">
                                Transaksi Tidak Aktif
                            </span>


                        @endif


                    </div>


                </div>

            </article>


        @empty


            {{-- EMPTY STATE --}}

            <div class="empty">

                <div class="empty-icon">
                    🎬
                </div>


                @if($filter === 'all')

                    <h3>
                        Belum Ada Riwayat Pemesanan
                    </h3>

                    <p>
                        Kamu belum memiliki transaksi tiket.

                        Yuk, temukan film favoritmu dan mulai pengalaman
                        menonton bersama CinemaTicket!
                    </p>

                @elseif($filter === 'upcoming')

                    <h3>
                        Belum Ada Tiket Upcoming
                    </h3>

                    <p>
                        Kamu belum memiliki tiket lunas untuk jadwal
                        yang akan atau sedang berlangsung.
                    </p>

                @elseif($filter === 'pending')

                    <h3>
                        Tidak Ada Pembayaran Tertunda
                    </h3>

                    <p>
                        Semua transaksi pembayaranmu sudah tidak memiliki
                        status menunggu.
                    </p>

                @elseif($filter === 'completed')

                    <h3>
                        Belum Ada Riwayat Film Selesai
                    </h3>

                    <p>
                        Tiket untuk film yang sudah selesai ditayangkan
                        akan muncul di sini.
                    </p>

                @elseif($filter === 'cancelled')

                    <h3>
                        Tidak Ada Transaksi Dibatalkan
                    </h3>

                    <p>
                        Kamu belum memiliki transaksi yang dibatalkan
                        atau kedaluwarsa.
                    </p>

                @endif


                <a
                    href="{{ route('home') }}#film"
                    class="action"
                >
                    Jelajahi Film →
                </a>

            </div>


        @endforelse


        {{-- PAGINATION --}}

        @if($pemesanans->hasPages())

            <div class="pagination">

                {{ $pemesanans->links() }}

            </div>

        @endif


    </section>


</main>


{{-- FOOTER --}}

<footer>

    &copy; {{ date('Y') }} CinemaTicket.

    Sistem Pemesanan Tiket Bioskop.

</footer>


</body>

</html>