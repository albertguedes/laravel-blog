<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * This method attempts to validate and authenticate the user
     * via the given credentials. If authentication was successful,
     * the user is redirected to the profile page. If the authentication
     * failed, the user is redirected back to the login page with
     * the appropriate error messages.
     *
     * @param  LoginRequest  $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $remember = isset($validated['remember']);

        if (auth()->attempt($credentials, $remember)) {
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect()->route('register.verify-email.resend')
                    ->with('danger', 'Email not verified. Please check your email for verification.');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('profile'))
                ->with('success', 'You have been logged in.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                        ->with('success', 'You have been logged out.');
    }
}
