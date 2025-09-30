<?php

namespace App\Http\Controllers\Admin;

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
        $peminjaman = Peminjaman::select(
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

        return view('admin.content.peminjaman.index', compact('peminjaman'));
    }

    public function tambah(Request $request)
    {
        $peminjaman = Peminjaman::all();
        $barang = Barang::all();
        return view('admin.content.peminjaman.tambah', compact('peminjaman', 'barang'));
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

        $barang = Barang::findOrFail($request->id_barang);

        // cek stok
        if ($barang->jumlah_tersedia < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // kurangi stok barang
        $barang->jumlah_tersedia -= $request->jumlah_pinjam;
        $barang->save();

        Peminjaman::create([
            'detail_kegiatan'     => $request->detail_kegiatan,
            'tgl_peminjaman'      => $request->tgl_peminjaman,
            'batas_peminjaman'    => $request->batas_peminjaman,
            'jumlah_pinjam'       => $request->jumlah_pinjam,
            'keterangan'          => 'dipinjam',
            'id_pengguna'         => Auth::guard('admin')->user()->id_pengguna,
            'id_barang'           => $request->id_barang,
            'created_pengguna_id' => Auth::guard('admin')->user()->id_pengguna,
        ]);
        return redirect()->route('admin.peminjaman.index')->with('success', 'Barang berhasil dipinjam.');
    }



    public function edit(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);
        $barang = Barang::all();
        return view('admin.content.peminjaman.edit', compact('peminjaman', 'barang'));
    }

    public function update(Request $request, $id_peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);
        $peminjaman->tgl_peminjaman   = $request->tgl_peminjaman;
        $peminjaman->detail_kegiatan  = $request->detail_kegiatan;
        $peminjaman->batas_peminjaman = $request->batas_peminjaman;
        $peminjaman->jumlah_pinjam    = $request->jumlah_pinjam;
        $peminjaman->id_barang        = $request->id_barang;
        $peminjaman->updated_pengguna_id = Auth::guard('admin')->user()->id_pengguna;

        // jika status diubah jadi dikembalikan
        if ($request->keterangan === 'dikembalikan' && $peminjaman->keterangan !== 'dikembalikan') {
            $barang = Barang::findOrFail($peminjaman->id_barang);
            $barang->jumlah_tersedia += $peminjaman->jumlah_pinjam;
            $barang->save();
        }

        $peminjaman->keterangan = $request->keterangan;

        try {
            $peminjaman->update();
            return redirect()->route('admin.peminjaman.index')->with('succeed', 'Ubah Data Peminjaman Berhasil!');
        } catch (\Exception $e) {
            return redirect()->route('admin.peminjaman.index')->with('fail', 'Ubah Data Peminjaman Gagal!');
        }
    }

    public function setuju($id_peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);

        if ($peminjaman->keterangan !== 'pengajuan') {
            return back()->with('error', 'Peminjaman ini sudah diproses sebelumnya.');
        }

        $barang = Barang::findOrFail($peminjaman->id_barang);

        // cek stok sebelum setuju
        if ($barang->jumlah_tersedia < $peminjaman->jumlah_pinjam) {
            return back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // kurangi stok baru setelah disetujui
        $barang->jumlah_tersedia -= $peminjaman->jumlah_pinjam;
        $barang->save();

        $peminjaman->update([
            'keterangan' => 'dipinjam',
            'updated_pengguna_id' => Auth::guard('admin')->user()->id_pengguna
        ]);

        return back()->with('success', 'Peminjaman disetujui dan barang berhasil dipinjam.');
    }

    public function tolak(Request $request, $id_peminjaman)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255'
        ]);


        $peminjaman = Peminjaman::findOrFail($id_peminjaman);

        // Cegah penolakan ganda
        if ($peminjaman->keterangan === 'ditolak') {
            return redirect()->back()->with('Gagal', 'Peminjaman ini sudah ditolak sebelumnya.');
        }

        $peminjaman->keterangan = 'ditolak';
        $peminjaman->alasan_penolakan = $request->alasan_penolakan;
        $peminjaman->save();

        $peminjaman->update([
            'keterangan' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->back()->with('Berhasil', 'Peminjaman ditolak dengan alasan: ' . $request->alasan_penolakan);
    }






    public function hapus($id_peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);

        try {
            $peminjaman->delete();
            return redirect()->route('admin.peminjaman.index')->with('succeed', 'Anda Berhasil Menghapus Data Peminjaman!');
        } catch (\Exception $e) {
            return redirect()->route('admin.peminjaman.index')->with('fail', 'Anda Gagal Menghapus Data Peminjaman!');
        }
    }

    // Update status keterlambatan otomatis
    public function cekTerlambat()
    {
        $peminjaman = peminjaman::where('keterangan', 'dipinjam')->get();

        foreach ($peminjaman as $pinjam) {
            if (Carbon::now()->greaterThan($pinjam->batas_peminjaman)) {
                $pinjam->update(['keterangan' => 'terlambat']);
            }
        }
    }


    // Barang dikembalikan
    public function kembalikan($id_peminjaman)
    {
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);

        if (in_array($peminjaman->keterangan, ['dipinjam', 'terlambat'])) {
            $barang = Barang::findOrFail($peminjaman->id_barang);
            $barang->jumlah_tersedia += $peminjaman->jumlah_pinjam;
            $barang->save();

            $peminjaman->update([
                'keterangan'          => 'dikembalikan',
                'updated_pengguna_id' => Auth::guard('admin')->user()->id_pengguna,
            ]);
        }

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
    }


    public function excel()
    {

        return Excel::download(new ExportPeminjaman(), 'Data Peminjaman-' . date(now()) . '.xlsx');
    }
    public function pdf()
    {
        $peminjaman = Peminjaman::select(
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
        $pdf = PDF::loadview('admin/content/peminjaman/pdf');
        return $pdf->download('Data Peminjaman.pdf');
    }
}
