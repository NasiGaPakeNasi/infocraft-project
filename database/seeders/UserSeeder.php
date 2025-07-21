<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'name' => 'Admin Infocraft',
            'email' => 'admin@infocraft.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat Akun User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@infocraft.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}