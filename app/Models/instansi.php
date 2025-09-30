<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instansi extends Model
{
    use HasFactory;
    
    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';
    protected $fillable = [
        'nama_instansi',
        'alamat',
        'created_pengguna_id',
        'updated_pengguna_id'
    ];
}
