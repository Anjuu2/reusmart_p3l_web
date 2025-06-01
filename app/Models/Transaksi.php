<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaksi
 * 
 * @property int $id_transaksi
 * @property int $id_pembeli
 * @property Carbon $tanggal_transaksi
 * @property float $total_pembayaran
 * @property string $status_transaksi
 * 
 * @property Pembeli $pembeli
 * @property DetailTransaksi|null $detail_transaksi
 * @property Collection|Komisi[] $komisis
 * @property Collection|Pembayaran[] $pembayarans
 * @property Collection|Penjadwalan[] $penjadwalans
 *
 * @package App\Models
 */
class Transaksi extends Model
{
	protected $table = 'transaksi';
	protected $primaryKey = 'id_transaksi';
	public $timestamps = false;

	protected $casts = [
		'id_pembeli' => 'int',
		'tanggal_transaksi' => 'datetime',
		'total_pembayaran' => 'float'
	];

	protected $fillable = [
		'id_pembeli',
		'tanggal_transaksi',
		'total_pembayaran',
		'status_transaksi'
	];

	public function pembeli()
	{
		return $this->belongsTo(Pembeli::class, 'id_pembeli');
	}

	public function detailTransaksi()
	{
		return $this->hasMany(\App\Models\DetailTransaksi::class, 'id_transaksi');
	}

	public function komisis()
	{
		return $this->hasMany(Komisi::class, 'id_transaksi');
	}

	public function pembayarans()
	{
		return $this->hasMany(Pembayaran::class, 'id_transaksi');
	}

	// public function penjadwalans()
	// {
	// 	return $this->hasMany(Penjadwalan::class, 'id_transaksi');
	// }

	public function penjadwalans()
	{
		return $this->hasMany(Penjadwalan::class, 'id_transaksi');
	}

}
