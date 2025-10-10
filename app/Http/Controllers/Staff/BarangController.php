<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = barang::all();

        return view('Staff/content/barang/index', compact('barang'));
    }
}
