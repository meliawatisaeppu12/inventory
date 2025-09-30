<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peminjaman')->insert([
            'tgl_peminjaman' => '2025-09-14',
            'detail_kegiatan' => 'Rapat',
            'batas_peminjaman' => '2025-08-14',
            'id_instansi' => '1',
            'id_barang' => '1',
            'created_pengguna_id' => '1'
        ]);

    }
}
