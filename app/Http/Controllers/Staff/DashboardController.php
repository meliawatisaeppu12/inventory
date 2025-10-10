<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\barang;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        $totalBarang      = barang::sum('jumlah_barang');                // jumlah jenis barang
        $totalStokBarang  = barang::sum('jumlah_tersedia');          // total unit barang
        $totalPeminjaman  = peminjaman::where('id_pengguna', Auth::id())->count(); // jumlah peminjaman user login
        // jumlah peminjaman

        return view('Staff/content/dashboard', compact(
            'totalBarang',
            'totalStokBarang',
            'totalPeminjaman'
        ));
    }
}
