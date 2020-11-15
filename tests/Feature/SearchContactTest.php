<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use App\Models\Company;

class SearchContactTest extends TestCase
{
    use RefreshDatabase;

    public function testContactView()
    {

    $user = User::factory()->create([
              'password' => bcrypt($password = 'i-love-laravel')]);

      $response = $this->actingAs($user)->get(route('contacts.index'));
      $response->assertSuccessful();
      $response->assertViewIs('contacts.index');
      $response->assertSeeText('Contacten');
    }

    public function testSearchContactViewAll()
    {
    $user = User::factory()->create([
             'password' => bcrypt($password = 'i-love-laravel')]);

    Contact::factory()->count(5)->create();
      $randomName = Contact::all()->first()->first_name;

    $first = Contact::factory()->create(['first_name' => 'hhh']);
    $second = Contact::factory()->create(['last_name' => 'kkk']);

      $response = $this->actingAs($user)->get(route('contacts.index'));

      $response->assertSeeText('Contacten');
      $response->assertSeeText('hhh');
      $response->assertSeeText('kkk');
    $response->assertSeeText($randomName);
    }

    public function testSearchContactView()
    {
    $user = User::factory()->create([
             'password' => bcrypt($password = 'i-love-laravel')]);

    Company::factory()->count(2)->create();
      $company_id = Company::all()->first()->id;

    Contact::factory()->count(5)->create(["company_id" => $company_id]);
      $randomName = Contact::all()->first()->first_name;

    $first = Contact::factory()
             ->create(['first_name' => 'hhh',"company_id" => $company_id]);
    $second = Contact::factory()
             ->create(['last_name' => 'hhh',"company_id" => $company_id]);

      $response = $this->actingAs($user)->get(route('contacts.index').'?keyword=hhh');

      $response->assertSeeText('Contacten');
      $response->assertSeeText('hhh');
      $response->assertDontSeeText($randomName);
  }


}
