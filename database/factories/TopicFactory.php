<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => implode(' ', $this->faker->words(2)),
            'slug' => $this->faker->slug,
            'description' => '<p>' . implode('</p><p>' , $this->faker->paragraphs(2)) . '</p>',
            'topic_id' => null,
            'user_id' => User::factory(),
        ];
    }
}
