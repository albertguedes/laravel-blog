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
                    )->all(),
                    'count_posts' => self::countPosts($category)
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
                )->all(),
                'count_posts' => self::countPosts($category)
            ];

        }

        return $tree;

    }

    /**
     * Counts the total number of posts belonging to a category, including posts in its children categories.
     *
     * @param Category $category The category to count posts for.
     * @return int The total number of posts.
     */
    public static function countPosts(Category $category): int
    {

        // Count posts for the given category.
        $count = $category->posts()
                          ->where('published', true)
                          ->count();

        // Recursively count posts for each child category.
        foreach ($category->children as $childCategory) {
            $count += self::countPosts($childCategory);
        }

        // Return the total count of posts.
        return $count;

    }

    public static function printCategoryTree( array $categories = [], int $id = 0 ): string {

        $html="<ul id='children-".$id."' class='collapse' >";

        if( $categories === [] ){
            $categories = self::getCategoryTree();
            $html="<ul id='category-tree' class='list-unstyled' >";
        }

        foreach( $categories as $category ){

            $html.="<li class='text-decoration-none mb-2' >";

            // Only leafs must have posts.
            if( $category['children'] !== [] ){
                $html.="<a class='collapse-link pe-2 fw-bold' data-bs-toggle='collapse' data-bs-target='#children-".$category['id']."' href='#' >[<span class='collapse-icon' >+</span>]</a>";
                $html.="<a class='text-uppercase' href='".route('category', [ 'category' => $category['slug'] ] )."' >";
                $html.=$category['title']." (".$category['count_posts'].")";
                $html.="</a>";
                $html.=self::printCategoryTree($category['children'],$category['id']);
            }
            else{
                $html.="<span class='pe-4' >&nbsp</span>";
                $html.="<a class='text-uppercase' href='".route('category', [ 'category' => $category['slug'] ] )."' >";
                $html.=$category['title']." (".$category['count_posts'].")";
                $html.="</a>";
            }

            $html.="</li>";

        }

        $html.="</ul>";

        return $html;

    }

}
