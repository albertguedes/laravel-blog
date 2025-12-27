<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Services\Auth\VerifyEmailService;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create([
                'email' => $validated['email'],
                'password' => $validated['password']
            ]);

            $user->roles()->attach([
                Role::where([ 'title' => 'guest' ])->first(),
                Role::where([ 'title' => 'user' ])->first()
            ]);

            $profile = Profile::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'username' => $validated['username'],
                'about' => $validated['about']
            ]);

            VerifyEmailService::sendVerificationEmail($user);

            return redirect()->route('login')
                                ->with('success', 'Registration successful. Please check your email for verification.');

        } catch (\Exception $e) {

            $user = User::where([ 'email' => $validated['email'] ])->first();

            if ($user) {
                $user->roles()->detach();
                $user->profile()->delete();
                $user->delete();
            }

            return back()->with('danger', 'Registration failed. Please try again.');
        }
    }
}
