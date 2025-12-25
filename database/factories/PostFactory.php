<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

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
        $sentence = $this->faker->unique()->sentence(rand(1,10));

        $created_at  = $this->faker->dateTime();
        $updated_at  = $this->faker->dateTimeBetween($created_at,'now');
        $author_id   = User::inRandomOrder()->first()->id;
        $title       = trim($sentence,'.');
        $slug        = Str::slug($title,'-');
        $description = $this->faker->text(140);
        $content     = $this->faker->text(2048);
        $category_id = null;
        $published   = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'author_id',
            'title',
            'slug',
            'description',
            'content',
            'category_id',
            'published'
        );
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post)
        {
            // Set some random leaf category to the post.
            $post->category_id = Category::whereDoesntHave('children')
                                            ->where('is_active', true)
                                            ->inRandomOrder()
                                            ->value('id');

            // Set random tags to the post
            $post->tags()->attach(
                Tag::inRandomOrder()
                            ->where('is_active', true)
                            ->limit(rand(1,5))
                            ->get()
                            ->pluck('id')
            );

            $post->save();
        });
    }
}
