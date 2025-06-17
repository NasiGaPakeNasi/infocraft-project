<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy'); // Tambahkan baris ini
});

// ... kode selanjutnya ...



    
});

// Rute untuk menampilkan detail postingan (bisa diakses siapa saja)
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Rute untuk halaman home default Laravel (biasanya sudah ada dari Auth scaffolding)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');