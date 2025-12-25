<?php declare(strict_types=1);

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    /**
     * Checks if a category is descendant of given test category,
     * to prevent circular categories.
     *
     * @param Category $current The category to check
     * @param Category $test The test category to check against
     *
     * @return bool True if $current is a descendant of $test, false otherwise
     *
     * @throws \Exception If either $current or $test is null
     */
    public static function hasDescendant(Category $current, Category $test): bool
    {
        if (!$current || !$test) {
            throw new \Exception('Category not found.');
        }

        $stack = [$current];

        while (!empty($stack))
        {
            $current = array_shift($stack);

            if ($current->id === $test->id) {
                return true;
            }

            foreach ($current->children as $child) {
                $stack[] = $child;
            }
        }

        return false;
    }
}
