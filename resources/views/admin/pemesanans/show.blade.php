@extends('layouts.admin')

@section('title', 'Detail Pemesanan')

@section('content')

<style>
    .detail-layout {
        display: grid;
        grid-template-columns: 1.2fr .8fr;
        gap: 20px;
    }

    .detail-card {
        background: white;
        border: 1px solid #e8edf3;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
    }

    .detail-card h2 {
        font-size: 17px;
        margin-bottom: 20px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 0;
        border-bottom: 1px solid #edf0f5;
        font-size: 13px;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-row span {
        color: #64748b;
    }

    .detail-row strong {
        text-align: right;
        color: #18243b;
        overflow-wrap: anywhere;
    }

    .seat-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .seat-item {
        padding: 9px 13px;
        border-radius: 6px;
        background: #fff4d8;
        color: #a36b00;
        font-size: 12px;
        font-weight: bold;
    }

    .total-card {
        background: #111b31;
        color: white;
        border-radius: 12px;
        padding: 24px;
    }

    .total-card span {
        color: #bdc8d9;
        font-size: 12px;
    }

    .total-card strong {
        display: block;
        color: #f5b942;
        font-size: 27px;
        margin-top: 12px;
    }

    .info-note {
        background: #fff8e8;
        border: 1px solid #f5dfaa;
        color: #98701e;
        padding: 15px;
        border-radius: 8px;
        font-size: 12px;
        line-height: 1.7;
        margin-top: 20px;
    }

    @media(max-width:900px) {
        .detail-layout {
            grid-template-columns: 1fr;
        }
    }
</style>


{{-- HEADER --}}

<div class="page-heading">

    <div>

        <div class="eyebrow">TRANSACTION DETAIL</div>

        <h1>Detail Pemesanan</h1>

        <p>
            Informasi lengkap transaksi pemesanan tiket CinemaTicket.
        </p>

    </div>

    <a
        href="{{ route('admin.pemesanans.index') }}"
        class="btn-secondary"
    >
        ← Kembali
    </a>

</div>


<div class="detail-layout">

    <div>

        {{-- INFORMASI PEMESAN --}}

        <div class="detail-card">

            <h2>Informasi Pemesan</h2>

            <div class="detail-row">

                <span>Kode Booking</span>

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

                <span>Tanggal Booking</span>

                <strong>
                    {{ $pemesanan->created_at?->format('d F Y, H:i') }}
                </strong>

            </div>

        </div>


        {{-- INFORMASI FILM DAN JADWAL --}}

        <div class="detail-card">

            <h2>Informasi Penayangan</h2>

            <div class="detail-row">

                <span>Judul Film</span>

                <strong>
                    {{ $pemesanan->jadwal?->film?->judul ?? '-' }}
                </strong>

            </div>

            <div class="detail-row">

                <span>Genre</span>

                <strong>
                    {{ $pemesanan->jadwal?->film?->genre ?? '-' }}
                </strong>

            </div>

            <div class="detail-row">

                <span>Tanggal Tayang</span>

                <strong>
                    @if($pemesanan->jadwal)
                        {{ \Carbon\Carbon::parse(
                            $pemesanan->jadwal->tanggal_tayang
                        )->format('d F Y') }}
                    @else
                        -
                    @endif
                </strong>

            </div>

            <div class="detail-row">

                <span>Jam Tayang</span>

                <strong>

                    @if($pemesanan->jadwal)

                        {{ date(
                            'H:i',
                            strtotime($pemesanan->jadwal->jam_mulai)
                        ) }}

                        -

                        {{ date(
                            'H:i',
                            strtotime($pemesanan->jadwal->jam_selesai)
                        ) }}

                    @else

                        -

                    @endif

                </strong>

            </div>

            <div class="detail-row">

                <span>Studio</span>

                <strong>
                    {{ $pemesanan->jadwal?->studio?->nama ?? '-' }}
                </strong>

            </div>

        </div>


        {{-- INFORMASI KURSI --}}

        <div class="detail-card">

            <h2>Kursi yang Dipesan</h2>

            <div class="seat-container">

                @forelse($pemesanan->detailKursis as $detail)

                    <span class="seat-item">
                        {{ $detail->no_kursi }}
                    </span>

                @empty

                    <span>
                        Tidak ada detail kursi.
                    </span>

                @endforelse

            </div>

            <div class="detail-row" style="margin-top:15px;">

                <span>Jumlah Kursi</span>

                <strong>
                    {{ $pemesanan->detailKursis->count() }} Kursi
                </strong>

            </div>

        </div>

    </div>


    {{-- RINGKASAN TRANSAKSI --}}

    <div>

        <div class="detail-card">

            <h2>Status Pemesanan</h2>

            <div style="margin-bottom:20px;">

                <span class="status status-{{ $pemesanan->status }}">
                    {{ ucfirst($pemesanan->status) }}
                </span>

            </div>

            <div class="detail-row">

                <span>Kode Booking</span>

                <strong>
                    {{ $pemesanan->kode_booking }}
                </strong>

            </div>

            <div class="detail-row">

                <span>Jumlah Tiket</span>

                <strong>
                    {{ $pemesanan->detailKursis->count() }}
                </strong>

            </div>

            <div class="detail-row">

                <span>Harga per Tiket</span>

                <strong>

                    @if($pemesanan->detailKursis->isNotEmpty())

                        Rp {{ number_format(
                            (float) $pemesanan->detailKursis->first()->harga,
                            0,
                            ',',
                            '.'
                        ) }}

                    @else

                        -

                    @endif

                </strong>

            </div>

        </div>


        <div class="total-card">

            <span>Total Pemesanan</span>

            <strong>
                Rp {{ number_format(
                    (float) $pemesanan->total_harga,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

        </div>


        <div class="info-note">

            <strong>Informasi Administrator</strong>

            <p style="margin-top:7px;">

                Halaman ini digunakan untuk memantau
                detail transaksi pemesanan.

                Pengubahan status pembayaran akan
                tersedia pada pengembangan Sprint 7.

            </p>

        </div>

    </div>

</div>

@endsection