<?php

namespace App\Mail;

use App\Models\Message as MessageModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public MessageModel $contactMessage,
        public string $otp
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Verification Code — Paul Albert Mina Portfolio',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-message',
        );
    }
}