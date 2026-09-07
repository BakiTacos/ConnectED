@extends('layouts.app')

@section('title', 'Login - ConnectED')

@section('content')
<style>
    /* Style Khusus Halaman Login */
    body { 
        background-color: #f0f2f5; 
        background: linear-gradient(rgba(59, 93, 132, 0.5), rgba(59, 93, 132, 0.7)), 
                    url('https://plus.unsplash.com/premium_photo-1665990294269-f1d6c35ab9d1?q=80&w=1738&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        padding-top: 120px; 
    }
    .login-card {
        background: white; 
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
        width: 100%;
        max-width: 400px;
        text-align: center;
        backdrop-filter: blur(5px);
    }
    .login-logo img { height: 60px; margin-bottom: 20px; transform: scale(2.2); }
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
    .form-control {
        width: 100%; padding: 12px; border: 1px solid #ddd;
        border-radius: 10px; font-size: 1rem; transition: border 0.3s;
    }
    .form-control:focus { border-color: #3b5d84; outline: none; }
    .btn-login {
        width: 100%; padding: 12px; border: none; border-radius: 50px;
        background: #3b5d84; color: white; font-weight: 600;
        font-size: 1rem; cursor: pointer; transition: background 0.3s, transform 0.2s;
    }
    .btn-login:hover { background: #2c4a6b; transform: translateY(-2px); }
    .alert-danger { 
        background: #fee2e2; color: #991b1b; padding: 10px; 
        border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; text-align: left;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-logo">
            <img src="https://github.com/BakiTacos/image-host/blob/main/ConnectED/logo.jpeg?raw=true" alt="ConnectED">
        </div>
        
        <h2 style="margin-bottom: 5px; color: #3b5d84;">Selamat Datang</h2>
        <p style="color: #666; margin-bottom: 30px; font-size: 0.9rem;">Masuk untuk mulai berkonsultasi</p>

        {{-- Tampilkan Error Login --}}
        @if ($errors->any())
            <div class="alert-danger">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf <div class="form-group">
                <label>Email Mahasiswa</label>
                <input type="email" name="email" class="form-control" placeholder="nama@student.umn.ac.id" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Masuk Sekarang</button>
        </form>

        <a href="{{ url('/') }}" class="back-link" style="display: block; margin-top: 20px; color: #666; text-decoration: none; font-size: 0.9rem;">&larr; Kembali ke Beranda</a>
    </div>
</div>
@endsection