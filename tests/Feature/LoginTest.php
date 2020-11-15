<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
  use RefreshDatabase;

  public function testLoginView()
  {
    $response = $this->get(route('login'));
    $response->assertSuccessful();
    $response->assertViewIs('auth.login');
    $response->assertSeeText('Login');
  }

  public function testCannotSeeLoginViewWhenLoggedIn()
  {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('login'));
    $response->assertRedirect(route('home'));
  }

  public function testUserLoggedIn()
  {
    $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel')]);

    $response = $this->post(route('login'), [
                    'email' => $user->email,
                    'password' => $password,
                ]);

    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($user);
  }

  public function testWrongUser()
  {
    $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel')]);

    $response = $this->post(route('login'), [
                    'email' => $user->email,
                    'password' => 'secret',
                ]);

    $response->assertRedirect('/');
    $this->assertGuest(null);
  }

}
