<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
      'first_name' => $faker->name,
      'last_name' => $faker->name,
      'city' => 'Stad',
      'country' => 'Land',
      'email'=> $faker->email
    ];
});
