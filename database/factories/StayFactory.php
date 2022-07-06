<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->word,
            'image' => null,
            'description' => $this->faker->sentence(15),
            'amenities' => $this->faker->sentence(4),
            'rooms' => $this->faker->numberBetween(1, 5),
            'beds' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['active', 'pending', 'inactive']),
            'type' => $this->faker->randomElement(['hotel', 'apartment', 'resort', 'villa', 'cottage']),
            'location' => $this->faker->word,
            'price' => $this->faker->numberBetween(200, 1000),
        ];
    }
}
