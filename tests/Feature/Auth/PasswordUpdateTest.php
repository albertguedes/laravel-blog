<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

describe('Password Update', function () {
    it('authenticated user can update password', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->put(route('profile.password.update'), [
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertSessionDoesntHaveErrors();
    });

    it('fails when password confirmation mismatch', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->put(route('profile.password.update'), [
            'password' => 'new-password',
            'password_confirmation' => 'different-password',
        ]);
        $response->assertSessionHasErrors('password');
    });

    it('guest cannot update password', function () {
        $response = $this->put(route('profile.password.update'), [
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertRedirect(route('login'));
    });
});
