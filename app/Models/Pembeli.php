<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Pembeli extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'pembeli';  
    protected $primaryKey = 'id_pembeli';  
    public $timestamps = true;  

    protected $fillable = [
        'username',
        'password',
        'poin',
        'email',
        'notelp',
        'nama_pembeli',
        'status_aktif'
    ];

    public function getAuthPassword()
    {
        return $this->password;  
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pembeli');
    }

}
