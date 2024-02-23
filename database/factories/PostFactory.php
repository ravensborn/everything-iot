<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $paragraphs = '';

        foreach ($this->faker->paragraphs(4) as $paragraph) {
            $paragraphs .= (($this->faker->paragraph . $this->faker->paragraph) . "<br><br>");
        }

        return [
            'author_id' => User::find(1)->id,
            'category_id' => 0,
            'title' => $this->faker->sentence,
            'content' => $paragraphs,
            'short_content' => $this->faker->paragraph,
            'is_commentable' => true,
        ];
    }
}
