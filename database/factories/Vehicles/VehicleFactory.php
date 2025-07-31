<?php

namespace Database\Factories\Vehicles;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => \App\Models\Vehicles\Type::factory(),

            'year' => $this->faker->year,
            'color' => $this->faker->colorName,
            'mileage' => $this->faker->numberBetween(1000, 200000),
            'price' => $this->faker->numberBetween(5000, 50000),
        ];
    }
}
