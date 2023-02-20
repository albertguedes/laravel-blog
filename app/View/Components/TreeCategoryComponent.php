<?php

namespace App\View\Components;

use App\Models\Category;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TreeCategoryComponent extends Component
{

    public $tree;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $roots = Category::IsActive()
                         ->where('parent_id','=',null)
                         ->with('children')
                         ->orderBy('title')
                         ->get();

        $this->tree = $this->subtree($roots,0);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tree-category-component');
    }

    public function subtree( Collection $categories, int $level ): string
    {

        $html="<ul class='category-tree-{$level}' >";
        foreach( $categories as $category ){
            $html.="<li class='category-tree-item py-2' >";
            $html.="<a class='category-tree-link text-capitalize' href='".route('category', compact('category'))."' >";
            $html.=$category->title." (".$category->posts(true)->count().")";
            $html.="</a>";
            if( $category->children->count() > 0 ){
                $html.=$this->subtree($category->children, $level+1 );
            }
            $html.="</li>";
        }
        $html.='</ul>';

        return $html;

    }

}
