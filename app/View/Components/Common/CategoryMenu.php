<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryMenu extends Component
{
    public $name;

    public $current;

    public $categories;

    public function __construct(string $name, ?Category $current = null)
    {
        $this->name = $name;
        $this->current = $current;

        $this->categories = $this->categorySelectOption($this->current);
    }

    public function render(): View|\Closure|string
    {
        return view('components.common.category-menu');
    }

    public function categorySelectOption(
        ?Category $current = null
    ): array {
        $roots = Category::doesntHave('children')
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        foreach ($roots as $root) {
            $path = '';
            $parent = $root->parent;
            while (! is_null($parent)) {
                if ($parent->is_active) {
                    $path = $parent->title.' / '.$path;
                }
                $parent = $parent->parent;
            }

            $options[] = [
                'id' => $root->id,
                'title' => $root->title,
                'path' => $path,
                'selected' => (! is_null($current)) ? ($root->id == $current->id) : '',
            ];
        }

        usort($options, function ($a, $b) {
            return strcmp($a['path'], $b['path']);
        });

        return $options;
    }
}
