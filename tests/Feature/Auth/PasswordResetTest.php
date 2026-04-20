<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Password;

describe('Password Reset', function () {
    it('shows password reset request page', function () {
        $response = $this->get('/password/forgot');
        $response->assertStatus(200);
    });

    it('shows password reset page with valid token', function () {
        $user = User::factory()->create();
        $token = Password::createToken($user);
        $response = $this->get("/password/reset/{$token}");
        $response->assertStatus(200);
    });

    it('sends password reset link with valid email', function () {
        $user = User::factory()->create();
        $response = $this->post('/password/forgot', [
            'email' => $user->email,
        ]);
        $response->assertSessionDoesntHaveErrors();
    });

    it('fails with invalid email', function () {
        $response = $this->post('/password/forgot', [
            'email' => 'nonexistent@example.com',
        ]);
        $response->assertSessionHasErrors('email');
    });
});
