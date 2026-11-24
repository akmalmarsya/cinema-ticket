<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pilih Kursi - CinemaTicket</title>

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
            color: inherit;
            text-decoration: none;
        }

        /* NAVBAR */

        .site-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 76px;
            padding: 18px 8%;
            background: #10172b;
            border-bottom: 1px solid #26344f;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            color: #f5b942;
        }

        .nav-links {
            display: flex;
            gap: 28px;
        }

        .nav-links a {
            color: #cbd5e1;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: #f5b942;
        }

        /* MAIN */

        .page-wrap {
            width: min(1050px, 90%);
            margin: 45px auto 70px;
        }

        .back-link {
            color: #f5b942;
            font-size: 13px;
            display: inline-block;
            margin-bottom: 25px;
        }

        .eyebrow {
            color: #f5b942;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 12px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.7;
        }

        /* MOVIE INFORMATION */

        .movie-info {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
            margin: 28px 0;
        }

        .info-box {
            background: #151e33;
            border: 1px solid #26344f;
            padding: 16px;
            border-radius: 9px;
        }

        .info-box small {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .info-box strong {
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        /* SEAT CONTAINER */

        .seat-container {
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 14px;
            padding: 30px;
        }

        .seat-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .seat-heading h2 {
            font-size: 21px;
            margin-bottom: 9px;
        }

        .seat-heading p {
            color: #94a3b8;
            font-size: 12px;
        }

        /* SCREEN */

        .screen-area {
            max-width: 550px;
            margin: 0 auto 45px;
            text-align: center;
        }

        .screen {
            height: 9px;
            width: 100%;
            border-radius: 50%;
            background: linear-gradient(
                90deg,
                transparent,
                #f5b942,
                #ffd477,
                #f5b942,
                transparent
            );
            box-shadow: 0 5px 25px rgba(245,185,66,.35);
            margin-bottom: 15px;
        }

        .screen-label {
            color: #94a3b8;
            font-size: 10px;
            letter-spacing: 5px;
        }

        /* SEAT MAP */

        .seat-map {
            width: 100%;
            overflow-x: auto;
            padding: 5px 0 20px;
        }

        .seat-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-width: max-content;
            margin-bottom: 12px;
        }

        .row-label {
            width: 25px;
            text-align: center;
            color: #f5b942;
            font-size: 12px;
            font-weight: bold;
        }

        .seat-line {
            display: grid;
            grid-template-columns: repeat(
                var(--seat-columns),
                minmax(34px, 1fr)
            );
            gap: 8px;
        }

        .seat {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px 8px 5px 5px;
            font-size: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: .15s;
            user-select: none;
        }

        .seat input {
            display: none;
        }

        .seat.available {
            background: #263b63;
            border: 1px solid #45618f;
            color: #cbd5e1;
        }

        .seat.available:hover {
            background: #365583;
            border-color: #f5b942;
            transform: translateY(-2px);
        }

        .seat.selected {
            background: #f5b942;
            border: 1px solid #ffd477;
            color: #10172b;
        }

        .seat.occupied {
            background: #3b4557;
            border: 1px solid #475569;
            color: #94a3b8;
            cursor: not-allowed;
            opacity: .55;
        }

        /* LEGEND */

        .seat-legend {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 25px;
            margin-top: 25px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #cbd5e1;
            font-size: 11px;
        }

        .legend-color {
            width: 17px;
            height: 17px;
            border-radius: 4px;
        }

        .legend-available {
            background: #263b63;
            border: 1px solid #45618f;
        }

        .legend-selected {
            background: #f5b942;
        }

        .legend-occupied {
            background: #3b4557;
        }

        /* SELECTION SUMMARY */

        .selection-summary {
            margin-top: 28px;
            padding: 22px;
            background: #10172b;
            border: 1px solid #26344f;
            border-radius: 10px;
        }

        .selection-summary h3 {
            font-size: 15px;
            margin-bottom: 18px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #26344f;
        }

        .summary-row:last-of-type {
            border-bottom: none;
        }

        .summary-row span {
            color: #94a3b8;
            font-size: 12px;
        }

        .summary-row strong {
            font-size: 13px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .total-price {
            color: #f5b942;
            font-size: 20px !important;
        }

        /* BUTTON */

        .seat-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 22px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 20px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .btn-back {
            border: 1px solid #475569;
            color: #cbd5e1;
            background: transparent;
        }

        .btn-back:hover {
            border-color: #f5b942;
            color: #f5b942;
        }

        .btn-submit {
            background: #f5b942;
            color: #10172b;
            border: none;
        }

        .btn-submit:hover {
            background: #ffd477;
        }

        .btn-submit:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        /* MESSAGES */

        .message {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success-message {
            background: rgba(34,197,94,.12);
            border: 1px solid #166534;
            color: #4ade80;
        }

        .error-message {
            background: rgba(239,68,68,.12);
            border: 1px solid #991b1b;
            color: #f87171;
        }

        .warning-message {
            background: rgba(245,185,66,.10);
            border: 1px solid #8a6728;
            color: #f5b942;
            padding: 13px;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        /* FOOTER */

        footer {
            background: #10172b;
            border-top: 1px solid #26344f;
            padding: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 600px) {

            .site-nav {
                padding: 16px 5%;
                min-height: 68px;
                flex-wrap: wrap;
                gap: 14px;
            }

            .logo {
                font-size: 20px;
            }

            .nav-links {
                gap: 13px;
            }

            .nav-links a {
                font-size: 12px;
            }

            .page-wrap {
                margin-top: 30px;
            }

            h1 {
                font-size: 27px;
            }

            .movie-info {
                grid-template-columns: 1fr;
            }

            .seat-container {
                padding: 18px 10px;
            }

            .seat {
                width: 32px;
                height: 34px;
                font-size: 9px;
            }

            .seat-line {
                gap: 5px;
            }

            .seat-row {
                gap: 7px;
            }

            .seat-legend {
                gap: 13px;
            }

            .seat-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn {
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

        <a
            href="{{ route('films.show', $jadwal->film_id) }}#filter-jadwal"
            class="back-link"
        >
            &larr; Kembali ke jadwal film
        </a>


        <div class="eyebrow">
            BOOKING TICKET
        </div>

        <h1>Pilih Kursi Bioskop</h1>

        <p class="subtitle">
            Pilih tempat duduk favoritmu sebelum melanjutkan
            proses pemesanan tiket.
        </p>


        {{-- INFORMASI FILM DAN JADWAL --}}

        <div class="movie-info">

            <div class="info-box">

                <small>Film</small>

                <strong>
                    {{ $jadwal->film->judul }}
                </strong>

            </div>

            <div class="info-box">

                <small>Tanggal dan Jam</small>

                <strong>
                    {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d M Y') }}
                    <br>
                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }}
                    -
                    {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                </strong>

            </div>

            <div class="info-box">

                <small>Studio</small>

                <strong>
                    {{ $jadwal->studio->nama }}
                    ({{ $jadwal->studio->tipe }})
                </strong>

            </div>

        </div>


        @if(session('success'))

            <div class="message success-message">
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div class="message error-message">
                {{ $errors->first() }}
            </div>

        @endif


        @if($capacityMismatch)

            <div class="warning-message">

                Perhatian: konfigurasi denah menghasilkan
                {{ $configuredCapacity }} kursi, sedangkan kapasitas
                yang tercatat pada studio adalah
                {{ $jadwal->studio->kapasitas }} kursi.

                Denah sementara mengikuti jumlah baris dan kursi per baris.

            </div>

        @endif


        {{-- SEAT MAP --}}

        <form
            action="{{ route('booking.store-seats') }}"
            method="POST"
            id="seat-form"
        >

            @csrf

            <div class="seat-container">

                <div class="seat-heading">

                    <h2>Denah Tempat Duduk</h2>

                    <p>
                        Studio {{ $jadwal->studio->nama }}
                    </p>

                </div>


                {{-- LAYAR BIOSKOP --}}

                <div class="screen-area">

                    <div class="screen"></div>

                    <div class="screen-label">
                        SCREEN
                    </div>

                </div>


                {{-- DENAH KURSI DINAMIS --}}

                <div class="seat-map">

                    @forelse($seatMap as $row)

                        <div class="seat-row">

                            <div class="row-label">
                                {{ $row['label'] }}
                            </div>

                            <div
                                class="seat-line"
                                style="--seat-columns: {{ count($row['seats']) }}"
                            >

                                @foreach($row['seats'] as $seat)

                                    @php
                                        $isSelected = in_array(
                                            $seat['number'],
                                            $selectedSeats,
                                            true
                                        ) && !$seat['occupied'];
                                    @endphp

                                    <label
                                        class="seat
                                            {{ $seat['occupied']
                                                ? 'occupied'
                                                : ($isSelected ? 'selected' : 'available')
                                            }}"
                                        title="{{ $seat['number'] }}"
                                    >

                                        <input
                                            type="checkbox"
                                            class="seat-input"
                                            name="seats[]"
                                            value="{{ $seat['number'] }}"

                                            {{ $isSelected ? 'checked' : '' }}

                                            {{ $seat['occupied'] ? 'disabled' : '' }}
                                        >

                                        <span>
                                            {{ $seat['number'] }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                            <div class="row-label">
                                {{ $row['label'] }}
                            </div>

                        </div>

                    @empty

                        <div class="message error-message">
                            Konfigurasi kursi studio belum tersedia.
                        </div>

                    @endforelse

                </div>


                {{-- KETERANGAN WARNA --}}

                <div class="seat-legend">

                    <div class="legend-item">

                        <div class="legend-color legend-available"></div>

                        Tersedia

                    </div>

                    <div class="legend-item">

                        <div class="legend-color legend-selected"></div>

                        Dipilih

                    </div>

                    <div class="legend-item">

                        <div class="legend-color legend-occupied"></div>

                        Terisi

                    </div>

                </div>


                {{-- RINGKASAN PILIHAN --}}

                <div class="selection-summary">

                    <h3>Ringkasan Pilihan Kursi</h3>

                    <div class="summary-row">

                        <span>Kursi Dipilih</span>

                        <strong id="selected-seat-list">
                            Belum ada kursi
                        </strong>

                    </div>

                    <div class="summary-row">

                        <span>Jumlah Kursi</span>

                        <strong id="selected-seat-count">
                            0 Kursi
                        </strong>

                    </div>

                    <div class="summary-row">

                        <span>Harga per Kursi</span>

                        <strong>
                            Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}
                        </strong>

                    </div>

                    <div class="summary-row">

                        <span>Total Harga</span>

                        <strong
                            class="total-price"
                            id="selected-total-price"
                        >
                            Rp 0
                        </strong>

                    </div>

                </div>


                {{-- TOMBOL --}}

                <div class="seat-actions">

                    <a
                        href="{{ route('films.show', $jadwal->film_id) }}#filter-jadwal"
                        class="btn btn-back"
                    >
                        Kembali ke Jadwal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-submit"
                        id="submit-seats"
                        disabled
                    >
                        Lanjutkan ke Data Pemesan
                    </button>

                </div>

            </div>

        </form>

    </main>


    {{-- FOOTER --}}

    <footer>

        &copy; {{ date('Y') }} CinemaTicket.
        Sistem Pemesanan Tiket Bioskop.

    </footer>


    {{-- JAVASCRIPT --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const seatInputs = document.querySelectorAll(
                '.seat-input:not(:disabled)'
            );

            const selectedList =
                document.getElementById('selected-seat-list');

            const selectedCount =
                document.getElementById('selected-seat-count');

            const totalPrice =
                document.getElementById('selected-total-price');

            const submitButton =
                document.getElementById('submit-seats');

            const seatForm =
                document.getElementById('seat-form');

            const pricePerSeat =
                {{ (float) $jadwal->harga }};


            // Format mata uang Rupiah.
            const formatter = new Intl.NumberFormat('id-ID', {

                style: 'currency',

                currency: 'IDR',

                maximumFractionDigits: 0

            });


            // Memperbarui ringkasan kursi.
            function updateSeatSummary() {

                const selectedSeats = [];

                seatInputs.forEach(input => {

                    const label = input.closest('.seat');

                    if (input.checked) {

                        selectedSeats.push(input.value);

                        label.classList.add('selected');

                        label.classList.remove('available');

                    } else {

                        label.classList.remove('selected');

                        label.classList.add('available');

                    }

                });


                const count = selectedSeats.length;

                const total = count * pricePerSeat;


                selectedList.textContent = count > 0
                    ? selectedSeats.join(', ')
                    : 'Belum ada kursi';


                selectedCount.textContent =
                    count + ' Kursi';


                totalPrice.textContent =
                    formatter.format(total);


                submitButton.disabled = count === 0;

            }


            // Event perubahan kursi.
            seatInputs.forEach(input => {

                input.addEventListener('change', updateSeatSummary);

            });


            // Validasi sebelum submit.
            seatForm.addEventListener('submit', function (event) {

                const selectedSeats = Array.from(seatInputs)
                    .filter(input => input.checked);

                if (selectedSeats.length === 0) {

                    event.preventDefault();

                    alert('Silakan pilih minimal satu kursi.');

                }

            });


            // Tampilkan ringkasan awal.
            updateSeatSummary();

        });

    </script>

</body>
</html>