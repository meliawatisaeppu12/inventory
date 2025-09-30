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
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->enum('role', ['admin', 'staff', 'atasan'])->default('admin');

            $table->string('nama_pengguna', 200);
            $table->enum('jk_pengguna', ['Laki-laki', 'Perempuan']);
            $table->string('telepon')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('remember_token')->nullable();

            $table->unsignedBigInteger('id_instansi');
            $table->foreign('id_instansi')
                ->references('id_instansi')
                ->on('instansi')
                ->onDelete('restrict');

            $table->unsignedBigInteger('updated_pengguna_id')->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => \Database\Seeders\PenggunaSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};
