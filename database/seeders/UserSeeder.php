<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // Create first admin user.
        User::factory()->create([
            'name'              => 'Administrator',
            'username'          => 'admin',
            'email'             => 'admin@fakemail.com',
            'password'          => Hash::make('admin@fakemail.com'),
            'is_active'         => true,
        ]);

        User::factory()->count(15)->create();

    }

}
