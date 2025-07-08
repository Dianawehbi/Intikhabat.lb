<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $candidate = Candidate::inRandomOrder()->first();

        return [
            'candidate_id' => $candidate?->id ?? Candidate::factory(),
            'election_id' => $candidate?->listModel?->election_id ?? 1,
            'voter_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
        ];
    }
}
