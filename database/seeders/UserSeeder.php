<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(9)->create();

        User::each(function ($user) {
            $role = Role::inRandomOrder()
                            ->where('title', '!=', 'admin')
                            ->where('is_active', true)
                            ->first();

            $user->roles()->attach($role);
            $user->save();
        });

        // Create admin user.
        $admin = User::factory()->create([
            'email'             => 'admin@fakemail.com',
            'password'          => Hash::make('admin@fakemail.com'),
            'email_verified_at' => now(),
            'is_active'         => true
        ]);

        $role = Role::where('title', 'admin')->first();
        $admin->roles()->attach($role);
        $admin->save();
    }
}
