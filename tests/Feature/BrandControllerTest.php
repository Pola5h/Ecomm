<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        // Your test logic for the index method
        // ...
    }

    public function testStore()
    {
        $this->withoutMiddleware(['auth', 'check_user:1']);

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

    // Add tests for other controller methods (create, show, edit, update, destroy) similarly

    // ...

    public function testDestroy()
    {
        $this->withoutMiddleware(['auth', 'check_user:1']);

        Storage::fake('public');

        // Create a brand for testing
        $brand = Brand::factory()->create();

        $response = $this->delete(route('admin.brand.destroy', ['slug' => $brand->slug]));

        $response->assertStatus(302); // Assuming a redirect on successful destroy

        // Add additional assertions if needed
    }
}
