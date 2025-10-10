<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use App\Models\barang;
use App\Export\ExportBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = barang::all();

        return view('Atasan.content.barang.index', compact('barang'));
    }

    public function excel()
    {

        return Excel::download(new ExportBarang(), 'Data Barang-' . date(now()) . '.xlsx');
    }
    public function pdf()
    {
        $barang = barang::all();

        view()->share('data', $barang);
        $pdf = PDF::loadview('Atasan/content/barang/pdf');
        return $pdf->download('Data Barang.pdf');
    }
}
