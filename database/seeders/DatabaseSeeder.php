<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Admin ConnectED',
            'email' => 'admin@umn.ac.id',
            'password' => Hash::make('password123'), // Passwordnya: password123
            'role' => 'admin',
        ]);

        // 2. Buat Akun MAHASISWA (User Biasa)
        User::create([
            'name' => 'Michael Julio',
            'email' => 'michael@student.umn.ac.id',
            'password' => Hash::make('password123'), // Passwordnya: password123
            'role' => 'student',
        ]);
    }
}