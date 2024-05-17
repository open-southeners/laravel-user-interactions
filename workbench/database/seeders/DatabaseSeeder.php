<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Workbench\App\Models\Post;
use Workbench\App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => 'unsafe',
        ]);

        User::create([
            'name' => 'Rubén Robles',
            'email' => 'ruben@opensoutheners.com',
            'password' => 'unsafe',
        ]);

        Post::create([
            'title' => 'Laravel is a great framework',
            'content' => 'It made everything easier for web developers',
        ]);

        Post::create([
            'title' => 'Hello world',
            'content' => 'This is a hello world',
        ]);
    }
}
