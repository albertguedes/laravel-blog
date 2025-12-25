<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Profile;
use App\Models\User;

/**
 * @template TModel of \App\Models\Profile
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::inRandomOrder()->first()->id;
        $name = $this->faker->name();
        $username = $this->faker->unique()->username();
        $about = $this->faker->paragraph();

        return compact(
            'user_id',
            'name',
            'username',
            'about'
        );
    }
}
