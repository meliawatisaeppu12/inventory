<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use Carbon\Carbon;

class CekPeminjamanTerlambat extends Command
{
    /**
     * Nama command yang dipanggil di terminal
     *
     * @var string
     */
    protected $signature = 'peminjaman:cekTerlambat';

    /**
     * Deskripsi command
     *
     * @var string
     */
    protected $description = 'Cek peminjaman yang melewati batas waktu dan ubah status jadi Terlambat';

    /**
     * Jalankan command
     */
    public function handle()
    {
        $now = Carbon::now();

        $terlambat = Peminjaman::where('status', 'Dipinjam')
            ->where('batas_peminjaman', '<', $now)
            ->get();

        foreach ($terlambat as $item) {
            $item->update(['status' => 'Terlambat']);
        }

        $this->info("Cek selesai. Jumlah peminjaman yang diubah jadi Terlambat: " . $terlambat->count());
    }
}
