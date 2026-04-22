<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Category dropdown menu component.
 *
 * Generates a hierarchical select option list of categories for forms.
 * Builds category paths showing full parent/child hierarchy.
 */
class CategoryMenu extends Component
{
    /** @var string Form input name */
    public $name;

    /** @var Category|null Currently selected category */
    public $current;

    /** @var array<int, array{id: int, title: string, path: string, selected: string}> Category options */
    public $categories;

    /**
     * Create a new component instance.
     *
     * @param  string  $name  Form input name attribute
     * @param  Category|null  $current  Currently selected category (optional)
     */
    public function __construct(string $name, ?Category $current = null)
    {
        $this->name = $name;
        $this->current = $current;

        $this->categories = $this->categorySelectOption($this->current);
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|\Closure|string
    {
        return view('components.common.category-menu');
    }

    /**
     * Build category options for select dropdown.
     *
     * Retrieves leaf categories (no children) and builds full path strings
     * showing the complete parent hierarchy. Useful for category selection in forms.
     *
     * @param  Category|null  $current  Currently selected category (optional)
     * @return array<int, array{id: int, title: string, path: string, selected: string}>
     */
    public function categorySelectOption(?Category $current = null): array
    {
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
