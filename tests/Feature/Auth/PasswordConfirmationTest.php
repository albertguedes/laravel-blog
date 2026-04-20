<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

describe('Password Confirmation', function () {
    it('shows confirmation page when required', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/confirm-password');
        $response->assertStatus(200);
    });

    it('confirms password successfully', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);
        $response->assertRedirect('/dashboard');
    });

    it('fails with wrong password', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);
        $response->assertSessionHasErrors('password');
    });

    it('guest is redirected to login', function () {
        $response = $this->get('/confirm-password');
        $response->assertRedirect('/login');
    });
});
