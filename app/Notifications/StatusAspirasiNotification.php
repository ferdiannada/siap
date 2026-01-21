<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusAspirasiNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $aspirasi,
        public $statusLama,
        public $statusBaru
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'aspirasi_id' => $this->aspirasi->id,
            'judul' => 'Perubahan Status Aspirasi',
            'pesan' => "Status berubah dari {$this->statusLama} ke {$this->statusBaru}",
            'status_baru' => $this->statusBaru,
        ];
    }
}
