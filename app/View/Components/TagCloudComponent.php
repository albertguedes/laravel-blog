<?php

namespace App\View\Components;

use App\Models\Tag;
use Illuminate\View\Component;

class TagCloudComponent extends Component
{

    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tags = Tag::IsActive()->orderBy('title')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tag-cloud-component');
    }
}
