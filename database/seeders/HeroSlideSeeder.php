<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroSlideSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel dulu agar tidak duplikat
        DB::table('hero_slides')->truncate();

        // Masukkan Data Dummy
        DB::table('hero_slides')->insert([
            [
                'image_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1000&auto=format&fit=crop',
                'title' => 'Bicara adalah Langkah Pertama',
                'description' => 'Mulailah langkahmu bersama ConnectED, kami hadir untuk mendengar tanpa menghakimi.',
                'cta_text' => 'Mulai Konsultasi',
                'cta_link' => '/booking',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1000&auto=format&fit=crop',
                'title' => 'Ruang Aman untuk Bercerita',
                'description' => 'Temukan ketenangan dan solusi profesional bersama para psikolog kami.',
                'cta_text' => 'Jadwalkan Sesi',
                'cta_link' => '/booking',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1527181152855-fc03fc7949c8?q=80&w=1000&auto=format&fit=crop',
                'title' => 'Kesehatan Mental Prioritas Utama',
                'description' => 'Jangan ragu untuk mencari bantuan. Kesehatan mentalmu sama pentingnya dengan kesehatan fisik.',
                'cta_text' => 'Hubungi Kami',
                'cta_link' => '/#tentang-kami',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}