<?php

declare(strict_types=1);

namespace App\View\Components\Layouts\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Profile section sidebar menu component.
 *
 * Renders a navigation menu for the profile section with links to
 * Profile and Posts pages. Automatically highlights the current active route.
 */
class SideMenu extends Component
{
    /** @var array<string, array{route: string, label: string, icon: string, active: bool}> */
    public array $items;

    /**
     * Create a new component instance.
     *
     * Builds the sidebar menu items array, determining the active state
     * based on the current route name.
     */
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

            'posts' => [
                'route' => 'profile.posts',
                'label' => 'Posts',
                'icon' => 'fa fa-newspaper',
                'active' => $current_route == 'profile.posts',
            ],
        ];
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.profile.side-menu');
    }
}
