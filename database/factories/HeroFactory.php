<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hero>
 */
class HeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $smallTitle = "test Small Title";
        $bigTitle = "test Big Title";
        $banner = 'chair.png';
        $discount = $this->faker->numberBetween(10, 100);
        $status = 1;

        return [
            'small_title' => $smallTitle,
            'big_title' => $bigTitle,
            'banner' => $banner,
            'discount' => $discount,
            'status' => $status,
        ];
    }
}
