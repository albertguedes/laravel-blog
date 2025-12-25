<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Requests\Profile\PasswordUpdateRequest;

use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Show the user profile page.
     *
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for editing the profile information.
     *
     * @return View
     */
    public function edit(): View
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the profile information.
     *
     * @param UpdateRequest $request
     * @param Profile $profile
     * @return RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = auth()->user();
        $user->email = $validated['email'];
        $user->save();

        $user->profile->update($validated);
        $user->profile->save();

        return redirect()->route('profile')
                            ->with('success','Profile updated.');
    }

    /**
     * Return the view for password update.
     *
     * @return View
     */
    public function password(): View
    {
        return view('profile.password');
    }

    /**
     * Update the user's password.
     *
     * @param PasswordUpdateRequest $request
     * @return RedirectResponse
     */
    public function passwordUpdate(PasswordUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        auth()->user()->update([
            'password' => Hash::make($validated['password'])
        ]);

        auth()->logoutOtherDevices($validated['password']);

        return redirect()->route('profile')
                            ->with('success','Password updated.');
    }

    public function delete(): View
    {
        $user = auth()->user();
        return view('profile.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): RedirectResponse
    {
        $result = auth()->user()->delete();

        if (!$result) {
            return redirect()->route('profile.delete')
                                ->with('danger','Wasn\'t possible to delete profile. Try again later or contact support.');
        }

        auth()->logout();

        return redirect()->route('auth.logout')
                            ->with('success','Account canceled.');
    }
}
