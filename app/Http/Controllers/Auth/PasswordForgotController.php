<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationToken;
use App\Services\Auth\PasswordForgotService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordForgotController extends Controller
{
    /**
     * Show the form for requesting a password reset link via email.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('auth.password-forgot');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the password reset form for the given token.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $token): View
    {
        if (VerificationToken::where('token', $token)->exists()) {
            return view('auth.password-reset', compact('token'));
        }

        abort(Response::HTTP_FORBIDDEN, 'This password reset token is invalid.');
    }

    /**
     * Reset the given user's password.
     *
     * @param  string  $token
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
