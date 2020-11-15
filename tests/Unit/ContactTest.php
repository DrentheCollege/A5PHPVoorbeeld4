<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactTest extends TestCase
{
     use RefreshDatabase;

      /** @test */
     function test_contactSearch()
     {
       //maak 5 willekeurige contacten die niet in test naar voren komen
       Contact::factory()->count(5)->create();

	   //twee duidelijk gedefinieerde contacten
       $first = Contact::factory()->create(['first_name' => 'Name']);
       $second = Contact::factory()->create(['last_name' => 'Name']);

       $contacts = Contact::contactSearch("Name");

       //Er moeten 2 contacten in de lijst zitten:
       // 1 met voornaam = Name en 1 met achternaam = Name
       $this->assertEquals($contacts->count(), 2);

       //De eerste is bekend
       $this->assertEquals($contacts->first()->id, $first->id);

       //De tweede zou ook nog getest kunnen worden
       $this->assertEquals($contacts->last()->id, $second->id);
     }
}
