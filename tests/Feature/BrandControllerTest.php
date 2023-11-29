<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Testing\Assert;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function testIndex()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Access the index route
        $response = $this->get(route('admin.brand.index'));

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
            'image' => UploadedFile::fake()->image('brand_image.jpg'),
            'description' => $this->faker->paragraph,
        ];

        $response = $this->post(route('admin.brand.store'), $data);

        $response->assertStatus(302); // Assuming a redirect on successful store

        // Add additional assertions if needed
    }




    public function testEdit()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Create a brand for testing
        $brand = Brand::factory()->create();

        // Access the edit route with the brand's slug
        $response = $this->get(route('admin.brand.edit', ['brand' => $brand->id, 'slug' => $brand->slug]));

        // Assert the expected HTTP status code for a successful view (e.g., 200)
        $response->assertStatus(200);

        // Assert that the response contains the brand data
        $response->assertSee($brand->name);
        $response->assertSee($brand->image);
    }



    public function testUpdate()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
    
        // Create a brand for testing
        $brand = Brand::factory()->create();
    
        // Prepare updated brand data
        $updatedBrandData = [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
        ];
    
        // Send the PUT request to update the brand
        $response = $this->put(route('admin.brand.update', ['brand' => $brand->slug]), $updatedBrandData);
    
        // Assert the expected HTTP status code for a successful update (e.g., 302 for redirect)
        $response->assertStatus(302);
    
        // Reload the updated brand from the database
        $updatedBrand = Brand::where('id', $brand->id)->first();
    
        // Assert that the brand was updated in the database
        Assert::assertEquals($updatedBrandData['name'], $updatedBrand->name);
        Assert::assertEquals($updatedBrandData['description'], $updatedBrand->description);
    }
    

    public function testDestroy()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        Storage::fake('public');

        // Create a brand for testing
        $brand = Brand::factory()->create();

        // Get the ID of the brand
        $brandId = $brand->id;

        // Delete the brand using the route
        $response = $this->delete(route('admin.brand.destroy', ['brand' => $brandId]));

        // Assert the expected HTTP status code for a successful destroy (e.g., 302 for redirect)
        $response->assertStatus(302);

        // Add additional assertions if needed
    }
}
