<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Role;

/**
 * @template TModel of \App\Role
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTime();
        $updated_at = $this->faker->dateTimeBetween($created_at,'now');
        $title = $this->faker->unique()->word();
        $description = $this->faker->paragraph();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'title',
            'description',
            'is_active'
        );
    }
}
