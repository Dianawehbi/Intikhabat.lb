<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Party>
 */
class PartyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Party',
            'leader_name' => $this->faker->name,
            'logo' => $this->faker->imageUrl(200, 200, 'politics', true, 'logo'),
            'description' => $this->faker->paragraph,
        ];
    }
}
