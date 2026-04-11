<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PharmacyTestAlert extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $title,
        private readonly string $message,
        private readonly string $severity = 'medium',
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return list<string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('[Healora Pharmacy Alert] '.$this->title)
            ->greeting('Hello Pharmacy Team,')
            ->line('A test notification was sent from Healora.')
            ->line('Severity: '.strtoupper($this->severity))
            ->line('Message: '.$this->message)
            ->line('Please verify delivery and response workflow.');
    }
}
