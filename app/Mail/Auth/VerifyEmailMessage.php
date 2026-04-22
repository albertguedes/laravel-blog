<?php

declare(strict_types=1);

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email verification mailable.
 *
 * Sends an email to new users with a verification link to confirm
 * their email address and activate their account.
 *
 * @property-read array $data Verification data (name, url)
 */
class VerifyEmailMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param  array  $data  Verification data with name and url keys
     */
    public function __construct(protected array $data) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Email Request- '.env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.auth.verify-email',
            with: [
                'name' => $this->data['name'],
                'url' => $this->data['url'],
            ],
        );
    }
}
