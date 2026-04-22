<?php

declare(strict_types=1);

namespace App\View\Components\Profile;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * User profile display component.
 *
 * Renders the user's profile information including avatar placeholder,
 * name, username, and bio/about text.
 */
class UserProfile extends Component
{
    /** @var User The user whose profile to display */
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
        return view('components.profile.user-profile');
    }
}
