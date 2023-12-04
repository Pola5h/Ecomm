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
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
        // Create a new brand using factory
        $brand = Brand::factory()->create();

        // Define new data for updating the brand
        $newData = [
            'name' => 'New Brand Name',
            'image' => UploadedFile::fake()->image('brand.jpg')
        ];

        // Make a POST request to the update route
        $response = $this->put(route('admin.brand.update', $brand->slug), $newData);

        // Assert that the response status is a redirect to the brand index page
        $response->assertRedirect(route('admin.brand.index'));


        // Assert that the response status is 302
        $response->assertStatus(302);


        // Assert that the brand's name has been updated in the database
        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => $newData['name'],
            'slug' => Str::slug($newData['name'], '-')
        ]);

        // Assert that the brand's image has been updated in the database
        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'image' => Str::slug($newData['name'], '-') . '.jpg'
        ]);

        // Assert that the old image has been deleted
        $this->assertFileDoesNotExist(public_path('brand/' . $brand->image));

        // Assert that the new image exists
        $this->assertFileExists(public_path('brand/' . Str::slug($newData['name'], '-') . '.jpg'));
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
