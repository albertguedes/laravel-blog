<?php

namespace App\View\Components\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Profile navigation tabs component.
 *
 * Renders horizontal navigation tabs for profile section pages.
 * Automatically highlights the current active route.
 */
class ProfileTabs extends Component
{
    /** @var array<string, array{route: string, label: string, icon: string, active: bool}> Tab items */
    public array $items;

    /**
     * Create a new component instance.
     *
     * Builds the tabs array, determining active state based on current route.
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

            'edit' => [
                'route' => 'profile.edit',
                'label' => 'Edit',
                'icon' => 'fa fa-user-edit',
                'active' => $current_route == 'profile.edit',
            ],

            'password' => [
                'route' => 'profile.password',
                'label' => 'Change Password',
                'icon' => 'fa fa-key',
                'active' => $current_route == 'profile.password',
            ],

            'cancel' => [
                'route' => 'profile.delete',
                'label' => 'Cancel Account',
                'icon' => 'fa fa-user-times',
                'active' => $current_route == 'profile.delete',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.profile-tabs');
    }
}
