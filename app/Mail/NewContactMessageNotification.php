<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    // Non chiamarla $message: nelle viste email è riservata a Illuminate\Mail\Message
    public function __construct(public ContactMessage $contactMessage)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nuovo messaggio da {$this->contactMessage->name} - ASCAI Bologna",
            // "Rispondi" nel client email risponde direttamente a chi ha scritto
            replyTo: [new Address($this->contactMessage->email, $this->contactMessage->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-contact-message',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
