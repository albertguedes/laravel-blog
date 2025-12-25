<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Helpers\CategoryHelper;
use App\Models\Category;

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
        $sentence = $this->faker->unique()->sentence(rand(1,3));

        $created_at  = $this->faker->dateTime();
        $updated_at  = $this->faker->dateTimeBetween($created_at,'now');
        $parent_id   = null; // Parents are created separately. See `configure` method bellow.
        $title       = trim($sentence,'.');
        $slug        = Str::slug($title,'-');
        $description = $this->faker->paragraph();
        $is_active   = $this->faker->boolean();

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
     *
     * @return static
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Category $category)
        {
            // Define a maximum number of attempts to find a parent category.
            $maxAttempts = 10;
            $attemptCount = 0;

            if ($this->faker->boolean()) {
                return;
            }

            // Verify if the parent selected isn't a child category of
            // the category, to prevent circular relationships.
            do {
                // Get new parent if the old is a descendant of the category.
                $parent = Category::inRandomOrder()
                                    ->where('is_active', true)
                                    ->first();

                $attemptCount++;
            } while (
                CategoryHelper::hasDescendant($category, $parent) &&
                ($attemptCount < $maxAttempts)
            );

            if ($attemptCount < $maxAttempts) {
                $category->parent()->associate($parent);
                $category->save();
            }
        });
    }
}
