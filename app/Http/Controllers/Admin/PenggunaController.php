<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\instansi;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
         $pengguna = Pengguna::select("pengguna.*", 'instansi.nama_instansi as instansi')
            ->join('instansi', 'instansi.id_instansi', '=', 'pengguna.id_instansi')
            ->orderBy('pengguna.id_pengguna')
            ->paginate(10);

        return view('admin/content/pengguna/index', compact('pengguna'));
    }

    function logout()
    {
        return redirect('/');
    }

    public function tambah()
    {
       $pengguna = Pengguna::select("pengguna.*",'instansi.nama_instansi as instansi')
            ->join('instansi','instansi.id_instansi', '=','pengguna.id_instansi')->orderBy('pengguna.id_pengguna')->get();
        $instansi = instansi::all();
        return view('admin/content/pengguna/tambah', compact('pengguna','instansi'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'role' => 'required',
            'nama_pengguna' => 'required',
            'jk_pengguna' => 'required',
            'telepon'=>'required',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:8',
            'id_instansi' => 'required',
            
            
        ]);

        $pengguna = new Pengguna();
        $pengguna->role = $request->role;
        $pengguna->nama_pengguna = $request->nama_pengguna;
        $pengguna->jk_pengguna = $request->jk_pengguna;
        $pengguna->telepon = $request->telepon;
        $pengguna->email = $request->email;
        $pengguna->password = Hash::make($request->password);
        $pengguna->id_instansi = $request->id_instansi;
        

        try {
            $pengguna->save();
            return redirect()->route('admin.pengguna.index')->with('success', 'Tambah Data Pengguna Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('admin.pengguna.index')->with('fail', 'Tambah Data Pengguna Gagal Ditambahkan');
        }
    }


    public function edit($id_pengguna){
         $pengguna = pengguna::findOrFail($id_pengguna);
        $instansi = instansi::all();
        return view('admin/content/pengguna/edit', compact('pengguna', 'instansi'));
  
    }

    public function update(Request $request ,$id_pengguna){

        $request->validate([
            'role' => 'required',
            'nama_pengguna' => 'required',
            'jk_pengguna' => 'required',
            'telepon' => 'required',
            'id_instansi' => 'required'
        ]);

        $pengguna = Pengguna::findOrFail($id_pengguna);
        $pengguna->role = $request->role;
        $pengguna->nama_pengguna = $request->nama_pengguna;
        $pengguna->jk_pengguna = $request->jk_pengguna;
        $pengguna->telepon = $request->telepon;
        $pengguna->email = $request->email;
        $pengguna->id_instansi = $request->id_instansi;

        try {
            $pengguna->update();
            return redirect()->route('admin.pengguna.index')->with('success', 'Ubah Data Pengguna Berhasil');
        }
        catch(\Exception $e){
            return redirect()->route('admin.pengguna.index')->with('fail', 'Ubah Data Pengguna Gagal');
        }
    }
    
    public function hapus($id_pengguna){
        $pengguna = Pengguna::findOrFail($id_pengguna);
        try {
            $pengguna->delete();
            return redirect(route('admin.pengguna.index'));
        } catch (\Exception $e) {
            return redirect(route('admin.pengguna.index'));
        }
    }

}


