<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationToken;
use App\Services\Auth\VerifyEmailService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller handling email verification operations.
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 * @see VerifyEmailService
 * @see VerificationToken
 */
class VerifyEmailController extends Controller
{
    /**
     * Verify user email using token.
     *
     * Validates the verification token and marks the user's email as verified.
     * If token is invalid or expired, redirects back with error message.
     *
     * @param  string  $token  The verification token from the URL
     * @return RedirectResponse Redirects to login on success, or back with error
     *
     * @throws AuthorizationException Never thrown (legacy docblock)
     *
     * @since 1.0.0
     */
    public function index(string $token): RedirectResponse
    {
        $verificationToken = VerificationToken::where('token', $token)->first();

        if (is_null($verificationToken)) {
            return redirect()->route('register.verify-email.resend', ['resend' => true])
                ->with('danger', 'Invalid Token. Please try again.');
        }

        if ($verificationToken->isExpired()) {
            return redirect()->route('register.verify-email.resend', ['resend' => true])
                ->with('danger', 'Token Expired. Please try again.');
        }

        $user = $verificationToken->user;
        $user->email_verified_at = now();
        $user->is_active = true;
        $user->save();

        $verificationToken->delete();

        return redirect()->route('login')
            ->with('success', 'Email verified successfully. You can now log in.');
    }

    /**
     * Display the resend verification email form.
     *
     * @param  Request  $request  The HTTP request
     * @return View The resend verification email view
     *
     * @since 1.0.0
     */
    public function edit(Request $request): View
    {
        return view('auth.resend-verify-email');
    }

    /**
     * Resend verification email to the given email address.
     *
     * Validates the email, finds the user, and sends a new verification email
     * with a fresh verification token.
     *
     * @param  Request  $request  The HTTP request containing email field
     *
     * @since 1.0.0
     * @see VerifyEmailService::sendVerificationEmail()
     */
    public function update(Request $request): void
    {
        $validated = $request->validate([
            'email' => 'required|string|min:5|max:255|email:rfc',
        ]);

        $user = User::where('email', $validated['email'])->first();

        VerifyEmailService::sendVerificationEmail($user);
    }
}
