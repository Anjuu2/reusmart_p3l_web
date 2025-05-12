<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Organisasi extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'organisasi';                
    protected $primaryKey = 'id_organisasi';        
    public $timestamps = false;                   

    protected $fillable = [
        'nama_organisasi',
        'alamat',
        'password',
        'status_aktif',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
