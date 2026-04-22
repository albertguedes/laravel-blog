<?php

declare(strict_types=1);

namespace App\View\Components\Layouts\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideMenu extends Component
{
    public array $items;

    public function __construct()
    {
        $current_route = request()->route()->getName();

        $this->items = [
            'profile' => [
                'route' => 'profile',
                'label' => 'Profile',
                'icon' => 'fa fa-user-circle',
                'active' => $current_route == 'profile',
            ],

            'edit' => [
                'route' => 'profile.edit',
                'label' => 'Edit',
                'icon' => 'fa fa-user-edit',
                'active' => $current_route == 'profile.edit',
            ],

            'password' => [
                'route' => 'profile.password',
                'label' => 'Password',
                'icon' => 'fa fa-key',
                'active' => $current_route == 'profile.password',
            ],

            'posts' => [
                'route' => 'profile.posts',
                'label' => 'Posts',
                'icon' => 'fa fa-newspaper',
                'active' => $current_route == 'profile.posts',
            ],
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.layouts.profile.side-menu');
    }
}
