<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini jika belum ada
use App\Http\Controllers\HomeController;

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

// Rute untuk menambah postingan (hanya bisa diakses jika sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// Rute untuk menampilkan detail postingan (akan kita buat nanti)
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// Rute untuk menampilkan halaman home setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');