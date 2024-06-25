<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'fname' => 'Testname',
            'lname' => 'Testname',
            'shop-name' => 'Testname',
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => '0776408076',
            'nic' => '200325311537',
            'password' => '$2y$12$zcUbYrRBf/vHv1GiOstQb.mohYMgeRU/6TnH2TaGkVvW.qe4OAbEK',
            'gender_id' => '1',
        ];
    }
}
