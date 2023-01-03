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
    public function definition()
    {

        return [
            'title' => implode(' ', $this->faker->words(2)),
            'slug' => $this->faker->slug,
            'question' => '<p>' . implode('</p><p>' , $this->faker->paragraphs(2)) . '</p>',
            'answer' => '<p>' . implode('</p><p>' , $this->faker->paragraphs(2)) . '</p>',
            'topic_id' => Topic::factory(),
            'user_id' => User::factory(),
        ];
    }
}
