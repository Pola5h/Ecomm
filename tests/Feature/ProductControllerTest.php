<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function testIndex()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Access the index route
        $response = $this->get(route('admin.product.index'));

        // Assert the expected HTTP status code for a successful view (e.g., 200)
        $response->assertStatus(200);

        // Add additional assertions if needed
    }

    public function testStore()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
    
        Storage::fake('public');
    
        $data = [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'stock_quantity' => $this->faker->randomNumber(),
            'category_id' => $this->faker->randomNumber(),
            'brand_id' => $this->faker->randomNumber(),
            'featured' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'thumbnail' => UploadedFile::fake()->image('product_thumbnail.jpg'),
        ];
    
        $response = $this->post(route('admin.product.store'), $data);
    
        $response->assertStatus(200);
    
        // Add additional assertions if needed
    }
    
    public function testEdit()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
    
        // Create a product
        $product = Product::factory()->create();
    
        // Call the edit method
        $response = $this->get(route('admin.product.edit', ['product' => $product->slug]));
    
        // Assert the response status is 200 (OK)
        $response->assertStatus(200);
    
    }
    
    public function testDestroy()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        Storage::fake('public');

        // Create a product for testing
        $product = Product::factory()->create();

        // Delete the product using the route
        $response = $this->delete(route('admin.product.destroy', ['product' => $product->slug]));

        // Assert the expected HTTP status code for a successful destroy (e.g., 302 for redirect)
        $response->assertStatus(302);

        // Add additional assertions if needed
    }

}
