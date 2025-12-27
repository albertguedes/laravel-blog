<?php declare(strict_types=1);

namespace App\Services\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\Auth\PasswordForgotMessage;
use App\Models\User;
use App\Models\VerificationToken;

class PasswordForgotService
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
    public static function sendPasswordForgotEmail(User $user): void
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
            'url' => route('password.reset', [
                'token' => $verificationToken->token
            ])
        ];

        $message = new PasswordForgotMessage($data);

        Mail::to($user->email)->send($message);
    }

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
