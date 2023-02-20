<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TabsComponent extends Component
{

    // Route resource prefix.
    public $prefix;

    // The model to be used.
    public $model;

    // The tabs routes.
    public $routes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $prefix, $model)
    {

        $this->prefix = $prefix;

        $this->model = $model;

        $this->routes = $this->getRoutes($prefix,$model);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tabs-component');
    }

    protected function getRoutes($prefix,$model){

        $model_name = strtolower(class_basename($model));

        $commands = [ 'show', 'edit', 'delete' ];

        return array_map(function ($command) use ($prefix,$model_name,$model){
            return [
                'url'  => route($prefix.'.'.$command, [ $model_name => $model ] ),
                'name' => ucwords($command),
            ];
        } , $commands);

    }

}
