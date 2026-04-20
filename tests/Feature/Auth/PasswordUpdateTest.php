<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;

describe('Password Update', function () {
    it('authenticated user can update password', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertSessionDoesntHaveErrors();
    });

    it('fails with wrong current password', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->put('/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertSessionHasErrors('current_password');
    });

    it('fails when password confirmation mismatch', function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'different-password',
        ]);
        $response->assertSessionHasErrors('password');
    });

    it('guest cannot update password', function () {
        $response = $this->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
        $response->assertRedirect('/login');
    });
});
