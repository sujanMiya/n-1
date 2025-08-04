<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
             User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => UserEnum::ADMIN
        ]);
        //          $this->call([
        // 	AuthorsBooksSeeder::class,
    	// ]);
        // User::factory(10)->create();

    // Author::factory(20)->create()->each(function ($author) {
    //     $author->books()->saveMany(Book::factory(10)->make());
    // });
    }
}
