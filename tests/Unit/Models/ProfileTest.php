<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Profile;
use App\Models\User;

describe('Profile Model', function () {
    it('can be created with factory', function () {
        $profile = Profile::factory()->create();
        expect($profile)->toBeInstanceOf(Profile::class);
    });

    it('belongs to a user', function () {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        expect($profile->user)->toBeInstanceOf(User::class);
        expect($profile->user->id)->toBe($user->id);
    });

    it('has correct fillable attributes', function () {
        $profile = Profile::factory()->make();
        expect($profile->fillable)->toContain('user_id', 'name', 'username', 'about');
    });

    it('user_id is cast to integer', function () {
        $profile = Profile::factory()->create(['user_id' => 1]);
        expect($profile->user_id)->toBeInt();
    });

    it('can have about text', function () {
        $profile = Profile::factory()->create(['about' => 'This is my bio']);
        expect($profile->about)->toBe('This is my bio');
    });
});
