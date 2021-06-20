<?php

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

        $created_at        = now();
        $updated_at        = now();        
        $name              = $this->faker->name();
        $email             = $this->faker->unique()->safeEmail();
        $email_verified_at = now();
        $password          = Hash::make($email);
        $remember_token    = Str::random(10);

        return compact('created_at','updated_at','name','email','email_verified_at','password','remember_token');

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
