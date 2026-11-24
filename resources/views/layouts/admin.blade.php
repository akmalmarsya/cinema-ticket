<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | CinemaTicket</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            color: #18243b;
        }

        .admin-shell {
            min-height: 100vh;
        }

        /* SIDEBAR FIXED */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 255px;
            height: 100vh;
            height: 100dvh;

            background: #111b31;
            color: white;
            padding: 28px 18px;

            display: flex;
            flex-direction: column;

            overflow: hidden;
            z-index: 1000;
        }

        .brand {
            color: white;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            padding: 5px 12px;
            flex-shrink: 0;
        }

        .brand span {
            color: #f5b942;
        }

        .brand small {
            display: block;
            color: #91a0b8;
            font-size: 10px;
            letter-spacing: 3px;
            margin-top: 8px;
        }

        /* AREA MENU SIDEBAR */
        .sidebar-nav {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 4px;

            scrollbar-width: thin;
            scrollbar-color: #40516e #111b31;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: #111b31;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #40516e;
            border-radius: 10px;
        }

        .sidebar-section {
            color: #8291a9;
            font-size: 10px;
            letter-spacing: 2px;
            margin: 45px 12px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            margin-bottom: 7px;
            border-radius: 8px;
            color: #bdc8d9;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-link.active {
            background: #263a5e;
            color: #f5b942;
        }

        .nav-link:hover:not(.disabled) {
            background: #263a5e;
            color: white;
        }

        .nav-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .nav-link.disabled {
            opacity: .55;
            cursor: default;
        }

        .soon {
            margin-left: auto;
            font-size: 9px;
            color: #f5b942;
        }

        /* ADMIN PROFILE DAN LOGOUT */
        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid #2a3850;
            padding-top: 20px;
            flex-shrink: 0;
        }

        .admin-name {
            font-size: 13px;
            font-weight: bold;
        }

        .admin-role {
            color: #91a0b8;
            font-size: 11px;
            margin-top: 5px;
        }

        .logout-button {
            margin-top: 18px;
            width: 100%;
            padding: 11px;
            background: #263a5e;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #8f2929;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 255px;
            min-width: 0;
        }

        .topbar {
            height: 75px;
            background: white;
            border-bottom: 1px solid #e6eaf0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
        }

        .topbar-title {
            font-size: 13px;
            color: #64748b;
        }

        .topbar-user {
            font-size: 13px;
            font-weight: bold;
        }

        .content {
            padding: 35px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .eyebrow {
            color: #b88620;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 9px;
        }

        .page-heading h1 {
            font-size: 29px;
            margin-bottom: 9px;
        }

        .page-heading p {
            color: #7b8798;
            font-size: 13px;
        }

        .date-pill {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            border-radius: 8px;
            color: #64748b;
            font-size: 12px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 12px;
            padding: 22px;
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            color: #64748b;
            font-size: 13px;
        }

        .stat-icon {
            background: #fff4d8;
            color: #b88620;
            padding: 9px;
            border-radius: 8px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: bold;
            margin-top: 18px;
        }

        .stat-description {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 8px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 20px;
        }

        .panel {
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 12px;
            padding: 23px;
            min-width: 0;
        }

        .panel h2 {
            font-size: 17px;
        }

        .panel-subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 7px;
        }

        .table-wrap {
            overflow-x: auto;
            margin-top: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            text-align: left;
            color: #94a3b8;
            font-size: 11px;
            padding: 13px 10px;
            border-bottom: 1px solid #e8edf3;
        }

        td {
            padding: 15px 10px;
            border-bottom: 1px solid #f0f2f6;
            font-size: 12px;
        }

        .status {
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 10px;
        }

        .status-booking {
            background: #fff4d8;
            color: #a36b00;
        }

        .status-lunas {
            background: #dcfce7;
            color: #15803d;
        }

        .status-dibatalkan,
        .status-kedaluwarsa {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            text-align: center;
            color: #94a3b8;
            padding: 35px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 18px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        .summary-item strong {
            font-size: 20px;
        }

        .summary-note {
            background: #fff8e8;
            color: #98701e;
            border-radius: 8px;
            padding: 14px;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 20px;
        }

        footer {
            padding: 20px 35px;
            color: #94a3b8;
            font-size: 11px;
        }

        /* RESPONSIVE */
        @media(max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 700px) {
            .admin-shell {
                min-height: 100vh;
            }

            .sidebar {
                position: relative;
                top: auto;
                left: auto;
                width: 100%;
                height: auto;
                max-height: none;
                overflow: visible;
                padding: 20px;
            }

            .sidebar-nav {
                flex: none;
                min-height: auto;
                overflow: visible;
                padding-right: 0;
            }

            .sidebar-section {
                margin-top: 25px;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }

            .main {
                margin-left: 0;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 20px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-value {
                font-size: 24px;
            }
        }

        /* CRUD FILM */

        .crud-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-block;
            background: #eeb63d;
            color: #18243b;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            font-weight: bold;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-secondary {
            display: inline-block;
            background: #e8edf4;
            color: #334155;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-danger {
            background: #fee2e2;
            color: #b91c1c;
            border: none;
            padding: 8px 11px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-edit {
            display: inline-block;
            background: #e0edff;
            color: #1d4ed8;
            padding: 8px 11px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
        }

        .alert-success,
        .alert-error {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .table-card,
        .form-card {
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 12px;
            padding: 23px;
        }

        .search-input,
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #dce3ec;
            border-radius: 7px;
            background: #fff;
            color: #18243b;
            font-size: 13px;
            outline: none;
        }

        .search-input {
            max-width: 300px;
        }

        .form-control:focus,
        .search-input:focus {
            border-color: #eeb63d;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #334155;
            font-weight: bold;
            font-size: 13px;
        }

        .form-hint {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 7px;
        }

        .field-error {
            color: #dc2626;
            font-size: 11px;
            margin-top: 6px;
        }

        .poster-thumb {
            width: 55px;
            height: 75px;
            object-fit: cover;
            border-radius: 6px;
        }

        .poster-preview {
            width: 100px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .table-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .pill {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
        }

        .pill-green {
            background: #dcfce7;
            color: #15803d;
        }

        .pill-gray {
            background: #e2e8f0;
            color: #475569;
        }

        .pagination-wrap {
            margin-top: 20px;
            font-size: 13px;
        }

        @media(max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .crud-toolbar {
                align-items: stretch;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="admin-shell">

    <aside class="sidebar">

        <a href="{{ route('admin.dashboard') }}" class="brand">
            CINEMA<span>TICKET</span>
            <small>ADMIN PANEL</small>
        </a>

        <nav class="sidebar-nav">

            <div class="sidebar-section">MENU UTAMA</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">▦</span>
                Dashboard
            </a>

            <div class="sidebar-section">MANAJEMEN DATA</div>

            <a href="{{ route('admin.films.index') }}"
               class="nav-link {{ request()->routeIs('admin.films.*') ? 'active' : '' }}">
                <span class="nav-icon">▣</span>
                Film
            </a>

            <a href="{{ route('admin.studios.index') }}"
               class="nav-link {{ request()->routeIs('admin.studios.*') ? 'active' : '' }}">
                <span class="nav-icon">▤</span>
                Studio
            </a>

            <a href="{{ route('admin.jadwals.index') }}"
               class="nav-link {{ request()->routeIs('admin.jadwals.*') ? 'active' : '' }}">
                <span class="nav-icon">◷</span>
                Jadwal
            </a>

            <div class="sidebar-section">TRANSAKSI</div>

            <a href="{{ route('admin.pemesanans.index') }}"
               class="nav-link {{ request()->routeIs('admin.pemesanans.*') ? 'active' : '' }}">
                <span class="nav-icon">▧</span>
                Pemesanan
            </a>

            <a href="{{ route('admin.pembayarans.index') }}"
               class="nav-link {{ request()->routeIs('admin.pembayarans.*') ? 'active' : '' }}">
                <span class="nav-icon">◇</span>
                Pembayaran
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="admin-name">
                {{ auth()->user()->name }}
            </div>

            <div class="admin-role">
                Administrator
            </div>

            <form
                method="POST"
                action="{{ route('admin.logout') }}"
                onsubmit="return confirm('Apakah kamu yakin ingin logout dari panel administrator?');"
            >
                @csrf

                <button type="submit" class="logout-button">
                    ↪ Logout
                </button>
            </form>

        </div>

    </aside>

    <main class="main">

        <header class="topbar">

            <div class="topbar-title">
                CinemaTicket / Administrator
            </div>

            <div class="topbar-user">
                {{ auth()->user()->name }}
            </div>

        </header>

        <section class="content">
            @yield('content')
        </section>

        <footer>
            © {{ date('Y') }} CinemaTicket. All Rights Reserved.
        </footer>

    </main>

</div>

</body>
</html>