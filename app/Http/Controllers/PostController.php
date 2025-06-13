<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini jika belum ada
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk akses user yang login

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
        // Pastikan hanya user yang sudah login yang bisa mengakses halaman ini
        // Anda bisa menambahkan middleware 'auth' di route atau di constructor controller
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
        // Pastikan hanya user yang sudah login yang bisa menambah postingan
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambah postingan.');
        }

        // 1. Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'title' => 'required|max:255|unique:posts', // Judul wajib, maks 255 karakter, harus unik
            'content' => 'required', // Konten wajib
            'image' => 'nullable|image|file|max:2048', // Gambar tidak wajib, harus file gambar, maks 2MB
        ]);

        // 2. Buat slug otomatis dari judul
        $validatedData['slug'] = Str::slug($request->title);

        // 3. Simpan gambar jika ada
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/post-images'
            $imagePath = $request->file('image')->store('post-images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // 4. Masukkan user_id dari user yang sedang login
        $validatedData['user_id'] = Auth::id();

        // 5. Simpan postingan baru ke database
        Post::create($validatedData);

        // 6. Redirect ke halaman daftar postingan dengan pesan sukses
        return redirect()->route('posts.index')->with('success', 'Postingan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) // Menggunakan Route Model Binding
    {
        return view('posts.show', compact('post'));
    }

    // Method edit, update, destroy akan ditambahkan nanti
    // ...
}