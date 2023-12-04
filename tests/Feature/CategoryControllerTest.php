<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function testIndex()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Access the index route
        $response = $this->get(route('admin.category.index'));

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
            'icon' => UploadedFile::fake()->image('category_image.jpg'),
            'description' => $this->faker->paragraph,
        ];

        $response = $this->post(route('admin.category.store'), $data);

        $response->assertStatus(302); // Assuming a redirect on successful store

        // Add additional assertions if needed
    }

    public function testEdit()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Create a category for testing
        $category = Category::factory()->create();

        // Access the edit route with the category's slug
        $response = $this->get(route('admin.category.edit', ['category' => $category->id, 'slug' => $category->slug]));

        // Assert the expected HTTP status code for a successful view (e.g., 200)
        $response->assertStatus(200);

        // Assert that the response contains the category data
        $response->assertSee($category->name);
        $response->assertSee($category->icon);
    }
   


    public function testUpdate()
    {
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
        // Create a new category
        $category = Category::factory()->create();
    
        // New data for the category
        $newData = [
            'name' => 'New Category Name',
            'image' => UploadedFile::fake()->image('new-category.jpg')
        ];
    
        // Make a POST request to the update() method
        $response = $this->put(route('admin.category.update', $category->slug), $newData);
        $response->assertRedirect(route('admin.category.index'));

        // Assert the response status
        $response->assertStatus(302);
    
        // Assert a session has 'success'
    
        // Assert a redirect to the admin.category.index route
        $response->assertRedirect(route('admin.category.index'));
    
        // Assert the category in the database has been updated
        $this->assertDatabaseHas('categories', [
            'name' => $newData['name'],
            'slug' => Str::slug($newData['name'], '-'),
            'icon' => Str::slug($newData['name'], '-') . '.jpg'
        ]);
    }
    

    public function testDestroy()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        Storage::fake('public');

        // Create a category for testing
        $category = Category::factory()->create();

        // Get the ID of the category
        $categoryId = $category->id;

        // Delete the category using the route
        $response = $this->delete(route('admin.category.destroy', ['category' => $categoryId]));

        // Assert the expected HTTP status code for a successful destroy (e.g., 302 for redirect)
        $response->assertStatus(302);

        // Add additional assertions if needed
    }
}
