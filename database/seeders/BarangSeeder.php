<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BarangSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
        'kode_barang' => '12.345.5',
        'kode_lokasi' => '54.321.65',
        'nama_barang' => 'Leptop',
        'nomor_registrasi' => '546879',
        'jumlah_barang' => '10',
        'jumlah_tersedia' => '10',
        'created_pengguna_id' => '1',
        ]);
    }
}
