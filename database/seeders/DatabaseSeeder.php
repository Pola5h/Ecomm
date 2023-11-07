<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;

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
     \App\Models\Product::factory(20)->create();


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
                'created_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => Hash::make('user1234'), // Hash the password
                'user_type' => '2',
                'about' => 'This is user',
                'image' => 'user.jpg',
                'created_at' => now(),
            ],
        ];

        User::insert($users);
 




    }
}
