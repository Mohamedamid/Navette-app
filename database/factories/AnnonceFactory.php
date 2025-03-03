<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => 2 ,
            'departure_city' => $this->faker->city(),
            'arrival_city' => $this->faker->city(),
            'departure_time' => $this->faker->time(),
            'arrival_time' => $this->faker->time(),
            'bus_description' => $this->faker->text(),
            'status' => $this->faker->randomElement(['valid', 'closed']),
        ];
    }
}
