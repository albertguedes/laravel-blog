<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Role;
use App\Models\User;

describe('Role Model', function () {
    it('can be created with factory', function () {
        $role = Role::factory()->create();
        expect($role)->toBeInstanceOf(Role::class);
    });

    it('has many users', function () {
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $user->roles()->attach($role->id);
        expect($role->users->first())->toBeInstanceOf(User::class);
    });

    it('has correct fillable attributes', function () {
        $role = new Role;
        expect(in_array('title', $role->getFillable()))->toBeTrue();
        expect(in_array('description', $role->getFillable()))->toBeTrue();
        expect(in_array('is_active', $role->getFillable()))->toBeTrue();
    });

    it('is_active cast is boolean', function () {
        $role = Role::factory()->create(['is_active' => true]);
        expect($role->is_active)->toBeTrue();
    });

    it('can have description', function () {
        $role = Role::factory()->create(['description' => 'Admin role']);
        expect($role->description)->toBe('Admin role');
    });
});
