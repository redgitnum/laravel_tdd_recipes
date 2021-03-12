<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recipe;
use App\Models\WantedRecipe;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewRecipesTest extends TestCase
{
    use RefreshDatabase;

    public function test_see_recipe_details_page()
    {
        Recipe::factory()->create([
            'title' => 'Title of a test recipe'
        ]);

        $response = $this->get('/recipes/details/1');
        $response->assertOk();
        $response->assertSee('Title of a test recipe');
    }

    public function test_see_404_when_accessing_wrong_recipe_details_page()
    {
        Recipe::factory()->create([
            'title' => 'Title of a test recipe'
        ]);
        $response = $this->get('/recipes/2');
        $response->assertStatus(404);
    }

    public function test_see_all_recipes()
    {
        $recipes = Recipe::factory()->count(10)->create();
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee($recipes->first()->title);
    }

    public function test_search_recipes_shows_results_if_there_is_match()
    {
        $recipes = Recipe::factory()->count(100)->create();
        $recipe = $recipes->random();

        $respone = $this->get('/recipes/search?query='.substr($recipe->title, -4));
        $respone->assertOk();
        $respone->assertSee($recipe->title);
    }

    public function test_search_recipes_shows_not_found_if_no_match()
    {
        Recipe::factory()->count(100)->create();

        $respone = $this->get('/recipes/search?query=randomstring');
        $respone->assertOk();
        $respone->assertSee('No recipes found');
    }

    public function test_search_recipes_shows_validation_errors_too_short()
    {

        Recipe::factory()->count(10)->create();

        $respone = $this->get('/recipes/search?query=dd');
        $respone->assertSessionHasErrors('query');
        $this->followRedirects($respone)->assertSee('Minimum 3 characters required');
    }

    public function test_search_recipes_shows_validation_errors_not_empty()
    {

        Recipe::factory()->count(10)->create();

        $respone = $this->get('/recipes/search?query=');
        $respone->assertSessionHasErrors('query');
        $this->followRedirects($respone)->assertSee('Query is required');
    } 

    public function test_see_all_wanted_recipes()
    {
        $this->withoutExceptionHandling();

        $wanted = WantedRecipe::factory()->create();

        $response = $this->get('/recipes/wanted');
        $response->assertOk();
        $response->assertSee($wanted->title);
    }

    public function test_see_request_recipe_form_page()
    {
        $response = $this->get('/recipes/request');
        $response->assertOk();
    }

    public function test_request_recipe_form_works_with_valid_input()
    {
        $response = $this->post('/recipes/request', [
            'title' => 'Random recipe title request'
        ]);
        $wanted = WantedRecipe::first();
        $response->assertOk();
        $this->assertEquals('Random recipe title request', $wanted->title);
    }

    public function test_request_recipe_form_validation_works_errors_not_empty()
    {
        $response = $this->post('/recipes/request', [
            'title' => ''
        ]);
        $response->assertSessionHasErrors('title');
        $this->followRedirects($response)->assertSee('Title cannot be empty');
        $this->assertDatabaseMissing('wanted_recipes', ['title' => '']);
    }

    public function test_request_recipe_form_validation_works_errors_too_short()
    {
        $response = $this->post('/recipes/request', [
            'title' => 'Cak'
        ]);
        $response->assertSessionHasErrors('title');
        $this->followRedirects($response)->assertSee('The title must be at least 4 characters');
        $this->assertDatabaseMissing('wanted_recipes', ['title' => 'Cak']);
    }

    public function test_request_recipe_form_validation_works_errors_only_words()
    {
        $response = $this->post('/recipes/request', [
            'title' => '84847'
        ]);
        $response->assertSessionHasErrors('title');
        $this->followRedirects($response)->assertSee('The title cannot contain numbers or special characters');
        $this->assertDatabaseMissing('wanted_recipes', ['title' => '84847']);
    }


}
