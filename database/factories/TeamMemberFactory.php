<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamMember>
 */
class TeamMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'links' => [
                [
                    'icon' => 'bi bi-mail',
                    'url' => 'https://google.com'
                ]
            ],
            'is_visible' => true,
        ];
    }
}
