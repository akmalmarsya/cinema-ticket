@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')

@php

    $pemesanan = $pembayaran->pemesanan;
    $jadwal = $pemesanan->jadwal;
    $film = $jadwal->film;
    $studio = $jadwal->studio;

    $metodeLabels = [
        'transfer_bank' => 'Transfer Bank',
        'qris' => 'QRIS',
        'e_wallet' => 'E-Wallet',
    ];

@endphp


<style>
    .payment-detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(300px, .85fr);
        gap: 20px;
    }

    .payment-detail-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
    }

    .payment-detail-card {
        background: white;
        border: 1px solid #e8edf3;
        border-radius: 12px;
        padding: 23px;
    }

    .payment-detail-card h2 {
        font-size: 17px;
        margin-bottom: 20px;
    }

    .payment-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 14px 0;
        border-bottom: 1px solid #edf0f5;
        font-size: 12px;
    }

    .payment-info-row:last-child {
        border-bottom: none;
    }

    .payment-info-row span {
        color: #64748b;
    }

    .payment-info-row strong {
        color: #18243b;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .payment-detail-status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .payment-menunggu {
        background: #fff4d8;
        color: #a36b00;
    }

    .payment-berhasil {
        background: #dcfce7;
        color: #15803d;
    }

    .payment-gagal {
        background: #fee2e2;
        color: #b91c1c;
    }

    .payment-total-card {
        background: #111b31;
        color: white;
        border-radius: 12px;
        padding: 25px;
    }

    .payment-total-card span {
        color: #cbd5e1;
        font-size: 12px;
    }

    .payment-total-card strong {
        display: block;
        color: #f5b942;
        font-size: 29px;
        margin-top: 12px;
    }

    .payment-seat-list {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 6px;
    }

    .payment-seat {
        background: #fff4d8;
        color: #a36b00;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: bold;
    }

    .payment-admin-note {
        background: #fff8e8;
        border: 1px solid #f5dfaa;
        border-radius: 9px;
        padding: 16px;
        color: #98701e;
        font-size: 12px;
        line-height: 1.7;
    }

    .payment-admin-note strong {
        display: block;
        margin-bottom: 7px;
    }

    .payment-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .payment-actions a {
        display: inline-block;
        padding: 11px 16px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
    }

    .payment-btn-secondary {
        background: #e8edf4;
        color: #334155;
    }

    .payment-btn-primary {
        background: #eeb63d;
        color: #18243b;
    }

    .payment-btn-ticket {
        background: #dcfce7;
        color: #15803d;
    }

    @media(max-width: 900px) {
        .payment-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 550px) {
        .payment-info-row {
            align-items: flex-start;
            flex-direction: column;
            gap: 7px;
        }

        .payment-info-row strong {
            text-align: left;
        }
    }
</style>


{{-- HEADER --}}

<div class="page-heading">

    <div>

        <div class="eyebrow">
            PAYMENT DETAIL
        </div>

        <h1>Detail Pembayaran</h1>

        <p>
            Informasi lengkap transaksi pembayaran CinemaTicket.
        </p>

    </div>


    <a
        href="{{ route('admin.pembayarans.index') }}"
        class="btn-secondary"
    >
        ← Kembali
    </a>

</div>


<div class="payment-detail-grid">


    {{-- KOLOM KIRI --}}

    <div class="payment-detail-column">


        {{-- INFORMASI PEMBAYARAN --}}

        <section class="payment-detail-card">

            <h2>Informasi Pembayaran</h2>


            <div class="payment-info-row">

                <span>Kode Referensi</span>

                <strong>
                    {{ $pembayaran->kode_referensi ?? '-' }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Metode Pembayaran</span>

                <strong>
                    {{ $metodeLabels[$pembayaran->metode_pembayaran]
                        ?? ucwords(str_replace('_', ' ', $pembayaran->metode_pembayaran)) }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Status Pembayaran</span>

                <strong>
                    <span class="payment-detail-status payment-{{ $pembayaran->status }}">
                        {{ ucfirst($pembayaran->status) }}
                    </span>
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Jumlah Pembayaran</span>

                <strong>
                    Rp {{ number_format(
                        (float) $pembayaran->jumlah_bayar,
                        0,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Waktu Pembayaran</span>

                <strong>

                    @if($pembayaran->waktu_bayar)

                        {{ \Carbon\Carbon::parse(
                            $pembayaran->waktu_bayar
                        )->format('d/m/Y H:i') }}

                    @else

                        Belum dibayar

                    @endif

                </strong>

            </div>


            <div class="payment-info-row">

                <span>Tanggal Pencatatan</span>

                <strong>
                    {{ $pembayaran->created_at->format('d/m/Y H:i') }}
                </strong>

            </div>

        </section>


        {{-- INFORMASI PEMESAN --}}

        <section class="payment-detail-card">

            <h2>Informasi Pemesan</h2>


            <div class="payment-info-row">

                <span>Kode Booking</span>

                <strong>
                    {{ $pemesanan->kode_booking }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Nama Pemesan</span>

                <strong>
                    {{ $pemesanan->nama_pemesan }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Nomor HP</span>

                <strong>
                    {{ $pemesanan->no_hp }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Tanggal Booking</span>

                <strong>
                    {{ $pemesanan->created_at->format('d/m/Y H:i') }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Status Pemesanan</span>

                <strong>
                    {{ ucfirst($pemesanan->status) }}
                </strong>

            </div>

        </section>


        {{-- INFORMASI PENAYANGAN --}}

        <section class="payment-detail-card">

            <h2>Informasi Penayangan</h2>


            <div class="payment-info-row">

                <span>Judul Film</span>

                <strong>
                    {{ $film->judul }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Genre</span>

                <strong>
                    {{ $film->genre }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Tanggal Tayang</span>

                <strong>
                    {{ \Carbon\Carbon::parse(
                        $jadwal->tanggal_tayang
                    )->format('d/m/Y') }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Jam Tayang</span>

                <strong>
                    {{ substr($jadwal->jam_mulai, 0, 5) }}
                    -
                    {{ substr($jadwal->jam_selesai, 0, 5) }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Studio</span>

                <strong>
                    {{ $studio->nama }}
                </strong>

            </div>


            <div class="payment-info-row">

                <span>Kursi yang Dipesan</span>

                <strong>

                    <div class="payment-seat-list">

                        @foreach($pemesanan->detailKursis as $detail)

                            <span class="payment-seat">
                                {{ $detail->no_kursi }}
                            </span>

                        @endforeach

                    </div>

                </strong>

            </div>


            <div class="payment-info-row">

                <span>Jumlah Tiket</span>

                <strong>
                    {{ $pemesanan->detailKursis->count() }} Tiket
                </strong>

            </div>

        </section>

    </div>


    {{-- KOLOM KANAN --}}

    <div class="payment-detail-column">


        {{-- TOTAL PEMBAYARAN --}}

        <section class="payment-total-card">

            <span>
                Total Pembayaran
            </span>

            <strong>
                Rp {{ number_format(
                    (float) $pembayaran->jumlah_bayar,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

        </section>


        {{-- STATUS --}}

        <section class="payment-detail-card">

            <h2>Status Transaksi</h2>

            <div style="margin-bottom: 17px;">

                <span class="payment-detail-status payment-{{ $pembayaran->status }}">
                    {{ ucfirst($pembayaran->status) }}
                </span>

            </div>


            @if($pembayaran->status === 'berhasil')

                <div style="color:#15803d;font-size:12px;line-height:1.7;">

                    <strong>✓ Pembayaran Berhasil</strong>

                    <p style="margin-top:8px;">
                        Transaksi telah berhasil diproses.
                        Pemesanan berstatus lunas dan e-ticket
                        tersedia untuk digunakan.
                    </p>

                </div>

            @elseif($pembayaran->status === 'gagal')

                <div style="color:#b91c1c;font-size:12px;line-height:1.7;">

                    <strong>Pembayaran Gagal</strong>

                    <p style="margin-top:8px;">
                        Transaksi belum berhasil diproses.
                        Pengunjung dapat mencoba kembali
                        proses pembayaran.
                    </p>

                </div>

            @else

                <div style="color:#a36b00;font-size:12px;line-height:1.7;">

                    <strong>Menunggu Pembayaran</strong>

                    <p style="margin-top:8px;">
                        Transaksi sudah tercatat, tetapi
                        pembayaran belum berhasil diselesaikan.
                    </p>

                </div>

            @endif

        </section>


        {{-- INFORMASI ADMIN --}}

        <div class="payment-admin-note">

            <strong>Informasi Administrator</strong>

            Status pembayaran diperbarui secara otomatis
            berdasarkan hasil proses simulasi pembayaran.

            Halaman ini digunakan untuk memantau informasi
            dan detail transaksi.

        </div>


        {{-- TOMBOL --}}

        <div class="payment-actions">

            <a
                href="{{ route(
                    'admin.pemesanans.show',
                    $pemesanan->id
                ) }}"
                class="payment-btn-secondary"
            >
                Detail Pemesanan
            </a>


            @if(
                $pemesanan->status === 'lunas'
                && $pembayaran->status === 'berhasil'
            )

                <a
                    href="{{ route(
                        'booking.tickets.index',
                        $pemesanan->kode_booking
                    ) }}"
                    class="payment-btn-ticket"
                    target="_blank"
                >
                    Lihat E-Ticket
                </a>

            @endif

        </div>

    </div>

</div>

@endsection