<?php
session_start();

// Jika user sudah login, langsung redirect ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIKEMAS DISKOMINFO</title>
    <link rel='icon' href="{{URL::asset('assets/img/logo.png')}}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi fade-in */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
    </style>
</head>

<body class="h-screen bg-gray-900">

    <!-- Background Image -->
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('assets/img/gedung.jpg');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">

            <!-- Logo -->
            <div class="flex items-center mb-4 fade-in-up" style="animation-delay: 0.2s;">
                <img src="assets/img/mentawai.png" alt="Logo" width="100">
                <img src="assets/img/logo_kominfo.png" alt="Logo" width="200">
            </div>

            <!-- Judul -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3 fade-in-up" style="animation-delay: 0.4s;">
                PINJAM KEMBALI ASET (PIKEMAS)
            </h1>

            <!-- Subjudul -->
            <h2 class="text-lg md:text-xl font-bold text-yellow-400 fade-in-up" style="animation-delay: 0.6s;">
                DINAS KOMUNIKASI DAN INFORMATIKA
            </h2>
            <p class="text-white mt-1 fade-in-up" style="animation-delay: 0.8s;">
                KABUPATEN KEPULAUAN MENTAWAI
            </p>

            <!-- Tombol -->
            <div class="flex space-x-4 fade-in-up" style="animation-delay: 1.2s;">
                <a href="{{ route('login.index') }}"
                    class="bg-blue-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg shadow transform transition duration-300 hover:scale-110">
                    LOGIN
                </a>
            </div>
        </div>
    </div>

</body>

</html>