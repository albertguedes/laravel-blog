<?php declare(strict_types=1);

namespace App\View\Components\Categories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

use App\Models\Category;

class MenuComponent extends Component
{
    public $name;
    public $current;
    public $roots;
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
        $this->roots = Category::where('parent_id',null)
                                    ->with('children')
                                    ->orderBy('title')
                                    ->get();

        $this->categories = $this->categorySelectOption($this->roots,0,$this->current);
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
     *
     * @param Collection $categories
     * @param int $level
     * @param Category $current
     *
     * @return array $list;
     */
    public function categorySelectOption(
        Collection $categories,
        int $level = 0,
        ?Category $current = null
    ): array {

        if (!$categories) {
            throw new \Exception('categories is required');
        }

        $list = [];

        if (count($categories) > 0)
        {
            foreach ($categories as $category)
            {
                $item['id'] = $category->id;
                $item['title'] = $category->title;
                $item['level'] = $level;
                $item['selected'] = ( $current && ( $category->id == $current->id ) );
                $list[] = $item;

                if($category->children){
                    $sublist = $this->categorySelectOption($category->children,$level+1,$current);
                    $list = array_merge($list, $sublist);
                }
            }
        }

        return $list;
    }
}
