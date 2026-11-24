@extends('layouts.admin')

@section('title', 'Tambah Studio')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Tambah Studio</h1>
        <p>Tambahkan studio baru ke dalam sistem bioskop.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert-error">
        Terdapat kesalahan pada input. Silakan periksa kembali.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.studios.store') }}"
        method="POST"
    >

        @csrf

        @include('admin.studios._form', ['studio' => null])

        <div class="crud-toolbar" style="margin-top:25px;margin-bottom:0">

            <a href="{{ route('admin.studios.index') }}" class="btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn-primary">
                Simpan Studio
            </button>

        </div>

    </form>

</div>

@endsection