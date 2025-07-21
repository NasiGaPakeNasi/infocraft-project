<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category; // <-- Tambahkan ini


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5); 
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
{
    // 1. Validasi input pencarian
    $request->validate([
        'query' => 'required|min:3',
    ]);

    // 2. Ambil kata kunci dari input
    $query = $request->input('query');

    // 3. Lakukan pencarian di database
    $posts = Post::where('title', 'like', "%{$query}%")
                 ->orWhere('content', 'like', "%{$query}%")
                 ->latest()
                 ->paginate(5);

    // 4. Kirim hasil ke view
    return view('search.results', [
        'posts' => $posts,
        'query' => $query,
    ]);
}

public function create()
{
    return view('posts.create', [
        'categories' => Category::all()
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambah postingan.');
        }

    $validatedData = $request->validate([
        'title' => 'required|max:255|unique:posts',
        'content' => 'required',
        'image' => 'nullable|image|file|max:2048',
        'categories' => 'nullable|array' // <-- Validasi baru
    ]);

        $validatedData['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['user_id'] = Auth::id();

         $post = Post::create($validatedData);
             // Simpan relasi kategori
    if ($request->has('categories')) {
        $post->categories()->sync($request->categories);
    }

         return redirect()->route('posts.index')->with('success', 'Postingan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
 /**
 * Menampilkan detail satu postingan.
 */
public function show(Post $post)
{
    // Tambahkan +1 ke views_count setiap kali halaman ini dibuka
    $post->increment('views_count');

    return view('posts.show', compact('post'));
}

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Post $post)
    // {
    //     if (Auth::id() !== $post->user_id) {
    //         return redirect()->route('posts.index')->with('error', 'Anda tidak diizinkan mengedit postingan ini.');
    //     }

    //     return view('posts.edit', compact('post'));
    // }

public function edit(Post $post)
{
    $this->authorize('update', $post);
    return view('posts.edit', [
        'post' => $post,
        'categories' => Category::all()
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Anda tidak diizinkan mengupdate postingan ini.');
        }

        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|file|max:2048',
        ];

        $rules['categories'] = 'nullable|array';
        $validatedData = $request->validate($rules);

        if ($request->title !== $post->title) {
            $rules['title'] .= '|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->title !== $post->title) {
            $validatedData['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('post-images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $post->update($validatedData);

          // Update relasi kategori
    $post->categories()->sync($request->categories ?? []);

        return redirect()->route('posts.show', $post->slug)->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Anda tidak diizinkan menghapus postingan ini.');
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Postingan berhasil dihapus!');
    }
} // <--- PASTIKAN INI ADALAH PENUTUP CLASS PostController