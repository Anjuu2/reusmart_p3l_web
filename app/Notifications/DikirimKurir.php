<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DikirimKurir extends Notification
{
    use Queueable;

    protected $jadwal;
    protected $transaksi;
    protected $pegawai;

    public function __construct($jadwal, $transaksi, $pegawai = null)
    {
        $this->jadwal = $jadwal;
        $this->transaksi = $transaksi;
        $this->pegawai = $pegawai; // Pegawai yang mengirim barang
    }

    public function via($notifiable)
    {
        // Notifikasi via database untuk mobile app
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $namaPegawai = $this->pegawai ? $this->pegawai->nama_pegawai : 'Kurir';

        return [
            'title' => 'Status Pengiriman: Diantar',
            'message' => "Transaksi #{$this->transaksi->id_transaksi} telah Diantar oleh {$namaPegawai}. Jadwal pengiriman pada tanggal {$this->jadwal->tanggal_jadwal}.",
            'id_transaksi' => $this->transaksi->id_transaksi,
            'tanggal_jadwal' => $this->jadwal->tanggal_jadwal,
            'status_pengiriman' => 'Diantar',
            'nama_pegawai' => $namaPegawai,
        ];
    }
}
