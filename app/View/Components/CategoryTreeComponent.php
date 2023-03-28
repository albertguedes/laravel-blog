<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryTreeComponent extends Component
{

    public string $tree;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tree = self::printCategoryTree();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-tree-component');
    }

    /**
     * Generate a hierarchical tree structure of categories, including children categories
     *
     * @param Category|null $category The starting category to build the tree from
     * @return array The hierarchical tree structure of categories and their children
     */
    public static function getCategoryTree(Category $category = null, $level = 0 ): array
    {

        if( $category === null ){

            $categories = Category::whereNull('parent_id')
                                  ->isActive()
                                  ->with('children')
                                  ->orderBy('title')
                                  ->get();

            foreach($categories as $category){
                $tree[] = [
                    'id'       => $category->id,
                    'title'    => $category->title,
                    'slug'     => $category->slug,
                    'level'    => $level,
                    'children' => $category->children()->get()->map(
                        fn($child) => self::getCategoryTree($child, $level + 1)
                    )->all()
                ];
            }

        }
        else {

            $tree = [
                'id'       => $category->id,
                'title'    => $category->title,
                'slug'     => $category->slug,
                'level'    => $level,
                'children' => $category->children()->get()->map(
                    fn($child) => self::getCategoryTree($child, $level + 1)
                )->all()
            ];

        }

        return $tree;

    }

    public function printCategoryTree( array $categories = [] ): string {

        if( $categories === [] ){
            $categories = self::getCategoryTree();
        }

        $html="<ul>";
        foreach( $categories as $category ){
            $html.="<li>";
            $html.="<a class='text-uppercase' href='".route('category', [ 'category' => $category['slug'] ] )."' >";
            $html.=$category['title'];
            $html.="</a>";
            if( $category['children'] !== [] ){
                $html.=self::printCategoryTree($category['children']);
            }
            $html.="</li>";
        }
        $html.="</ul>";

        return $html;

    }

}
