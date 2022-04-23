<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Starship>
 */
class StarshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'status' => $this->faker->randomElement(['Operational', 'Damaged']),
            'class' => $this->faker->word(),
            'crew' => $this->faker->numberBetween(1000, 35000),
            'image' => $this->faker->imageUrl(),
            'value' => $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}
