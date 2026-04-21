<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;

describe('Middleware', function () {
    it('guest cannot access profile', function () {
        $response = $this->get('/profile');
        $response->assertRedirect('/auth/login');
    });

    it('guest cannot access password update', function () {
        $response = $this->put('/profile/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertRedirect('/auth/login');
    });

    it('authenticated user can access profile', function () {
        $user = User::factory()->create(['email_verified_at' => now()]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    });

    it('verified email required for profile', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertRedirect('/auth/verify-email/resend');
    });

    it('unverified user can still access non-profile routes', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    });
});
