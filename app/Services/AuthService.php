<?php declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\RegisterConfirmMessage;
use App\Models\VerificationToken;
use App\Models\User;

class AuthService
{
    public static function sendRegisterConfirmMessage(User $user): bool
    {
        $token = Str::random(64);
        $verifyToken = VerificationToken::create([
            'email' => $user->email,
            'token' => $token,
            'expires_at' => now()->addDays(1)
        ]);

        try {
            if (!$verifyToken) {
                return false;
            }

            $data = [
                'name' => $user->profile->name,
                'url' => route('auth.register.confirm', $token)
            ];

            Mail::to($user->email)->send(new RegisterConfirmMessage($data));

            return true;
        }
        catch (\Exception $e) {
            $verifyToken->delete();

            return false;
        }
    }
}
