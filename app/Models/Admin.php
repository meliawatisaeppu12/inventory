<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "pengguna";
    protected $primaryKey = "id_pengguna";
    protected $fillable = [
        'role',
        'nama_pengguna',
        'jk_pengguna',
        'email',
        'password',
        'pengguna_telepon	',
        'pengguna_foto',
        'pengguna_enabled',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
