<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Category;
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

        $category_id = null;
        while( is_null($category_id) ){
            $category = Category::all()->random();
            if( !is_null($category->children()) ) $category_id = $category->id;
        }

        $created_at  = $this->faker->dateTime();
        $updated_at  = $this->faker->dateTimeBetween($created_at,'now');
        $author_id   = User::all()->random()->id;
        $category_id = $category->id;
        $published   = $this->faker->boolean();
        $title       = trim($sentence,'.');
        $slug        = Str::slug($title,'-');
        $description = $this->faker->text(140);
        $content     = $this->faker->text(2048);

        return compact('created_at','updated_at','author_id','category_id','published','title','slug','description','content');

    }

}
