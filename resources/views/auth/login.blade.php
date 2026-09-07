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
        padding-top: 100px;
        padding-bottom: 60px;
    }
    .login-wrapper {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
        max-width: 440px;
    }
    .login-card {
        background: white; 
        padding: 36px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        backdrop-filter: blur(5px);
    }
    .login-logo img { height: 60px; margin-bottom: 20px; transform: scale(2.2); }
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
    .form-control {
        width: 100%; padding: 12px; border: 1px solid #ddd;
        border-radius: 10px; font-size: 1rem; transition: border 0.3s;
        box-sizing: border-box;
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

    /* Demo Credentials Box */
    .demo-box {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border: 1px solid rgba(59, 93, 132, 0.2);
        text-align: left;
        box-sizing: border-box;
    }
    .demo-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 8px;
    }
    .demo-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #3b5d84;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .demo-badge {
        background: #e0f2fe;
        color: #0369a1;
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 600;
    }
    .demo-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 8px;
    }
    .demo-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    .demo-item:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .demo-role {
        font-weight: 600;
        font-size: 0.82rem;
        color: #1e293b;
    }
    .demo-email {
        font-size: 0.76rem;
        color: #64748b;
    }
    .demo-password {
        font-size: 0.72rem;
        color: #94a3b8;
    }
    .btn-quick-fill {
        background: #3b5d84;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .btn-quick-fill:hover {
        background: #234162;
    }
</style>

<div class="login-container">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-logo">
                <img src="https://github.com/BakiTacos/image-host/blob/main/ConnectED/logo.jpeg?raw=true" alt="ConnectED">
            </div>
            
            <h2 style="margin-bottom: 5px; color: #3b5d84;">Selamat Datang</h2>
            <p style="color: #666; margin-bottom: 24px; font-size: 0.9rem;">Masuk untuk mulai berkonsultasi</p>

            {{-- Tampilkan Error Login --}}
            @if ($errors->any())
                <div class="alert-danger">
                    @foreach ($errors->all() as $error)
                        <p style="margin: 2px 0;">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label>Email Akun</label>
                    <input type="email" id="emailInput" name="email" class="form-control" placeholder="nama@student.umn.ac.id" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="passwordInput" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Masuk Sekarang</button>
            </form>

            <a href="{{ url('/') }}" class="back-link" style="display: block; margin-top: 18px; color: #666; text-decoration: none; font-size: 0.88rem;">&larr; Kembali ke Beranda</a>
        </div>

        {{-- Info Akun Demo --}}
        <div class="demo-box">
            <div class="demo-header">
                <div class="demo-title">
                    <span>🔑</span> Info Akun Demo
                </div>
                <span class="demo-badge">Auto Fill Ready</span>
            </div>

            <div class="demo-grid">
                {{-- Mahasiswa --}}
                <div class="demo-item">
                    <div>
                        <div class="demo-role">🎓 Mahasiswa (Student)</div>
                        <div class="demo-email">michael@student.umn.ac.id</div>
                        <div class="demo-password">Pass: <code>password123</code></div>
                    </div>
                    <button type="button" class="btn-quick-fill" onclick="autoFill('michael@student.umn.ac.id', 'password123')">Pakai Ini</button>
                </div>

                {{-- Admin --}}
                <div class="demo-item">
                    <div>
                        <div class="demo-role">🛡️ Admin ConnectED</div>
                        <div class="demo-email">admin@umn.ac.id</div>
                        <div class="demo-password">Pass: <code>password123</code></div>
                    </div>
                    <button type="button" class="btn-quick-fill" onclick="autoFill('admin@umn.ac.id', 'password123')">Pakai Ini</button>
                </div>

                {{-- Psikolog --}}
                <div class="demo-item">
                    <div>
                        <div class="demo-role">🧠 Psikolog (Yanuar)</div>
                        <div class="demo-email">yanuar@umn.ac.id</div>
                        <div class="demo-password">Pass: <code>password123</code></div>
                    </div>
                    <button type="button" class="btn-quick-fill" onclick="autoFill('yanuar@umn.ac.id', 'password123')">Pakai Ini</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function autoFill(email, password) {
        document.getElementById('emailInput').value = email;
        document.getElementById('passwordInput').value = password;
        
        // Highlight form inputs briefly
        const emailEl = document.getElementById('emailInput');
        const passEl = document.getElementById('passwordInput');
        
        emailEl.style.borderColor = '#10B981';
        passEl.style.borderColor = '#10B981';
        
        setTimeout(() => {
            emailEl.style.borderColor = '#ddd';
            passEl.style.borderColor = '#ddd';
        }, 1000);
    }
</script>
@endsection