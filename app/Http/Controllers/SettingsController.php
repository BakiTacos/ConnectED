<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;


class SettingsController extends Controller
{
    // 1. Menampilkan Halaman Settings (Profil, Jadwal, Notif, Riwayat)
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ambil tab dari URL, default ke 'profil' jika tidak ada
        $active_tab = $request->query('tab', 'profil');

        $schedules = \App\Models\Booking::with('psychologist')
        ->where('user_id', $user->user_id)
        ->whereIn('status', ['Pending', 'Accepted', 'Rescheduled', 'Waiting'])
        ->orderBy('booking_date', 'asc')
        ->get();

        // Data untuk Tab Jadwal (Status aktif)
        $upcoming_schedules = Booking::where('user_id', $user->user_id)
            ->whereIn('status', ['Pending', 'Accepted', 'Waiting', 'Reschedule'])
            ->with('psychologist')
            ->orderBy('booking_date', 'asc')
            ->get();

        // Data untuk Tab Riwayat (Status selesai/batal)
        $history = \App\Models\Booking::with('psychologist')
        ->where('user_id', $user->user_id)
        ->whereIn('status', ['Completed', 'Cancelled', 'Rejected']) 
        ->orderBy('booking_date', 'desc')
        ->get();
        // Data Mockup untuk Notifikasi
        $notifications = [
            [
                'title' => 'Consultation Rescheduled',
                'message' => 'Jadwal konsultasi bersama Yanuar Lurisa Aldio, S.Psi pada tanggal 17 November 2025 dijadwalkan ulang.',
                'type' => 'danger',
                'date' => '2 jam yang lalu',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100'
            ],
            [
                'title' => 'Consultation Reminder',
                'message' => 'Anda memiliki jadwal konsultasi bersama Yanuar Lurisa Aldio, S.Psi dalam 30 menit.',
                'type' => 'warning',
                'date' => '5 jam yang lalu',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100'
            ],
            [
                'title' => 'Career Day segera datang !!',
                'message' => 'Career Day akan segera tiba di UMN lho! Kapan lagi ada kesempatan tanya jawab langsung.',
                'type' => 'info',
                'date' => '1 hari yang lalu',
                'image' => null
            ],
            [
                'title' => 'Hi Michael!',
                'message' => 'Selamat datang di ConnectED! Kami senang untuk bertemu anda disini.',
                'type' => 'warning',
                'date' => '3 hari yang lalu',
                'image' => null
            ]
        ];

        // PERBAIKAN UTAMA DI SINI:
        // Kirim SEMUA variabel ke view menggunakan compact
        return view('settings.index', compact(
            'user', 
            'active_tab', 
            'schedules', 
            'history',
            'notifications'
        ));
    }

    // app/Http/Controllers/SettingsController.php

        public function update(Request $request)
        {
            // Menggunakan Auth::id() lebih aman
            $user = User::find(Auth::id()); 

            // Validasi
            $request->validate([
                'name' => 'required|string|max:255',
                'avatar_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'phone' => 'nullable|numeric',          // Validasi No WA
                'guardian_phone' => 'nullable|numeric', // Validasi No Wali
            ]);

            // Update Data
            $user->name = $request->name;
            $user->phone = $request->phone; 
            $user->guardian_phone = $request->guardian_phone;

            // Upload Foto (Jika ada)
            if ($request->hasFile('avatar_image')) {
                // ... logika upload foto Anda ...
            }

            $user->save(); // Simpan ke database

            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        }
}