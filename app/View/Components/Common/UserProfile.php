<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserProfile extends Component
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function render(): View|Closure|string
    {
        return view('components.common.user-profile');
    }
}
