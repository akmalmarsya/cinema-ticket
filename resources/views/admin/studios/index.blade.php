@extends('layouts.admin')

@section('title', 'Data Studio')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Data Studio</h1>
        <p>Kelola studio dan kapasitas tempat duduk bioskop.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<div class="crud-toolbar">

    <form action="{{ route('admin.studios.index') }}" method="GET">
        <input
            type="text"
            name="search"
            class="search-input"
            placeholder="Cari nama atau tipe studio..."
            value="{{ request('search') }}"
        >

        <button type="submit" class="btn-secondary">
            Cari
        </button>
    </form>

    <a href="{{ route('admin.studios.create') }}" class="btn-primary">
        + Tambah Studio
    </a>

</div>

<div class="table-card">

    <h2>Daftar Studio</h2>

    <p class="panel-subtitle">
        Total {{ $studios->total() }} studio terdaftar.
    </p>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>NAMA STUDIO</th>
                    <th>TIPE</th>
                    <th>JUMLAH BARIS</th>
                    <th>KURSI PER BARIS</th>
                    <th>KAPASITAS</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>

                @forelse($studios as $studio)

                    <tr>

                        <td>
                            <strong>{{ $studio->nama }}</strong>
                        </td>

                        <td>{{ $studio->tipe }}</td>

                        <td>{{ $studio->jumlah_baris }} baris</td>

                        <td>{{ $studio->kursi_per_baris }} kursi</td>

                        <td>
                            <strong>{{ $studio->kapasitas }} kursi</strong>
                        </td>

                        <td>
                            @if($studio->status === 'aktif')
                                <span class="pill pill-green">Aktif</span>
                            @else
                                <span class="pill pill-gray">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.studios.edit', $studio->id) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.studios.destroy', $studio->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus studio ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-danger">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada data studio.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="pagination-wrap">
        {{ $studios->links() }}
    </div>

</div>

@endsection