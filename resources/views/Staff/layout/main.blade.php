<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIKEMAS DISKOMINFO</title>
    <link rel="icon" href="{{ URL::asset('assets/img/logo.png') }}" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/lib/datatables-net/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/separate/vendor/datatables-net.min.css') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/lib/lobipanel/lobipanel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/separate/vendor/lobipanel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/lib/jqueryui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/separate/pages/widgets.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}">

    <!-- SweetAlert + jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            margin: 0;
            padding-top: 70px;
            /* supaya konten tidak ketiban header */
            font-family: Arial, sans-serif;
        }

        /* Header */
        .site-header {
            height: 65px;
            background: #fff;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        /* Sidebar style */
        .sidebar {
            position: fixed;
            top: 65px;
            left: 0;
            height: calc(100% - 65px);
            width: 220px;
            background: #2c313e;
            color: #fff;
            transition: width 0.3s;
            overflow-y: auto;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        /* Header kecil di dalam sidebar untuk toggle */
        .sidebar-header {
            display: flex;
            justify-content: flex-end;
            /* default di kanan */
            padding: 10px;
            position: relative;
        }

        /* Toggle Button */
        .toggle-btn {
            background: #fff;
            /* putih polos */
            border: none;
            color: #333;
            /* ikon gelap */
            font-size: 10px;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .toggle-btn:hover {
            background: #f1f1f1;
            /* abu muda saat hover */
        }

        /* Saat sidebar collapsed → tombol pindah ke tengah */
        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }

        /* Link menu */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: #1a1d25;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
            min-width: 25px;
            text-align: center;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        /* Content */
        .main-content {
            margin-left: 220px;
            padding: 15px 20px;
            transition: margin-left 0.3s;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 70px;
        }

        /* Tombol user info (biar rata atas-bawah & flat) */
        #dd-user-menu {
            display: flex;
            align-items: center;
            /* isi (avatar + teks) rata tengah vertikal */
            height: 45px;
            /* tinggi tombol */
            padding: 5px 14px;
            /* ruang atas bawah seimbang */
            background-color: #fff;
            /* putih polos */
            border: 1px solid #ddd;
            /* border tipis */
            border-radius: 6px;
            box-shadow: none;
            color: #333;
        }

        /* Hilangkan efek biru bootstrap saat hover/focus */
        #dd-user-menu:hover,
        #dd-user-menu:focus,
        #dd-user-menu:active,
        #dd-user-menu.show {
            background-color: #fff !important;
            color: #000 !important;
            box-shadow: none !important;
        }

        /* Avatar user */
        #dd-user-menu img {
            border: 1px solid #ddd;
        }

        /* Dropdown menu */
        .dropdown-menu {
            border-radius: 8px;
            border: 1px solid #eee;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-size: 14px;
        }

        /* Item dalam dropdown */
        .dropdown-menu .dropdown-item {
            padding: 8px 12px;
            color: #333;
            transition: background 0.2s;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #000;
        }
    </style>

</head>

<body class="horizontal-navigation">

    <!-- Header -->
    <header class="site-header">
        <!-- Logo -->
        <div class="container-fluid d-flex align-items-center gap-3">
            <a href="#" class="site-logo">
                <img src="{{ URL::asset('assets/img/mentawai.png') }}" alt="Logo" height="40" class="d-none d-md-block me-2">
                <img src="{{ URL::asset('assets/img/logo_kominfo.png') }}" alt="Logo" height="35">
            </a>
        </div>

        <!-- User Info -->
        <div class="dropdown">
            <button class="dropdown-toggle d-flex align-items-center" type="button"
                id="dd-user-menu" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ URL::asset('assets/img/avatar-2-64.png') }}" alt="User" width="35" class="rounded-circle me-2">
                <span class="font-weight-bold">Hi, {{ \App\Util\Helper::firstUserNameLogin() }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dd-user-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('login.logout') }}">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <button id="toggleSidebar" class="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <a href="{{ route('staff.dashboard.index') }}"><i class="fa-solid fa-gauge"></i><span>DASHBOARD</span></a>
        <a href="{{ route('staff.barang.index') }}"><i class="fas fa-box"></i><span>BARANG</span></a>
        <a href="{{ route('staff.peminjaman.index') }}"><i class="fas fa-hand-holding"></i><span>PEMINJAMAN</span></a>
    </div>


    <!-- Konten -->
    <div class="main-content">
        <div class="container-fluid">
            @yield('staff.content')
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('assets/js/lib/datatables-net/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        });
    </script>

</body>

</html>