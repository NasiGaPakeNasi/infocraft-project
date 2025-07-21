<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        // Ambil 5 postingan terakhir dari user ini
        $posts = $user->posts()->latest()->paginate(5);

        // Ambil 5 komentar terakhir dari user ini
        $comments = $user->comments()->latest()->paginate(5, ['*'], 'comments_page');

        // Kirim semua data ke view
        return view('profile.show', [
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
        ]);
    }
}