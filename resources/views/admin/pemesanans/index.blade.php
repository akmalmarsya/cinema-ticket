@extends('layouts.admin')

@section('title', 'Manajemen Pemesanan')

@section('content')

<style>
    .order-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .order-stat {
        background: white;
        padding: 20px;
        border: 1px solid #e8edf3;
        border-radius: 10px;
    }

    .order-stat span {
        color: #64748b;
        font-size: 12px;
    }

    .order-stat strong {
        display: block;
        font-size: 25px;
        margin-top: 10px;
    }

    .filter-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto auto;
        gap: 10px;
        margin-top: 22px;
        align-items: center;
    }

    .filter-form select,
    .filter-form input {
        width: 100%;
        height: 42px;
        padding: 0 12px;
        border: 1px solid #dce3ec;
        border-radius: 7px;
        background: white;
        color: #18243b;
        font-size: 12px;
        outline: none;
    }

    .filter-form input:focus,
    .filter-form select:focus {
        border-color: #eeb63d;
    }

    .filter-button {
        height: 42px;
        padding: 0 17px;
        border: none;
        border-radius: 7px;
        background: #eeb63d;
        color: #18243b;
        font-weight: bold;
        cursor: pointer;
    }

    .reset-button {
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 15px;
        border-radius: 7px;
        background: #e8edf4;
        color: #334155;
        text-decoration: none;
        font-size: 12px;
    }

    .booking-code {
        font-weight: bold;
        color: #1d4ed8;
    }

    .customer-name {
        font-weight: bold;
        color: #18243b;
    }

    .customer-phone {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 5px;
    }

    .film-name {
        font-weight: bold;
    }

    .film-date {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 5px;
    }

    .seat-list {
        color: #475569;
        font-size: 11px;
        white-space: normal;
        max-width: 140px;
    }

    .price {
        font-weight: bold;
        white-space: nowrap;
    }

    .detail-button {
        display: inline-block;
        background: #e0edff;
        color: #1d4ed8;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 11px;
        font-weight: bold;
    }

    .detail-button:hover {
        background: #c9defd;
    }

    .order-table th,
    .order-table td {
        padding: 15px 11px;
    }

    .order-table td {
        vertical-align: middle;
    }

    .order-table .empty {
        text-align: center;
        padding: 40px;
    }

    @media(max-width: 1200px) {
        .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .order-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 700px) {
        .filter-form {
            grid-template-columns: 1fr;
        }

        .order-summary {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>


{{-- HEADER --}}

<div class="page-heading">

    <div>

        <div class="eyebrow">TRANSACTION MANAGEMENT</div>

        <h1>Manajemen Pemesanan</h1>

        <p>
            Kelola dan pantau seluruh transaksi pemesanan tiket CinemaTicket.
        </p>

    </div>

</div>


{{-- NOTIFIKASI --}}

@if(session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif

@if(session('error'))

    <div class="alert-error">
        {{ session('error') }}
    </div>

@endif


{{-- RINGKASAN TRANSAKSI --}}

<div class="order-summary">

    <div class="order-stat">

        <span>Total Pemesanan</span>

        <strong>
            {{ number_format($statusCounts->sum()) }}
        </strong>

    </div>

    <div class="order-stat">

        <span>Menunggu Pembayaran</span>

        <strong style="color:#b88620;">
            {{ number_format($statusCounts->get('booking', 0)) }}
        </strong>

    </div>

    <div class="order-stat">

        <span>Sudah Lunas</span>

        <strong style="color:#15803d;">
            {{ number_format($statusCounts->get('lunas', 0)) }}
        </strong>

    </div>

    <div class="order-stat">

        <span>Dibatalkan / Kedaluwarsa</span>

        <strong style="color:#b91c1c;">
            {{ number_format(
                $statusCounts->get('dibatalkan', 0) +
                $statusCounts->get('kedaluwarsa', 0)
            ) }}
        </strong>

    </div>

</div>


{{-- TABEL PEMESANAN --}}

<div class="table-card">

    <div class="crud-toolbar">

        <div>

            <h2 style="font-size:17px;">
                Daftar Transaksi Pemesanan
            </h2>

            <p class="panel-subtitle">
                Seluruh transaksi booking yang tersimpan dalam database.
            </p>

        </div>

    </div>


    {{-- FILTER --}}

    <form
        action="{{ route('admin.pemesanans.index') }}"
        method="GET"
        class="filter-form"
    >

        <input
            type="text"
            name="cari"
            placeholder="Cari kode booking, nama, HP, atau film..."
            value="{{ request('cari') }}"
        >

        <select name="status">

            <option value="">Semua Status</option>

            <option value="booking"
                {{ request('status') === 'booking' ? 'selected' : '' }}>
                Booking
            </option>

            <option value="lunas"
                {{ request('status') === 'lunas' ? 'selected' : '' }}>
                Lunas
            </option>

            <option value="dibatalkan"
                {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>
                Dibatalkan
            </option>

            <option value="kedaluwarsa"
                {{ request('status') === 'kedaluwarsa' ? 'selected' : '' }}>
                Kedaluwarsa
            </option>

        </select>


        <input
            type="date"
            name="tanggal"
            value="{{ request('tanggal') }}"
            title="Filter tanggal penayangan"
        >


        <button type="submit" class="filter-button">
            Cari
        </button>


        <a
            href="{{ route('admin.pemesanans.index') }}"
            class="reset-button"
        >
            Reset
        </a>

    </form>


    {{-- DATA TRANSAKSI --}}

    <div class="table-wrap">

        <table class="order-table">

            <thead>

                <tr>

                    <th>KODE BOOKING</th>

                    <th>PEMESAN</th>

                    <th>FILM</th>

                    <th>JADWAL</th>

                    <th>KURSI</th>

                    <th>TOTAL</th>

                    <th>STATUS</th>

                    <th>AKSI</th>

                </tr>

            </thead>


            <tbody>

                @forelse($pemesanans as $pemesanan)

                    <tr>

                        {{-- KODE BOOKING --}}

                        <td>

                            <span class="booking-code">
                                {{ $pemesanan->kode_booking }}
                            </span>

                            <div class="film-date">
                                {{ $pemesanan->created_at?->format('d/m/Y H:i') }}
                            </div>

                        </td>


                        {{-- PEMESAN --}}

                        <td>

                            <div class="customer-name">
                                {{ $pemesanan->nama_pemesan }}
                            </div>

                            <div class="customer-phone">
                                {{ $pemesanan->no_hp }}
                            </div>

                        </td>


                        {{-- FILM --}}

                        <td>

                            <div class="film-name">
                                {{ $pemesanan->jadwal?->film?->judul ?? '-' }}
                            </div>

                            <div class="film-date">
                                {{ $pemesanan->jadwal?->studio?->nama ?? '-' }}
                            </div>

                        </td>


                        {{-- JADWAL --}}

                        <td>

                            @if($pemesanan->jadwal)

                                <div>
                                    {{ \Carbon\Carbon::parse(
                                        $pemesanan->jadwal->tanggal_tayang
                                    )->format('d M Y') }}
                                </div>

                                <div class="film-date">
                                    {{ date(
                                        'H:i',
                                        strtotime($pemesanan->jadwal->jam_mulai)
                                    ) }}
                                </div>

                            @else

                                -

                            @endif

                        </td>


                        {{-- KURSI --}}

                        <td>

                            <div class="seat-list">

                                {{ $pemesanan->detailKursis
                                    ->pluck('no_kursi')
                                    ->implode(', ') ?: '-' }}

                            </div>

                        </td>


                        {{-- TOTAL --}}

                        <td>

                            <span class="price">
                                Rp {{ number_format(
                                    (float) $pemesanan->total_harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </span>

                        </td>


                        {{-- STATUS --}}

                        <td>

                            <span class="status status-{{ $pemesanan->status }}">
                                {{ ucfirst($pemesanan->status) }}
                            </span>

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <a
                                href="{{ route(
                                    'admin.pemesanans.show',
                                    $pemesanan->id
                                ) }}"
                                class="detail-button"
                            >
                                Detail
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="empty">

                            Belum ada transaksi pemesanan yang ditemukan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}

    <div class="pagination-wrap">

        {{ $pemesanans->links() }}

    </div>

</div>

@endsection