<?php

namespace Database\Factories;

use App\Models\Election;
use App\Models\ElectoralDistrict;
use App\Models\Party;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListModel>
 */
class ListModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // e.g., "Unity and Progress"
            // 50% chance of being independent (no party)
            'party_id' => $this->faker->optional()->randomElement(Party::pluck('id')->toArray()),

            // always required
            'electoral_district_id' => ElectoralDistrict::inRandomOrder()->value('id'),
            'election_id' => Election::inRandomOrder()->value('id'),
        ];
    }
}
