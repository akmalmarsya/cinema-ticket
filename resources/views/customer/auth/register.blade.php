<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Customer - CinemaTicket</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b1020;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .card {
            width: 100%;
            max-width: 450px;
            padding: 38px;
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 15px;
        }

        .logo {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .logo span {
            color: #f5b942;
        }

        .eyebrow {
            text-align: center;
            color: #f5b942;
            font-size: 11px;
            letter-spacing: 3px;
            margin-bottom: 12px;
        }

        h1 {
            text-align: center;
            font-size: 27px;
            margin-bottom: 12px;
        }

        .subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 12px;
            color: #cbd5e1;
            margin-bottom: 9px;
        }

        input {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            background: #202c45;
            border: 1px solid #34435e;
            border-radius: 8px;
            color: white;
            outline: none;
        }

        input:focus {
            border-color: #f5b942;
        }

        .btn {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 8px;
            background: #f5b942;
            color: #10172b;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn:hover {
            background: #ffd477;
        }

        .error {
            background: rgba(239,68,68,.12);
            border: 1px solid #991b1b;
            color: #f87171;
            padding: 12px;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .field-error {
            color: #f87171;
            font-size: 11px;
            margin-top: 7px;
        }

        .bottom {
            margin-top: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        .bottom a {
            color: #f5b942;
            text-decoration: none;
            font-weight: bold;
        }

        .back {
            display: block;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 20px;
            text-decoration: none;
        }

        /* Penyesuaian halaman autentikasi dengan navbar */

        body {
            display: block;
            padding: 0;
        }

        .card {
            margin: 52px auto;
        }

        @media (max-width: 520px) {
            .card {
                margin: 28px auto;
            }
        }
    </style>

    @include('layouts.partials.public-navbar-styles')

</head>

<body>
    @include('layouts.partials.public-navbar')

<div class="card">

    <div class="logo">
        CINEMA<span>TICKET</span>
    </div>

    <div class="eyebrow">JOIN CINEMATICKET</div>

    <h1>Buat Akun Baru</h1>

    <p class="subtitle">
        Daftar sekarang agar kamu dapat memesan tiket
        dan menyimpan seluruh riwayat pembelian.
    </p>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('customer.register.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input
                type="text"
                name="name"
                placeholder="Masukkan nama lengkap"
                value="{{ old('name') }}"
                autocomplete="name"
                maxlength="255"
                required
            >
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                placeholder="Masukkan email aktif"
                value="{{ old('email') }}"
                autocomplete="email"
                required
            >
        </div>

        <div class="form-group">
            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Minimal 8 karakter"
                autocomplete="new-password"
                minlength="8"
                required
            >
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                placeholder="Ulangi password"
                autocomplete="new-password"
                minlength="8"
                required
            >
        </div>

        <button type="submit" class="btn">
            Daftar Akun →
        </button>

    </form>

    <div class="bottom">
        Sudah punya akun?
        <a href="{{ route('customer.login') }}">Login di sini</a>
    </div>

    <a href="{{ route('home') }}" class="back">
        ← Kembali ke Homepage
    </a>

</div>

</body>
</html>