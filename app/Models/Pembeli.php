<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pembeli
 * 
 * @property int $id_pembeli
 * @property string $username
 * @property string $password
 * @property int $poin
 * @property string $email
 * @property string $notelp
 * @property string $nama_pembeli
 * @property bool $status_aktif
 * 
 * @property Collection|AlamatPembeli[] $alamat_pembelis
 * @property Collection|DiskusiProduk[] $diskusi_produks
 * @property Collection|Keranjang[] $keranjangs
 * @property Collection|Pembayaran[] $pembayarans
 * @property Collection|Rating[] $ratings
 * @property Collection|Reward[] $rewards
 * @property Collection|Transaksi[] $transaksis
 *
 * @package App\Models
 */
class Pembeli extends Model
{
	protected $table = 'pembeli';
	protected $primaryKey = 'id_pembeli';
	public $timestamps = false;

	protected $casts = [
		'poin' => 'int',
		'status_aktif' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'poin',
		'email',
		'notelp',
		'nama_pembeli',
		'status_aktif'
	];

	public function alamat_pembelis()
	{
		return $this->hasMany(AlamatPembeli::class, 'id_pembeli');
	}

	public function diskusi_produks()
	{
		return $this->hasMany(DiskusiProduk::class, 'id_pembeli');
	}

	public function keranjangs()
	{
		return $this->hasMany(Keranjang::class, 'id_pembeli');
	}

	public function pembayarans()
	{
		return $this->hasMany(Pembayaran::class, 'id_pembeli');
	}

	public function ratings()
	{
		return $this->hasMany(Rating::class, 'id_pembeli');
	}

	public function rewards()
	{
		return $this->hasMany(Reward::class, 'id_pembeli');
	}

	public function transaksis()
	{
		return $this->hasMany(Transaksi::class, 'id_pembeli');
	}
}
