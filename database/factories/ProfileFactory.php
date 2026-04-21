<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of \App\Models\Profile
 *
 * @extends Factory<TModel>
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
        $user = User::query()->inRandomOrder()->first();

        if (! $user) {
            $user = User::factory()->create();
        }

        return [
            'user_id' => $user->id,
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'about' => $this->faker->paragraph(),
        ];
    }
}
