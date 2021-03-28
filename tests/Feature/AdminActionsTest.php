<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_with_admin_options_as_admin()
    {
        $admin = User::factory()->create([
            'super_user' => 1
        ]);
        $this->actingAs($admin);
        $response = $this->get('/dashboard/recipes');
        $response->assertOk();
        $response->assertSee('Admin Panel');
    }

    public function test_cannot_see_admin_options_as_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/dashboard/recipes');
        $response->assertOk();
        $response->assertDontSee('Admin Panel');
    }

    public function test_can_delete_any_recipe_as_admin()
    {
        $this->withExceptionHandling();
        $admin = User::factory()->create([
            'super_user' => 1
        ]);
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($admin);
        $response = $this->delete('/dashboard/recipes/'.$recipe->id);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseMissing('recipes', ['title' => $recipe->title]);
    }

    public function test_can_update_any_recipe_as_admin()
    {
        $admin = User::factory()->create([
            'super_user' => 1
        ]);
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($admin);
        $response = $this->put('/dashboard/recipes/'.$recipe->id, [
            'title' => 'Updated Recipe Title',
            'overview' => $recipe->overview,
            'ingredients' => implode(',', $recipe->ingredients),
            'paragraph_1' => $recipe->paragraph_1 
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
        $this->assertDatabaseHas('recipes', ['title' => 'Updated Recipe Title']);
    }


}
