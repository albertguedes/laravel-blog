<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some root categories.
        Category::factory()->count(7)->create(
            [
                'parent_id' => null,
                'is_active' => true,
            ]
        );

        // Create some child categories for root categories.
        Category::each(function (Category $category) {
            if ($category->parent_id == null) {
                Category::factory()->count(3)->create(
                    [
                        'parent_id' => $category->id,
                        'is_active' => true,
                    ]
                );
            }
        });

        // Create some child categories for non-root categories.
        Category::each(function (Category $category) {
            if ($category->parent_id !== null && $category->children->count() == 0) {
                Category::factory()->count(3)->create(
                    [
                        'parent_id' => $category->id,
                        'is_active' => true,
                    ]
                );
            }
        });
    }
}
