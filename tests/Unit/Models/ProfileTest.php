<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Profile;
use App\Models\User;

describe('Profile Model', function () {
    it('can be created with factory', function () {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        expect($profile)->toBeInstanceOf(Profile::class);
    });

    it('belongs to a user', function () {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        expect($profile->user)->toBeInstanceOf(User::class);
        expect($profile->user->id)->toBe($user->id);
    });

    it('has correct fillable attributes', function () {
        $profile = new Profile;
        expect(in_array('user_id', $profile->getFillable()))->toBeTrue();
        expect(in_array('name', $profile->getFillable()))->toBeTrue();
        expect(in_array('username', $profile->getFillable()))->toBeTrue();
        expect(in_array('about', $profile->getFillable()))->toBeTrue();
    });

    it('user_id is cast to integer', function () {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);
        expect($profile->user_id)->toBeInt();
    });

    it('can have about text', function () {
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id, 'about' => 'This is my bio']);
        expect($profile->about)->toBe('This is my bio');
    });
});
