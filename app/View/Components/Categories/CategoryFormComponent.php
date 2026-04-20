<?php

declare(strict_types=1);

namespace App\View\Components\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryFormComponent extends Component
{
    public string $action;

    public string $method;

    public Category $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $action, string $method, Category $category)
    {
        if (! $action) {
            throw new \Exception('action is required');
        }

        if (! $method) {
            throw new \Exception('method is required');
        }

        if (! $category) {
            throw new \Exception('category is required');
        }

        $this->action = $action;
        $this->method = $method;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.categories\category-form-component');
    }
}
