<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pegawai extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    public $timestamps = false;

    protected $fillable = [
        'id_jabatan',
        'nama_pegawai',
        'email',
        'notelp',
        'tanggal_lahir',
        'username',
        'password',
        'status_aktif',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
