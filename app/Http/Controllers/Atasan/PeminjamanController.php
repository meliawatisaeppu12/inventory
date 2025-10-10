<?php

namespace App\Http\Controllers\Atasan;

use App\Export\ExportPeminjaman;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController
{
    public function index()
    {
        $peminjaman = peminjaman::select(
            'peminjaman.*',
            'pengguna.nama_pengguna as pengguna',
            'barang.nama_barang as barang'
        )
            ->join('pengguna', 'pengguna.id_pengguna', '=', 'peminjaman.id_pengguna')
            ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
            ->get();

        // update status otomatis jadi "terlambat" kalau sudah melewati batas_peminjaman
        foreach ($peminjaman as $item) {
            if ($item->keterangan === 'dipinjam' && now()->greaterThan($item->batas_peminjaman)) {
                $item->keterangan = 'terlambat';
                $item->save();
            }
        }

        return view('atasan.content.peminjaman.index', compact('peminjaman'));
    }

    public function tambah(Request $request)
    {
        $peminjaman = peminjaman::all();
        $barang = barang::all();
        return view('atasan.content.peminjaman.tambah', compact('peminjaman', 'barang'));
    }



    // Simpan data peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'detail_kegiatan' => 'required|string',
            'tgl_peminjaman' => 'required|date',
            'batas_peminjaman' => 'required|date|after:tgl_peminjaman',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        $barang = barang::findOrFail($request->id_barang);

        // cek stok
        if ($barang->jumlah_tersedia < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // kurangi stok barang
        $barang->jumlah_tersedia -= $request->jumlah_pinjam;
        $barang->save();

        peminjaman::create([
            'detail_kegiatan'     => $request->detail_kegiatan,
            'tgl_peminjaman'      => $request->tgl_peminjaman,
            'batas_peminjaman'    => $request->batas_peminjaman,
            'jumlah_pinjam'       => $request->jumlah_pinjam,
            'keterangan'          => 'pengajuan',
            'id_pengguna'         => Auth::guard('atasan')->user()->id_pengguna,
            'id_barang'           => $request->id_barang,
            'created_pengguna_id' => Auth::guard('atasan')->user()->id_pengguna,
        ]);
        return redirect()->route('atasan.peminjaman.index')->with('success', 'Peminjaman berhasil diajukan, menunggu persetujuan admin.');
    }



    public function edit(Request $request, $id_peminjaman)
    {
        $peminjaman = peminjaman::findOrFail($id_peminjaman);
        $barang = barang::all();
        return view('atasan.content.peminjaman.edit', compact('peminjaman', 'barang'));
    }

    public function update(Request $request, $id_peminjaman)
    {
        $peminjaman = peminjaman::findOrFail($id_peminjaman);

        $peminjaman->tgl_peminjaman   = $request->tgl_peminjaman;
        $peminjaman->detail_kegiatan  = $request->detail_kegiatan;
        $peminjaman->batas_peminjaman = $request->batas_peminjaman;
        $peminjaman->jumlah_pinjam    = $request->jumlah_pinjam;
        $peminjaman->id_barang        = $request->id_barang;
        $peminjaman->updated_pengguna_id = Auth::guard('atasan')->user()->id_pengguna;

        // jika status diubah jadi dikembalikan
        if ($request->keterangan === 'dikembalikan' && $peminjaman->keterangan !== 'dikembalikan') {
            $barang = barang::findOrFail($peminjaman->id_barang);
            $barang->jumlah_tersedia += $peminjaman->jumlah_pinjam;
            $barang->save();
        }

        $peminjaman->keterangan = $request->keterangan;

        try {
            $peminjaman->update();
            return redirect()->route('atasan.peminjaman.index')->with('succeed', 'Ubah Data Peminjaman Berhasil!');
        } catch (\Exception $e) {
            return redirect()->route('atasan.peminjaman.index')->with('fail', 'Ubah Data Peminjaman Gagal!');
        }
    }


    public function cekTerlambat()
    {
        $peminjaman = peminjaman::where('keterangan', 'dipinjam')
            ->get();

        foreach ($peminjaman as $pinjam) {
            if (Carbon::now()->greaterThan($pinjam->batas_peminjaman)) {
                $pinjam->update(['keterangan' => 'terlambat']);
            }
        }
    }

    public function excel()
    {

        return Excel::download(new ExportPeminjaman(), 'Data Peminjaman-' . date(now()) . '.xlsx');
    }
    public function pdf()
    {
        $peminjaman = peminjaman::select(
            'detail_kegiatan',
            'tgl_peminjaman',
            'batas_peminjaman',
            'jumlah_pinjam',
            'keterangan',
            'pengguna.nama_pengguna as pengguna',
            'barang.nama_barang as barang'
        )
            ->join('pengguna', 'pengguna.id_pengguna', '=', 'peminjaman.id_pengguna')
            ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
            ->get();

        view()->share('data', $peminjaman);
        $pdf = PDF::loadview('Admin/content/peminjaman/pdf');
        return $pdf->download('Data Peminjaman.pdf');
    }
}
