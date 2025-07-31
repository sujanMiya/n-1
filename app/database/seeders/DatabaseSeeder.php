<?php

namespace Database\Seeders;

use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Database\Seeders\AuthorsBooksSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //          $this->call([
        // 	AuthorsBooksSeeder::class,
    	// ]);
        // User::factory(10)->create();

    // Author::factory(20)->create()->each(function ($author) {
    //     $author->books()->saveMany(Book::factory(10)->make());
    // });
    }
}
