@extends('layouts.admin')

@section('title', 'Edit Studio')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Edit Studio</h1>
        <p>Perbarui informasi {{ $studio->nama }}.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert-error">
        Terdapat kesalahan pada input. Silakan periksa kembali.
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.studios.update', $studio->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        @include('admin.studios._form', ['studio' => $studio])

        <div class="crud-toolbar" style="margin-top:25px;margin-bottom:0">

            <a href="{{ route('admin.studios.index') }}" class="btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn-primary">
                Perbarui Studio
            </button>

        </div>

    </form>

</div>

@endsection