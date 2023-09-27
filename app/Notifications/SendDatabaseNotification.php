<?php

namespace App\Notifications;

use App\Models\Scheduler;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendDatabaseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new message instance.
     *
     * @param Scheduler $scheduler
     */
    public function __construct(protected Scheduler $scheduler)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'channel' => $this->scheduler->channel,
            'message' => $this->scheduler->message,
            'time' => $this->scheduler->time,
        ];
    }
}
