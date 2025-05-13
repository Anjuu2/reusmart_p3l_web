<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Penitip
 * 
 * @property int $id_penitip
 * @property string $no_ktp
 * @property string $nama_penitip
 * @property string $username
 * @property string $password
 * @property int $poin
 * @property string $alamat
 * @property string $email
 * @property float $saldo_penitip
 * @property bool $status_aktif
 * 
 * @property Collection|Badge[] $badges
 * @property Collection|BarangTitipan[] $barang_titipans
 * @property Collection|Komisi[] $komisis
 * @property Collection|Rating[] $ratings
 *
 * @package App\Models
 */
class Penitip extends Authenticatable
{
	use HasApiTokens, HasFactory;
	protected $table = 'penitip';
	protected $primaryKey = 'id_penitip';
	public $timestamps = false;

	protected $casts = [
		'poin' => 'int',
		'saldo_penitip' => 'float',
		'status_aktif' => 'bool'
	];

	protected $hidden = [
		'password'
	];

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

	public function badges()
	{
		return $this->hasMany(Badge::class, 'id_penitip');
	}

	public function barang_titipans()
	{
		return $this->hasMany(BarangTitipan::class, 'id_penitip');
	}

	public function komisis()
	{
		return $this->hasMany(Komisi::class, 'id_penitip');
	}

	public function ratings()
	{
		return $this->hasMany(Rating::class, 'id_penitip');
	}
}
