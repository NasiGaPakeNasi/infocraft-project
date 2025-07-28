<?php

namespace App\Providers;

use App\Models\Comment; // <-- Tambahkan ini
use App\Policies\CommentPolicy; // <-- Tambahkan ini
use Illuminate\Support\ServiceProvider;
use App\Models\Post; // <-- Tambahkan ini
use App\Policies\PostPolicy; // <-- Tambahkan ini
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View; // <-- TAMBAHKAN INI
use App\Models\Category;             // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Paginator::useBootstrapFive(); // <-- TAMBAHKAN BARIS INI
              // Mengirim data kategori ke semua view
        // View::composer('*', function ($view) {
        //     $view->with('categories', Category::all());
        // });
        View::composer('*', function ($view) {
    // Ganti nama variabel agar tidak konflik
    $view->with('global_categories', Category::all()); 

        // Definisikan Gate untuk 'is_admin'
    Gate::define('is_admin', function ($user) {
        return $user->isAdmin(); // Memanggil method isAdmin() dari model User
    });
});
    }
}


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comment::class => CommentPolicy::class, // <-- Tambahkan baris ini
    ];

    // ...
}
