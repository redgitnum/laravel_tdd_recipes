<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use App\Models\WantedRecipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$cnRuRQyK/iHM.EKbob84g.XJwfmLYfeKGV5Y8/J1o4SEBL4L5XbPu', // admin
            'super_user' => 1
        ]);
        User::factory(10)->create();
        Recipe::factory(200)->create();
        WantedRecipe::factory(25)->create();
    }
}
