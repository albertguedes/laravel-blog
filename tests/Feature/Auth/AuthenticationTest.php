<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

describe('Authentication', function () {
    beforeEach(function () {
        \Artisan::call('migrate');
    });

    it('shows login page', function () {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    });

    it('logs in with valid credentials', function () {
        $user = User::factory()->create();
        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect(route('profile'));
        $this->assertAuthenticatedAs($user);
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
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('profile'));
        $response->assertStatus(200);
    });
});
