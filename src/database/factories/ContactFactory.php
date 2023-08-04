<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $contact = Contact::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $prefecture = $this->faker->prefecture();
        $city = $this->faker->city();
        $streetAddress = $this->faker->streetAddress();

        $postcode = str_replace('-', '', $this->faker->postcode()); 
        $formattedPostcode = substr($postcode, 0, 3) . '-' . substr($postcode, 3); 

        return [
            'fullname' => $this->faker->name(),
            'gender' => rand(1, 2),
            'email' => $this->faker->email(),
            'postcode' => $formattedPostcode,
            'address' => $prefecture . $city . $streetAddress,
            'building_name' => $this->faker->secondaryAddress(),
            'option' => $this->faker->realText(120, 2),
        ];
    }
}
