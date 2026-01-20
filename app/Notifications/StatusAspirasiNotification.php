<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusAspirasiNotification extends Notification
{
    use Queueable;

    protected $aspirasi;
    protected $statusLama;
    protected $statusBaru;

    /**
     * Create a new notification instance.
     */
    public function __construct($aspirasi, $statusLama, $statusBaru)
    {
        $this->aspirasi = $aspirasi;
        $this->statusLama = $statusLama;
        $this->statusBaru = $statusBaru;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'aspirasi_id' => $this->aspirasi->id,
            'judul' => 'Perubahan Status Aspirasi',
            'pesan' => "Status aspirasi berubah dari {$this->statusLama} ke {$this->statusBaru}",
        ];
    }
}
