<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
public function index()
{
    $users = User::latest()->paginate(10); // Ambil 10 user terbaru per halaman

    return view('admin.dashboard', [
        'users' => $users
    ]);
}
}