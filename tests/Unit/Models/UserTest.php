<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Models\VerificationToken;

describe('User Model', function () {
    it('can be created with factory', function () {
        $user = User::factory()->create();
        expect($user)->toBeInstanceOf(User::class);
    });

    it('has profile relationship', function () {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        expect($user->profile)->toBeInstanceOf(Profile::class);
    });

    it('has many posts', function () {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);
        expect($user->posts->first())->toBeInstanceOf(Post::class);
    });

    it('has many roles', function () {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->roles()->attach($role->id);
        expect($user->roles->first())->toBeInstanceOf(Role::class);
    });

    it('can check if email is verified', function () {
        $user = User::factory()->create(['email_verified_at' => null]);
        expect($user->isEmailVerified())->toBeFalse();
        $user->email_verified_at = now();
        expect($user->isEmailVerified())->toBeTrue();
    });

    it('has verification token relationship', function () {
        $user = User::factory()->create();
        VerificationToken::factory()->forUser($user)->create();
        expect($user->verificationToken)->toBeInstanceOf(VerificationToken::class);
    });

    it('hides password and remember_token in array', function () {
        $user = User::factory()->create();
        $array = $user->toArray();
        expect($array)->not->toHaveKey('password');
        expect($array)->not->toHaveKey('remember_token');
    });

    it('is_active cast is boolean', function () {
        $user = User::factory()->create(['is_active' => true]);
        expect($user->is_active)->toBeTrue();
    });
});
