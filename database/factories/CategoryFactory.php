<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_name = $this->faker->unique()->words($nb = 2, $asText = true);
        $slug = Str::slug($category_name, '-');
        $icon = 't-product-' . $this->faker->randomElement(['01', '02', '03']) . '.png';
        return [
            'name' => $category_name,
            'slug' => $slug,
            'icon' => $icon
        ];
    }
}
