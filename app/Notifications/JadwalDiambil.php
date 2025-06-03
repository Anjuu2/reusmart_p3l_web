<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JadwalDiambil extends Notification
{
    use Queueable;

    protected $jadwal;
    protected $transaksi;

    public function __construct($jadwal, $transaksi)
    {
        $this->jadwal = $jadwal;
        $this->transaksi = $transaksi;
    }

    public function via($notifiable)
    {
        return ['database']; // Channel database untuk mobile app
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Jadwal Pengambilan',
            'message' => "Jadwal untuk transaksi #{$this->transaksi->id_transaksi} telah dijadwalkan pada tanggal {$this->jadwal->tanggal_jadwal}.",
            'id_transaksi' => $this->transaksi->id_transaksi,
            'tanggal_jadwal' => $this->jadwal->tanggal_jadwal,
        ];
    }
}
