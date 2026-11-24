@extends('layouts.admin')

@section('title', 'Tambah Film')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Tambah Film</h1>
        <p>Masukkan informasi film baru ke dalam sistem.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert-error">
        Terdapat kesalahan pada input. Silakan periksa kembali.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.films.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @include('admin.films._form', ['film' => null])

        <div class="crud-toolbar" style="margin-top:25px; margin-bottom:0">

            <a href="{{ route('admin.films.index') }}" class="btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn-primary">
                Simpan Film
            </button>

        </div>

    </form>

</div>

@endsection