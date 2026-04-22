<?php

declare(strict_types=1);

namespace App\View\Components\Profile\Posts;

use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Post create/edit form component.
 *
 * Renders a form for creating or editing blog posts with fields for
 * title, slug, description, content, category, tags, and publication status.
 */
class PostForm extends Component
{
    /** @var string Form action URL */
    public string $action;

    /** @var string HTTP method (POST for create, PUT for update) */
    public string $method;

    /** @var Post|null Post being edited (null for create) */
    public ?Post $post;

    /**
     * Create a new component instance.
     *
     * @param  string  $action  Form submission URL
     * @param  string  $method  HTTP method for form
     * @param  Post|null  $post  Post to edit (null for new post)
     */
    public function __construct(string $action, string $method, ?Post $post = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->post = $post;
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View
    {
        return view('components.profile.posts.post-form');
    }
}
