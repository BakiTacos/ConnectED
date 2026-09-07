<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Counseling; 
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Tambahan untuk password
use Carbon\Carbon;

class AdminController extends Controller
{
    // ==========================================
    // 1. DASHBOARD & PROFILE
    // ==========================================
    public function dashboard()
    {
        $user = Auth::user(); 

        // Query Dasar
        $studentQuery = User::where('role', 'student');
        $counselingQuery = Booking::where('status', 'Completed');
        $bookingQuery = Booking::where('status', 'Pending');

        // LOGIKA PEMISAH (POV)
        if ($user->role == 'psychologist') {
            $counselingQuery->where('psychologist_id', $user->user_id);
            $bookingQuery->where('psychologist_id', $user->user_id);
        }

        $stats = [
            'total_students' => $studentQuery->count(),
            'total_counseling' => $counselingQuery->count(),
            'total_booking' => $bookingQuery->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    public function profile()
    {
        $user = Auth::user(); 
        
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'nik' => $user->nim ?? '00000247211', // Gunakan data asli jika ada
            'phone' => $user->whatsapp ?? $user->phone ?? '-', 
            'description' => 'Konselor profesional UMN...',
            'expertise' => ['Depression', 'Burnout', 'Insomnia']
        ];
        
        return view('admin.profile', compact('data'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|numeric',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        // Sesuaikan dengan nama kolom di database Anda (misal: phone atau whatsapp)
        if(isset($user->whatsapp)) {
            $user->whatsapp = $request->phone;
        } else {
            $user->phone = $request->phone;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // ==========================================
    // 2. MASTER DATA (Student, Psychologist, dll)
    // ==========================================
    public function studentData(Request $request)
    {
        $query = User::where('role', 'student');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $students = $query->orderBy('created_at', 'desc')->get();
        return view('admin.master.student', compact('students'));
    }

    public function psychologistData()
    {
        $psychologists = User::whereIn('role', ['admin', 'psychologist'])->get();
        return view('admin.master.psychologist', compact('psychologists'));
    }

    public function counselingData()
    {
        $counselings = Counseling::with(['student', 'psychologist'])->get();
        return view('admin.master.counseling', compact('counselings'));
    }

    // ==========================================
    // 3. LOGIKA BOOKING UTAMA (List, Actions)
    // ==========================================
    
    // --- LIST BOOKING (Masuk & Proses) ---
    public function listBooking()
    {
        $user = Auth::user();

        // [PERBAIKAN UTAMA]
        // Tambahkan 'Accepted' agar data TIDAK HILANG setelah diklik Terima.
        // Data hanya hilang jika statusnya Completed/Rejected/Cancelled (masuk history).
        $query = Booking::with('user')
            ->whereIn('status', ['Pending', 'Rescheduled', 'Accepted']);

        // Filter Psikolog
        if ($user->role == 'psychologist') {
            $query->where('psychologist_id', $user->user_id);
        }

        $rawBookings = $query->orderBy('booking_date', 'asc')->get();

        // Transformasi Data untuk View
        $bookings = $rawBookings->map(function ($item) {
            return [
                'id' => $item->booking_id ?? $item->id, // Handle beda nama PK
                'date' => Carbon::parse($item->booking_date)->translatedFormat('d M Y'),
                'time' => $item->booking_time,
                'name' => $item->user->name ?? 'User Terhapus',
                'nim' => $item->user->nim ?? '-',
                'type' => $item->type,
                'status' => $item->status,
                // Actions ditangani logic di Blade berdasarkan status
            ];
        });
                        
        return view('admin.booking.list', compact('bookings'));
    }

    // --- RIWAYAT (Selesai/Batal) ---
    public function historyBooking(Request $request)
    {
        $user = Auth::user();

        $query = Booking::with('user')->whereIn('status', ['Completed', 'Cancelled', 'Rejected']);

        if ($user->role == 'psychologist') {
            $query->where('psychologist_id', $user->user_id);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search){
                $q->where('name', 'like', '%'.$search.'%');
            });
        }

        $history = $query->orderBy('booking_date', 'desc')->get();
        return view('admin.booking.history', compact('history'));
    }

    // --- JADWAL KALENDER ---
    public function scheduleBooking(Request $request)
    {
        $user = Auth::user();
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $query = Booking::with('user')
            ->where('status', 'Accepted')
            ->whereMonth('booking_date', $month)
            ->whereYear('booking_date', $year);

        if ($user->role == 'psychologist') {
            $query->where('psychologist_id', $user->user_id);
        }

        $bookings = $query->get();

        // Logic Kalender Mingguan
        $startOfWeek = Carbon::createFromDate($year, $month, 1)->startOfWeek(Carbon::MONDAY);
        $weekDates = [];
        for ($i = 0; $i < 5; $i++) { 
            $date = $startOfWeek->copy()->addDays($i);
            $weekDates[] = [
                'day_name' => $date->translatedFormat('D'),
                'day_date' => $date->format('d'),
                'full_date' => $date->format('Y-m-d'),
            ];
        }

        if ($user->role == 'admin') {
            $psychologists = User::whereIn('role', ['admin', 'psychologist'])->limit(4)->get();
        } else {
            $psychologists = User::where('user_id', $user->user_id)->get();
        }

        return view('admin.booking.schedule', compact('bookings', 'weekDates', 'psychologists', 'month', 'year'));
    }

    // ==========================================
    // 4. AKSI TOMBOL (Terima, Selesai, Reschedule)
    // ==========================================

    // TERIMA JADWAL
    public function acceptBooking($id)
    {
        // Gunakan findOrFail agar jika ID salah langsung 404
        $booking = Booking::findOrFail($id);
        
        $booking->status = 'Accepted';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil diterima! Silakan selesaikan sesi nanti.');
    }

    // SELESAIKAN SESI (Memindahkan ke Riwayat)
    public function completeBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->status = 'Completed';
        $booking->save();

        return redirect()->back()->with('success', 'Sesi konseling selesai. Data dipindahkan ke Riwayat.');
    }

    // 1. TAMPILKAN FORM RESCHEDULE
    public function showRescheduleForm($id)
    {
        // Ambil data booking beserta user-nya
        $booking = Booking::with('user')->findOrFail($id);
        
        // Arahkan ke file view baru
        return view('admin.booking.reschedule', compact('booking'));
    }

    // 2. PROSES SIMPAN JADWAL BARU
    public function processReschedule(Request $request, $id)
    {
        $request->validate([
            'new_date' => 'required|date|after:today', // Tanggal harus masa depan
            'new_time' => 'required',
        ]);

        $booking = Booking::findOrFail($id);

        // Update Data
        $booking->booking_date = $request->new_date;
        $booking->booking_time = $request->new_time;
        $booking->status = 'Rescheduled'; // Ubah status agar User tahu
        $booking->save();

        // Kembali ke list dengan pesan sukses
        return redirect()->route('admin.booking.list')->with('success', 'Jadwal berhasil diubah (Rescheduled). Mahasiswa akan melihat jadwal baru.');
    }
}