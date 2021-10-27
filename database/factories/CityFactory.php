<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city(),
            'latitude' => rand(16.57946, 31.67252),
            'longitude' => rand(35.69014, 50.20833),
        ];
    }
}
