<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\VerificationToken;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Login page.
     *
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Attempt to authenticate a user.
     * The credentials are validated which is provided in the LoginRequest.
     * If the user is authenticated, redirect them to the dashboard.
     * If not, redirect them to the login page with a error message.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function authenticate (LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_active'] = true;

        /**
         * This works. If code editor accuse that some method dont exists, dont believe!
         */
        if (Auth::guard('web')->attempt($validated)) {
            return redirect()->route('profile')
                                ->with('success','You are logged.');
        }

        return redirect()->route('auth.login')
                            ->with('danger','Wrong user or password.');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => false
        ]);

        $user->remember_token = Str::random(10);
        $user->save();

        $user->profile()->create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'about' => $validated['about']
        ]);

        if (!$user) {
            return redirect()->route('auth.register')
                                ->with('danger','Wasn\'t possible to register. Try again later or contact support.');
        }

        if (!AuthService::sendRegisterConfirmMessage($user)) {
            $user->delete();

            return redirect()->route('auth.register')
                                ->with('danger','Wasn\'t possible to register. Try again later or contact support.');
        }

        return redirect()->route('auth.login')
                            ->with('success','You are registered. An email was sent to confirm your account.');
    }

    public function registerConfirm($token): RedirectResponse
    {
        $verifyToken = VerificationToken::where('token', $token)->first();

        if (is_null($verifyToken)) {
            return redirect()->route('auth.register')
                                ->with('danger','Invalid token.');
        }

        $user = User::where('email', $verifyToken->email)->first();

        if (is_null($user)) {
            return redirect()->route('auth.register')
                                ->with('danger','User not found.');
        }

        $role = Role::where('title', 'user')->first();
        $user->roles()->attach($role);
        $user->is_active = true;
        $user->save();

        $verifyToken->delete();

        return redirect()->route('auth.login')
                            ->with('success','You are registered. You can login now.');
    }

    public function passwordForget(): View
    {
        return view('auth.password-forget');
    }

    public function passwordForgetUpdate(PasswordRequest $request): RedirectResponse
    {
        if (!$request->hasValidToken()) {
            return redirect()->route('auth.password.forget')
                                ->with('danger','Invalid token.');
        }

        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (is_null($user)) {
            return redirect()->route('auth.password.forget')
                                ->with('danger','User not found.');
        }

        $user->sendPasswordResetNotification();

        return redirect()->route('auth.password.forget')
                            ->with('success','Password reset instructions sent.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login')
                            ->with('success','You are logged out.');
    }
}
