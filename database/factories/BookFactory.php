<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    public function definition(): array
    {
        return [
            "author" =>[
                "en" => fake()->name(),
                "ru" => "Russian->".fake()->name(),
                "uz" => "Uzbek->".fake()->name(),
            ],

            "category_id" => rand(1, 6),
            "quantity" => rand(1,20),
            "created_at_book" =>$this->faker->unique()->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null) ,
            "name" => [
                "en" => fake()->sentence(3),
                "ru" => "Постройте жизнь, которую хотите: искусство и наука стать счастливее",
                "uz" => "O'zingiz xohlagan hayotni yarating: baxtli bo'lish san'ati va ilmi",

            ],
        ];
    }
}
