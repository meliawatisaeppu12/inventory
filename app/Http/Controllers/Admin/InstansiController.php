<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\instansi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $instansi = instansi::all();

        return view('admin.content.instansi.index', compact('instansi'));
    }

    public function tambah()
    {
        return view('admin.content.instansi.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required',
            'alamat' => 'required',
            'updated_pengguna_id' => 'nullable'

        ], [
            'nama_instansi.required' => 'Nama Instansi wajib diisi!'
        ]);

        $instansi = new instansi();
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->alamat = $request->alamat;
        $instansi->created_pengguna_id = Auth::guard('admin')->user()->id_pengguna;

        try {
            $instansi->save();
            return redirect(route('admin.instansi.index'))->with(['success' => 'Tambah Data Berhasil']);
        } catch (\Exception $e) {
            return redirect(route('admin.instansi.index'))->with(['warning' => 'Tambah Data Gagal']);
        }
    }

    public function edit($id_instansi)
    {
        $instansi = instansi::findOrFail($id_instansi);
        return view('admin/content/instansi/edit', compact('instansi'));
    }

    public function update(Request $request, $id_instansi)
    {
        $instansi = instansi::findOrFail($id_instansi);
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->alamat = $request->alamat;
        $instansi->updated_pengguna_id = Auth::guard('admin')->user()->id_pengguna;

        try {
            $instansi->update();
            return redirect(route('admin.instansi.index'))->with(['success', 'Ubah Data Instansi Berhasil']);
        } catch (\Exception $e) {
            return redirect(route('admin.instansi.index'))->with(['warning', 'Ubah Data Instansi Gagal']);
        }
    }

    public function hapus($id_instansi)
    {
        $instansi = instansi::findOrFail($id_instansi);

        try {
            $instansi->delete();
            return redirect()->route('admin.instansi.index')->with('Berhasil', 'Anda Berhasil Menghapus Data Instansi!');
        } catch (\Exception $e) {
            return redirect()->route('admin.instansi.index')->with('Berhasil', 'Anda Gagal Menghapus Data Instansi!');
        }
    }
}
