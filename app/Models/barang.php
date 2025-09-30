<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'kode_barang',
        'kode_lokasi',
        'nama_barang',
        'nomor_registrasi',
        'jumlah_barang',
        'jumlah_tersedia',
        'created_pengguna_id',
        'updated_pengguna_id'
    ];
}
