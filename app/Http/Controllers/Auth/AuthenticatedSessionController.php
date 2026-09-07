<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Ambil data user
        $user = $request->user();
        
        // Pastikan pengecekan role aman (ubah ke huruf kecil semua)
        $role = strtolower($user->role); 

        // 1. LOGIKA ADMIN & PSIKOLOG
        if ($role == 'admin' || $role == 'psychologist') {
            return redirect()->route('admin.dashboard');
        }

        // 2. LOGIKA MAHASISWA (USER BIASA)
        // Ubah '/settings' menjadi '/' untuk ke Home
        return redirect('/'); 
    }

    /**
     * Menangani proses logout (Keluar).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}