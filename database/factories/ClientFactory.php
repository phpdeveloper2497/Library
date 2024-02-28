<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'library_card_id' => rand(100000, 999999),
            'passport_series_number' =>fake()->regexify('[A-E]{2} [0-9]{7}'),
            'address' =>fake()->address,
            'email' => fake()->email,
            'phone_number' => fake()->phoneNumber
        ];
    }
}
