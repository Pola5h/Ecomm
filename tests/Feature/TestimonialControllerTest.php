<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestimonialControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Access the index route
        $response = $this->get(route('admin.testimonial.index'));

        // Assert the expected HTTP status code for a successful view (e.g., 200)
        $response->assertStatus(200);

        // Add additional assertions if needed
    }

    public function testStore()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Create a fake image
        $fakeImage = UploadedFile::fake()->image('avatar.jpg');

        // Add data to the request
        $data = [
            'image' => $fakeImage,
            'name' => 'Test Name',
            'designation' => 'Test Designation',
            'testimonial' => 'Test Testimonial',
        ];

        // Call the store method
        $response = $this->post(route('admin.testimonial.store'), $data);

        // Assert a new testimonial was stored
        $this->assertDatabaseHas('testimonials', [
            'client_name' => 'Test Name',
            'designation' => 'Test Designation',
            'testimonial' => 'Test Testimonial',
            'image' => 'Test Name.jpg', // This assumes the image name is the same as the client name
        ]);

        // Assert a redirect response
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue($response->isRedirect());
    }

    public function testEdit()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Create a testimonial
        $testimonial = Testimonial::factory()->create();
        // Call the edit method
        $response = $this->get(route('admin.testimonial.edit', $testimonial->id));

        $response->assertStatus(200);

    }
    public function testUpdate()
    {
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
        // Create a new category
        $category = Testimonial::factory()->create();
    
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

    public function testDistroy()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Create a testimonial
        $testimonial = Testimonial::factory()->create();
        // Call the edit method
        $response = $this->get(route('admin.testimonial.edit', $testimonial->id));

        $response->assertStatus(200);

    }





}
