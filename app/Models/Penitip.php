<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Penitip extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'penitip';              
    protected $primaryKey = 'id_penitip';      
    public $timestamps = false;                

    protected $fillable = [
        'no_ktp',
        'nama_penitip',
        'username',
        'password',
        'poin',
        'alamat',
        'email',
        'saldo_penitip',
        'status_aktif'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
