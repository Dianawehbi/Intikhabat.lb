<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IdScan>
 */
class IdScanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_path' => $this->faker->imageUrl(640, 480, 'people', true, 'ID'),
            'extracted_date' => $this->faker->date('Y-m-d'),
            'matched' => $this->faker->boolean,
            'uploaded_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => User::factory(), // Creates a related user automatically
        ];
    }
}
