<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'user_id' =>User::all()->random()->id,
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->words(6),
            'paragraph_1' => $this->faker->text(),
            'paragraph_2' => $this->faker->text(),
            'paragraph_3' => $this->faker->text(),
            'paragraph_4' => $this->faker->text(),
            'paragraph_5' => $this->faker->text(),
            'paragraph_6' => $this->faker->text(),
            'images' => 'images/'.$this->faker->lexify('????????????????')
        ];
    }
}
