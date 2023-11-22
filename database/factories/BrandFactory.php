<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company,
            'slug' => $this->faker->unique()->slug,
            'image' => 'brand-logo-' . $this->faker->randomElement(['01', '02', '03','04','05','06','07']) . '.png',
            'description' => $this->faker->paragraph,
        ];
    }
    
}
