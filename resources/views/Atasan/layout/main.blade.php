<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SEPAKAT DISKOMINFO</title>
    <link rel="icon" href="{{URL::asset('assets/img/logo.png')}}">

    <!-- SweetAlert & jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Favicon -->
    <link href="{{URL::asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="{{URL::asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="{{URL::asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="{{URL::asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.png')}}" rel="icon" type="image/png">
    <link href="{{URL::asset('assets/img/favicon.ico')}}" rel="shortcut icon">

    <!-- CSS Table -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/datatables-net/datatables.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/vendor/datatables-net.min.css')}}">

    <!-- CSS Vendor -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/vendor/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/separate/pages/widgets.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            padding-top: 70px;
        }

        /* Sidebar */
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

        .sidebar-header {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 4px;
            transition: background 0.2s;
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

        .sidebar.collapsed~.page-content {
            margin-left: 70px;
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

        .site-header .site-logo img {
            display: block;
        }

        /* Content */
        .page-content {
            margin-left: 220px;
            padding: 15px 20px 20px;
            transition: margin-left 0.3s;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #c9e7f2, #d6c8f5);
        }

        /* Toggle Button */
        .toggle-btn {
            background: #fff;
            border: none;
            color: #333;
            font-size: 14px;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .toggle-btn:hover {
            background: #f1f1f1;
        }

        /* User menu */
        .user-menu img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<body class="horizontal-navigation">

    <!-- Header -->
    <header class="site-header">
        <div class="container-fluid d-flex align-items-center gap-3">
            <a href="#" class="site-logo">
                <img src="{{ URL::asset('assets/img/mentawai.png') }}" alt="Logo" height="40" class="d-none d-md-block me-2">
                <img src="{{ URL::asset('assets/img/logo_kominfo.png') }}" alt="Logo" height="35">
            </a>
        </div>

        <!-- User Info -->
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
        <a href="{{Route('atasan.dashboard.index')}}"><i class="fa-solid fa-gauge"></i> <span>DASHBOARD</span></a>
        <a href="{{Route('atasan.instansi.index')}}"><i class="fa-solid fa-building"></i> <span>INSTANSI</span></a>
        <a href="{{Route('atasan.barang.index')}}"><i class="fas fa-box"></i> <span>BARANG</span></a>
        <a href="{{Route('atasan.peminjaman.index')}}"><i class="fas fa-hand-holding"></i> <span>PEMINJAMAN</span></a>
        <a href="#"><i class="fa-solid fa-file-lines"></i> <span>LAPORAN</span></a>
    </div>

    <!-- Content -->
    <div class="page-content">
        <div class="container-fluid">
            @yield('atasan.content')
        </div>
    </div>

    <!-- Vendor Scripts -->
    <script src="{{URL::asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/lib/lobipanel/lobipanel.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- DataTables -->
    <script src="{{URL::asset('assets/js/lib/datatables-net/datatables.min.js')}}"></script>

    <script>
        $(function() {
            $('#semester').DataTable();

            document.getElementById("toggleSidebar").addEventListener("click", function() {
                document.getElementById("sidebar").classList.toggle("collapsed");
            });
        });
    </script>
</body>

</html>