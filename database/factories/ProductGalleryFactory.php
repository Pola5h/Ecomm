<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductGallery>
 */
class ProductGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
            'product_id' => $this->faker->numberBetween(1, 20), // Adjust the range as needed
            'image' => 't-product-' . $this->faker->randomElement(['01', '02', '03']) . '.png', // Generate a random image URL, adjust as needed
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
