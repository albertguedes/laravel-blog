<?php

namespace App\View\Components\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Password change form component.
 *
 * Renders a form for users to change their password,
 * requiring current password confirmation.
 */
class PasswordForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.password-form');
    }
}
