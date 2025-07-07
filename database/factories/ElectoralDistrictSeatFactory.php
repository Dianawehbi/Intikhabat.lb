<?php

namespace Database\Factories;

use App\Enums\Sect;
use App\Models\ElectoralDistrict;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ElectoralDistrictSeat>
 */
class ElectoralDistrictSeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'electoral_district_id' => ElectoralDistrict::inRandomOrder()->value('id'),
            'sect' => $this->faker->randomElement(Sect::cases())->value,
            'seat_count' => $this->faker->numberBetween(1, 5),
        ];
    }
}
