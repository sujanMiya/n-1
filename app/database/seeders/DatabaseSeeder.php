<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRoleEnum;
use App\Models\Service;
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
            'role' => UserRoleEnum::ADMIN
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => UserRoleEnum::USER,
        ]);
        Service::create([]);
        for ($i = 0; $i < 10; $i++) {
             Service::create([
                'name'=> 'Services'. $i,
                'uid' => 
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
