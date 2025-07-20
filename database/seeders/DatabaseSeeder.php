<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class, // <-- TAMBAHKAN INI DI ATAS
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}