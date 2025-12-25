<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create(
            [
                'title' => 'admin',
                'description' => 'Admin role',
                'is_active' => true
            ],
        );

        Role::factory()->create(
            [
                'title' => 'user',
                'description' => 'User role',
                'is_active' => true
            ],
        );

        Role::factory()->create(
            [
                'title' => 'guest',
                'description' => 'Guest role',
                'is_active' => true
            ],
        );

        Role::factory()->create(
            [
                'title' => 'author',
                'description' => 'Author role',
                'is_active' => true
            ],
        );

        Role::factory()->create(
            [
                'title' => 'subscriber',
                'description' => 'Subscriber role',
                'is_active' => false
            ],
        );
    }
}
