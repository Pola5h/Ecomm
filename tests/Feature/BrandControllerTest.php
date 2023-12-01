<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Str;
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
    
        // Assuming you have a Brand model and a brand instance for testing
        $brand = Brand::factory()->create();
    
        // Mock a request with sample data
        $requestData = [
            'name' => 'Updated Brand',
            'image' => 'brand.png', // Ensure consistency with your storage assertions
            'description' => 'xyz'
        ];

    
        // Perform the update using the mocked request
        $response = $this->put(route('admin.brand.update', ['brand' => $brand->slug]), $requestData);
    
        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => $requestData['name'],
            'slug' => Str::slug($requestData['name'], '-'),
            'description' => $requestData['description'],

            // Add other fields as needed
        ]);
    
        // Assert that the brand image has been uploaded and saved
        Storage::disk('public')->assertExists('brand/' . Str::slug($requestData['name'], '-') . '.' . pathinfo($requestData['image'], PATHINFO_EXTENSION));
    
        // Optionally, assert that the old image has been deleted
        if ($brand->image) {
            Storage::disk('public')->assertMissing('brand/' . $brand->image);
        }
    
        // Optionally, assert any flash messages or other response expectations
        $this->assertTrue(session()->has('toastr_message.success'));
    
        // Assert the response is a redirect
        $response->assertRedirect(route('admin.brand.index'));
    
        // Refresh the brand instance to get the updated data from the database
        $response->assertStatus(200);

        // Reload the brand from the database to get the updated data
        $updatedBrand = $brand->fresh();
    
        // Assert that the updated data matches the expected attributes
        $this->assertEquals('Updated Brand', $updatedBrand->name);
        $this->assertEquals('updated-brand', $updatedBrand->slug);
        $this->assertEquals('xyz', $updatedBrand->description);
    
        // Optionally, assert other expectations based on your application logic
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
