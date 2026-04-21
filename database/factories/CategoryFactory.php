<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\CategoryHelper;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->sentence();

        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        $parent_id = null; // Parents are created separately. See `configure` method bellow.
        $title = trim($sentence, '.');
        $slug = Str::slug($title, '-');
        $description = $this->faker->paragraph();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'parent_id',
            'title',
            'slug',
            'description',
            'is_active'
        );

    }

    /**
     * Set actions after create a category.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Category $category) {
            if ($category->parent_id !== null) {
                return;
            }

            if ($this->faker->boolean()) {
                return;
            }

            $parent = Category::query()
                ->where('is_active', true)
                ->where('id', '!=', $category->id)
                ->inRandomOrder()
                ->first();

            if (! $parent) {
                return;
            }

            if (CategoryHelper::hasDescendant($category, $parent)) {
                return;
            }

            $category->parent()->associate($parent);
            $category->save();
        });
    }
}
