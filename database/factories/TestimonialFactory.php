<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            

            'client_name' => $this->faker->name,
            'image' => 'testimonials.png', // Assuming you want a random image URL
            'designation' => $this->faker->jobTitle,
            'testimonial' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),


        ];
    }
}
