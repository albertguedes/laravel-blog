<?php declare(strict_types=1);

namespace App\View\Components\Posts;

use Illuminate\View\Component;
use Illuminate\View\View;

use App\Models\Post;

class PostFormComponent extends Component
{
    public string $action;
    public string $method;
    public ?Post $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $action, string $method, ?Post $post = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        return view('components.posts.post-form-component');
    }

}
