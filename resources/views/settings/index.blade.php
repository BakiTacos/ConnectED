@extends('layouts.app')

@section('title', 'Profil Saya - ConnectED')

@section('content')

@php
    $activeTab = request('tab', 'profil'); 
@endphp

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* RESET & CONTAINER */
    .settings-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        min-height: 100vh;
        padding-top: 100px;
        padding-bottom: 50px;
    }

    .main-container { max-width: 1000px; margin: 0 auto; padding: 0 20px; }

    /* NAVIGASI TABS (LINK) */
    .custom-nav-container {
        background: #fff;
        border-radius: 50px;
        padding: 6px;
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .nav-item-link {
        flex: 1; text-align: center; padding: 10px 0; border-radius: 40px;
        text-decoration: none; color: #666; font-weight: 500; font-size: 0.9rem; transition: all 0.3s ease;
    }
    .nav-item-link:hover { background-color: #f1f1f1; color: #333; }
    .nav-item-link.active { background-color: #dbe4ed; color: #3b5d84; font-weight: 700; }

    /* KARTU KONTEN UTAMA */
    .content-card {
        background: #fff; border: 1px solid #e5e5e5; border-radius: 20px;
        padding: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); min-height: 500px; position: relative;
    }

    /* --- LAYOUT PROFIL --- */
    .profile-layout { display: flex; gap: 40px; }
    .profile-left { width: 300px; flex-shrink: 0; text-align: center; border-right: 1px solid #eee; padding-right: 20px; }
    .profile-right { flex-grow: 1; padding-left: 10px; }
    .avatar-img { width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 15px; }
    
    /* BUTTONS */
    .btn-edit-link { color: #3b9ae1; font-size: 0.9rem; font-weight: 600; text-decoration: none; cursor: pointer; display: inline-block; margin-bottom: 20px; }
    .btn-keluar { color: #ff6b6b; font-weight: 600; background: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; font-size: 0.9rem; }

    /* Tabel Detail Profil */
    .detail-table { width: 100%; border-collapse: collapse; }
    .detail-table td { padding: 12px 5px; font-size: 0.95rem; color: #444; border-bottom: 1px solid #f9f9f9; vertical-align: top; }
    .detail-label { width: 160px; font-weight: 600; color: #333; }

    /* --- MODAL EDIT CUSTOM --- */
    .custom-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: none; justify-content: center; align-items: center; }
    .custom-modal-content { background: white; width: 500px; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); animation: slideDown 0.3s ease; }
    @keyframes slideDown { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    .form-group { margin-bottom: 15px; text-align: left; }
    .form-label { font-weight: 600; font-size: 0.85rem; color: #666; display: block; margin-bottom: 5px; }
    .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; }
    .btn-save { background: #3b5d84; color: white; border: none; padding: 10px 25px; border-radius: 30px; font-weight: 600; cursor: pointer; float: right; }
    .btn-close-modal { background: #eee; color: #333; border: none; padding: 10px 20px; border-radius: 30px; font-weight: 600; cursor: pointer; float: right; margin-left: 10px; }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .profile-layout { flex-direction: column; }
        .profile-left { width: 100%; border-right: none; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
        .custom-nav-container { flex-wrap: wrap; border-radius: 20px; }
        .nav-item-link { width: 50%; }
        .custom-modal-content { width: 90%; }
    }
</style>
@endpush

<div class="settings-wrapper">
    <div class="main-container">
        
        {{-- NAVIGASI TAB (LINK) --}}
        <div class="custom-nav-container">
            <a href="{{ route('settings.index', ['tab' => 'profil']) }}" class="nav-item-link {{ $activeTab == 'profil' ? 'active' : '' }}">Profil Saya</a>
            <a href="{{ route('settings.index', ['tab' => 'jadwal']) }}" class="nav-item-link {{ $activeTab == 'jadwal' ? 'active' : '' }}">Jadwal Konseling</a>
            <a href="{{ route('settings.index', ['tab' => 'chat']) }}" class="nav-item-link {{ $activeTab == 'chat' ? 'active' : '' }}">Chat</a>
            <a href="{{ route('settings.index', ['tab' => 'notifikasi']) }}" class="nav-item-link {{ $activeTab == 'notifikasi' ? 'active' : '' }}">Notifikasi</a>
            <a href="{{ route('settings.index', ['tab' => 'riwayat']) }}" class="nav-item-link {{ $activeTab == 'riwayat' ? 'active' : '' }}">Riwayat Konseling</a>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="content-card">

            {{-- 1. TAB PROFIL --}}
            @if($activeTab == 'profil')
                <div class="profile-layout">
                    {{-- KIRI --}}
                    <div class="profile-left">
                        <img src="{{ $user->avatar_image ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" class="avatar-img">
                        <h3 style="font-weight: 700; margin-bottom: 5px; color: #333;">{{ $user->name }}</h3>
                        <p style="color: #888; font-size: 0.9rem; margin-bottom: 15px;">{{ $user->email }}</p>

                        <div onclick="document.getElementById('modalEdit').style.display='flex'" class="btn-edit-link">
                            <i class="fa-regular fa-pen-to-square"></i> Edit Profile
                        </div>
                        <br>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-keluar">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                            </button>
                        </form>
                    </div>

                    {{-- KANAN --}}
                    <div class="profile-right">
                        <h4 style="font-weight: 700; margin-bottom: 25px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">Profil Saya</h4>
                        
                        <table class="detail-table">
                            <tr><td class="detail-label">Nama Lengkap</td><td>: {{ $user->name }}</td></tr>
                            <tr><td class="detail-label">NIM</td><td>: {{ $user->nim ?? '-' }}</td></tr>
                            <tr><td class="detail-label">Pendidikan</td><td>: S1/D4</td></tr>
                            <tr><td class="detail-label">Program Studi</td><td>: Sistem Informasi</td></tr>
                            
                            {{-- MENAMPILKAN NO WHATSAPP --}}
                            <tr>
                                <td class="detail-label">No. WhatsApp</td>
                                <td>: {{ $user->phone ?? '-' }}</td>
                            </tr>
                            {{-- MENAMPILKAN NO WALI --}}
                            <tr>
                                <td class="detail-label">No. Wali</td>
                                <td>: {{ $user->guardian_phone ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif

            {{-- 2. TAB JADWAL --}}
            @if($activeTab == 'jadwal')
                <h4 style="font-weight: 700; margin-bottom: 25px;">Jadwal Konseling</h4>
                @if($schedules->isEmpty())
                    <div style="text-align:center; padding:50px; color:#999;">Tidak ada jadwal aktif.</div>
                @else
                    @foreach($schedules as $item)
                        @php
                            $psyName = optional($item->psychologist)->name ?? 'Psikolog Tidak Ditemukan';
                            $psyImg = optional($item->psychologist)->image_url ?? 'https://ui-avatars.com/api/?name=Unknown';
                        @endphp
                        <div style="border:1px solid #eee; border-radius:15px; margin-bottom:20px; padding:20px; display:flex; align-items:center; gap:20px;">
                            <img src="{{ $psyImg }}" style="width:60px; height:60px; border-radius:50%; object-fit:cover;">
                            <div style="flex-grow:1;">
                                <div style="font-weight:700;">{{ $psyName }}</div>
                                <div style="font-size:0.9rem; color:#666;">{{ $item->topic }} | {{ date('d M Y', strtotime($item->booking_date)) }}</div>
                            </div>
                            <span style="background:#eee; padding:5px 15px; border-radius:20px; font-size:0.8rem; font-weight:600;">{{ $item->status }}</span>
                        </div>
                    @endforeach
                @endif
            @endif

            {{-- 3. TAB RIWAYAT --}}
            @if($activeTab == 'riwayat')
                <h4 style="font-weight: 700; margin-bottom: 25px;">Riwayat Konseling</h4>
                @if($history->isEmpty())
                    <div style="text-align:center; padding:50px; color:#999;">
                        <p>Belum ada riwayat.</p>
                    </div>
                @else
                    @foreach($history as $item)
                        @php
                            $psyName = optional($item->psychologist)->name ?? 'Data Terhapus';
                            $psyImg = optional($item->psychologist)->image_url ?? 'https://ui-avatars.com/api/?name=Unknown';
                        @endphp
                        <div style="border:1px solid #eee; border-radius:15px; margin-bottom:20px; padding:20px; display:flex; align-items:center; gap:20px;">
                            <img src="{{ $psyImg }}" style="width:60px; height:60px; border-radius:50%; object-fit:cover; filter: grayscale(100%);">
                            <div style="flex-grow:1;">
                                <div style="font-weight:700; color:#555;">{{ $psyName }}</div>
                                <div style="font-size:0.9rem; color:#888;">{{ date('d M Y', strtotime($item->booking_date)) }}</div>
                            </div>
                            
                            @if($item->status == 'Completed')
                                <span class="status-badge bg-blue" style="background:#cce5ff; color:#004085; padding:5px 15px; border-radius:20px;">Selesai</span>
                            @elseif($item->status == 'Cancelled')
                                <span class="status-badge bg-red" style="background:#f8d7da; color:#721c24; padding:5px 15px; border-radius:20px;">Dibatalkan</span>
                            @else
                                <span class="status-badge bg-gray" style="background:#e2e3e5; color:#383d41; padding:5px 15px; border-radius:20px;">{{ $item->status }}</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            @endif

            {{-- 4. TAB PLACEHOLDER --}}
            @if($activeTab == 'chat' || $activeTab == 'notifikasi')
                <div style="text-align:center; padding:50px; color:#999;">
                    <p>Fitur {{ ucfirst($activeTab) }} belum tersedia.</p>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- MODAL EDIT (CUSTOM MANUAL) --}}
<div id="modalEdit" class="custom-modal-overlay">
    <div class="custom-modal-content">
        <h3 style="margin-bottom: 20px; font-weight: 700;">Edit Profil</h3>
        
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ $user->avatar_image ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">
                <input type="file" name="avatar_image" style="font-size: 0.8rem;">
            </div>

            <div class="form-group">
                <label class="form-label">NAMA LENGKAP</label>
                <input type="text" name="name" class="form-input" value="{{ $user->name }}">
            </div>

            {{-- INPUT NO WHATSAPP BARU --}}
            <div class="form-group">
                <label class="form-label">NO. WHATSAPP</label>
                <input type="text" name="phone" class="form-input" value="{{ $user->phone }}" placeholder="Contoh: 08123456789">
            </div>

            {{-- INPUT NO WALI BARU --}}
            <div class="form-group">
                <label class="form-label">NO. WALI</label>
                <input type="text" name="guardian_phone" class="form-input" value="{{ $user->guardian_phone }}" placeholder="Contoh: 08129876543">
            </div>

            <div style="margin-top: 30px; overflow: hidden;">
                <button type="button" class="btn-close-modal" onclick="document.getElementById('modalEdit').style.display='none'">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection