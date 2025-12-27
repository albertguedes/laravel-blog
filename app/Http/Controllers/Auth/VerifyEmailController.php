<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\VerificationToken;
use App\Services\Auth\VerifyEmailService;

class VerifyEmailController extends Controller
{
    /**
     * Verify user email using token.
     *
     * @param string $token
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(string $token): RedirectResponse
    {
        $verificationToken = VerificationToken::where('token', $token)->first();

        // Redirect to login page if token is not found
        if (is_null($verificationToken)) {
            return redirect()->route('register.verify-email.resend', [ 'resend' => true ])
                            ->with('danger', 'Invalid Token. Please try again.');
        }

        // Redirect to resend verification email page if token is expired.
        if ($verificationToken->isExpired()) {
            return redirect()->route('register.verify-email.resend', [ 'resend' => true ])
                            ->with('danger', 'Token Expired. Please try again.');
        }

        // If token is valid and not expired, mark the user as verified
        $user = $verificationToken->user;
        $user->email_verified_at = now();
        $user->is_active = true;
        $user->save();

        // Delete the verification token, as its not needed anymore.
        $verificationToken->delete();

        return redirect()->route('login')
                            ->with('success', 'Email verified successfully. You can now log in.');
    }

    /**
     * Render the resend verification email view.
     *
     * @param string $email
     * @return View
     */
    public function edit(Request $request): View
    {
        if ($request->has('resend')) {
            return view('auth.resend-verify-email');
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    /**
     * Resend verification email to the given email address.
     *
     * This method will update the verification token and send a new verification email
     * to the given email address.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $validated = $request->validate([
            'email' => "required|string|min:5|max:255|email:rfc",
        ]);

        $user = User::where('email', $validated['email'])->first();

        VerifyEmailService::sendVerificationEmail($user);
    }
}
