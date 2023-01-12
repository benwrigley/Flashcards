<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flashcard>
 */
class FlashcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition( )
    {

        return [
            'question' => implode($this->faker->paragraphs(1)),
            'answer' => implode($this->faker->paragraphs(1)),
            'avg_score' => $this->faker->numberBetween(0,100),
            'max_score' => $this->faker->numberBetween(1,5),
            'topic_id' => Topic::factory(),
            'user_id' => User::factory(),
        ];
    }
}
