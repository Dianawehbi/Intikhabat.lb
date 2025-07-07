<?php

namespace Database\Factories;

use App\Enums\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ElectoralDistrict>
 */
class ElectoralDistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'region' => $this->faker->randomElement(Region::cases())->value,
            'seats_available' => $this->faker->numberBetween(1, 20),
        ];
    }
}
