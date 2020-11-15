<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $company = Company::factory()->create();
      
      return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'city' => 'Stad',
            'country' => 'Land',
            'email'=> $this->faker->email,
            'company_id'=>$company->id
    	];
    }
}
