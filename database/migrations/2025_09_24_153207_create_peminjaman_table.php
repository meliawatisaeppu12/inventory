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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->text('detail_kegiatan');
            $table->dateTime('tgl_peminjaman');
            $table->dateTime('batas_peminjaman');
            $table->unsignedInteger('jumlah_pinjam');
            $table->enum('keterangan', ['pengajuan', 'dipinjam', 'terlambat', 'dikembalikan', 'ditolak'])->default('dipinjam');

            $table->text('alasan_penolakan')->nullable();

            $table->unsignedBigInteger('id_pengguna');
            $table->foreign('id_pengguna')
                ->references('id_pengguna')
                ->on('pengguna')
                ->onDelete('restrict');

            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')
                ->references('id_barang')
                ->on('barang')
                ->onDelete('restrict');

            $table->unsignedBigInteger('created_pengguna_id');
            $table->unsignedBigInteger('updated_pengguna_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('alasan_penolakan');
        });
    }
};
