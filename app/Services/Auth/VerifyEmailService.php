<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Mail\Auth\VerifyEmailMessage;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerifyEmailService
{
    /**
     * Send a verification email to the given user.
     *
     * This method will create a new verification token and send a verification email
     * to the given user.
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
            // Mail sending failed, but token was created
        }
    }
}
