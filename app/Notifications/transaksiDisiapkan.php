<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue; // optional untuk queue
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Transaksi;
use App\Models\Pembeli;

class transaksiDisiapkan extends Notification implements ShouldQueue
{
    use Queueable;

    protected $transaksi;
    protected $pembeli;

    /**
     * Create a new notification instance.
     */
    public function __construct(Transaksi $transaksi, Pembeli $pembeli)
    {
        $this->transaksi = $transaksi;
        $this->pembeli = $pembeli;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail']; // Kirim via email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Status Transaksi Anda: Disiapkan')
                    ->greeting('Halo ' . ($this->pembeli->nama_pembeli ?? 'Pelanggan') . ',')
                    ->line('Bukti aembayaran Anda dengan ID transaksi #' . $this->transaksi->id_transaksi . ' telaj diverifikasi.')
                    ->line('Terima kasih telah berbelanja di ReUseMart!')
                    // ->action('Lihat Transaksi', url('/transaksi/' . $this->transaksi->id_transaksi))
                    ->line('Jika ada pertanyaan, jangan ragu menghubungi kami.');
    }
}
