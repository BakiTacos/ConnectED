<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\User::create([
        'full_name' => 'Michael UMN',
        'email' => 'michael@umn.ac.id',
        'password' => bcrypt('password123'), // Password harus di-hash!
        'role' => 'mahasiswa',
        'avatar_image' => 'https://ui-avatars.com/api/?name=Michael+UMN&background=random',
        'nim' => '00000012345',
        'study_program' => 'Informatika'
    ]);
}
}
