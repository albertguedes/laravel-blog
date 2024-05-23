<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper {

    /**
     * Function to verify if a test category is descendant of current category,
     * to prevent circular relationships.
     *
     * @param Category $test
     * @param Category $current
     * @return boolean
     */
    public static function hasDescendant(Category $test, Category $current): bool {

        // Prevent to set category as parent of yourself.
        if( $test->id === $current->id ) return true;

        // If the current category has children, verify each of then
        // to see if one of it is the test category.
        foreach ($current->children ?? [] as $child) {
            if (self::hasDescendant($test, $child)) {
                return true;
            }
        }

        return false;
    }
}
