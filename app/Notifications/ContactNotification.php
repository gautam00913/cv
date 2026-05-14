<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification
{
    use Queueable;

    public function __construct(public array $data) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'full_name' => $this->data['full_name'],
            'email' => $this->data['email'],
            'phone' => $this->data['phone'] ?? null,
            'subject' => $this->data['subject'],
            'message' => $this->data['message'],
            'type' => 'contact',
        ];
    }
}
