<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // Ambil semua postingan yang dimiliki kategori ini, dengan pagination
        $posts = $category->posts()->latest()->paginate(5);

        // Kirim data ke view
        return view('categories.show', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }
}