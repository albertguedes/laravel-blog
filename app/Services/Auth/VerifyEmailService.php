<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Mail\Auth\VerifyEmailMessage;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Service for handling email verification operations.
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 * @see VerificationToken
 * @see VerifyEmailMessage
 */
class VerifyEmailService
{
    /**
     * Send a verification email to the given user.
     *
     * Creates a new verification token for the user and sends
     * a verification email with a link containing the token.
     *
     * @param  User  $user  The user to send verification email to
     * @param  string|null  $name  Optional name override for the email
     *
     * @since 1.0.0
     *
     * @example
     * VerifyEmailService::sendVerificationEmail($user);
     * VerifyEmailService::sendVerificationEmail($user, 'John Doe');
     */
    public static function sendVerificationEmail(User $user, ?string $name = null): void
    {
        if ($user->verificationToken()->exists()) {
            $user->verificationToken()->delete();
        }

        $verificationToken = VerificationToken::create([
            'email' => $user->email,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(1),
        ]);

        $profileName = $name ?? optional($user->profile)->name ?? 'User';

        $data = [
            'name' => $profileName,
            'url' => route('verify-email', [
                'token' => $verificationToken->token,
            ]),
        ];

        try {
            $message = new VerifyEmailMessage($data);
            Mail::to($user->email)->send($message);
        } catch (\Exception $e) {
        }
    }
}
