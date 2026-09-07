<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking; // Pastikan model Booking diimport

class BookingController extends Controller
{
    // ==========================================
    // 1. HALAMAN UTAMA (Kalender)
    // ==========================================
    public function index()
    {
        $user = Auth::user();
        
        // Set timezone agar tanggal akurat
        date_default_timezone_set('Asia/Jakarta');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        return view('booking.index', compact('user', 'tomorrow'));
    }

    // ==========================================
    // 2. LOGIKA AJAX (Load Daftar Psikolog)
    // ==========================================
    public function getCounselors(Request $request)
    {
        $selected_date = $request->date ?? date('Y-m-d');
        
        $hari_indo = [
            'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
        ];

        // Ambil user dengan role psychologist
        $counselors = User::where('role', 'psychologist')->get();

        return view('booking.partials.counselor-list', compact('counselors', 'selected_date', 'hari_indo'));
    }

    // ==========================================
    // 3. HALAMAN DETAIL PSIKOLOG
    // ==========================================
    public function showDetails($id, Request $request)
    {
        // Cari user berdasarkan ID (pastikan primary key di model User benar)
        $psychologist = User::findOrFail($id);
        $selected_date = $request->query('date');
        
        return view('booking.details', compact('psychologist', 'selected_date'));
    }

    // ==========================================
    // 4. PROSES SIMPAN BOOKING
    // ==========================================
    public function processBooking(Request $request)
    {

        // 1. Validasi Input
        $request->validate([
            // Pastikan 'user_id' adalah nama kolom PK di tabel users Anda
            'psychologist_id' => 'required|exists:users,user_id', 
            'booking_date' => 'required',
            'booking_time' => 'required',
            'method' => 'required',
            'type' => 'required',
            'topic' => 'required',
            'description' => 'required|min:20',
        ]);

        // 2. Simpan ke Database
        $booking = Booking::create([
            'user_id' => Auth::id(),
            // INI KUNCI AGAR TIDAK SALAH ORANG (Ambil dari form)
            'psychologist_id' => $request->input('psychologist_id'), 
            'booking_date' => $request->input('booking_date'),
            'booking_time' => $request->input('booking_time'),
            'method' => $request->input('method'),
            'type' => $request->input('type'),
            'topic' => $request->input('topic'),
            'description' => $request->input('description'),
            'hope' => $request->input('hope'),
            'media' => $request->input('media'), // Tambahkan jika ada input media
            'status' => 'Pending'
        ]);

        // 3. Redirect ke Halaman Konfirmasi (Bawa ID Booking di Session)
        // Teknik ini mencegah resubmit form saat refresh
        return redirect()->route('booking.confirm')->with('success_booking_id', $booking->booking_id);
    }

    // ==========================================
    // 5. HALAMAN KONFIRMASI (SUKSES)
    // ==========================================
    public function showConfirmation()
    {
        // Cek apakah ada ID booking di session (hasil redirect tadi)
        if (!session('success_booking_id')) {
            // Jika user akses langsung URL ini tanpa booking, lempar ke home
            return redirect()->route('booking.index');
        }

        // Ambil data booking terbaru dari database berdasarkan ID di session
        // Load relasi psychologist agar namanya muncul dinamis
        $booking = Booking::with('psychologist')->find(session('success_booking_id'));

        return view('booking.confirm', compact('booking'));
    }

    // ==========================================
    // 6. HALAMAN RIWAYAT (PENTING TAMBAHAN)
    // ==========================================
    public function history()
    {
        // Ambil semua booking milik user yang login
        $bookings = Booking::with('psychologist')
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('booking.history', compact('bookings'));
    }

    // ==========================================
    // 7. BATALKAN JADWAL
    // ==========================================
    public function cancelBooking($id)
    {
        $booking = Booking::where('user_id', Auth::id())
                        ->where('booking_id', $id) // Pastikan PK tabel booking adalah booking_id
                        ->firstOrFail();

        $booking->status = 'Cancelled';
        $booking->save();

        // Redirect kembali ke riwayat dengan pesan
        return redirect()->route('booking.history')->with('status', 'Jadwal berhasil dibatalkan.');
    }
}