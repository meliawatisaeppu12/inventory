<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pengguna')->insert([
            'role' => 'admin',
            'nama_pengguna' => 'Hiththoh',
            'jk_pengguna' => 'Laki-laki',
            'telepon' => '082323278934',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'id_instansi' => '1',
        ]);
    }
}
