@extends('layouts.admin')

@section('title', 'Data Film')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Data Film</h1>
        <p>Kelola seluruh informasi film CinemaTicket.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<div class="crud-toolbar">

    <form action="{{ route('admin.films.index') }}" method="GET">
        <input
            type="text"
            name="search"
            class="search-input"
            placeholder="Cari judul atau genre film..."
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn-secondary">
            Cari
        </button>
    </form>

    <a href="{{ route('admin.films.create') }}" class="btn-primary">
        + Tambah Film
    </a>

</div>

<div class="table-card">

    <h2>Daftar Film</h2>
    <p class="panel-subtitle">
        Total {{ $films->total() }} film terdaftar.
    </p>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>POSTER</th>
                    <th>JUDUL FILM</th>
                    <th>GENRE</th>
                    <th>DURASI</th>
                    <th>RATING</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>

                @forelse($films as $film)

                    <tr>
                        <td>
                            @if($film->poster)
                                <img
                                    src="{{ asset('storage/'.$film->poster) }}"
                                    class="poster-thumb"
                                    alt="{{ $film->judul }}"
                                >
                            @else
                                <span>-</span>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $film->judul }}</strong>
                        </td>

                        <td>{{ $film->genre }}</td>

                        <td>{{ $film->durasi_menit }} menit</td>

                        <td>{{ $film->rating_usia }}</td>

                        <td>
                            @if($film->status === 'tayang')
                                <span class="pill pill-green">Tayang</span>
                            @else
                                <span class="pill pill-gray">Tidak Tayang</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.films.edit', $film->id) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.films.destroy', $film->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus film ini?')"
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
                            Belum ada data film.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="pagination-wrap">
        {{ $films->links() }}
    </div>

</div>

@endsection
