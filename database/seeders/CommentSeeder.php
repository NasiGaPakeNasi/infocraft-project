// Buka file: database/seeders/CommentSeeder.php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // Komentar utama di postingan pertama
        $comment1 = Comment::create([
            'user_id' => 2, // User Biasa
            'post_id' => 1, // Postingan "Selamat Datang"
            'body' => 'Wow, keren sekali websitenya! Semangat terus!'
        ]);

        // Balasan untuk komentar di atas
        Comment::create([
            'user_id' => 1, // Admin
            'post_id' => 1,
            'parent_id' => $comment1->id, // Ini adalah balasan
            'body' => 'Terima kasih atas dukungannya!'
        ]);
    }
}