<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'country_code' => 99,
            'latitude' => rand(16.57946, 31.67252),
            'max_number_of_offers' => 20,
            'longitude' => rand(35.69014, 50.20833),
            'address' => $this->faker->unique()->address(),
            'checked' => rand(1, 2),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'city_id' => City::inRandomOrder()->first()->id,
            'domain_id' => Domain::inRandomOrder()->first()->id,
        ];
    }
}
