<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');

            // Identitas Barang
            $table->string('kode_barang', 100)->unique();
            $table->string('kode_lokasi', 100);
            $table->string('nama_barang', 100);
            $table->string('nomor_registrasi', 100)->nullable();

            // Jumlah & Stok
            $table->unsignedInteger('jumlah_barang');   // jumlah total barang
            $table->unsignedInteger('jumlah_tersedia'); // jumlah stok tersedia untuk dipinjam

            // Audit Trail
            $table->unsignedBigInteger('created_pengguna_id');
            $table->unsignedBigInteger('updated_pengguna_id')->nullable();

            $table->timestamps();

             });
              \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => \Database\Seeders\BarangSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
