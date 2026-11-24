
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | CinemaTicket</title>

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
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 950px;
            min-height: 550px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #151e33;
            border: 1px solid #26344f;
            border-radius: 18px;
            overflow: hidden;
        }

        .left-panel {
            padding: 55px 45px;
            background: linear-gradient(
                145deg,
                #172647,
                #263b63,
                #10172b
            );
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 55px;
        }

        .logo span {
            color: #f5b942;
        }

        .left-panel h1 {
            font-size: 36px;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .left-panel h1 span {
            color: #f5b942;
        }

        .left-panel p {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 14px;
        }

        .left-panel small {
            margin-top: 60px;
            color: #94a3b8;
        }

        .right-panel {
            padding: 55px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel h2 {
            font-size: 27px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 13px;
            color: #cbd5e1;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            border: 1px solid #334155;
            background: #0b1020;
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
            color: #cbd5e1;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .remember input {
            accent-color: #f5b942;
        }

        button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: #f5b942;
            color: #10172b;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #e5a928;
        }

        .error {
            background: #7f1d1d;
            color: #fecaca;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success {
            background: #14532d;
            color: #bbf7d0;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .back-home {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
        }

        .back-home a {
            color: #f5b942;
            text-decoration: none;
        }

        .copyright {
            text-align: center;
            color: #64748b;
            font-size: 11px;
            margin-top: 35px;
        }

        @media (max-width: 700px) {
            .container {
                grid-template-columns: 1fr;
            }

            .left-panel {
                padding: 30px;
            }

            .left-panel h1 {
                font-size: 27px;
            }

            .logo {
                margin-bottom: 25px;
            }

            .left-panel small {
                margin-top: 25px;
            }

            .right-panel {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="left-panel">

        <div class="logo">
            CINEMA<span>TICKET</span>
        </div>

        <h1>
            Welcome Back to
            <span>CinemaTicket.</span>
        </h1>

        <p>
            Kelola sistem pemesanan tiket bioskop dengan
            mudah melalui dashboard administrator.
            Pantau film, studio, jadwal tayang,
            dan transaksi pemesanan.
        </p>

        <small>
            ADMINISTRATOR ACCESS ONLY
        </small>

    </div>

    <div class="right-panel">

        <h2>Admin Login</h2>

        <p class="subtitle">
            Silakan masuk menggunakan akun administrator.
        </p>

        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.process') }}">

            @csrf

            <div class="form-group">
                <label for="email">Email Administrator</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="admin@cinematicket.test"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <label class="remember">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >
                Ingat saya
            </label>

            <button type="submit">
                LOGIN TO DASHBOARD
            </button>

        </form>

        <div class="back-home">
            <a href="{{ route('home') }}">
                ← Kembali ke Homepage
            </a>
        </div>

        <div class="copyright">
            © 2026 CinemaTicket. All Rights Reserved.
        </div>

    </div>

</div>

</body>
</html>
