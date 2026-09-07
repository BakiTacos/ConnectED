<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSlide; 
use App\Models\Psychologist; // <--- Tambahkan Model ini

class HomeController extends Controller
{
    public function index()
    {
        // 1. DATA DUMMY UNTUK HERO SLIDER (Agar tidak muncul "Data Belum Tersedia")
        $slides = [
            (object)[
                'image_url' => 'https://images.unsplash.com/photo-1527689368864-3a821dbccc34?q=80&w=1920&auto=format&fit=crop',
                'title' => 'Kesehatan Mental Prioritas Utama',
                'description' => 'Jangan ragu untuk mencari bantuan. Kesehatan mentalmu sama pentingnya dengan kesehatan fisik.',
                'cta_text' => 'Hubungi Kami',
                'cta_link' => 'about'
            ],
            (object)[
                'image_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1920&auto=format&fit=crop',
                'title' => 'Ruang Aman untuk Bercerita',
                'description' => 'Temukan ketenangan dan solusi profesional bersama para psikolog kami.',
                'cta_text' => 'Jadwalkan Sesi',
                'cta_link' => 'booking'
            ],
            (object)[
                'image_url' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1920&auto=format&fit=crop',
                'title' => 'Bicara adalah Langkah Pertama',
                'description' => 'Mulailah langkahmu bersama ConnectED, kami hadir untuk mendengar tanpa menghakimi.',
                'cta_text' => 'Mulai Konsultasi',
                'cta_link' => 'booking'
            ]
        ];

        // 2. DATA DUMMY PSIKOLOG (Untuk Slider Profil)
        $psychologists = [
            [
                'id' => 1,
                'name' => 'Yanuar Lurisa Aldio, S.Psi',
                'role' => 'Psikolog Klinis Dewasa',
                'image' => null, // Nanti otomatis jadi avatar
                'specialty' => 'Depression, Burnout'
            ],
            [
                'id' => 2,
                'name' => 'Ignatia Ria Natalia, M.Psi',
                'role' => 'Psikolog Pendidikan',
                'image' => null,
                'specialty' => 'Academic Stress, Career'
            ],
            [
                'id' => 3,
                'name' => 'Sonny Tirta Luzanil, M.Psi',
                'role' => 'Psikolog Klinis',
                'image' => null,
                'specialty' => 'Anxiety, Trauma'
            ],
            [
                'id' => 4,
                'name' => 'Fiona Valentina Damanik, M.Psi',
                'role' => 'Psikolog Remaja',
                'image' => null,
                'specialty' => 'Self-Harm, Family Issues'
            ]
        ];

        // Kirim semua data ke View
        return view('welcome', compact('slides', 'psychologists'));
    }
    public function about()
    {
        // Ambil semua psikolog untuk section "Meet Our Team"
        $psychologists = \App\Models\Psychologist::all();

        // Ambil data seminar (jika ada modelnya, ambil 3 terbaru)
        // Jika belum ada tabel seminars, nanti kita pakai data dummy di view
        $seminars = \App\Models\Seminar::limit(3)->get(); 

        return view('about', compact('psychologists', 'seminars'));
    }
    public function individual() {
        return view('services.individual');
    }

    public function kelompok() {
        return view('services.kelompok');
    }

    public function narasumber() {
        return view('services.narasumber');
    }
}
