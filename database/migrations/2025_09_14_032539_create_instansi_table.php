<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->id('id_instansi');
            $table->string('nama_instansi');
            $table->string('alamat');
            $table->unsignedBigInteger('created_pengguna_id');
            $table->unsignedBigInteger('updated_pengguna_id')->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => \Database\Seeders\InstansiSeeder::class,
        ]);
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('instansi');
    }
};
