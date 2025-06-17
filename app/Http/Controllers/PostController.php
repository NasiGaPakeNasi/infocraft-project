<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambah postingan.');
        }

        return view('posts.create');
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
        ]);

        $validatedData['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['user_id'] = Auth::id();

        Post::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Postingan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Anda tidak diizinkan mengedit postingan ini.');
        }

        return view('posts.edit', compact('post'));
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