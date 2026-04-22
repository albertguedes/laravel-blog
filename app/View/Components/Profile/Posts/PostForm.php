<?php

declare(strict_types=1);

namespace App\View\Components\Profile\Posts;

use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\View\View;

class PostForm extends Component
{
    public string $action;

    public string $method;

    public ?Post $post;

    public function __construct(string $action, string $method, ?Post $post = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->post = $post;
    }

    public function render(): View
    {
        return view('components.profile.posts.post-form');
    }
}
