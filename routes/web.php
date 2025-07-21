<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController; // Jangan lupa tambahkan ini di atas
use App\Http\Controllers\CategoryController; // <-- Jangan lupa tambahkan ini di atas
use App\Http\Controllers\Admin\DashboardController; // <-- Tambahkan ini di atas
use App\Http\Controllers\Admin\PostController as AdminPostController; // <-- Tambahkan ini di atas
use App\Http\Controllers\Admin\CommentController as AdminCommentController; // <-- Tambahkan ini di atas
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController; // <-- Tambahkan ini di atas
use App\Http\Controllers\PostLikeController; // <-- Jangan lupa tambahkan ini di atas


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Auth::routes();

// Rute yang memerlukan autentikasi (hanya bisa diakses jika sudah login)
Route::middleware(['auth'])->group(function () {
    // Rute untuk menambah postingan
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Rute untuk mengedit dan mengupdate postingan
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');

    // Rute untuk menghapus postingan (akan kita tambahkan nanti)
    // Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
// ... kode sebelumnya ...

// Rute yang memerlukan autentikasi (hanya bisa diakses jika sudah login)
Route::middleware(['auth'])->group(function () {
    // Rute untuk menambah postingan
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Rute untuk mengedit dan mengupdate postingan
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');

    // Rute untuk menghapus postingan
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy'); 
    // Tambahkan baris ini

      // Route untuk menyimpan komentar
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Route untuk mengupdate komentar
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update'); // <-- Tambahkan ini

    // Route untuk menghapus komentar
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // <-- Tambahkan ini
});

// ... kode selanjutnya ...

// Route yang memerlukan login
Route::middleware(['auth'])->group(function () {
    // Route untuk menyimpan komentar
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});    
});

// Rute untuk menampilkan detail postingan (bisa diakses siapa saja)
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Rute untuk halaman home default Laravel (biasanya sudah ada dari Auth scaffolding)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route untuk menampilkan postingan berdasarkan kategori
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Route untuk menangani pencarian
Route::get('/search', [PostController::class, 'search'])->name('search');


// --- GRUP UNTUK SEMUA ROUTE ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Nanti semua route admin lainnya kita letakkan di sini
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Route untuk manajemen postingan oleh admin
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk postingan
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    
    // Rute untuk komentar
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... route admin lainnya
    Route::resource('/categories', AdminCategoryController::class)->except(['show']);
});

Route::middleware(['auth'])->group(function () {
    // ... (route-route Anda yang lain)

    // Route untuk Like & Unlike Postingan
    Route::post('/posts/{post}/like', [PostLikeController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [PostLikeController::class, 'unlike'])->name('posts.unlike');
});