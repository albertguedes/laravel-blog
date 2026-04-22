<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Contact form email mailable.
 *
 * Sends an email notification when a visitor submits the contact form.
 * Includes the sender's name, email, subject, and message body.
 *
 * @property-read array $mail Mail data (name, email, subject, message)
 */
class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /** @var array Mail data including name, email, subject, and message */
    protected array $mail;

    /**
     * Create a new message instance.
     *
     * @param  array  $mail  Mail data array with name, email, subject, message keys
     */
    public function __construct(array $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mail['subject'].' - '.env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact.contact',
            with: ['mail' => $this->mail],
        );
    }
}
