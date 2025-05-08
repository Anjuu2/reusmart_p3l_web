<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organisasi
 * 
 * @property int $id_organisasi
 * @property string $nama_organisasi
 * @property string $alamat
 * @property string $password
 * @property bool $status_aktif
 * 
 * @property Collection|RequestDonasi[] $request_donasis
 *
 * @package App\Models
 */
class Organisasi extends Model
{
	protected $table = 'organisasi';
	protected $primaryKey = 'id_organisasi';
	public $timestamps = false;

	protected $casts = [
		'status_aktif' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nama_organisasi',
		'alamat',
		'password',
		'status_aktif'
	];

	public function request_donasis()
	{
		return $this->hasMany(RequestDonasi::class, 'id_organisasi');
	}
}
