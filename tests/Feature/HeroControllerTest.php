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


    public function test_store_hero_with_valid_data()
    {
        // Create a new request with valid data
        $request = new Request([
            'small_title' => 'Small Title',
            'big_title' => 'Big Title',
            'discount' => 10,
            'banner' => UploadedFile::fake()->create('hero.png', 1024, 'image/png'),
        ]);

        // Mock the Hero model's save method
        $hero = $this->mock(Hero::class);
        $hero->expects('save')->once();

        // Mock the toastr()->success method
        $toastr = $this->mock(Toastr::class);
        $toastr->expects('success')->once();

        // Call the store function
        $controller = new HeroController();
        $controller->store($request);

        // Assert that the hero was created with the correct data
        $this->assertEquals('Small Title', $hero->small_title);
        $this->assertEquals('Big Title', $hero->big_title);
        $this->assertEquals(10, $hero->discount);
        $this->assertEquals('hero' . uniqid() . '.png', $hero->banner);

        // Assert that the banner was uploaded to the public/hero directory
        $this->assertFileExists(public_path('hero/' . $hero->banner));
    }
    public function testDestroy()
    {

        // Create a user with user_type = 1 and authenticate them
        $user = User::factory()->create(['user_type' => 1]);
        $this->actingAs($user);
        // Create a new hero
        $hero = Hero::factory()->create();


        // Get the count of heroes before deletion
        $beforeCount = Hero::count();

        // Call the destroy method
        $response = $this->delete("/hero/{$hero->id}");

        // Assert the hero was deleted successfully
        $this->assertEquals($beforeCount - 1, Hero::count());

        // Assert the hero's image was deleted
        $this->assertFileDoesNotExist(public_path('hero/' . $hero->image));

        // Assert a success message was flashed
        $response->assertSessionHas('toastr_success', 'Hero deleted successfully');

        // Assert a redirect back to the previous page
        $response->assertRedirect(url()->previous());
    }
}
