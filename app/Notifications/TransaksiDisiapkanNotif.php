<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Transaksi;
use Illuminate\Support\Collection;

class TransaksiDisiapkanNotif extends Notification
{
    use Queueable;

    protected $transaksi;
    protected $penitip;
    protected $barangList;

    public function __construct(Transaksi $transaksi, $penitip, Collection $barangList)
    {
        $this->transaksi = $transaksi;
        $this->penitip = $penitip;
        $this->barangList = $barangList;
    }

    public function via($notifiable)
    {
        return ['database']; // Bisa ditambah 'mail' kalau mau email juga
    }

    public function toDatabase($notifiable)
    {
        $barangNames = $this->barangList->join(', ');
        return [
            'message' => "Pembayaran transaksi #{$this->transaksi->id_transaksi} telah diverifikasi. Barang Anda ($barangNames) sedang disiapkan untuk dikirim/diambil.",
            'id_transaksi' => $this->transaksi->id_transaksi,
            'barang' => $this->barangList,
            'status_transaksi' => $this->transaksi->status_transaksi,
        ];
    }

    // Jika mau email, bisa tambahkan toMail()
}
