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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$current)
    {
        $this->name = $name;
        $this->current = $current;
        $this->roots = Category::where('parent_id',null)
                               ->with('children')
                               ->orderBy('title')
                               ->get();
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
     *
     * @return string $html;
     */
    public function category_select_option( Collection $categories, int $level, Category $current = null ): string {

        $html='';
        if( count($categories) > 0 ){
            foreach ($categories as $category) {

                $selected = ( $current && $category->id == $current->parent_id) ? "selected='selected'" : "";

                $html.="<option value='{$category->id}' {$selected} >".str_repeat('-',$level).$category->title."</option>";
                if($category->children){
                    $html.=$this->category_select_option($category->children,$level+1,$current);
                }

            }
        }

        return $html;

    }

}
