<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Mail\Auth\PasswordForgotMessage;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Service for handling password reset operations.
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 * @see VerificationToken
 * @see PasswordForgotMessage
 */
class PasswordForgotService
{
    /**
     * Send a password reset email to the given user.
     *
     * Creates a new verification token for the user and sends
     * a password reset email with a link containing the token.
     *
     * @param  User  $user  The user to send password reset email to
     *
     * @since 1.0.0
     *
     * @example
     * PasswordForgotService::sendPasswordForgotEmail($user);
     */
    public static function sendPasswordForgotEmail(User $user): void
    {
        if ($user->verificationToken()->exists()) {
            $user->verificationToken()->delete();
        }

        $verificationToken = VerificationToken::create([
            'email' => $user->email,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(1),
        ]);

        $profileName = optional($user->profile)->name ?? 'User';

        $data = [
            'name' => $profileName,
            'url' => route('password.reset', [
                'token' => $verificationToken->token,
            ]),
        ];

        try {
            $message = new PasswordForgotMessage($data);
            Mail::to($user->email)->send($message);
        } catch (\Exception $e) {
        }
    }

    /**
     * Reset user password using verification token.
     *
     * @param  string  $token  The verification token
     * @param  string  $password  The new password
     * @return bool True on success, false on failure
     *
     * @since 1.0.0
     */
    public static function resetPassword(string $token, string $password): bool
    {
        try {
            $verificationToken = VerificationToken::where('token', $token)->first();

            $user = $verificationToken->user;
            $user->password = bcrypt($password);
            $user->save();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
