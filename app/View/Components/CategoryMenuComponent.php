<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CategoryMenuComponent extends Component
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
    public function __construct($name,$current)
    {
        $this->name    = $name;
        $this->current = $current;
        $this->roots = Category::where('parent_id',null)
                                 ->with('children')
                                 ->orderBy('title')
                                 ->get();

        $this->categories = $this->category_select_option($this->roots,0,$this->current);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-menu-component');
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
    public function category_select_option(
        Collection $categories,
        int $level,
        Category $current = null
    ): array {

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
                    $sublist = $this->category_select_option($category->children,$level+1,$current);
                    $list = array_merge($list, $sublist);
                }
            }
        }

        return $list;
    }
}
