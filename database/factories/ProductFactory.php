<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



     public function definition()
     {
         $product_name = $this->faker->unique()->words($nb = 6, $asText = true);
         $slug = Str::slug($product_name, '-');
 
         return [
            'name' => $product_name,
            'slug' => $slug,
            'thumbnail' => 't-product-' . $this->faker->randomElement(['01', '02', '03']) . '.png',
            'category_id' => $this->faker->numberBetween(1, 5),
            'brand_id' => $this->faker->numberBetween(1, 5),
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'price' => $this->faker->numberBetween(10, 500),
            'discount' => $this->faker->randomFloat(2, 0, 1),
            'status' => $this->faker->boolean,
            'featured' => $this->faker->boolean,
            'stock_quantity' => $this->faker->numberBetween(10, 50),
        ];
        
     }
     
}
