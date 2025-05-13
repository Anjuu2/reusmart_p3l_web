<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengiriman
 * 
 * @property int $id_pengiriman
 * @property int|null $Id_pegawai
 * @property int $id_jadwal
 * @property string $status_pengiriman
 * 
 * @property Penjadwalan $penjadwalan
 * @property Pegawai|null $pegawai
 *
 * @package App\Models
 */
class Pengiriman extends Model
{
	protected $table = 'pengiriman';
	protected $primaryKey = 'id_pengiriman';
	public $timestamps = false;

	protected $casts = [
		'Id_pegawai' => 'int',
		'id_jadwal' => 'int'
	];

	protected $fillable = [
		'Id_pegawai',
		'id_jadwal',
		'status_pengiriman'
	];

	public function penjadwalan()
	{
		return $this->belongsTo(Penjadwalan::class, 'id_jadwal');
	}

	public function pegawai()
	{
		return $this->belongsTo(Pegawai::class, 'Id_pegawai');
	}
}
