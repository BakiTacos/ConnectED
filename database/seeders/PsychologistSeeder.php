<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Psychologist;

class PsychologistSeeder extends Seeder
{
    public function run()
    {
        // Data Dummy Sesuai Gambar Referensi
        $counselors = [
            [
                'name' => 'Yanuar Lurisa Aldio',
                'title' => 'S.Psi., M.Psi., Psikolog',
                'role' => 'Psikolog Klinis Dewasa',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/psikolog1.png?raw=true',
                'available_days' => 'Monday, Tuesday, Wednesday, Thursday, Friday', // Tersedia setiap hari kerja
            ],
            [
                'name' => 'Ignatia Ria Natalia',
                'title' => 'M.Psi., Psikolog',
                'role' => 'Psikolog Pendidikan',
                'image_url' => 'https://ui-avatars.com/api/?name=Ignatia+Ria&background=FFD700&color=fff&size=200',
                'available_days' => 'Monday, Tuesday, Wednesday, Thursday, Friday',
            ],
            [
                'name' => 'Sonny Tirta Luzanil',
                'title' => 'M.Psi., Psikolog',
                'role' => 'Psikolog Industri',
                'image_url' => 'https://ui-avatars.com/api/?name=Sonny+Tirta&background=0D8ABC&color=fff&size=200',
                'available_days' => 'Monday, Wednesday, Friday',
            ],
            [
                'name' => 'Fiona Valentina Damanik',
                'title' => 'M.Psi., Psikolog',
                'role' => 'Psikolog Klinis Anak',
                'image_url' => 'https://ui-avatars.com/api/?name=Fiona+Valentina&background=E91E63&color=fff&size=200',
                'available_days' => 'Tuesday, Thursday',
            ]
        ];

        foreach ($counselors as $data) {
            Psychologist::create($data);
        }
    }
}