@extends('layouts.app')

@section('title', 'Profil Saya - ConnectED')

@section('content')
<style>
    /* CSS Khusus Halaman Settings */
    .settings-wrapper { max-width: 1000px; margin: 120px auto 60px; padding: 0 20px; }
    
    /* Navigasi Tab (Pill Shape di atas) */
    .settings-nav {
        display: flex; background: #fff; padding: 10px; border-radius: 50px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #eee; margin-bottom: 30px;
        justify-content: space-between;
    }
    .nav-item {
        flex: 1; text-align: center; padding: 12px 0; border-radius: 40px;
        text-decoration: none; color: #666; font-weight: 500; font-size: 0.95rem;
        transition: all 0.3s;
    }
    .nav-item:hover { background: #f8f9fa; color: #333; }
    .nav-item.active {
        background: #dbeafe; /* Biru muda sekali */
        color: #3b5d84; font-weight: 700;
        box-shadow: inset 0 0 0 1px #3b5d84; /* Border dalam biru */
    }

    /* Card Style Umum */
    .card-box {
        background: white; border-radius: 20px; padding: 30px;
        border: 1px solid #eee; box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        margin-bottom: 20px;
    }
    .card-title { font-size: 1.2rem; font-weight: 700; color: #333; margin-bottom: 20px; }
    
    /* Badge Status */
    .badge { padding: 6px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }
    .bg-green { background: #dcfce7; color: #166534; }
    .bg-yellow { background: #fef9c3; color: #854d0e; }
    .bg-red { background: #fee2e2; color: #991b1b; }
    .bg-gray { background: #f3f4f6; color: #4b5563; }
    
    /* Tombol-tombol */
    .btn-xs { padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: 0.2s; display:inline-block; }
    .btn-blue { background: #3b5d84; color: white; }
    .btn-outline { background: white; border: 1px solid #ddd; color: #555; }
    .btn-outline:hover { border-color: #3b5d84; color: #3b5d84; }
    .btn-red-outline { background: white; border: 1px solid #fee2e2; color: #dc2626; }
    .btn-red-outline:hover { background: #fee2e2; }
</style>

<div class="settings-wrapper">
    <div class="settings-nav">
        <a href="?tab=profil" class="nav-item {{ $active_tab == 'profil' ? 'active' : '' }}">Profil Saya</a>
        <a href="?tab=jadwal" class="nav-item {{ $active_tab == 'jadwal' ? 'active' : '' }}">Jadwal Konseling</a>
        <a href="#" class="nav-item">Chat</a> {{-- Placeholder --}}
        <a href="?tab=chat" class="nav-item {{ $active_tab == 'chat' ? 'active' : '' }}">Chat</a>
        <a href="?tab=notifikasi" class="nav-item {{ $active_tab == 'notifikasi' ? 'active' : '' }}">Notifikasi</a>
        <a href="?tab=riwayat" class="nav-item {{ $active_tab == 'riwayat' ? 'active' : '' }}">Riwayat Konseling</a>
    </div>

    @if($active_tab == 'profil')
        @include('settings.partials.profil')
    @elseif($active_tab == 'chat')
        @include('settings.partials.chat')
    @elseif($active_tab == 'jadwal')
        @include('settings.partials.jadwal')
    @elseif($active_tab == 'notifikasi')
        @include('settings.partials.notifikasi')
    @elseif($active_tab == 'riwayat')
        @include('settings.partials.riwayat')
    @endif

</div>

<div class="row">
    <div class="col-md-6">
        <label>Nama Lengkap</label>
    </div>
    <div class="col-md-6">
        <p>: {{ $user->name ?? 'Michael Julio' }}</p> 
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label>NIM</label>
    </div>
    <div class="col-md-6">
        <p>: {{ $user->nim ?? '00000282620' }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label>Program Studi</label>
    </div>
    <div class="col-md-6">
        <p>: {{ $user->prodi ?? 'Sistem Informasi' }}</p>
    </div>
</div>
@endsection