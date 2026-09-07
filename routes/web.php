<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

// Halaman Utama (Homepage)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Tentang Kami
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Halaman Layanan (Konseling)
Route::prefix('konseling')->group(function () {
    Route::get('/individual', [HomeController::class, 'individual'])->name('konseling.individual');
    Route::get('/kelompok', [HomeController::class, 'kelompok'])->name('konseling.kelompok');
    Route::get('/narasumber', [HomeController::class, 'narasumber'])->name('konseling.narasumber');
});

/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES (Hanya untuk yang BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Menampilkan Form Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    
    // Memproses Data Login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATED ROUTES (Harus LOGIN dulu)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // --- LOGOUT ---
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // ==========================================
    //            ADMIN ROUTES
    // ==========================================
    Route::prefix('admin')->group(function () {
        
        // 1. Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // 2. Profile Admin (Edit & Update)
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

        // 3. Booking Menu (Reports & Actions)
        Route::get('/booking-list', [AdminController::class, 'listBooking'])->name('admin.booking.list');
        Route::get('/booking-history', [AdminController::class, 'historyBooking'])->name('admin.booking.history');
        Route::get('/booking-schedule', [AdminController::class, 'scheduleBooking'])->name('admin.booking.schedule');

        // Action Booking (Terima / Reschedule oleh Admin)
        Route::get('/booking/reschedule/{id}', [AdminController::class, 'rescheduleBooking'])->name('admin.booking.reschedule');
        Route::post('/booking/accept/{id}', [AdminController::class, 'acceptBooking'])->name('admin.booking.accept');

        // 4. Master Data Menu
        Route::get('/master/student', [AdminController::class, 'studentData'])->name('admin.master.student');
        Route::get('/master/psychologist', [AdminController::class, 'psychologistData'])->name('admin.master.psychologist');
        Route::get('/master/counseling', [AdminController::class, 'counselingData'])->name('admin.master.counseling');

        // Di file routes/web.php, di dalam group prefix('admin')

        // Route untuk mengubah status menjadi Completed (Selesai)
        Route::post('/booking/complete/{id}', [AdminController::class, 'completeBooking'])->name('admin.booking.complete');

        // Route untuk menampilkan Form Reschedule
        Route::get('/admin/booking/reschedule/{id}', [App\Http\Controllers\AdminController::class, 'showRescheduleForm'])->name('admin.booking.reschedule.form');

        // Route untuk Proses Simpan Perubahan Jadwal
        Route::put('/admin/booking/reschedule/{id}', [App\Http\Controllers\AdminController::class, 'processReschedule'])->name('admin.booking.reschedule.process');
   
    });

    // ==========================================
    //         USER/STUDENT ROUTES
    // ==========================================

    // 1. Settings / Profil User
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

    // 2. Booking System User
    // Semua URL di sini otomatis diawali '/booking'
    Route::prefix('booking')->group(function () {
        
        // Route untuk mengubah status menjadi Completed (Selesai)
        Route::post('/booking/complete/{id}', [AdminController::class, 'completeBooking'])->name('admin.booking.complete');

        // Halaman Depan Booking (List Psikolog / Kalender)
        Route::get('/', [BookingController::class, 'index'])->name('booking.index');
        
        // AJAX Load Psikolog
        Route::get('/counselors', [BookingController::class, 'getCounselors'])->name('booking.counselors');
        
        // Detail Psikolog & Form
        Route::get('/details/{id}', [BookingController::class, 'showDetails'])->name('booking.details');
        
        // Proses Submit Booking
        Route::post('/process', [BookingController::class, 'processBooking'])->name('booking.process');
        
        // Halaman Sukses
        Route::get('/confirm', [BookingController::class, 'showConfirmation'])->name('booking.confirm');
        
        // Riwayat Booking User
        // URL: domain.com/booking/history
        Route::get('/history', [BookingController::class, 'history'])->name('booking.history');

        // Action User (Cancel / Reschedule)
        Route::patch('/cancel/{id}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
        Route::patch('/reschedule/{id}', [BookingController::class, 'rescheduleBooking'])->name('booking.reschedule');
    });

});