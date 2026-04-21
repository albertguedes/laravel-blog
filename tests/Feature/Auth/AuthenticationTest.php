<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

describe('Authentication', function () {
    beforeEach(function () {
        \Artisan::call('migrate');
    });

    it('logs in with valid credentials', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'is_active' => true,
            'password' => Hash::make('password'),
        ]);
        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect(route('profile'));
        $this->assertAuthenticatedAs($user);
    });

    it('shows login page', function () {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    });

    it('fails login with invalid password', function () {
        $user = User::factory()->create();
        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        $this->assertGuest();
    });

    it('logs out successfully', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('logout'));
        $response->assertRedirect(route('login'));
        $this->assertGuest();
    });

    it('redirects guest users from protected pages', function () {
        $response = $this->get(route('profile'));
        $response->assertRedirect(route('login'));
    });

    it('authenticated user can access protected pages', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user->profile()->create([
            'name' => 'Test User',
            'username' => 'testuser',
        ]);
        $response = $this->actingAs($user)->get(route('profile'));
        $response->assertStatus(200);
    });
});
