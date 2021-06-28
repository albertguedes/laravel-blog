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

        $created_at = date('now');

        // Create first admin user. 
        DB::table('users')->insert([
            'created_at'        => $created_at,
            'updated_at'        => $created_at,
            'name'              => 'Administrator',
            'username'          => 'admin',
            'email'             => 'admin@fakemail.com',
            'email_verified_at' => $created_at,
            'password'          => Hash::make('admin'),
            'remember_token'    => Str::random(10),
            'is_active'         => true,
        ]);

        User::factory()->count(15)->create();

    }

}
