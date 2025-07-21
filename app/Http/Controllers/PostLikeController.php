<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya user yang login yang bisa like/unlike
        $this->middleware('auth');
    }

    public function like(Post $post)
    {
        // Hubungkan user yang sedang login dengan postingan ini
        $post->likes()->attach(auth()->user()->id);

        return back(); // Kembali ke halaman sebelumnya
    }

    public function unlike(Post $post)
    {
        // Putuskan hubungan user yang sedang login dengan postingan ini
        $post->likes()->detach(auth()->user()->id);

        return back(); // Kembali ke halaman sebelumnya
    }
}