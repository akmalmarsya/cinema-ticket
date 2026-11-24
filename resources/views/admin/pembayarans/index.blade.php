@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')

<style>
    .payment-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .payment-stat {
        background: white;
        border: 1px solid #e8edf3;
        border-radius: 12px;
        padding: 22px;
    }

    .payment-stat-label {
        color: #64748b;
        font-size: 13px;
    }

    .payment-stat-value {
        font-size: 29px;
        font-weight: bold;
        margin-top: 17px;
    }

    .payment-stat-value.orange {
        color: #c58a18;
    }

    .payment-stat-value.green {
        color: #15803d;
    }

    .payment-stat-value.red {
        color: #dc2626;
    }

    .payment-stat-description {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 7px;
    }

    .payment-total-note {
        background: #fff8e8;
        color: #98701e;
        border-radius: 8px;
        padding: 13px 16px;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .payment-filter {
        display: grid;
        grid-template-columns: minmax(200px, 1fr) 220px auto auto;
        gap: 10px;
        margin-top: 22px;
        margin-bottom: 22px;
    }

    .payment-filter select {
        width: 100%;
        padding: 12px;
        border: 1px solid #dce3ec;
        border-radius: 7px;
        background: white;
        font-size: 13px;
        color: #18243b;
    }

    .payment-filter button,
    .payment-filter a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 11px 17px;
        border-radius: 7px;
        border: none;
        text-decoration: none;
        font-size: 13px;
        cursor: pointer;
    }

    .payment-filter .btn-search {
        background: #eeb63d;
        color: #18243b;
        font-weight: bold;
    }

    .payment-filter .btn-reset {
        background: #e8edf4;
        color: #334155;
    }

    .payment-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: bold;
        white-space: nowrap;
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

    .payment-code {
        color: #1d4ed8;
        font-weight: bold;
        text-decoration: none;
    }

    .payment-code:hover {
        text-decoration: underline;
    }

    .payment-muted {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 5px;
    }

    .payment-amount {
        font-weight: bold;
        white-space: nowrap;
    }

    .payment-detail-button {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 6px;
        background: #e0edff;
        color: #1d4ed8;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
    }

    .payment-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
        font-size: 12px;
        color: #64748b;
    }

    .pagination-buttons {
        display: flex;
        gap: 7px;
    }

    .pagination-buttons a,
    .pagination-buttons span {
        padding: 9px 13px;
        border-radius: 6px;
        text-decoration: none;
        background: #e8edf4;
        color: #334155;
    }

    .pagination-buttons span.disabled {
        opacity: .45;
    }

    .pagination-buttons a:hover {
        background: #263a5e;
        color: white;
    }

    @media(max-width: 1100px) {
        .payment-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 700px) {
        .payment-stats {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .payment-stat {
            padding: 15px;
        }

        .payment-stat-value {
            font-size: 23px;
        }

        .payment-filter {
            grid-template-columns: 1fr;
        }
    }
</style>


{{-- HEADER --}}

<div class="page-heading">

    <div>
        <div class="eyebrow">PAYMENT MANAGEMENT</div>

        <h1>Manajemen Pembayaran</h1>

        <p>
            Kelola dan pantau seluruh transaksi pembayaran
            tiket CinemaTicket.
        </p>
    </div>

</div>


{{-- STATISTIK --}}

<div class="payment-stats">

    <div class="payment-stat">

        <div class="payment-stat-label">
            Total Pembayaran
        </div>

        <div class="payment-stat-value">
            {{ $stats['total'] }}
        </div>

        <div class="payment-stat-description">
            Seluruh transaksi pembayaran
        </div>

    </div>


    <div class="payment-stat">

        <div class="payment-stat-label">
            Menunggu Pembayaran
        </div>

        <div class="payment-stat-value orange">
            {{ $stats['menunggu'] }}
        </div>

        <div class="payment-stat-description">
            Transaksi belum berhasil
        </div>

    </div>


    <div class="payment-stat">

        <div class="payment-stat-label">
            Pembayaran Berhasil
        </div>

        <div class="payment-stat-value green">
            {{ $stats['berhasil'] }}
        </div>

        <div class="payment-stat-description">
            Transaksi sudah lunas
        </div>

    </div>


    <div class="payment-stat">

        <div class="payment-stat-label">
            Pembayaran Gagal
        </div>

        <div class="payment-stat-value red">
            {{ $stats['gagal'] }}
        </div>

        <div class="payment-stat-description">
            Transaksi gagal diproses
        </div>

    </div>

</div>


{{-- NOMINAL PEMBAYARAN --}}

<div class="payment-total-note">

    Total nominal pembayaran yang berhasil:

    <strong>
        Rp {{ number_format(
            (float) $stats['nominal_berhasil'],
            0,
            ',',
            '.'
        ) }}
    </strong>

</div>


{{-- DAFTAR PEMBAYARAN --}}

<div class="table-card">

    <h2>Daftar Transaksi Pembayaran</h2>

    <p class="panel-subtitle">
        Seluruh pembayaran yang telah tercatat dalam database.
    </p>


    {{-- FILTER DAN PENCARIAN --}}

    <form
        method="GET"
        action="{{ route('admin.pembayarans.index') }}"
        class="payment-filter"
    >

        <input
            type="text"
            name="q"
            class="search-input"
            value="{{ $keyword }}"
            placeholder="Cari kode booking, pemesan, HP, atau referensi..."
        >

        <select name="status">

            <option value="">
                Semua Status
            </option>

            <option
                value="menunggu"
                {{ $status === 'menunggu' ? 'selected' : '' }}
            >
                Menunggu
            </option>

            <option
                value="berhasil"
                {{ $status === 'berhasil' ? 'selected' : '' }}
            >
                Berhasil
            </option>

            <option
                value="gagal"
                {{ $status === 'gagal' ? 'selected' : '' }}
            >
                Gagal
            </option>

        </select>


        <button type="submit" class="btn-search">
            Cari
        </button>


        <a
            href="{{ route('admin.pembayarans.index') }}"
            class="btn-reset"
        >
            Reset
        </a>

    </form>


    {{-- TABEL --}}

    <div class="table-wrap">

        <table>

            <thead>

                <tr>
                    <th>KODE BOOKING</th>
                    <th>PEMESAN</th>
                    <th>FILM</th>
                    <th>METODE</th>
                    <th>JUMLAH</th>
                    <th>KODE REFERENSI</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>

            </thead>


            <tbody>

                @forelse($pembayarans as $pembayaran)

                    <tr>

                        {{-- KODE BOOKING --}}

                        <td>

                            <a
                                href="{{ route(
                                    'admin.pemesanans.show',
                                    $pembayaran->pemesanan->id
                                ) }}"
                                class="payment-code"
                            >
                                {{ $pembayaran->pemesanan->kode_booking }}
                            </a>

                            <div class="payment-muted">
                                {{ $pembayaran->created_at->format('d/m/Y H:i') }}
                            </div>

                        </td>


                        {{-- PEMESAN --}}

                        <td>

                            <strong>
                                {{ $pembayaran->pemesanan->nama_pemesan }}
                            </strong>

                            <div class="payment-muted">
                                {{ $pembayaran->pemesanan->no_hp }}
                            </div>

                        </td>


                        {{-- FILM --}}

                        <td>

                            <strong>
                                {{ $pembayaran->pemesanan->jadwal->film->judul ?? '-' }}
                            </strong>

                        </td>


                        {{-- METODE --}}

                        <td>

                            {{ ucwords(str_replace(
                                '_',
                                ' ',
                                $pembayaran->metode_pembayaran
                            )) }}

                        </td>


                        {{-- JUMLAH --}}

                        <td>

                            <span class="payment-amount">
                                Rp {{ number_format(
                                    (float) $pembayaran->jumlah_bayar,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </span>

                        </td>


                        {{-- REFERENSI --}}

                        <td>

                            <span>
                                {{ $pembayaran->kode_referensi ?? '-' }}
                            </span>

                        </td>


                        {{-- STATUS --}}

                        <td>

                            <span class="payment-badge payment-{{ $pembayaran->status }}">
                                {{ ucfirst($pembayaran->status) }}
                            </span>

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <a
                                href="{{ route(
                                    'admin.pembayarans.show',
                                    $pembayaran->id
                                ) }}"
                                class="payment-detail-button"
                            >
                                Detail
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="empty">

                            Belum ada data pembayaran yang ditemukan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}

    @if($pembayarans->hasPages())

        <div class="payment-pagination">

            <div>
                Menampilkan {{ $pembayarans->firstItem() }}
                sampai {{ $pembayarans->lastItem() }}
                dari {{ $pembayarans->total() }} pembayaran
            </div>

            <div class="pagination-buttons">

                @if($pembayarans->previousPageUrl())

                    <a href="{{ $pembayarans->previousPageUrl() }}">
                        ← Sebelumnya
                    </a>

                @else

                    <span class="disabled">
                        ← Sebelumnya
                    </span>

                @endif


                <span>
                    {{ $pembayarans->currentPage() }}
                    / {{ $pembayarans->lastPage() }}
                </span>


                @if($pembayarans->nextPageUrl())

                    <a href="{{ $pembayarans->nextPageUrl() }}">
                        Selanjutnya →
                    </a>

                @else

                    <span class="disabled">
                        Selanjutnya →
                    </span>

                @endif

            </div>

        </div>

    @endif

</div>

@endsection