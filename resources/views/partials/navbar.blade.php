<header id="main-header">
    <style>
        /* === 1. RESET & LAYOUT UTAMA === */
        * { box-sizing: border-box; }
        
        #main-header {
            position: fixed;
            top: 25px; /* Jarak dari atas */
            left: 50%;
            transform: translateX(-50%); /* Tengah horizontal */
            width: 95%;
            max-width: 1150px; /* Lebar maksimal agar tidak terlalu panjang */
            height: 75px; /* Tinggi navbar */
            z-index: 9999;
            background: white;
            border-radius: 60px; /* Lengkungan kapsul */
            box-shadow: 0 8px 25px rgba(0,0,0,0.08); /* Shadow lembut */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px; /* Padding kiri-kanan isi navbar */
            font-family: 'Poppins', sans-serif; /* Pastikan font sesuai */
        }

        /* === 2. LOGO === */
        .logo a { display: flex; align-items: center; text-decoration: none; }
        .logo img { 
            height: 50px; /* Ukuran Logo Pas */
            width: auto; 
        }

        /* === 3. MENU TENGAH & KANAN === */
        .nav-right-group {
            display: flex;
            align-items: center;
            gap: 30px; /* Jarak antar grup menu */
            height: 100%;
        }

        /* Link Text (Konseling, Tentang Kami) */
        .nav-text-link {
            text-decoration: none;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex; 
            align-items: center; 
            gap: 6px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .nav-text-link:hover { color: #e68a2e; }
        
        /* Panah Kecil Dropdown */
        .arrow-icon { width: 10px; transition: transform 0.2s; }
        .nav-text-link:hover .arrow-icon { transform: rotate(180deg); }

        /* === 4. DROPDOWN MENU (LOGIKA JEMBATAN) === */
        .dropdown-wrapper {
            position: relative;
            height: 100%;
            display: flex; 
            align-items: center;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 55px; /* Muncul di bawah text */
            left: 50%;
            transform: translateX(-50%);
            width: 240px;
            padding-top: 20px; /* Area transparan agar kursor tidak putus */
        }

        .dropdown-inner {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            border: 1px solid #f1f5f9;
            overflow: hidden;
            padding: 8px;
        }
        
        .dropdown-item {
            display: block;
            padding: 12px 20px;
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: 8px;
            transition: 0.2s;
        }
        .dropdown-item:hover {
            background-color: #eff6ff;
            color: #3b5d84;
        }

        .dropdown-wrapper:hover .dropdown-menu { display: block; animation: fadeIn 0.2s; }

        /* === 5. BAGIAN ICON & BUTTONS === */
        .icon-btn {
            color: #333;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s;
        }
        .icon-btn:hover { color: #e68a2e; transform: scale(1.1); }

        /* Tombol Booking Orange */
        .btn-booking {
            background: #e68a2e; 
            color: white; 
            padding: 10px 28px; 
            border-radius: 50px;
            text-decoration: none; 
            font-weight: 700; 
            font-size: 0.9rem;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(230, 138, 46, 0.2);
        }
        .btn-booking:hover { background: #d97706; transform: translateY(-2px); }

        /* User Profile Pill (Biru) */
        .user-pill {
            background: #3b5d84;
            display: flex; 
            align-items: center; 
            gap: 10px;
            padding: 5px 15px 5px 5px; /* Padding kanan lebih besar untuk nama */
            border-radius: 50px;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(59, 93, 132, 0.3);
        }
        .user-pill:hover { background: #2c4663; }
        
        .user-avatar {
            width: 38px; height: 38px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 2px solid white;
        }
        .user-name {
            font-size: 0.9rem; 
            font-weight: 600;
            white-space: nowrap;
        }

        /* Animasi */
        @keyframes fadeIn { from { opacity: 0; transform: translate(-50%, 10px); } to { opacity: 1; transform: translate(-50%, 0); } }

        /* Responsive Mobile */
        @media (max-width: 992px) {
            #main-header { padding: 0 20px; height: 70px; }
            .nav-text-link, .icon-btn { display: none; } /* Sembunyikan menu teks di HP */
            .logo img { height: 40px; }
        }
    </style>

    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="https://github.com/BakiTacos/image-host/blob/main/ConnectED/logo.jpeg?raw=true" alt="ConnectED Logo">
        </a>
    </div>

    <div class="nav-right-group">

        {{-- 1. Dropdown Konseling --}}
        <div class="dropdown-wrapper">
            <div class="nav-text-link">
                Konseling 
                <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
            </div>
            <div class="dropdown-menu">
                <div class="dropdown-inner">
                    <a href="{{ route('konseling.individual') }}" class="dropdown-item">Individual</a>
                    <a href="{{ route('konseling.kelompok') }}" class="dropdown-item">Kelompok</a>
                    <a href="{{ route('konseling.narasumber') }}" class="dropdown-item">Request Narasumber</a>
                </div>
            </div>
        </div>

        {{-- 2. Link Tentang Kami --}}
        <a href="{{ route('about') }}" class="nav-text-link">Tentang Kami</a>

        {{-- SEPARATOR / LOGIKA AUTH --}}
        @auth
            <div style="width: 1px; height: 25px; background: #e2e8f0; margin: 0 5px;"></div>

            {{-- 3. Ikon Notifikasi (Bell) --}}
            <a href="{{ route('settings.index', ['tab' => 'notifikasi']) }}" class="icon-btn" title="Notifikasi">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            </a>

            {{-- 4. Ikon Chat (Baru) --}}
            <a href="{{ route('settings.index', ['tab' => 'chat']) }}" class="icon-btn" title="Chat">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            </a>

            {{-- 5. Tombol Booking --}}
            <a href="{{ url('booking') }}" class="btn-booking" style="margin-left: 10px;">Booking</a>

            {{-- 6. User Profile Dropdown --}}
            <div class="dropdown-wrapper">
                <div class="user-pill">
                    <img src="{{ Auth::user()->avatar_image ?? 'https://ui-avatars.com/api/?background=random&color=fff&name='.urlencode(Auth::user()->name) }}" class="user-avatar">
                    <span class="user-name">{{ explode(' ', Auth::user()->name)[0] }}</span>
                </div>
                
                <div class="dropdown-menu" style="width: 180px; left: auto; right: 0; transform: none;">
                    <div class="dropdown-inner">
                        <a href="{{ route('settings.index') }}" class="dropdown-item">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" style="width:100%; border:none; background:none; color:#ef4444; cursor:pointer;">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>

        @else
            {{-- Jika Belum Login --}}
            <a href="{{ route('login') }}" class="btn-booking" style="background:#3b5d84; margin-left: 20px;">Masuk</a>
        @endauth

    </div>
</header>