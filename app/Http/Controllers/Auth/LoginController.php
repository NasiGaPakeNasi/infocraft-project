<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Method baru untuk mengarahkan pengguna setelah login.
     */
    public function redirectTo()
    {
        // Cek jika peran pengguna adalah 'admin'
        if (auth()->user()->isAdmin()) {
            // Arahkan ke dashboard admin
            return '/admin/dashboard';
        }

        // Jika bukan admin, arahkan ke halaman utama
        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}