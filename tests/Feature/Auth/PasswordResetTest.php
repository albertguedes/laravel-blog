<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\Profile;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

describe('Password Reset', function () {
    beforeEach(function () {
        Mail::fake();
    });

    it('shows password reset request page', function () {
        $response = $this->get(route('password'));
        $response->assertStatus(200);
    });

    it('shows password reset page with valid token', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        Profile::factory()->create(['user_id' => $user->id]);

        $token = VerificationToken::create([
            'email' => $user->email,
            'token' => 'valid-test-token-'.uniqid(),
            'expires_at' => now()->addDay(),
        ]);

        $response = $this->get(route('password.reset', ['token' => $token->token]));
        $response->assertStatus(200);
    });

    it('sends password reset link with valid email', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        Profile::factory()->create(['user_id' => $user->id]);
        $response = $this->post(route('password.store'), [
            'email' => $user->email,
        ]);
        $response->assertRedirect(route('login'));
    });

    it('fails with invalid email', function () {
        $response = $this->post(route('password.store'), [
            'email' => 'nonexistent@example.com',
        ]);
        $response->assertRedirect(route('login'));
    });
});
