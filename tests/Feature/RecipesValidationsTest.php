<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipesValidationsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_recipe_with_all_inputs_available()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza Dough maximus',
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->jobtitle,
            'paragraph_1' => $this->faker->text(),
            'paragraph_2' => $this->faker->text(),
            'paragraph_3' => $this->faker->text(),
            'paragraph_4' => $this->faker->text(),
            'paragraph_5' => $this->faker->text(),
            'paragraph_6' => $this->faker->text(),
            'images' => 'images/'.$this->faker->lexify('????????????????')
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseHas('recipes', ['title' => 'Pizza Dough maximus']);
    }

    public function test_cannot_create_recipe_validation_error_missing_input()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza Dough maximus',
            'overview' => $this->faker->sentence(10),
            'paragraph_1' => $this->faker->text(),
            'images' => 'images/'.$this->faker->lexify('????????????????')
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes/create');
        $this->assertDatabaseMissing('recipes', ['title' => 'Pizza Dough maximus']);
        $response->assertSessionHasErrors('ingredients');
    }

    public function test_cannot_create_recipe_validation_error_empty_paragraph_in_the_middle()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza Dough maximus',
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->jobtitle,
            'paragraph_1' => $this->faker->text(),
            'paragraph_2' => '',
            'paragraph_3' => $this->faker->text(),
            'images' => 'images/'.$this->faker->lexify('????????????????')
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes/create');
        $this->assertDatabaseMissing('recipes', ['title' => 'Pizza Dough maximus']);
        $response->assertSessionHasErrors('paragraph_2');
    }

    public function test_cannot_create_recipe_validation_error_short_title()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza',
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->jobtitle,
            'paragraph_1' => $this->faker->text(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes/create');
        $this->assertDatabaseMissing('recipes', ['title' => 'Pizza Dough maximus']);
        $response->assertSessionHasErrors('title');
    }
}
