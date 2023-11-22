<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      \App\Models\Category::factory(10)->create();
      \App\Models\Brand::factory(10)->create();

      \App\Models\Product::factory(20)->create();
      \App\Models\ProductGallery::factory(60)->create();

      \App\Models\Testimonial::factory(4)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'), // Hash the password
                'user_type' => '1',
                'about' => 'This is admin',
                'image' => 'admin.jpg',
                'status' => true,
                'address' => 'abc',
                'phone' => '1234567890', // Add phone number
                'email_verified_at' => null,
                'remember_token' => Str::random(10), // Add remember token
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => Hash::make('user1234'), // Hash the password
                'user_type' => '2',
                'about' => 'This is user',
                'image' => 'user.jpg',
                'status' => true,
                'address' => 'xyz',
                'phone' => '0987654321', // Add phone number
                'email_verified_at' => null,
                'remember_token' => Str::random(10), // Add remember token
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        

        User::insert($users);
 




    }
}
