@extends('layouts.admin')

@section('header_title', 'Profile')

@section('content')

<style>
    /* Container Card */
    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    /* Header Section (Avatar & Nama) */
    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 20px;
        position: relative;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
        border: 3px solid #eef2f7;
    }

    .profile-info h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #333;
    }

    .profile-info p {
        margin: 0;
        color: #777;
        font-size: 0.9rem;
    }

    .btn-logout-text {
        color: #dc3545;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        margin-top: 5px;
        display: inline-block;
    }
    .btn-logout-text:hover { text-decoration: underline; }

    /* Tombol Edit di Pojok Kanan */
    .btn-edit-profile {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #3b5d84;
        color: white;
        padding: 8px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .btn-edit-profile:hover { background-color: #2c4663; color: white; }

    /* Form Fields Styling */
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: 600;
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: block;
    }
    
    /* Input Readonly Style (Background Abu-abu seperti desain) */
    .form-control-view {
        background-color: #e9ecef;
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #495057;
        width: 100%;
        font-size: 0.95rem;
        display: block;
    }

    /* Section Topik Keahlian (Kanan) */
    .skills-header {
        font-weight: 600;
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }
    
    .skill-badge {
        display: block; /* Agar memanjang ke bawah */
        background-color: #e9ecef;
        color: #555;
        padding: 10px 15px;
        border-radius: 8px; /* Rounded corner kotak */
        margin-bottom: 10px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Layout Grid Helpers */
    .row-custom { display: flex; flex-wrap: wrap; margin: 0 -15px; }
    .col-left { flex: 0 0 70%; max-width: 70%; padding: 0 15px; }
    .col-right { flex: 0 0 30%; max-width: 30%; padding: 0 15px; }
    .col-half { flex: 0 0 50%; max-width: 50%; padding-right: 15px; }
    
    @media (max-width: 768px) {
        .col-left, .col-right, .col-half { flex: 0 0 100%; max-width: 100%; }
        .btn-edit-profile { position: static; display: block; text-align: center; margin-bottom: 20px; }
    }
</style>

<div class="profile-card">
    
    {{-- Header: Avatar, Nama, Tombol Edit --}}
    <div class="profile-header">
        <img src="{{ $data['image_url'] ?? 'https://ui-avatars.com/api/?name='.urlencode($data['name']).'&background=random' }}" 
             alt="Profile" class="profile-avatar">
        
        <div class="profile-info">
            <h3>{{ $data['name'] }}</h3>
            <p>{{ $data['email'] }}</p>
            
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;" class="btn-logout-text">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>

        {{-- Link ini bisa diarahkan ke halaman edit profil jika sudah ada --}}
        <a href="#" class="btn-edit-profile">Edit</a>
    </div>

    <div class="row-custom">
        {{-- KOLOM KIRI: Form Data Diri --}}
        <div class="col-left">
            <div class="row-custom" style="margin-bottom: 20px;">
                {{-- Nama Lengkap --}}
                <div class="col-half">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="form-control-view">{{ $data['name'] }}</div>
                </div>
                {{-- Email --}}
                <div class="col-half" style="padding-right:0;">
                    <label class="form-label">Email</label>
                    <div class="form-control-view">{{ $data['email'] }}</div>
                </div>
            </div>

            <div class="row-custom" style="margin-bottom: 20px;">
                {{-- NIK --}}
                <div class="col-half">
                    <label class="form-label">NIK</label>
                    <div class="form-control-view">{{ $data['nik'] ?? '-' }}</div>
                </div>
                {{-- No Whatsapp --}}
                <div class="col-half" style="padding-right:0;">
                    <label class="form-label">No. Whatsapp</label>
                    <div class="form-control-view">{{ $data['phone'] }}</div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label class="form-label">Deskripsi Konselor</label>
                <div class="form-control-view" style="min-height: 120px; line-height: 1.6;">
                    {{ $data['description'] }}
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: Topik Keahlian --}}
        <div class="col-right">
            <div class="skills-header">Topik Keahlian</div>
            
            @if(!empty($data['expertise']))
                @foreach($data['expertise'] as $skill)
                    <div class="skill-badge">{{ $skill }}</div>
                @endforeach
            @else
                <div class="skill-badge">Belum ada data</div>
            @endif
            
            {{-- Slot kosong untuk placeholder (biar mirip desain) --}}
            <div class="skill-badge" style="background: #f8f9fa; color: #ccc;">Kosong</div>
            <div class="skill-badge" style="background: #f8f9fa; color: #ccc;">Kosong</div>
        </div>
    </div>
</div>

@endsection