<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Menampilkan daftar semua postingan.
     */
    public function index()
    {
        // BENARKAN BAGIAN INI
        $posts = Post::latest()->with('user', 'categories')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Menghapus postingan dari database.
     */
    public function destroy(Post $post)
    {
        // Hapus gambar terkait jika ada
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // BENARKAN BAGIAN INI
        $post->delete();

        // BENARKAN BAGIAN INI
        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dihapus oleh Admin.');
    }
}