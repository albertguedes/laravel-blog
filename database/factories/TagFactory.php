<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $created_at  = $this->faker->dateTime();
        $updated_at  = $this->faker->dateTimeBetween($created_at,'now');
        $title       = $this->faker->unique()->word();
        $slug        = $title;
        $description = $this->faker->paragraph();
        $is_active   = $this->faker->boolean();

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
