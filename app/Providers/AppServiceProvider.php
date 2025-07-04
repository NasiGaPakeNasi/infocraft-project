<?php

namespace App\Providers;

use App\Models\Comment; // <-- Tambahkan ini
use App\Policies\CommentPolicy; // <-- Tambahkan ini
use Illuminate\Support\ServiceProvider;
use App\Models\Post; // <-- Tambahkan ini
use App\Policies\PostPolicy; // <-- Tambahkan ini
use Illuminate\Pagination\Paginator;
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
