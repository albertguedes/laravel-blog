<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::each(function ($user) {
            $user->profile()
                ->save(
                    Profile::factory()->create()
                );
        });
    }
}
