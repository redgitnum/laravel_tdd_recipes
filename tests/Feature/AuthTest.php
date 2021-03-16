<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_see_login_page_as_guest()
    {
        $response = $this->get('/login');
        $response->assertOk();
    }

    public function test_cannot_see_login_page_as_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/login');
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
    }

    public function test_can_login_with_valid_credentials()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard/recipes');
    }

    public function test_cannot_login_with_invalid_credentials()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword'
        ]);
        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    public function test_see_register_page_as_guest()
    {
        $response = $this->get('/register');
        $response->assertOk();
    }

    public function test_cannot_see_register_page_as_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/register');
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/recipes');
    }

    public function test_can_register_with_valid_input()
    {
        $response = $this->post('/register', [
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $response->assertRedirect('/dashboard/recipes');
    }

    public function test_cannot_register_with_invalid_input()
    {
        $this->withExceptionHandling();
        $response = $this->post('/register', [
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'wrongpassword'
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('password');
        $response->assertRedirect('/register');
    }

    public function test_cannot_register_with_missing_input()
    {
        $this->withExceptionHandling();
        $response = $this->post('/register', [
            'username' => $this->faker->userName,
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('email');
        $response->assertRedirect('/register');
    }
}
