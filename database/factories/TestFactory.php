<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'final_score' => $this->faker->numberBetween(0,100),
            'max_score' => $this->faker->numberBetween(1,100),
            'topic_id' => 1,
            'user_id' => User::factory(),
            'completed_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
