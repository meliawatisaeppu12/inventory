<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = "pengguna";
    protected $primaryKey = "id_pengguna";
    protected $fillable = [
        'role',
        'nama_pengguna',
        'jk_pengguna',
        'telepon',
        'email',
        'password',
        'id_instansi',
        'pengguna_enabled',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
