<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WantedRecipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class WantedRecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WantedRecipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'user_id' =>$this->faker->randomElement([null, User::all()->random()->id])
        ];
    }
}
