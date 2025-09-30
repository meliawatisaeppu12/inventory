<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instansi')->insert([
            'nama_instansi' => 'Dinas Pendidikan',
            'alamat' => 'KM.04',
            'created_pengguna_id' => '1'
        ]);

        DB::table('instansi')->insert([
            'nama_instansi' => 'Dinas Perumahan',
            'alamat' => 'KM.04',
            'created_pengguna_id' => '1'
        ]);
    }
}
