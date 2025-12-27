<?php declare(strict_types=1);

namespace App\Services\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\Auth\VerifyEmailMessage;
use App\Models\User;
use App\Models\VerificationToken;

class VerifyEmailService
{
    /**
     * Send a verification email to the given user.
     *
     * This method will create a new verification token and send a verification email
     * to the given user.
     *
     * @param User $user
     * @return void
     */
    public static function sendVerificationEmail(User $user): void
    {
        if($user->verificationToken()->exists()) {
            $user->verificationToken()->delete();
        }

        $verificationToken = VerificationToken::create([
            'email' => $user->email,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(1)
        ]);

        $data = [
            'name' => $user->profile->name,
            'url' => route('verify-email', [
                'token' => $verificationToken->token
            ])
        ];

        $message = new VerifyEmailMessage($data);

        Mail::to($user->email)->send($message);
    }
}
