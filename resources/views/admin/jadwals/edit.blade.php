@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')

<div class="page-heading">
    <div>
        <div class="eyebrow">MANAJEMEN DATA</div>
        <h1>Edit Jadwal</h1>
        <p>Perbarui jadwal penayangan film.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert-error">
        <strong>Jadwal tidak dapat diperbarui.</strong>

        <ul style="margin:8px 0 0 18px">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-card">

    <form
        action="{{ route('admin.jadwals.update', $jadwal->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        @include('admin.jadwals._form', ['jadwal' => $jadwal])

        <div class="crud-toolbar" style="margin-top:25px;margin-bottom:0">

            <a href="{{ route('admin.jadwals.index') }}" class="btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn-primary">
                Perbarui Jadwal
            </button>

        </div>

    </form>

</div>

@endsection