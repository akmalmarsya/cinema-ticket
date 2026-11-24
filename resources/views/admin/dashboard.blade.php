@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="page-heading">

    <div>
        <div class="eyebrow">OVERVIEW</div>

        <h1>Dashboard</h1>

        <p>
            Selamat datang di panel administrator CinemaTicket.
            Berikut ringkasan data bioskop.
        </p>
    </div>

    <div class="date-pill">
        {{ now()->translatedFormat('l, d F Y') }}
    </div>

</div>


<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-top">
            Total Film
            <span class="stat-icon">🎬</span>
        </div>

        <div class="stat-value">
            {{ number_format($stats['films']) }}
        </div>

        <div class="stat-description">
            Film terdaftar dalam sistem
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-top">
            Total Studio
            <span class="stat-icon">🏢</span>
        </div>

        <div class="stat-value">
            {{ number_format($stats['studios']) }}
        </div>

        <div class="stat-description">
            Studio bioskop terdaftar
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-top">
            Total Jadwal
            <span class="stat-icon">🗓️</span>
        </div>

        <div class="stat-value">
            {{ number_format($stats['schedules']) }}
        </div>

        <div class="stat-description">
            Jadwal penayangan tersimpan
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-top">
            Total Pemesanan
            <span class="stat-icon">🎟️</span>
        </div>

        <div class="stat-value">
            {{ number_format($stats['orders']) }}
        </div>

        <div class="stat-description">
            Transaksi pemesanan tercatat
        </div>
    </div>

</div>


<div class="content-grid">

    <div class="panel">

        <h2>Pemesanan Terbaru</h2>

        <p class="panel-subtitle">
            Lima transaksi terakhir yang tercatat dalam sistem.
        </p>

        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>KODE BOOKING</th>
                        <th>PEMESAN</th>
                        <th>FILM</th>
                        <th>STUDIO</th>
                        <th>STATUS</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($latestOrders as $order)

                        <tr>

                            <td>
                                {{ $order->kode_booking }}
                            </td>

                            <td>
                                {{ $order->nama_pemesan }}
                            </td>

                            <td>
                                {{ $order->jadwal?->film?->judul ?? '-' }}
                            </td>

                            <td>
                                {{ $order->jadwal?->studio?->nama ?? '-' }}
                            </td>

                            <td>
                                <span class="status status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format((float) $order->total_harga, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada transaksi pemesanan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="panel">

        <h2>Ringkasan Transaksi</h2>

        <p class="panel-subtitle">
            Status pemesanan saat ini.
        </p>

        <div class="summary-item">
            <span>Menunggu pembayaran</span>

            <strong>
                {{ number_format($stats['booking']) }}
            </strong>
        </div>

        <div class="summary-item">
            <span>Sudah lunas</span>

            <strong>
                {{ number_format($stats['paid']) }}
            </strong>
        </div>

        <div class="summary-note">
            Data statistik ditampilkan secara dinamis
            berdasarkan isi database CinemaTicket.
        </div>

    </div>

</div>

@endsection
