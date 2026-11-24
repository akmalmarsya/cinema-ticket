<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Customer - CinemaTicket</title>

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
            max-width: 430px;
            padding: 38px;
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 15px;
        }

        .logo {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .logo span {
            color: #f5b942;
        }

        .eyebrow {
            color: #f5b942;
            font-size: 11px;
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 12px;
        }

        h1 {
            text-align: center;
            font-size: 27px;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.7;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 12px;
            color: #cbd5e1;
            margin-bottom: 9px;
        }

        input[type=email],
        input[type=password] {
            width: 100%;
            height: 48px;
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

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 22px;
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
        }

        .btn:hover {
            background: #ffd477;
        }

        .message {
            padding: 12px;
            border-radius: 7px;
            font-size: 12px;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        .error {
            background: rgba(239,68,68,.12);
            color: #f87171;
        }

        .info {
            background: rgba(245,185,66,.12);
            color: #f5b942;
        }

        .success {
            background: rgba(34,197,94,.12);
            color: #4ade80;
        }

        .field-error {
            color: #f87171;
            font-size: 11px;
            margin-top: 7px;
        }

        .bottom {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            line-height: 2;
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
            text-decoration: none;
            margin-top: 20px;
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

    <div class="eyebrow">CUSTOMER ACCOUNT</div>

    <h1>Selamat Datang!</h1>

    <p class="subtitle">
        Login untuk memesan tiket dan melihat riwayat
        pembelian film favoritmu.
    </p>

    @if(session('info'))
        <div class="message info">
            {{ session('info') }}
        </div>
    @endif

    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="message error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('customer.login.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
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
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >
        </div>

        <label class="remember">
            <input type="checkbox" name="remember" value="1">
            Ingat saya
        </label>

        <button type="submit" class="btn">
            Login Sekarang →
        </button>

    </form>

    <div class="bottom">
        Belum punya akun?
        <a href="{{ route('customer.register') }}">Daftar sekarang</a>
    </div>

    <a href="{{ route('home') }}" class="back">
        ← Kembali ke Homepage
    </a>

</div>

</body>
</html>