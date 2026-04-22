<?php

declare(strict_types=1);

namespace App\View\Components\Profile;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Profile edit form component.
 *
 * Renders a form for users to edit their profile information
 * including name, username, and about/bio text.
 */
class ProfileEditForm extends Component
{
    /** @var User The user whose profile to edit */
    public User $user;

    /**
     * Create a new component instance.
     *
     * @param  User  $user  The authenticated user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.profile-edit-form');
    }
}
