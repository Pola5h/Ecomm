<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Hero;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\backend\HeroController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HeroControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    public function testIndex()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);

        // Access the index route
        $response = $this->get(route('admin.hero.index'));

        // Assert the expected HTTP status code for a successful view (e.g., 200)
        $response->assertStatus(200);

        // Add additional assertions if needed
    }

    public function testStore()
    {
        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
        Storage::fake('public'); // Mocks storage

        $data = [
            'small_title' => 'Test Small Title',
            'big_title' => 'Test Big Title',
            'discount' => 10,
            'banner' => UploadedFile::fake()->image('test_banner.jpg')
        ];

        $response = $this->post(route('admin.hero.store'), $data);

        $response->assertStatus(302); // Assuming a redirect on successful store

    }

    public function testDistroy()
    {
        // Create a hero
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
        $hero = Hero::factory()->create();

        // Make a DELETE request to the destroy route
        $response = $this->delete(route('admin.hero.destroy', $hero->id));

        // Assert the expected HTTP status code for a successful destroy (e.g., 302 for redirect)
        $response->assertStatus(302);
    }
}
