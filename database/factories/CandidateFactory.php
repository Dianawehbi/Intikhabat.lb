<?php

namespace Database\Factories;

use App\Enums\Position;
use App\Enums\Sect;
use App\Models\ElectoralDistrict;
use App\Models\ListModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'sect' => $this->faker->randomElement(Sect::cases())->value,
            'position' => $this->faker->randomElement(Position::cases())->value,
            'list_model_id' => ListModel::inRandomOrder()->value('id'),
            'electoral_district_id' => ElectoralDistrict::inRandomOrder()->value('id'),
            'won' => $this->faker->boolean(30), // 30% chance of being a winner
            'votes_count' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
