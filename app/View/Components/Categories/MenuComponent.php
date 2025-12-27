<?php declare(strict_types=1);

namespace App\View\Components\Categories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

use App\Models\Category;

class MenuComponent extends Component
{
    public $name;
    public $current;
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct (string $name, ?Category $current = null)
    {
        $this->name = $name;
        $this->current = $current;

        $this->categories = $this->categorySelectOption($this->current);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.categories.menu-component');
    }

    /**
     * Create option of selector and options of subcategory if exists.
     * Only categories without children can be selected.
     * Path of category is generated.
     *
     * @param Collection $categories
     * @param int $level
     * @param Category $current
     *
     * @return array $list;
     */
    public function categorySelectOption(
        ?Category $current = null
    ): array {

        // Get all categories without children.
        $roots = Category::doesntHave('children')
                        ->where('is_active', true)
                        ->orderBy('title')
                        ->get();

        foreach ($roots as $root)
        {
            $path = '';
            $parent = $root->parent;
            while (!is_null($parent)) {
                if($parent->is_active) {
                    $path = $parent->title . ' / ' . $path;
                }
                $parent = $parent->parent;
            }

            $options[] = [
                'id' => $root->id,
                'title' => $root->title,
                'path' => $path,
                'selected' => (!is_null($current)) ? ($root->id == $current->id) : '',
            ];
        }

        // Order the options by path.
        usort($options, function ($a, $b) {
            return strcmp($a['path'], $b['path']);
        });

        return $options;
    }
}
