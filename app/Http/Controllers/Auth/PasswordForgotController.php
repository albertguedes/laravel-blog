<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationToken;
use App\Services\Auth\PasswordForgotService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Controller handling password reset requests.
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 * @see PasswordForgotService
 * @see VerificationToken
 */
class PasswordForgotController extends Controller
{
    /**
     * Display the password reset request form.
     *
     * @return View The password forgot view
     *
     * @since 1.0.0
     */
    public function index(): View
    {
        return view('auth.password-forgot');
    }

    /**
     * Store a password reset request.
     *
     * Validates the email, finds the user, and sends a password reset email
     * with a verification token.
     *
     * @param  Request  $request  The HTTP request containing email field
     * @return RedirectResponse Redirects to login with success or danger message
     *
     * @since 1.0.0
     * @see PasswordForgotService::sendPasswordForgotEmail()
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|string|min:5|max:255|email:rfc',
        ]);

        $email = $validated['email'];

        $user = User::where('email', $email)->first();

        if ($user) {
            PasswordForgotService::sendPasswordForgotEmail($user);

            return redirect()->route('login')
                ->with('success', 'We have e-mailed your password reset link!');
        }

        return redirect()->route('login')->with('danger', 'We can\'t find a user with that e-mail address.');
    }

    /**
     * Display the password reset form with the given token.
     *
     * @param  string  $token  The verification token from the URL
     * @return View|Response The password reset view or abort with 403
     *
     * @since 1.0.0
     */
    public function edit(string $token): View
    {
        if (VerificationToken::where('token', $token)->exists()) {
            return view('auth.password-reset', compact('token'));
        }

        abort(Response::HTTP_FORBIDDEN, 'This password reset token is invalid.');
    }

    /**
     * Reset the user's password.
     *
     * Validates the password and token, updates the user's password,
     * and deletes the verification token.
     *
     * @param  Request  $request  The HTTP request containing password, password_confirmation, and token
     * @return RedirectResponse Redirects to login with success message or aborts
     *
     * @since 1.0.0
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string',
        ]);

        $password = $validated['password'];
        $token = $validated['token'];

        if (VerificationToken::where('token', $token)->exists()) {

            $verifyToken = VerificationToken::where('token', $token)->first();

            $user = $verifyToken->user;
            $user->password = bcrypt($password);
            $user->save();

            $verifyToken->delete();

            return redirect()->route('login')->with('success', 'Your password has been reset!');
        }

        abort(Response::HTTP_FORBIDDEN, 'This password reset token is invalid.');
    }
}
