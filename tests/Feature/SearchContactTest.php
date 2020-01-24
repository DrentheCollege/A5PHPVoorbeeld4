<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Contact;
use App\Company;

class SearchContactTest extends TestCase
{
    use RefreshDatabase;

    public function testContactView()
    {

      $user = factory(User::class)->create([
              'password' => bcrypt($password = 'i-love-laravel')]);

      $response = $this->actingAs($user)->get(route('contacts.index'));
      $response->assertSuccessful();
      $response->assertViewIs('contacts.index');
      $response->assertSeeText('Contacten');
    }

    public function testSearchContactViewAll()
    {
      $user = factory(User::class)->create([
             'password' => bcrypt($password = 'i-love-laravel')]);


      factory(Contact::class, 5)->create();
      $randomName = Contact::all()->first()->first_name;

      $first = factory(Contact::class)->create(['first_name' => 'hhh']);
      $second = factory(Contact::class)->create(['last_name' => 'kkk']);

      $response = $this->actingAs($user)->get(route('contacts.index'));

      $response->assertSeeText('Contacten');
      $response->assertSeeText('hhh');
      $response->assertSeeText('kkk');
      $response->assertSeeText(Contact::all()->first()->first_name);

    }

    public function testSearchContactView()
    {
      $user = factory(User::class)->create([
             'password' => bcrypt($password = 'i-love-laravel')]);

      factory(Company::class, 2)->create();
      $company_id = Company::all()->first()->id;

      factory(Contact::class, 5)->create(["company_id" => $company_id]);
      $randomName = Contact::all()->first()->first_name;

      $first = factory(Contact::class)->create(['first_name' => 'hhh',"company_id" => $company_id]);
      $second = factory(Contact::class)->create(['last_name' => 'hhh',"company_id" => $company_id]);

      $response = $this->actingAs($user)->get(route('contacts.index').'?keyword=hhh');

      $response->assertSeeText('Contacten');
      $response->assertSeeText('hhh');
      $response->assertDontSeeText($randomName);

    }
}
