<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\FaqItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FaqItem>
 */
class FaqItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       static $i = 0;
        return [
            'order' => ++$i,
            'category_id' => $this->faker->randomElement(Category::where('model', FaqItem::class)->get()),
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph,
        ];
    }
}
