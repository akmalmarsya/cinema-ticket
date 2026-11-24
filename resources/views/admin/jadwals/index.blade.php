@extends('layouts.admin')

@section('title', 'Data Jadwal')

@section('content')

@php
    $studioSort = request('studio_sort');

    $nextStudioSort = $studioSort === 'asc'
        ? 'desc'
        : 'asc';
@endphp

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Jadwal Tayang</h1>
        <p>Kelola jadwal penayangan film di seluruh studio.</p>
    </div>
</div>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Notifikasi error --}}
@if(session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>
@endif

{{-- Toolbar pencarian dan filter --}}
<div class="crud-toolbar">

    <form action="{{ route('admin.jadwals.index') }}" method="GET">

        <input
            type="text"
            name="search"
            class="search-input"
            placeholder="Cari judul film atau studio..."
            value="{{ request('search') }}"
        >

        <select name="status" class="search-input">

            <option value="">
                Semua Status
            </option>

            <option
                value="aktif"
                @selected(request('status') === 'aktif')
            >
                Aktif
            </option>

            <option
                value="dibatalkan"
                @selected(request('status') === 'dibatalkan')
            >
                Dibatalkan
            </option>

        </select>

        <button type="submit" class="btn-secondary">
            Filter
        </button>

    </form>

    <a
        href="{{ route('admin.jadwals.create') }}"
        class="btn-primary"
    >
        + Tambah Jadwal
    </a>

</div>


{{-- Tabel jadwal --}}
<div class="table-card">

    <h2>Daftar Jadwal Tayang</h2>

    <p class="panel-subtitle">
        Total {{ $jadwals->total() }} jadwal terdaftar.
    </p>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>

                    {{-- Kolom Film --}}
                    <th>FILM</th>

                    {{-- Kolom Studio: Sorting ASC / DESC --}}
                    <th>
                        <a
                            href="{{ request()->fullUrlWithQuery([
                                'studio_sort' => $nextStudioSort,
                                'page' => null
                            ]) }}"
                            style="
                                color: inherit;
                                text-decoration: none;
                                cursor: pointer;
                                display: inline-flex;
                                align-items: center;
                                gap: 5px;
                            "
                            title="Klik untuk mengurutkan studio"
                        >

                            STUDIO

                            @if($studioSort === 'asc')
                                <span style="color: #F5B82E;">↑</span>
                            @elseif($studioSort === 'desc')
                                <span style="color: #F5B82E;">↓</span>
                            @else
                                <span style="color: #94A3B8;">↕</span>
                            @endif

                        </a>
                    </th>

                    {{-- Kolom Tanggal: Terlama ke Terbaru --}}
                    <th>
                        TANGGAL
                        <span style="color: #16A34A;">↑</span>
                    </th>

                    {{-- Kolom Jam: Paling Awal ke Paling Akhir --}}
                    <th>
                        JAM MULAI
                        <span style="color: #16A34A;">↑</span>
                    </th>

                    {{-- Kolom Jam Selesai --}}
                    <th>JAM SELESAI</th>

                    {{-- Kolom Harga --}}
                    <th>HARGA TIKET</th>

                    {{-- Kolom Status --}}
                    <th>STATUS</th>

                    {{-- Kolom Aksi --}}
                    <th>AKSI</th>

                </tr>
            </thead>

            <tbody>

                @forelse($jadwals as $jadwal)

                    <tr>

                        {{-- Nama Film --}}
                        <td>
                            <strong>
                                {{ $jadwal->film->judul ?? '-' }}
                            </strong>
                        </td>

                        {{-- Nama Studio --}}
                        <td>
                            {{ $jadwal->studio->nama ?? '-' }}
                        </td>

                        {{-- Tanggal Tayang --}}
                        <td>
                            {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->translatedFormat('d M Y') }}
                        </td>

                        {{-- Jam Mulai --}}
                        <td>
                            {{ date('H:i', strtotime($jadwal->jam_mulai)) }}
                        </td>

                        {{-- Jam Selesai --}}
                        <td>
                            {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                        </td>

                        {{-- Harga Tiket --}}
                        <td>
                            Rp {{ number_format((float) $jadwal->harga, 0, ',', '.') }}
                        </td>

                        {{-- Status Jadwal --}}
                        <td>

                            @if($jadwal->status === 'aktif')

                                <span class="pill pill-green">
                                    Aktif
                                </span>

                            @else

                                <span class="pill pill-gray">
                                    Dibatalkan
                                </span>

                            @endif

                        </td>

                        {{-- Aksi --}}
                        <td>

                            <div class="table-actions">

                                {{-- Edit --}}
                                <a
                                    href="{{ route('admin.jadwals.edit', $jadwal->id) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>

                                {{-- Hapus --}}
                                <form
                                    action="{{ route('admin.jadwals.destroy', $jadwal->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-danger"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="empty">
                            Belum ada jadwal penayangan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="pagination-wrap">
        {{ $jadwals->links() }}
    </div>

</div>

@endsection