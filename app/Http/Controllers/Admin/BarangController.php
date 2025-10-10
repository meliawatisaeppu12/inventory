<?php

namespace App\Http\Controllers\Admin;

use App\Export\ExportBarang;
use App\Http\Controllers\Controller;
use App\Models\barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = barang::all();

        return view('Admin/content/barang/index', compact('barang'));
    }

    public function tambah()
    {
        return view('Admin/content/barang/tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'kode_lokasi' => 'required',
            'nama_barang' => 'required',
            'nomor_registrasi' => 'nullable',
            'jumlah_barang' => 'required',
            'jumlah_tersedia' => 'required',
            'updated_pengguna_id' => 'nullable'

        ], [
            'nama_barang.required' => 'Nama barang wajib diisi!'
        ]);

        $barang = new barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->kode_lokasi = $request->kode_lokasi;
        $barang->nama_barang = $request->nama_barang;
        $barang->nomor_registrasi = $request->nomor_registrasi;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->jumlah_tersedia = $request->jumlah_tersedia;
        $barang->created_pengguna_id = Auth::guard('admin')->user()->id_pengguna;

        try {
            $barang->save();
            return redirect(route('admin.barang.index'))->with(['success' => 'Tambah Data Berhasil']);
        } catch (\Exception $e) {
            return redirect(route('admin.barang.index'))->with(['warning' => 'Tambah Data Gagal']);
        }
    }

    public function edit($id_barang)
    {
        $barang = barang::findOrFail($id_barang);
        return view('Admin/content/barang/edit', compact('barang'));
    }

    public function update(Request $request, $id_barang)
    {
        $barang = barang::findOrFail($id_barang);
        $barang->kode_barang = $request->kode_barang;
        $barang->kode_lokasi = $request->kode_lokasi;
        $barang->nama_barang = $request->nama_barang;
        $barang->nomor_registrasi = $request->nomor_registrasi;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->jumlah_tersedia = $request->jumlah_tersedia;
        $barang->updated_pengguna_id = Auth::guard('admin')->user()->id_pengguna;


        try {
            $barang->update();
            return redirect(route('admin.barang.index'))->with(['success' => 'Ubah Data Berhasil']);
        } catch (\Exception $e) {
            return redirect(route('admin.barang.index'))->with(['warning' => 'Ubah Data Gagal']);
        }
    }


    public function hapus($id_barang)
    {
        $barang = barang::findOrFail($id_barang);

        try {
            $barang->delete();
            return redirect(route('admin.barang.index'))->with(['success' => 'Anda Berhasil Menghapus Data Barang!']);
        } catch (\Exception $e) {
            return redirect(route('admin.barang.index'))->with(['warning' => 'Anda Gagal Menghapus Data Barang!']);
        }
    }


    public function excel()
    {

        return Excel::download(new ExportBarang(), 'Data Barang-' . date(now()) . '.xlsx');
    }
    public function pdf()
    {
        $barang = barang::all();

        view()->share('data', $barang);
        $pdf = PDF::loadview('Admin/content/barang/pdf');
        return $pdf->download('Data Barang.pdf');
    }
}
