<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryForm extends Component
{
    public string $action;

    public string $method;

    public Category $category;

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

    public function render(): View|\Closure|string
    {
        return view('components.common.category-form');
    }
}
