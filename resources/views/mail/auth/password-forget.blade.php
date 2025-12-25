<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ env('APP_NAME') }}</title>
    </head>
    <body>

        <p>Your are receiving this email because we received a password reset
            request for your account.</p>

        <p>If you did not request a password reset, no further action is
            required.</p>

        <p>If you request a password reset, you may reset your password by clicking
            the button below:</p>

        <p>
            <a href="{{ route('auth.password.forget.update', $token) }}" >Reset Password</a>
        </p>

    </body>
</html>
