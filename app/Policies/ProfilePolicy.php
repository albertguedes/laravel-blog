<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;

/**
 * Policy for Profile model authorization.
 *
 * This policy denies all profile-related operations as profiles are
 * managed directly through the User model and profile controller.
 */
class ProfilePolicy
{
    /**
     * Determine whether the user can view any profiles.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view a profile.
     */
    public function view(User $user, Profile $profile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create profiles.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update a profile.
     */
    public function update(User $user, Profile $profile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete a profile.
     */
    public function delete(User $user, Profile $profile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore a profile.
     */
    public function restore(User $user, Profile $profile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete a profile.
     */
    public function forceDelete(User $user, Profile $profile): bool
    {
        return false;
    }
}
