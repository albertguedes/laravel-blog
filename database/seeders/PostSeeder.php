<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::whereDoesntHave('children')->get()->each(function ($category) {
            Post::factory()->count(rand(1, 5))->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
