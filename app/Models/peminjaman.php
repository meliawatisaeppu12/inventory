<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'detail_kegiatan',
        'tgl_peminjaman',
        'batas_peminjaman',
        'keterangan',
        'id_pengguna',
        'id_barang',
        'jumlah_pinjam',
        'alasan_penolakan',
        'created_pengguna_id',
        'updated_pengguna_id',
    ];
}
