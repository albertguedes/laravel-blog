<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

describe('Registration', function () {
    beforeEach(function () {
        Mail::fake();
    });

    it('shows registration page', function () {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    });

    it('registers a new user with valid data', function () {
        $email = 'test_'.uniqid().'@example.com';
        $username = 'testuser_'.uniqid();

        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'username' => $username,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', ['email' => $email]);
        $this->assertDatabaseHas('profiles', ['username' => $username]);
    });

    it('fails registration with invalid email', function () {
        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'username' => 'testuser_'.uniqid(),
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
    });

    it('fails registration when password mismatch', function () {
        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'username' => 'testuser_'.uniqid(),
            'email' => 'test_'.uniqid().'@example.com',
            'password' => 'password',
            'password_confirmation' => 'different-password',
        ]);
        $response->assertSessionHasErrors('password');
    });

    it('fails registration with duplicate email', function () {
        $existingEmail = 'existing_'.uniqid().'@example.com';
        User::factory()->create(['email' => $existingEmail]);
        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'username' => 'testuser_'.uniqid(),
            'email' => $existingEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
    });
});
