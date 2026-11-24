@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Tambah Jadwal</h1>
        <p>Tambahkan jadwal penayangan film.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert-error">
        <strong>Jadwal tidak dapat disimpan.</strong>

        <ul style="margin:8px 0 0 18px">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($films->isEmpty() || $studios->isEmpty())
    <div class="alert-error">
        Jadwal belum dapat dibuat. Pastikan tersedia minimal
        satu film berstatus tayang dan satu studio berstatus aktif.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.jadwals.store') }}"
        method="POST"
    >

        @csrf

        @include('admin.jadwals._form', ['jadwal' => null])

        <div class="crud-toolbar" style="margin-top:25px;margin-bottom:0">

            <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">
                Kembali
            </a>

            <button
                type="submit"
                class="btn-primary"
                @disabled($films->isEmpty() || $studios->isEmpty())
            >
                Simpan Jadwal
            </button>

        </div>

    </form>

</div>

@endsection