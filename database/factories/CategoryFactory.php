<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $sentence = $this->faker->unique()->sentence(4);

        $created_at  = $this->faker->dateTime();
        $updated_at  = $this->faker->dateTimeBetween($created_at,'now');
        $parent_id   = null;
        $is_active   = $this->faker->boolean();
        $title       = trim($sentence,'.');
        $slug        = Str::slug($title,'-');
        $description = $this->faker->text(140);

        return compact('created_at','updated_at','parent_id','is_active','title','slug','description');

    }

}
