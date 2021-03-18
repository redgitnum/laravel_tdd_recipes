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
        User::factory(10)->create();
        Recipe::factory(50)->create();
        WantedRecipe::factory(25)->create();
    }
}
