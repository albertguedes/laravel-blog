<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTimeBetween($created_at,'now');
        $email = $this->faker->unique()->safeEmail();
        $email_verified_at = $this->faker->boolean() ? $created_at : null;
        $password = Hash::make($email);
        $remember_token = Str::random(10);
        // User can be active only if email is verified.
        $is_active = (!is_null($email_verified_at)) ? $this->faker->boolean() : false;

        return compact(
            'created_at',
            'updated_at',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'is_active'
        );
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
