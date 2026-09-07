<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Psychologist;
use App\Models\Booking;
use App\Models\HeroSlide;
use App\Models\Seminar;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users
        $users = [
            [
                'user_id' => 2,
                'name' => 'Michael Julio',
                'email' => 'michael@student.umn.ac.id',
                'phone' => '089697580793',
                'nim' => '00000282620',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'avatar_image' => 'https://ui-avatars.com/api/?name=Michael+Julio&background=0D8ABC&color=fff',
                'education' => 'S1/D4',
                'study_program' => 'Sistem Informasi',
                'batch_year' => '2025',
                'whatsapp' => '089697580793',
                'guardian_name' => 'Budi',
                'guardian_phone' => '08123456789',
            ],
            [
                'user_id' => 3,
                'name' => 'Admin Utama',
                'email' => 'admin@umn.ac.id',
                'phone' => '081234567890',
                'nim' => '00000247211',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'avatar_image' => 'https://ui-avatars.com/api/?name=Admin+Utama&background=3b5d84&color=fff',
                'education' => 'S1/D4',
                'study_program' => 'Sistem Informasi',
                'batch_year' => '2024',
                'whatsapp' => '081234567890',
                'guardian_name' => null,
                'guardian_phone' => null,
            ],
            [
                'user_id' => 4,
                'name' => 'Yanuar Lurisa Aldio',
                'email' => 'yanuar@umn.ac.id',
                'phone' => '081234567891',
                'nim' => '00000247212',
                'password' => Hash::make('password123'),
                'role' => 'psychologist',
                'avatar_image' => 'https://ui-avatars.com/api/?name=Yanuar+Aldio&background=10B981&color=fff',
                'education' => 'S2',
                'study_program' => 'Psikologi Klinis',
                'batch_year' => '2020',
                'whatsapp' => '081234567891',
                'guardian_name' => null,
                'guardian_phone' => null,
            ],
            [
                'user_id' => 5,
                'name' => 'Fiona Valentina Damanik',
                'email' => 'fiona@umn.ac.id',
                'phone' => '081234567892',
                'nim' => '00000247213',
                'password' => Hash::make('password123'),
                'role' => 'psychologist',
                'avatar_image' => 'https://ui-avatars.com/api/?name=Fiona+Valentina&background=E91E63&color=fff',
                'education' => 'S2',
                'study_program' => 'Psikologi Remaja',
                'batch_year' => '2020',
                'whatsapp' => '081234567892',
                'guardian_name' => null,
                'guardian_phone' => null,
            ],
            [
                'user_id' => 6,
                'name' => 'Sonny Tirta Luzanil',
                'email' => 'sonny@umn.ac.id',
                'phone' => '081234567893',
                'nim' => '00000247214',
                'password' => Hash::make('password123'),
                'role' => 'psychologist',
                'avatar_image' => 'https://ui-avatars.com/api/?name=Sonny+Tirta&background=8B5CF6&color=fff',
                'education' => 'S2',
                'study_program' => 'Psikologi Industri',
                'batch_year' => '2020',
                'whatsapp' => '081234567893',
                'guardian_name' => null,
                'guardian_phone' => null,
            ],
            [
                'user_id' => 7,
                'name' => 'Ignatia Ria Natalia',
                'email' => 'ria@umn.ac.id',
                'phone' => '081234567894',
                'nim' => '00000247215',
                'password' => Hash::make('password123'),
                'role' => 'psychologist',
                'avatar_image' => 'https://ui-avatars.com/api/?name=Ignatia+Ria&background=F59E0B&color=fff',
                'education' => 'S2',
                'study_program' => 'Psikologi Pendidikan',
                'batch_year' => '2020',
                'whatsapp' => '081234567894',
                'guardian_name' => null,
                'guardian_phone' => null,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(['user_id' => $userData['user_id']], $userData);
        }

        // 2. Seed Psychologists
        $psychologists = [
            [
                'psy_id' => 1,
                'name' => 'Yanuar Lurisa Aldio',
                'title' => 'S.Psi., M.Psi., Psikolog',
                'role' => 'Psikolog UMN',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/yanuar.jpg?raw=true',
                'specialties' => 'Depression, Burnout, Insomnia, PTSD',
                'available_days' => 'Monday,Wednesday,Thursday,Friday,Saturday'
            ],
            [
                'psy_id' => 2,
                'name' => 'Ignatia Ria Natalia',
                'title' => 'M.Psi., Psikolog',
                'role' => 'Psikolog UMN',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/ignatia.jpg?raw=true',
                'specialties' => 'Family Issue, Toxic Relationship, Anxiety',
                'available_days' => 'Monday,Tuesday,Wednesday,Thursday,Friday'
            ],
            [
                'psy_id' => 3,
                'name' => 'Fiona Valentina Damanik',
                'title' => 'M.Psi., Psikolog',
                'role' => 'Psikolog UMN',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/fiona.jpg?raw=true',
                'specialties' => 'Self-Harm, Family Issues, Anxiety',
                'available_days' => 'Tuesday,Wednesday,Thursday,Friday,Saturday'
            ],
            [
                'psy_id' => 4,
                'name' => 'Sonny Tirta Luzanil',
                'title' => 'M.Psi., Psikolog',
                'role' => 'Psikolog UMN',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/sonny.jpg?raw=true',
                'specialties' => 'Career, Burnout, Self-Development',
                'available_days' => 'Monday,Wednesday,Thursday,Friday,Saturday'
            ]
        ];

        foreach ($psychologists as $psy) {
            Psychologist::updateOrCreate(['psy_id' => $psy['psy_id']], $psy);
        }

        // 3. Seed Services
        $services = [
            [
                'service_id' => 1,
                'title' => 'Individual',
                'description' => 'Konseling yang akan dilakukan antara individu dan psikolog langsung, dengan tatap muka maupun online.',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/services-thumb/individual.png?raw=true',
                'price' => 0.00
            ],
            [
                'service_id' => 2,
                'title' => 'Kelompok',
                'description' => 'Konseling yang akan dilakukan secara kelompok dengan psikolog langsung, tatap muka maupun online.',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/services-thumb/kelompok.png?raw=true',
                'price' => 0.00
            ],
            [
                'service_id' => 3,
                'title' => 'Request Narasumber',
                'description' => 'Mahasiswa dapat request untuk menjadikan Psikolog untuk menjadi narasumber project maupun acara-acara seminar.',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/services-thumb/narasumber.png?raw=true',
                'price' => 0.00
            ]
        ];

        foreach ($services as $serv) {
            Service::updateOrCreate(['service_id' => $serv['service_id']], $serv);
        }

        // 4. Seed Hero Slides
        $heroSlides = [
            [
                'slide_id' => 1,
                'image_url' => 'https://github.com/BakiTacos/image-host/raw/main/ConnectED/hero-carousel/hero-1.png?raw=true',
                'title' => 'Bicara adalah Langkah Pertama untuk Menemukan Jalan Keluar',
                'description' => 'Mulailah langkahmu bersama ConnectED, kami hadir untuk menangani masalah kamu.',
                'cta_text' => 'Mulai Konsultasi',
                'cta_link' => 'booking',
                'sort_order' => 1
            ],
            [
                'slide_id' => 2,
                'image_url' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80&fm=webp',
                'title' => 'Kesehatan Mental Anda Adalah Prioritas Utama Kami',
                'description' => 'Temukan ketenangan dan solusi profesional bersama psikolog terbaik kami.',
                'cta_text' => 'Jadwalkan Sesi',
                'cta_link' => 'booking',
                'sort_order' => 2
            ],
            [
                'slide_id' => 3,
                'image_url' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80&fm=webp',
                'title' => 'Ruang Aman untuk Bercerita Tanpa Penghakiman',
                'description' => 'Kami mendengarkan, memahami, dan membantu anda pulih kembali.',
                'cta_text' => 'Hubungi Kami',
                'cta_link' => 'about',
                'sort_order' => 3
            ]
        ];

        foreach ($heroSlides as $slide) {
            HeroSlide::updateOrCreate(['slide_id' => $slide['slide_id']], $slide);
        }

        // 5. Seed Seminars
        $seminars = [
            [
                'seminar_id' => 1,
                'title' => 'Seminar Manajemen Stres dan Burnout Mahasiswa',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/seminar-thumb/thumb-1.png?raw=true'
            ],
            [
                'seminar_id' => 2,
                'title' => 'Mengenal Potensi Diri dan Self-Growth',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/seminar-thumb/thumb-2.png?raw=true'
            ],
            [
                'seminar_id' => 3,
                'title' => 'Membangun Mindfulness di Tengah Kesibukan Kuliah',
                'image_url' => 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/seminar-thumb/thumb-3.png?raw=true'
            ]
        ];

        foreach ($seminars as $sem) {
            Seminar::updateOrCreate(['seminar_id' => $sem['seminar_id']], $sem);
        }

        // 6. Seed Testimonials
        $testimonials = [
            [
                'review_id' => 1,
                'initials' => 'MJ',
                'service_type' => 'e-Counseling',
                'review_text' => 'Awalnya ragu buat cerita soal burnout. Tapi ternyata psikolognya suportif dan nggak nge-judge.',
                'review_date' => '21 November 2025'
            ],
            [
                'review_id' => 2,
                'initials' => 'AL',
                'service_type' => 'e-Counseling',
                'review_text' => 'Jujurly, sempet burnout parah gara-gara skripsi. Untung nyoba counseling, psikolognya keren abis.',
                'review_date' => '30 Oktober 2025'
            ],
            [
                'review_id' => 3,
                'initials' => 'KV',
                'service_type' => 'e-Counseling',
                'review_text' => 'Vibe sesi nyaman banget, bener-bener safe space buat cerita masalah yang complicated. Konselornya baik banget.',
                'review_date' => '08 November 2025'
            ],
            [
                'review_id' => 4,
                'initials' => 'JM',
                'service_type' => 'e-Counseling',
                'review_text' => 'Sangat membantu dalam mengatasi kecemasan menghadapi ujian akhir. Penjelasannya mudah dipahami.',
                'review_date' => '15 Desember 2025'
            ]
        ];

        foreach ($testimonials as $testi) {
            Testimonial::updateOrCreate(['review_id' => $testi['review_id']], $testi);
        }

        // 7. Seed Bookings
        $bookings = [
            [
                'booking_id' => 1,
                'user_id' => 2,
                'psychologist_id' => 4,
                'booking_date' => date('Y-m-d', strtotime('+1 day')),
                'booking_time' => '10:00 - 11:00',
                'method' => 'Offline',
                'type' => 'Individual',
                'topic' => 'Akademik',
                'description' => 'Saya merasa kewalahan mengatur waktu antara skripsi dan kegiatan organisasi.',
                'hope' => 'Bisa menyusun time management yang lebih baik.',
                'media' => 'Tatap Muka',
                'status' => 'Accepted'
            ],
            [
                'booking_id' => 2,
                'user_id' => 2,
                'psychologist_id' => 5,
                'booking_date' => date('Y-m-d', strtotime('+3 days')),
                'booking_time' => '13:00 - 14:00',
                'method' => 'Offline',
                'type' => 'Individual',
                'topic' => 'Pribadi & Emosi',
                'description' => 'Sering merasa cemas dan sulit tidur saat malam hari.',
                'hope' => 'Mendapatkan solusi praktis untuk meredakan cemas.',
                'media' => 'Tatap Muka',
                'status' => 'Pending'
            ],
            [
                'booking_id' => 3,
                'user_id' => 2,
                'psychologist_id' => 4,
                'booking_date' => date('Y-m-d', strtotime('-5 days')),
                'booking_time' => '10:00 - 11:00',
                'method' => 'Offline',
                'type' => 'Individual',
                'topic' => 'Pribadi & Emosi',
                'description' => 'Sesi konseling pertama tentang burnout perkuliahan.',
                'hope' => 'Evaluasi kondisi mental.',
                'media' => 'Tatap Muka',
                'status' => 'Completed'
            ]
        ];

        foreach ($bookings as $bk) {
            Booking::updateOrCreate(['booking_id' => $bk['booking_id']], $bk);
        }
    }
}