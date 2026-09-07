<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ConnectED</title>
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- FontAwesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        body { background-color: #f4f6f9; display: flex; height: 100vh; overflow: hidden; }

        /* === SIDEBAR === */
        .sidebar {
            width: 260px;
            background-color: white;
            display: flex; flex-direction: column;
            border-right: 1px solid #eee;
            flex-shrink: 0;
            padding-bottom: 20px;
        }
        .sidebar-logo {
            height: 70px;
            display: flex; align-items: center; padding-left: 25px;
            border-bottom: 1px solid #f0f0f0;
        }
        .sidebar-logo img { height: 35px; }

        .menu-group { margin-top: 20px; }
        .menu-label {
            padding: 0 25px;
            font-size: 0.8rem;
            color: #aaa;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .nav-item {
            display: flex; align-items: center;
            padding: 12px 25px;
            color: #666;
            text-decoration: none;
            font-size: 0.95rem;
            transition: 0.2s;
            border-left: 4px solid transparent;
            margin-bottom: 2px;
            cursor: pointer;
        }
        .nav-item:hover { background-color: #f8f9fa; color: #3b5d84; }
        
        /* Active State */
        .nav-item.active {
            background-color: #eef7ff;
            color: #3b5d84;
            border-left-color: #3b5d84;
            font-weight: 600;
        }
        .nav-icon { width: 25px; text-align: center; margin-right: 10px; font-size: 1rem; }

        /* === MAIN CONTENT === */
        .main-content {
            flex: 1;
            display: flex; flex-direction: column;
            overflow: hidden;
        }

        /* HEADER */
        .top-header {
            height: 70px;
            background-color: #3b5d84;
            color: white;
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 10;
        }
        
        .header-left { font-size: 1.2rem; font-weight: 600; }
        
        .header-right { display: flex; align-items: center; gap: 20px; }
        .notif-icon { cursor: pointer; font-size: 1.2rem; position: relative; }
        .notif-badge { position: absolute; top: -5px; right: -5px; width: 8px; height: 8px; background: #e68a2e; border-radius: 50%; }

        /* Profile Link Styling */
        .profile-link {
            text-decoration: none;
            color: inherit;
            display: block;
            transition: 0.2s;
        }
        .profile-link:hover { opacity: 0.9; }

        .admin-profile { display: flex; align-items: center; gap: 15px; text-align: right; }
        .admin-name { font-weight: 700; font-size: 0.9rem; line-height: 1.2; }
        .admin-role { font-size: 0.75rem; opacity: 0.9; font-weight: 300; }
        .admin-avatar { width: 40px; height: 40px; border-radius: 50%; background: white; padding: 2px; overflow: hidden; }
        .admin-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

        /* CONTENT SCROLL */
        .content-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
        }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="https://github.com/BakiTacos/image-host/blob/main/ConnectED/logo.jpeg?raw=true" alt="ConnectED">
        </div>

        {{-- 1. Dashboard --}}
        <div class="menu-group">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-chart-pie"></i></span> Dashboard
            </a>
        </div>

        {{-- 2. Reports --}}
        <div class="menu-group">
            <div class="menu-label">Reports</div>
            
            {{-- List Booking --}}
            <a href="{{ route('admin.booking.list') }}" class="nav-item {{ request()->routeIs('admin.booking.list') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-clipboard-list"></i></span> List Booking
            </a>

            {{-- Riwayat Booking --}}
            <a href="{{ route('admin.booking.history') }}" class="nav-item {{ request()->routeIs('admin.booking.history') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-clock-rotate-left"></i></span> Riwayat Booking
            </a>

            {{-- Jadwal Booking --}}
            <a href="{{ route('admin.booking.schedule') }}" class="nav-item {{ request()->routeIs('admin.booking.schedule') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-regular fa-calendar-days"></i></span> Jadwal Booking
            </a>
        </div>

        {{-- 3. Master Data --}}
        <div class="menu-group">
            <div class="menu-label">Master</div>
            
            {{-- Data Mahasiswa --}}
            <a href="{{ route('admin.master.student') }}" class="nav-item {{ request()->routeIs('admin.master.student') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user-graduate"></i></span> Data Mahasiswa
            </a>

            {{-- Data Psikolog --}}
            <a href="{{ route('admin.master.psychologist') }}" class="nav-item {{ request()->routeIs('admin.master.psychologist') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user-doctor"></i></span> Data Psikolog
            </a>

            {{-- Data Konseling --}}
            <a href="{{ route('admin.master.counseling') }}" class="nav-item {{ request()->routeIs('admin.master.counseling') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-folder-open"></i></span> Data Konseling
            </a>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        <header class="top-header">
            <div class="header-left">
                @yield('header_title', 'Dashboard')
            </div>
            
            <div class="header-right">
                <div class="notif-icon">
                    <i class="fa-regular fa-bell"></i>
                    <div class="notif-badge"></div>
                </div>
                
                {{-- Link ke Profile --}}
                <a href="{{ route('admin.profile') }}" class="profile-link">
                    <div class="admin-profile">
                        <div>
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <div class="admin-avatar">
                            <img src="https://ui-avatars.com/api/?name=Yanuar+Lurisa&background=random" alt="Admin">
                        </div>
                    </div>
                </a>
            </div>
        </header>

        <div class="content-scroll">
            @yield('content')
        </div>
    </div>

</body>
</html>