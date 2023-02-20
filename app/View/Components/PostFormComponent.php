<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostFormComponent extends Component
{

    public $action;
    public $method;
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action,$method,$post)
    {
        $this->action = $action;
        $this->method = $method;
        $this->post   = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-form-component');
    }

}
