<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Contact] '.$this->data['subject'],
            replyTo: $this->data['email'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contact',
            with: ['data' => $this->data],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}