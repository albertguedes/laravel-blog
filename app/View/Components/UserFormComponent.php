<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserFormComponent extends Component
{

    public $user;

    public $action;

    public $method;



    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user,$action,$method)
    {
        $this->user    = $user;
        $this->action  = $action;
        $this->method  = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-form-component');
    }

}
