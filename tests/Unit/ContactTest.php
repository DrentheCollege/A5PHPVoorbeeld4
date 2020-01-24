<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
     use RefreshDatabase;
      /** @test */
     function test_contactSearch()
     {
         factory(Contact::class, 5)->create();
         $first = factory(Contact::class)->create(['first_name' => 'Name']);
         $second = factory(Contact::class)->create(['last_name' => 'Name']);

         $contacts = Contact::contactSearch("Name");

         //Er moeten 2 contacten in de lijst zitten
         $this->assertEquals($contacts->count(), 2);

         //De eerste is bekend
         $this->assertEquals($contacts->first()->id, $first->id);

         //De tweede zou ook nog getest kunnen worden
         $this->assertEquals($contacts->last()->id, $second->id);
     }
}
