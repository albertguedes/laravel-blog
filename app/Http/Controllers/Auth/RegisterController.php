<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Services\Auth\VerifyEmailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Controller handling user registration.
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 * @see RegisterRequest
 * @see User
 * @see Profile
 */
class RegisterController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return View The registration view
     *
     * @since 1.0.0
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle a new user registration.
     *
     * Validates the request, creates a new user with profile,
     * assigns default roles, and sends a verification email.
     *
     * @param  RegisterRequest  $request  The validated registration request
     * @return RedirectResponse Redirects to login on success, or back with error
     *
     * @since 1.0.0
     * @see RegisterRequest for validation rules
     * @see VerifyEmailService::sendVerificationEmail()
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create([
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            $guestRole = Role::where('title', 'guest')->first();
            $userRole = Role::where('title', 'user')->first();

            if ($guestRole) {
                $user->roles()->attach($guestRole);
            }
            if ($userRole) {
                $user->roles()->attach($userRole);
            }

            Profile::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'username' => $validated['username'],
                'about' => $validated['about'] ?? null,
            ]);

            try {
                VerifyEmailService::sendVerificationEmail($user, $validated['name']);
            } catch (\Exception $e) {
            }

            return redirect()->route('login')
                ->with('success', 'Registration successful. Please check your email for verification.');
        } catch (\Exception $e) {
            $user = User::where('email', $validated['email'])->first();

            if ($user) {
                $user->roles()->detach();
                $user->profile()->delete();
                $user->delete();
            }

            return back()->with('danger', 'Registration failed. Please try again.');
        }
    }
}
