<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3),
            'date' => $this->faker->dateTime(3),
            'published_at' => $this->faker->dateTime(3),
            'price' => rand(100, 500),
            'description' => $this->faker->words(30),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'company_id' => Company::inRandomOrder()->first()->id ?? 1,

        ];
    }
}
