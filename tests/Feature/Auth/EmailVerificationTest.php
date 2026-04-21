<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

describe('Email Verification', function () {
    beforeEach(function () {
        Mail::fake();
    });

    it('unverified user is redirected to verify email page', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('profile'));
        $response->assertRedirect(route('verify-email.resend'));
    });

    it('verified user can access profile', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('profile'));
        $response->assertStatus(200);
    });

    it('shows verification page', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('verify-email.resend'));
        $response->assertStatus(200);
    });

    it('can resend verification email', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->post(route('verify-email.resend.update'));
        $response->assertStatus(302);
    });
});
