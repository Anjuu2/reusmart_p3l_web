<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Penjadwalan;
use App\Models\Transaksi;

class JadwalDikirimNotif extends Notification
{
    use Queueable;

    protected $jadwal;
    protected $transaksi;

    public function __construct(Penjadwalan $jadwal, Transaksi $transaksi)
    {
        $this->jadwal = $jadwal;
        $this->transaksi = $transaksi;
    }

    public function via($notifiable)
    {
        return ['database']; // Bisa ditambah 'mail' atau 'broadcast'
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Jadwal pengiriman untuk transaksi #{$this->transaksi->id_transaksi} telah dijadwalkan pada {$this->jadwal->tanggal_jadwal}.",
            'id_transaksi' => $this->transaksi->id_transaksi,
            'tanggal_jadwal' => $this->jadwal->tanggal_jadwal,
        ];
    }
}
