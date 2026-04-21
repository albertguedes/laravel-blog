<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of \App\Models\VerificationToken
 *
 * @extends Factory<TModel>
 */
class VerificationTokenFactory extends Factory
{
    protected $model = VerificationToken::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'token' => $this->faker->unique()->sha256(),
            'expires_at' => now()->addHours(24),
        ];
    }

    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => $user->email,
        ]);
    }
}
