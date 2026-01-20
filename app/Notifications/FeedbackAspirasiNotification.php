<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FeedbackAspirasiNotification extends Notification
{
    use Queueable;

    protected $aspirasi;

    /**
     * Create a new notification instance.
     */
    public function __construct($aspirasi)
    {
        $this->aspirasi = $aspirasi;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'aspirasi_id' => $this->aspirasi->id,
            'judul' => 'Feedback dari Admin',
            'pesan' => 'Admin telah memberikan feedback pada aspirasi Anda.',
        ];
    }
}
