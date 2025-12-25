<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Tag;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->unique()->sentence(rand(1,3));

        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTimeBetween($created_at,'now');
        $title = trim($sentence,'.');
        $slug = Str::slug($title,'-');
        $description = $this->faker->paragraph();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'title',
            'slug',
            'description',
            'is_active'
        );
    }
}
