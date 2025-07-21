<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Menampilkan daftar semua komentar.
     */
    public function index()
    {
        $comments = Comment::latest()->with('user', 'post')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Menghapus komentar dari database.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus oleh Admin.');
    }
}