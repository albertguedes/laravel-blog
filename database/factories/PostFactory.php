<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $sentence = $this->faker->unique()->sentence(4); 

        $title       = trim($sentence,'.');
        $description = $this->faker->text(140);
        $content     = $this->faker->text(2048);
        $slug        = Str::slug($title,'-');
        $published   = $this->faker->boolean();

        return compact('title','description','content','slug','published');

    }
}
