<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;

describe('Profile', function () {
    it('profile page is accessible for authenticated user', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    });

    it('profile information is displayed', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $response = $this->actingAs($user)->get('/profile');
        $response->assertViewHas('user');
    });

    it('profile can be updated', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'Updated Name',
            'username' => 'updatedusername',
            'about' => 'Updated bio',
        ]);
        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'name' => 'Updated Name',
        ]);
    });

    it('profile deletion requires password confirmation', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $response = $this->actingAs($user)->delete('/profile', [
            'password' => 'wrong-password',
        ]);
        $response->assertSessionHasErrors();
    });

    it('user can delete account with correct password', function () {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $response = $this->actingAs($user)->delete('/profile', [
            'password' => 'password',
        ]);
        $response->assertRedirect('/');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    });
});
