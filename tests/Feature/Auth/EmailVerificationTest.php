<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

describe('Email Verification', function () {
    it('unverified user is redirected to verify email page', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertRedirect('/verify-email/resend');
    });

    it('verified user can access profile', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    });

    it('shows verification page', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/verify-email/resend');
        $response->assertStatus(200);
    });

    it('can resend verification email', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->post('/verify-email/resend');
        $response->assertStatus(302);
    });
});
