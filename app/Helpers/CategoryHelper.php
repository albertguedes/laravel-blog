<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper {

    /**
     * Function to verify if a test category is descendant of given category,
     * to prevent circular relationships.
     *
     * @param Category $test
     * @param Category $category
     * @return boolean
     */
    public static function hasDescendant(Category $test, Category $category): bool {

        // Prevent to set category as parent of yourself.
        if( $test->id === $category->id ) return true;

        // If the category has children, verify each of then and the children of
        // the each child.
        foreach ($category->children ?? [] as $child) {
            if( $test->id === ( $child->id || self::hasDescendant($test, $child) ) ){
                return true;
            }
        }

        return false;

    }

}
