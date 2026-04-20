<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;

describe('Middleware', function () {
    it('guest cannot access profile', function () {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
    });

    it('guest cannot access password update', function () {
        $response = $this->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertRedirect('/login');
    });

    it('authenticated user can access profile', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    });

    it('admin middleware blocks non-admin users', function () {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(403);
    });

    it('admin user can access admin routes', function () {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
    });

    it('verified email required for profile', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertRedirect('/verify-email/resend');
    });

    it('unverified user can still access non-profile routes', function () {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    });
});
