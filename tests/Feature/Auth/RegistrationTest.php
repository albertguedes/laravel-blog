<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

describe('Registration', function () {
    it('shows registration page', function () {
        $response = $this->get('/register');
        $response->assertStatus(200);
    });

    it('registers a new user with valid data', function () {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    });

    it('fails registration with invalid email', function () {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
    });

    it('fails registration when password mismatch', function () {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different-password',
        ]);
        $response->assertSessionHasErrors('password');
    });

    it('fails registration with duplicate email', function () {
        User::factory()->create(['email' => 'existing@example.com']);
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'existing@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
    });
});
