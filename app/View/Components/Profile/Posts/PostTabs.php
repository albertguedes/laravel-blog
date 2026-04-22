<?php

declare(strict_types=1);

namespace App\View\Components\Profile\Posts;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Post management tabs component.
 *
 * Renders navigation tabs for post management pages (list, show, edit, delete).
 * Automatically highlights the current active route.
 */
class PostTabs extends Component
{
    /** @var array<string, array{label: string, icon: string, route: string, active: bool}> Tab items */
    public array $tabs;

    /**
     * Create a new component instance.
     *
     * @param  Post|null  $post  Post to operate on (used for show/edit/delete routes)
     */
    public function __construct(?Post $post)
    {
        $this->tabs = [

            'list' => [
                'label' => 'List',
                'icon' => 'fa fa-list',
                'route' => route('profile.posts'),
                'active' => request()->routeIs('profile.posts'),
            ],

            'show' => [
                'label' => 'Show',
                'icon' => 'fa fa-eye',
                'route' => route('profile.post', compact('post')),
                'active' => request()->routeIs('profile.post'),
            ],

            'edit' => [
                'label' => 'Edit',
                'icon' => 'fa fa-edit',
                'route' => route('profile.post.edit', compact('post')),
                'active' => request()->routeIs('profile.post.edit'),
            ],

            'delete' => [
                'label' => 'Delete',
                'icon' => 'fa fa-trash',
                'route' => route('profile.post.delete', compact('post')),
                'active' => request()->routeIs('profile.post.delete'),
            ],
        ];
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.posts.post-tabs');
    }
}
