<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Tests\TestCase;
use App\Models\User;
use App\Models\WantedRecipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ManageRecipesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_view_all_user_recipes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $recipes = Recipe::factory()->count(10)->create(['user_id' => $user->id]);
        $response = $this->get('/dashboard/recipes');
        $response->assertOk();
        $response->assertSee($recipes->random()->title);
    }

    public function test_create_recipe_page_exists_as_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/dashboard/recipes/create');
        $response->assertOk();
    }

    public function test_create_recipe_page_redirect_to_login_as_guest()
    {
        $response = $this->get('/dashboard/recipes/create');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_create_recipe_form_works()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza dough',
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->words(6),
            'paragraph_1' => $this->faker->text(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseHas('recipes', ['title' => 'Pizza dough']);
    }

    public function test_create_recipe_success_session_message()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza dough',
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->words(6),
            'paragraph_1' => $this->faker->text(),
        ]);
        $response->assertSessionHas('success');
    }

    public function test_cannot_create_recipe_as_guest()
    {
        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza dough'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('recipes', ['title' => 'Pizza dough']);
    }

    public function test_create_recipe_validation_works()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => ''
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseMissing('recipes', ['title' => '']);
    }

    public function test_create_recipe_validation_error_in_session()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/dashboard/recipes', [
            'title' => ''
        ]);
        $response->assertSessionHasErrors('title');
    }

    public function test_update_recipe_form_exists()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Recipe::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/dashboard/recipes/1/edit');
        $response->assertOk();
        $response->assertViewIs('dashboard.recipes.edit');
    }

    public function test_update_recipe_form_view_as_other_user_403()
    {
        $users = User::factory()->count(2)->create();
        Recipe::factory()->create(['user_id' => 2]);
        $this->actingAs($users->first());

        $response = $this->get('/dashboard/recipes/1/edit');
        $response->assertStatus(403);
    }

    public function test_update_recipe_form_redirect_as_guest()
    {
        User::factory()->create();
        Recipe::factory()->create(['user_id' => 1]);

        $response = $this->get('/dashboard/recipes/1/edit');
        $response->assertRedirect('/login');
    }

    public function test_update_recipe_works()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put('/dashboard/recipes/1', [
            'title' => 'Updated Recipe Title'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseHas('recipes', ['title' => 'Updated Recipe Title']);
    }

    public function test_update_recipe_success_session_message()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put('/dashboard/recipes/1', [
            'title' => 'Updated Recipe Title'
        ]);
        $response->assertSessionHas('success');
    }

    public function test_cannot_update_other_user_recipe()
    {
        $users = User::factory()->count(2)->create();
        Recipe::factory()->create(['user_id' => 2]);
        $this->actingAs($users->first());

        $response = $this->put('/dashboard/recipes/1', [
            'title' => 'Updated Recipe Title'
        ]);
        $response->assertStatus(403);
        $this->assertDatabaseMissing('recipes', ['title' => 'Updated Recipe Title']);
    }

    public function test_cannot_update_recipe_as_guest()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);

        $response = $this->put('/dashboard/recipes/1', [
            'title' => 'Updated Recipe Title'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('recipes', ['title' => 'Updated Recipe Title']);
    }

    public function test_update_recipe_validation_works()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put('/dashboard/recipes/1', [
            'title' => ''
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseMissing('recipes', ['title' => '']);
    }

    public function test_update_recipe_validation_error_in_session()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put('/dashboard/recipes/1', [
            'title' => ''
        ]);
        $response->assertSessionHasErrors('title');
    }

    public function test_delete_own_recipe_as_user()
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete('/dashboard/recipes/1');
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseMissing('recipes', ['title' => $recipe->title]);
    }

    public function test_delete_own_recipe_success_session_message()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete('/dashboard/recipes/1');
        $response->assertSessionHas('success');
    }

    public function test_cannot_delete_other_user_recipe()
    {
        $users = User::factory()->count(2)->create();
        $recipe = Recipe::factory()->create(['user_id' => 2]);
        $this->actingAs($users->first());

        $response = $this->delete('/dashboard/recipes/1');
        $response->assertStatus(403);
        $this->assertDatabaseHas('recipes', ['title' => $recipe->title]);
    }

    public function test_cannot_delete_non_existing_recipe()
    {
        $user = User::factory()->create();
        Recipe::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete('/dashboard/recipes/10');
        $response->assertStatus(404);
    }

    public function test_create_recipe_form_from_requested_recipe()
    {
        $user = User::factory()->create();
        $wanted = WantedRecipe::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard/recipes/create?request_id='.$wanted->id);
        $response->assertSee($wanted->title);
    }

    public function test_create_recipe_form_from_requested_recipe_bad_id_404()
    {
        $user = User::factory()->create();
        WantedRecipe::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard/recipes/create?request_id=5');
        $response->assertStatus(404);
    }

    public function test_create_recipe_from_requested_recipe_works()
    {
        $user = User::factory()->create();
        $wanted = WantedRecipe::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza dough',
            'request_id' => $wanted->id,
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->words(6),
            'paragraph_1' => $this->faker->text(),
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('recipes', ['request_id' => $wanted->id]);
    }

    public function test_recipe_request_removed_after_successfull_create_recipe_from_requested_recipe()
    {
        $user = User::factory()->create();
        $wanted = WantedRecipe::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza dough',
            'request_id' => $wanted->id,
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->words(6),
            'paragraph_1' => $this->faker->text(),
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('recipes', ['request_id' => $wanted->id]);
        $this->assertDatabaseMissing('wanted_recipes', ['id' => $wanted->id]);
    }

    public function test_create_recipe_from_requested_recipe_bad_request_id_400()
    {
        $user = User::factory()->create();
        WantedRecipe::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/dashboard/recipes', [
            'title' => 'Pizza dough',
            'request_id' => 2,
            'overview' => $this->faker->sentence(10),
            'ingredients' => $this->faker->words(6),
            'paragraph_1' => $this->faker->text(),
        ]);
        $response->assertStatus(400);
    }
}
