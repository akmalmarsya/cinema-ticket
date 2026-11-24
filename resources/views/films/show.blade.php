<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $film->judul }} - CinemaTicket</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b1020;
            color: #fff;
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* NAVBAR */

        .site-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            min-height: 76px;
            padding: 18px 8%;
            background: #10172b;
            border-bottom: 1px solid #26344f;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .site-nav .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            white-space: nowrap;
        }

        .site-nav .logo span {
            color: #f5b942;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a {
            color: #cbd5e1;
            font-size: 14px;
            transition: .2s;
        }

        .nav-links a:hover {
            color: #f5b942;
        }

        .nav-links .admin-link {
            padding: 10px 17px;
            background: #f5b942;
            color: #10172b;
            border-radius: 7px;
            font-weight: bold;
        }

        .nav-links .admin-link:hover {
            background: #ffd477;
            color: #10172b;
        }

        /* MAIN */

        .page-wrap {
            width: min(1100px, 88%);
            margin: 48px auto 100px;
        }

        .back-link {
            display: inline-block;
            color: #f5b942;
            font-size: 14px;
            margin-bottom: 28px;
        }

        /* DETAIL FILM */

        .detail-card {
            display: grid;
            grid-template-columns: minmax(230px, 340px) minmax(0, 1fr);
            gap: 42px;
            padding: 30px;
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 16px;
        }

        .poster-wrap {
            width: 100%;
            aspect-ratio: 2 / 3;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #0b1020;
            border: 1px solid #26344f;
            border-radius: 10px;
        }

        .poster-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            display: block;
        }

        .poster-empty {
            text-align: center;
            color: #f5b942;
        }

        .poster-empty strong {
            display: block;
            font-size: 54px;
        }

        .eyebrow {
            color: #f5b942;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 5px 0 14px;
        }

        h1 {
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: rgba(34,197,94,.12);
            color: #4ade80;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 24px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 28px;
        }

        .meta-box {
            padding: 14px;
            background: #202c45;
            border-radius: 8px;
        }

        .meta-label {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            margin-bottom: 7px;
        }

        .meta-value {
            font-size: 14px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        h2 {
            font-size: 19px;
            margin-bottom: 12px;
        }

        .synopsis {
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.9;
            white-space: pre-line;
        }

        .detail-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 13px;
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
            border: 1px solid #475569;
            color: #cbd5e1;
        }

        /* JADWAL */

        .schedule-section {
            margin-top: 45px;
        }

        .schedule-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            margin-bottom: 22px;
        }

        .schedule-heading h2 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .schedule-subtitle {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.7;
        }

        .schedule-count {
            color: #f5b942;
            font-size: 13px;
            white-space: nowrap;
        }

        /* FILTER */

        .filter-panel {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            scroll-margin-top: 90px;
        }

        .filter-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 14px;
        }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .date-field {
            flex: 1;
            min-width: 220px;
        }

        .date-field label {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .date-field input {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border-radius: 7px;
            border: 1px solid #34435e;
            outline: none;
            background: #202c45;
            color: white;
            color-scheme: dark;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .date-field input:focus {
            border-color: #f5b942;
        }

        .filter-button,
        .reset-button {
            height: 43px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .filter-button {
            background: #f5b942;
            color: #10172b;
            border: none;
        }

        .filter-button:hover {
            background: #ffd477;
        }

        .reset-button {
            border: 1px solid #475569;
            color: #cbd5e1;
        }

        .reset-button:hover {
            border-color: #f5b942;
            color: #f5b942;
        }

        .filter-error {
            color: #f87171;
            font-size: 12px;
            margin-top: 10px;
        }

        .filter-result {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 14px;
        }

        .filter-result strong {
            color: #f5b942;
        }

        /* SCHEDULE GRID */

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .schedule-card {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 12px;
            padding: 20px;
            transition: .2s;
        }

        .schedule-card:hover {
            border-color: #f5b942;
            transform: translateY(-2px);
        }

        .schedule-card.selected {
            border: 2px solid #f5b942;
            background: #1b2942;
        }

        .schedule-date {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 1px solid #26344f;
            margin-bottom: 16px;
        }

        .date-label {
            color: #f5b942;
            font-size: 13px;
            font-weight: bold;
        }

        .schedule-active {
            color: #4ade80;
            background: rgba(34,197,94,.12);
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .schedule-time {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px;
        }

        .time-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #202c45;
            color: #f5b942;
            font-size: 20px;
        }

        .time-info small {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .time-info strong {
            font-size: 19px;
        }

        .time-info span {
            color: #94a3b8;
            font-size: 12px;
        }

        .schedule-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .schedule-detail-box {
            padding: 11px;
            border-radius: 8px;
            background: #202c45;
            min-width: 0;
        }

        .schedule-detail-box small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            margin-bottom: 6px;
        }

        .schedule-detail-box strong {
            display: block;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .schedule-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid #26344f;
            margin-bottom: 15px;
        }

        .schedule-price span {
            color: #94a3b8;
            font-size: 12px;
        }

        .schedule-price strong {
            color: #f5b942;
            font-size: 17px;
        }

        .select-schedule-button {
            width: 100%;
            padding: 12px;
            background: #202c45;
            color: #f5b942;
            border: 1px solid #475569;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .select-schedule-button:hover,
        .select-schedule-button.selected {
            background: #f5b942;
            color: #10172b;
            border-color: #f5b942;
        }

        /* EMPTY STATE */

        .empty-schedule {
            grid-column: 1 / -1;
            padding: 45px 20px;
            text-align: center;
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 12px;
        }

        .empty-schedule h3 {
            margin-bottom: 10px;
        }

        .empty-schedule p {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.7;
        }

        /* CONFIRMATION PANEL */

        .selection-confirmation {
            position: fixed;
            left: 50%;
            bottom: 18px;
            transform: translateX(-50%);
            width: min(760px, calc(100% - 32px));
            z-index: 900;

            padding: 20px;
            background: #151e33;
            border: 1px solid #f5b942;
            border-radius: 13px;
            box-shadow: 0 15px 50px rgba(0,0,0,.55);
        }

        .selection-confirmation[hidden] {
            display: none;
        }

        .confirmation-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 14px;
        }

        .confirmation-heading h3 {
            font-size: 16px;
        }

        .confirmation-heading span {
            color: #4ade80;
            font-size: 11px;
        }

        .confirmation-details {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 16px;
        }

        .confirmation-item {
            background: #202c45;
            padding: 11px;
            border-radius: 7px;
            min-width: 0;
        }

        .confirmation-item small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            margin-bottom: 6px;
        }

        .confirmation-item strong {
            display: block;
            font-size: 12px;
            overflow-wrap: anywhere;
        }

        .confirmation-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .change-selection {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 12px;
        }

        .continue-button {
            padding: 12px 20px;
            background: #f5b942;
            color: #10172b;
            border: none;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
        }

        .continue-button:hover {
            background: #ffd477;
        }

        /* FOOTER */

        footer {
            padding: 25px 8%;
            text-align: center;
            background: #10172b;
            border-top: 1px solid #26344f;
            color: #94a3b8;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 700px) {

            .detail-card {
                grid-template-columns: 1fr;
                gap: 25px;
                padding: 18px;
            }

            .page-wrap {
                width: 90%;
                margin-top: 30px;
            }

            .poster-wrap {
                width: min(100%, 300px);
                margin: auto;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }

            .schedule-heading {
                flex-direction: column;
                align-items: flex-start;
            }

        }

        @media (max-width: 600px) {

            .site-nav {
                padding: 16px 5%;
                min-height: 68px;
                flex-wrap: wrap;
                gap: 14px;
            }

            .site-nav .logo {
                font-size: 20px;
            }

            .nav-links {
                gap: 13px;
                flex-wrap: wrap;
            }

            .nav-links a {
                font-size: 12px;
            }

            .nav-links .admin-link {
                padding: 8px 12px;
            }

            .meta-grid {
                grid-template-columns: 1fr;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .date-field {
                min-width: 100%;
            }

            .filter-button,
            .reset-button {
                width: 100%;
            }

            .confirmation-details {
                grid-template-columns: 1fr 1fr;
            }

            .selection-confirmation {
                padding: 15px;
            }

        }

        @media (max-width: 380px) {

            .confirmation-details {
                grid-template-columns: 1fr;
            }

            .confirmation-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .continue-button {
                width: 100%;
            }

        }

    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>

    {{-- NAVBAR --}}

    @include('layouts.partials.public-navbar')


    <main class="page-wrap">

        <a href="{{ route('home') }}#film" class="back-link">
            &larr; Kembali ke daftar film
        </a>


        {{-- DETAIL FILM --}}

        <article class="detail-card">

            <div class="poster-wrap">

                @if($film->poster)

                    <img
                        src="{{ asset('storage/' . $film->poster) }}"
                        alt="Poster {{ $film->judul }}"
                    >

                @else

                    <div class="poster-empty">
                        <strong>🎬</strong>
                        <span>POSTER BELUM TERSEDIA</span>
                    </div>

                @endif

            </div>


            <div class="detail-content">

                <div class="eyebrow">INFORMASI FILM</div>

                <h1>{{ $film->judul }}</h1>

                <span class="status">● Sedang Tayang</span>

                <div class="meta-grid">

                    <div class="meta-box">
                        <span class="meta-label">Genre</span>
                        <span class="meta-value">{{ $film->genre }}</span>
                    </div>

                    <div class="meta-box">
                        <span class="meta-label">Durasi</span>
                        <span class="meta-value">{{ $film->durasi_menit }} Menit</span>
                    </div>

                    <div class="meta-box">
                        <span class="meta-label">Rating Usia</span>
                        <span class="meta-value">{{ $film->rating_usia }}</span>
                    </div>

                </div>

                <h2>Sinopsis</h2>

                <p class="synopsis">
                    {{ $film->sinopsis ?: 'Sinopsis film belum tersedia.' }}
                </p>

                <div class="detail-actions">

                    <a href="{{ route('home') }}#film" class="btn btn-primary">
                        Lihat Film Lain
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        Kembali ke Beranda
                    </a>

                </div>

            </div>

        </article>


        {{-- JADWAL TAYANG --}}

        <section class="schedule-section">

            <div class="schedule-heading">

                <div>

                    <div class="eyebrow">MOVIE SCHEDULE</div>

                    <h2>Jadwal Tayang</h2>

                    <p class="schedule-subtitle">
                        Pilih jadwal penayangan yang sesuai dengan waktumu.
                    </p>

                </div>

                <div class="schedule-count">
                    {{ $jadwals->count() }} Jadwal Tersedia
                </div>

            </div>


            {{-- FILTER --}}

            <div class="filter-panel" id="filter-jadwal">

                <div class="filter-title">
                    <span style="color:#f5b942;">▦</span>
                    Filter Jadwal Berdasarkan Tanggal
                </div>

                <form
                    action="{{ route('films.show', $film) }}"
                    method="GET"
                    class="filter-form"
                    id="filter-form"
                >

                    <div class="date-field">

                        <label for="tanggal">
                            Pilih Tanggal Penayangan
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ $selectedDate }}"
                            min="{{ now('Asia/Jakarta')->toDateString() }}"
                        >

                    </div>

                    <button type="submit" class="filter-button">
                        Cari Jadwal
                    </button>

                    @if($selectedDate)

                        <a
                            href="{{ route('films.show', $film) }}"
                            class="reset-button"
                            id="reset-filter"
                        >
                            Reset Filter
                        </a>

                    @endif

                </form>

                @error('tanggal')

                    <div class="filter-error">
                        {{ $message }}
                    </div>

                @enderror

                <div class="filter-result">

                    @if($selectedDate)

                        Menampilkan jadwal tanggal:

                        <strong>
                            {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
                        </strong>

                    @else

                        Menampilkan seluruh jadwal yang akan datang.

                    @endif

                </div>

            </div>


            {{-- DAFTAR JADWAL --}}

            <div class="schedule-grid">

                @forelse($jadwals as $jadwal)

                    <div
                        class="schedule-card"
                        data-schedule-id="{{ $jadwal->id }}"
                    >

                        <div class="schedule-date">

                            <span class="date-label">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}
                            </span>

                            <span class="schedule-active">
                                ● Aktif
                            </span>

                        </div>


                        <div class="schedule-time">

                            <div class="time-icon">◷</div>

                            <div class="time-info">

                                <small>Jam Penayangan</small>

                                <strong>
                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }}
                                </strong>

                                <span>
                                    - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                </span>

                            </div>

                        </div>


                        <div class="schedule-details">

                            <div class="schedule-detail-box">

                                <small>Studio</small>

                                <strong>
                                    {{ $jadwal->studio->nama }}
                                </strong>

                            </div>

                            <div class="schedule-detail-box">

                                <small>Tipe Studio</small>

                                <strong>
                                    {{ $jadwal->studio->tipe }}
                                </strong>

                            </div>

                        </div>


                        <div class="schedule-price">

                            <span>Harga Tiket</span>

                            <strong>
                                Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}
                            </strong>

                        </div>


                        <button
                            type="button"
                            class="select-schedule-button"

                            data-schedule-id="{{ $jadwal->id }}"

                            data-date="{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}"

                            data-time="{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}"

                            data-studio="{{ $jadwal->studio->nama }}"

                            data-studio-type="{{ $jadwal->studio->tipe }}"

                            data-price="Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}"
                        >
                            Pilih Jadwal
                        </button>

                    </div>

                @empty

                    <div class="empty-schedule">

                        <h3>Jadwal Belum Tersedia</h3>

                        <p>

                            @if($selectedDate)

                                Tidak ada jadwal aktif untuk film
                                {{ $film->judul }}
                                pada tanggal
                                {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}.

                            @else

                                Saat ini belum ada jadwal penayangan aktif
                                untuk film {{ $film->judul }}.

                            @endif

                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    </main>


    {{-- KONFIRMASI JADWAL TERPILIH --}}

    <div
        class="selection-confirmation"
        id="selection-confirmation"
        hidden
    >

        <div class="confirmation-heading">

            <h3>Konfirmasi Jadwal Pilihan</h3>

            <span>✓ Jadwal dipilih</span>

        </div>

        <div class="confirmation-details">

            <div class="confirmation-item">

                <small>Film</small>

                <strong>{{ $film->judul }}</strong>

            </div>

            <div class="confirmation-item">

                <small>Tanggal</small>

                <strong id="confirm-date">-</strong>

            </div>

            <div class="confirmation-item">

                <small>Jam Tayang</small>

                <strong id="confirm-time">-</strong>

            </div>

            <div class="confirmation-item">

                <small>Studio</small>

                <strong id="confirm-studio">-</strong>

            </div>

            <div class="confirmation-item">

                <small>Tipe Studio</small>

                <strong id="confirm-studio-type">-</strong>

            </div>

            <div class="confirmation-item">

                <small>Harga per Tiket</small>

                <strong id="confirm-price">-</strong>

            </div>

        </div>

        <div class="confirmation-actions">

            <button
                type="button"
                class="change-selection"
                id="change-selection"
            >
                Ganti Jadwal
            </button>

            <form
                action="{{ route('booking.schedule.select') }}"
                method="POST"
                id="schedule-selection-form"
            >

                @csrf

                <input
                    type="hidden"
                    name="jadwal_id"
                    id="selected-jadwal-id"
                >

                <button type="submit" class="continue-button">
                    Lanjutkan Pilih Kursi →
                </button>

            </form>

        </div>

    </div>


    {{-- FOOTER --}}

    <footer>

        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.

    </footer>


    {{-- JAVASCRIPT --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const filterPanel =
                document.getElementById('filter-jadwal');

            const scheduleGrid =
                document.querySelector('.schedule-grid');

            const scheduleCount =
                document.querySelector('.schedule-count');

            const confirmationPanel =
                document.getElementById('selection-confirmation');

            const selectedScheduleInput =
                document.getElementById('selected-jadwal-id');

            let activeRequest = null;


            // ======================================
            // RESET PILIHAN JADWAL
            // ======================================

            function clearScheduleSelection() {

                selectedScheduleInput.value = '';

                confirmationPanel.hidden = true;

                document.querySelectorAll('.schedule-card')
                    .forEach(card => {

                        card.classList.remove('selected');

                    });

                document.querySelectorAll('.select-schedule-button')
                    .forEach(button => {

                        button.classList.remove('selected');

                        button.textContent = 'Pilih Jadwal';

                    });

            }


            // ======================================
            // AJAX FILTER JADWAL
            // TANPA RELOAD HALAMAN
            // ======================================

            async function refreshSchedule(
                targetUrl,
                updateHistory = true
            ) {

                if (activeRequest) {
                    activeRequest.abort();
                }

                activeRequest = new AbortController();

                try {

                    const response = await fetch(targetUrl, {

                        method: 'GET',

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        },

                        credentials: 'same-origin',

                        cache: 'no-store',

                        signal: activeRequest.signal

                    });

                    if (!response.ok) {
                        throw new Error('Gagal mengambil jadwal.');
                    }

                    const html = await response.text();

                    const parser = new DOMParser();

                    const newDocument = parser.parseFromString(
                        html,
                        'text/html'
                    );

                    const newFilter =
                        newDocument.querySelector('#filter-jadwal');

                    const newGrid =
                        newDocument.querySelector('.schedule-grid');

                    const newCount =
                        newDocument.querySelector('.schedule-count');

                    if (!newFilter || !newGrid || !newCount) {
                        throw new Error('Elemen jadwal tidak ditemukan.');
                    }

                    // Perbarui filter.
                    filterPanel.innerHTML = newFilter.innerHTML;

                    // Perbarui daftar jadwal.
                    scheduleGrid.innerHTML = newGrid.innerHTML;

                    // Perbarui jumlah jadwal.
                    scheduleCount.textContent =
                        newCount.textContent.trim();

                    // Reset pilihan sebelumnya.
                    clearScheduleSelection();

                    // Perbarui URL tanpa reload.
                    if (updateHistory) {

                        const newUrl = new URL(
                            targetUrl,
                            window.location.origin
                        );

                        if (window.location.href !== newUrl.href) {

                            history.pushState(
                                {},
                                '',
                                newUrl.href
                            );

                        }

                    }

                    // Tidak menggunakan scrollTo atau sessionStorage.
                    // Posisi scroll tetap karena tidak ada page reload.

                } catch (error) {

                    if (error.name === 'AbortError') {
                        return;
                    }

                    console.error(error);

                    let errorElement =
                        filterPanel.querySelector('.filter-error');

                    if (!errorElement) {

                        errorElement = document.createElement('div');

                        errorElement.className = 'filter-error';

                        filterPanel.appendChild(errorElement);

                    }

                    errorElement.textContent =
                        'Jadwal gagal diperbarui. Silakan coba kembali.';

                }

            }


            // ======================================
            // EVENT FILTER
            // ======================================

            document.addEventListener('submit', function (event) {

                const form = event.target.closest('#filter-form');

                if (!form) {
                    return;
                }

                event.preventDefault();

                const targetUrl = new URL(
                    form.action,
                    window.location.origin
                );

                const formData = new FormData(form);

                targetUrl.search = '';

                for (const [key, value] of formData.entries()) {

                    if (value !== '') {
                        targetUrl.searchParams.set(key, value);
                    }

                }

                refreshSchedule(targetUrl.toString(), true);

            });


            // ======================================
            // EVENT RESET FILTER
            // ======================================

            document.addEventListener('click', function (event) {

                const resetButton =
                    event.target.closest('#reset-filter');

                if (resetButton) {

                    event.preventDefault();

                    refreshSchedule(resetButton.href, true);

                    return;

                }


                // ==================================
                // EVENT PILIH JADWAL
                // ==================================

                const selectButton =
                    event.target.closest('.select-schedule-button');

                if (!selectButton) {
                    return;
                }

                clearScheduleSelection();

                const card = selectButton.closest('.schedule-card');

                card.classList.add('selected');

                selectButton.classList.add('selected');

                selectButton.textContent = 'Jadwal Dipilih ✓';

                // Isi ID jadwal.
                selectedScheduleInput.value =
                    selectButton.dataset.scheduleId;

                // Isi informasi konfirmasi.
                document.getElementById('confirm-date').textContent =
                    selectButton.dataset.date;

                document.getElementById('confirm-time').textContent =
                    selectButton.dataset.time;

                document.getElementById('confirm-studio').textContent =
                    selectButton.dataset.studio;

                document.getElementById('confirm-studio-type').textContent =
                    selectButton.dataset.studioType;

                document.getElementById('confirm-price').textContent =
                    selectButton.dataset.price;

                // Tampilkan panel konfirmasi.
                confirmationPanel.hidden = false;

            });


            // ======================================
            // GANTI JADWAL
            // ======================================

            document.getElementById('change-selection')
                .addEventListener('click', function () {

                    clearScheduleSelection();

                });


            // ======================================
            // BROWSER BACK / FORWARD
            // ======================================

            window.addEventListener('popstate', function () {

                refreshSchedule(window.location.href, false);

            });

        });

    </script>

</body>
</html>