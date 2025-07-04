// Buka file: database/seeders/PostSeeder.php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'user_id' => 1, // ID Admin
            'title' => 'Selamat Datang di Infocraft!',
            'content' => 'Ini adalah postingan pertama di website Infocraft. Selamat menikmati fitur-fitur yang ada! Anda bisa mulai menulis postingan baru, memberikan komentar, atau membalas komentar yang sudah ada.',
        ]);

        Post::create([
            'user_id' => 2, // ID User Biasa
            'title' => 'Tips & Trik Bermain Minecraft Survival',
            'content' => 'Berikut adalah beberapa tips untuk pemula yang baru bermain mode survival di Minecraft. Pertama, segera cari pohon dan buat alat-alat dasar. Kedua, bangun tempat berlindung sebelum malam tiba untuk menghindari monster. Semoga membantu!',
        ]);
    }
}