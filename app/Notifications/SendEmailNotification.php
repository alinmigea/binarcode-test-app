<?php

namespace App\Notifications;

use App\Models\Scheduler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class SendEmailNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Scheduler $scheduler
     */
    public function __construct(protected Scheduler $scheduler)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have a message:')
            ->line($this->scheduler->message)
            ->action('Scheduler Id', url('/reminders/' . $this->scheduler->id))
            ->line('Thank you for using our application!');
            //->onQueue('emails');
    }
}
