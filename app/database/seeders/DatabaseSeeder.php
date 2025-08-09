<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\ServiceEnum;
use App\Enums\UserRoleEnum;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => fake()->name(),
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::ADMIN
        ]);
        User::create([
            'name' => fake()->name(),
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::USER,
        ]);
        for ($i = 0; $i < 100; $i++) {
             Service::create([
                'name'=> fake()->name(). $i,
                'uid' => str_unique_with_prefix('se-'),
                'image_url' => 'https://www.realsimple.com/thmb/uWsB5XxJNwi4CihWKBv_BmQ4aWY=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/dabito-living-room-7297f95db79240d095734d010681d23e.png',
                'description' => fake()->text(50),
                'price' => fake()->randomFloat(3,2,0),
                'status' =>ServiceEnum::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
             ]);
        }

        //          $this->call([
        // 	AuthorsBooksSeeder::class,
        // ]);
        // User::factory(10)->create();

        // Author::factory(20)->create()->each(function ($author) {
        //     $author->books()->saveMany(Book::factory(10)->make());
        // });
    }
}
