<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use App\Models\barang;
use App\Models\instansi;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $totalBarang      = barang::sum('jumlah_barang');                // jumlah jenis barang
        $totalStokBarang  = barang::sum('jumlah_tersedia');          // total unit barang
        $totalInstansi    = instansi::count();              // jumlah instansi
        $totalPeminjaman  = peminjaman::count();            // jumlah peminjaman

        return view('atasan/content/dashboard', compact(
            'totalBarang',
            'totalStokBarang',
            'totalInstansi',
            'totalPeminjaman'
        ));
    }
}
