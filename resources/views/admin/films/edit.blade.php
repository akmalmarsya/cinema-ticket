@extends('layouts.admin')

@section('title', 'Edit Film')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Edit Film</h1>
        <p>Perbarui informasi film {{ $film->judul }}.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert-error">
        Terdapat kesalahan pada input. Silakan periksa kembali.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.films.update', $film->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        @include('admin.films._form', ['film' => $film])

        <div class="crud-toolbar" style="margin-top:25px; margin-bottom:0">

            <a href="{{ route('admin.films.index') }}" class="btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn-primary">
                Perbarui Film
            </button>

        </div>

    </form>

</div>

@endsection