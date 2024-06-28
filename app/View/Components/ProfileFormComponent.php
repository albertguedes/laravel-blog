<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileFormComponent extends Component
{

    public $profile;

    public $action;

    public $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($profile,$action,$method)
    {
        $this->profile = $profile;
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
        return view('components.profile-form-component');
    }

}
