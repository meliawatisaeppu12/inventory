<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SEPAKAT DISKOMINFO - Kabupaten Kepulauan Mentawai</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" />

    <!-- jQuery + Bootstrap 5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS tambahan -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        :root {
            --warna-utama: #007bff;
            --warna-gelap: #003c8f;
            --warna-sidebar: #0f172a;
            --warna-teks: #e2e8f0;
            --warna-putih: #ffffff;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* ===== HEADER ===== */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: var(--warna-putih);
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .site-header .site-logo img {
            height: 42px;
            display: block;
        }

        .site-header .site-logo span {
            font-weight: 600;
            color: black(--warna-utama);
            font-size: 18px;
            margin-left: 8px;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background-color: var(--warna-sidebar);
            width: 230px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            padding-top: 70px;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sidebar .nav-link {
            color: var(--warna-teks);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-radius: 6px;
            font-weight: 500;
            transition: 0.3s;
        }

        .sidebar .nav-link i {
            width: 22px;
            font-size: 16px;
            margin-right: 10px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--warna-utama);
            color: var(--warna-putih);
        }

        /* ===== KONTEN ===== */
        .page-content {
            margin-left: 230px;
            margin-top: 70px;
            padding: 25px;
            min-height: 100vh;
            background: #f8fafc;
            transition: 0.3s;
        }

        /* ===== TOGGLE BUTTON (HP) ===== */
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            background: var(--warna-utama);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 20px;
            z-index: 1100;
            display: none;
        }


        /* ===== RESPONSIVE HP ===== */
        @media (max-width: 768px) {
            .sidebar {
                left: -240px;
            }

            .sidebar.active {
                left: 0;
            }

            .page-content {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }

            .site-header {
                padding-left: 55px;
            }
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

        .custom-alert {
            position: relative;
            padding: 14px 45px 14px 18px;
            border-radius: 8px;
            font-weight: 500;
            margin: 20px auto;
            border: 1px solid transparent;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            width: 95%;
            max-width: 800px;
            animation: fadeInDown 0.5s ease;
            transition: opacity 0.3s ease;
        }

        /* Warna alert sukses */
        .custom-alert.alert-success {
            background-color: #e6f9ec;
            border-color: #b6e7c1;
            color: #2d6a4f;
        }

        /* Warna alert error */
        .custom-alert.alert-danger {
            background-color: #fdecea;
            border-color: #f5c2c7;
            color: #842029;
        }

        /* Tombol close */
        .alert-close {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: inherit;
            opacity: 0.6;
            transition: 0.2s ease;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* Animasi masuk */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* biar smooth di HP */
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        table {
            min-width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        table th,
        table td {
            white-space: nowrap;
            /* biar teks tidak turun ke bawah */
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_wrapper {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <!-- Tombol Sidebar Mobile -->
    <button class="toggle-btn" id="toggleSidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- HEADER -->
    <header class="site-header">
        <a href="{{ route('staff.dashboard.index') }}" class="site-logo d-flex align-items-center text-decoration-none ">
            <img src="{{ URL::asset('assets/img/mentawai.png') }}" alt="Logo" height="40" class="d-none d-md-block me-2">
            <img src="{{ asset('assets/img/logo_kominfo.png') }}" alt="Logo">
            <span class="text-center">SEPAKAT DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN KEPULAUAN MENTAWAI</span>
        </a>

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

    <!-- SIDEBAR -->
    <nav class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('staff.dashboard.index') }}">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('staff.barang.index') }}">
                    <i class="fa-solid fa-box"></i> Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('staff.peminjaman.index') }}">
                    <i class="fa-solid fa-clipboard-list"></i> Peminjaman
                </a>
            </li>
        </ul>
    </nav>

    <!-- KONTEN UTAMA -->
    <main class="page-content">
        <div class="container-fluid">
            @yield('Staff/content')
        </div>
    </main>

    <!-- SCRIPT TOGGLE -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });


        setTimeout(() => {
            const alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 400); // hapus dari DOM setelah animasi
            }
        }, 3000);


        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('alert-close')) {
                const alertBox = e.target.closest('.custom-alert');
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 300);
            }
        });

        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollX: true, // aktifkan scroll horizontal
                autoWidth: false,
                responsive: true
            });
        });
    </script>
</body>

</html>