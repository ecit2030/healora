<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepartmentTestAlert extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $department,
        private readonly string $title,
        private readonly string $message,
        private readonly string $severity = 'medium',
    ) {}

    /**
     * @return list<string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('[Healora Notification]['.$this->department.'] '.$this->title)
            ->greeting('Hello '.$this->department.' Team,')
            ->line('A test notification was sent from Healora.')
            ->line('Severity: '.strtoupper($this->severity))
            ->line('Message: '.$this->message)
            ->line('Please verify delivery and response workflow.');
    }
}
