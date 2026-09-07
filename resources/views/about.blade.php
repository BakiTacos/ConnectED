@extends('layouts.app')

@section('title', 'Tentang Kami - ConnectED')

@section('content')

<style>
    /* === 1. HEADER SECTION (Fixed Layout) === */
    .header-wrapper {
        position: relative;
        padding-top: 140px; /* INCREASED PADDING: To prevent navbar overlap */
        padding-bottom: 80px;
        max-width: 1200px; 
        margin: 0 auto; 
        padding-left: 20px; 
        padding-right: 20px;
        display: flex;
        align-items: center;
        gap: 60px; /* Increased gap for better spacing */
        overflow: visible;
    }

    /* Left Side: Text Content */
    .header-text {
        flex: 1;
        z-index: 2; /* Ensure text is above background elements */
        min-width: 300px;
    }
    .header-text h4 {
        color: #3b5d84; 
        font-weight: 700; 
        margin-bottom: 15px; 
        font-size: 1.2rem;
        text-transform: uppercase; 
        letter-spacing: 1px;
    }
    .header-text h1 {
        color: #e68a2e; 
        font-weight: 800; 
        font-size: 3.2rem; /* Larger font for impact */
        margin-bottom: 25px; 
        line-height: 1.1;
    }
    .header-text p {
        color: #666; 
        line-height: 1.7; 
        font-size: 1.05rem; 
        max-width: 550px;
    }

    /* Right Side: Image Collage */
    .header-images {
        flex: 1;
        position: relative;
        height: 450px; /* Fixed height container */
        min-width: 300px;
    }

    /* Main Large Image */
    .img-main {
        position: absolute;
        top: 0; 
        right: 0;
        width: 85%; 
        height: 85%;
        object-fit: cover;
        border-radius: 20px 0 20px 20px; /* Custom rounded corners */
        z-index: 2;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    /* Small Overlapping Image */
    .img-small {
        position: absolute;
        bottom: 20px; 
        left: 0;
        width: 45%; 
        height: 55%;
        object-fit: cover;
        border-radius: 15px;
        border: 6px solid white; /* Thick white border for separation */
        z-index: 3;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* Decorative Background Shape (Orange Triangle) */
    .orange-accent {
        position: absolute;
        top: 80px; 
        right: -100px; /* Extend outside container slightly */
        width: 400px; 
        height: 700px;
        background: #fef3c7; /* Very light orange/yellow */
        clip-path: polygon(100% 0, 100% 100%, 0 50%); /* Triangle shape */
        z-index: -1;
        opacity: 0.6;
        pointer-events: none; /* Prevent interference with clicks */
    }


    /* === 2. BLUE STRIP SECTION (Location) === */
    .blue-strip {
        background: #3b5d84;
        border-radius: 20px 0 0 20px;
        margin-left: 5%; /* Indent from left */
        padding: 50px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        position: relative;
        z-index: 5;
        box-shadow: 0 15px 40px rgba(59, 93, 132, 0.25);
        margin-bottom: 100px;
        flex-wrap: wrap; /* Allow wrapping on smaller screens */
        gap: 30px;
    }
    .strip-left h2 { 
        font-size: 2rem; 
        font-weight: 700; 
        margin-bottom: 20px; 
    }
    .strip-list div { 
        margin-top: 10px; 
        font-size: 1rem; 
        display: flex; 
        align-items: center; 
        gap: 12px; 
    }
    
    .student-support-box {
        background: white; 
        color: #3b5d84; 
        padding: 15px 30px; 
        border-radius: 50px; /* Pill shape */
        display: flex; 
        align-items: center; 
        gap: 15px;
        font-weight: 700;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    /* === 3. TEAM SECTION === */
    .section-container { 
        max-width: 1200px; 
        margin: 0 auto 100px; 
        padding: 0 20px; 
        text-align: center; 
    }
    .sec-title { 
        color: #3b5d84; 
        font-size: 2.2rem; 
        font-weight: 800; 
        margin-bottom: 15px; 
    }
    .sec-desc { 
        color: #666; 
        max-width: 700px; 
        margin: 0 auto 60px; 
        font-size: 1.05rem;
    }
    
    .team-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
        gap: 30px; 
    }
    .team-card { 
        background: white; 
        padding: 40px 20px; 
        border-radius: 25px; 
        border: 1px solid #f0f0f0; 
        transition: 0.3s ease-in-out; 
    }
    .team-card:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 20px 40px rgba(0,0,0,0.08); 
        border-color: transparent;
    }
    .avatar-circle { 
        width: 120px; 
        height: 120px; 
        border-radius: 50%; 
        margin: 0 auto 20px; 
        overflow: hidden; 
        border: 4px solid #e0f2fe; /* Light blue border */
        padding: 3px;
        background: white;
    }
    .avatar-circle img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        border-radius: 50%;
    }

    /* === 4. SEMINAR SECTION === */
    .seminar-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
    }
    .seminar-card {
        border-radius: 20px;
        overflow: hidden;
        height: 220px;
        position: relative;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .seminar-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .seminar-card:hover img {
        transform: scale(1.05);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .header-wrapper { 
            flex-direction: column; 
            padding-top: 120px; 
            text-align: center;
        }
        .header-text { margin-bottom: 40px; }
        .header-text p { margin: 0 auto; }
        .header-images { width: 100%; max-width: 600px; height: 400px; }
        
        .blue-strip { 
            margin-left: 20px; 
            margin-right: 20px;
            border-radius: 20px; 
            flex-direction: column; 
            text-align: center; 
            gap: 30px; 
            padding: 40px 30px;
        }
        .strip-list div { justify-content: center; }
    }
</style>

{{-- 1. HEADER HERO SECTION --}}
<div class="header-wrapper">
    <div class="orange-accent"></div>

    <div class="header-text">
        <h4>Your Mental Health Partner at UMN</h4>
        <h1>Let's Get ConnectED</h1>
        <p>
            Unit layanan psikologis resmi Universitas Multimedia Nusantara yang hadir untuk mendengarkan, mendukung, dan menjaga kesehatan mental Anda. Kami menyediakan ruang aman bagi mahasiswa untuk bercerita dan menemukan solusi.
        </p>
    </div>

    <div class="header-images">
        {{-- Gambar Utama (Rapat/Kegiatan) --}}
        <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?q=80&w=1000&auto=format&fit=crop" class="img-main" alt="Main Activity">
        
        {{-- Gambar Kecil (Kantor/Lorong) --}}
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=600&auto=format&fit=crop" class="img-small" alt="Office">
    </div>
</div>

{{-- 2. BLUE STRIP (LOKASI & JAM) --}}
<div class="blue-strip">
    <div class="strip-left">
        <h2>Lokasi & Jam Operasional</h2>
        <div class="strip-list">
            <div>📍 Gedung C, Lantai 2.</div>
            <div>🕒 Senin - Jumat, 09:00 - 17:00 WIB.</div>
            <div>📞 +62 851-7440-0582</div>
        </div>
    </div>
    
    <div class="student-support-box">
        <img src="https://cdn-icons-png.flaticon.com/512/2942/2942544.png" width="40" alt="Logo">
        <div style="text-align: left;">
            <div style="font-size: 0.75rem; color: #888; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Official</div>
            <div style="font-size: 1.2rem; line-height: 1; color: #3b5d84;">Student Support</div>
        </div>
    </div>
</div>

{{-- 3. MEET OUR TEAM --}}
<div class="section-container">
    <h2 class="sec-title">Meet Our Team</h2>
    <p class="sec-desc">Tim profesional kami siap membantu dan mendampingi perjalanan Anda menuju kesehatan mental yang lebih baik.</p>

    <div class="team-grid">
        @forelse($psychologists as $psy)
            <div class="team-card">
                <div class="avatar-circle">
                    <img src="{{ $psy->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($psy->name).'&background=3b5d84&color=fff' }}" alt="{{ $psy->name }}">
                </div>
                <div style="color: #3b5d84; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; margin-bottom: 5px;">Psikolog UMN</div>
                <div style="font-weight: 700; color: #333; font-size: 1.1rem; margin-bottom: 5px;">{{ $psy->name }}</div>
                <div style="font-size: 0.9rem; color: #666;">{{ $psy->title }}</div>
            </div>
        @empty
            <p>Data Psikolog belum tersedia.</p>
        @endforelse
    </div>
</div>

{{-- 4. SEMINAR SECTION --}}
<div class="section-container">
    <h2 class="sec-title" style="font-size: 1.8rem;">Menghadirkan Wawasan Lewat Seminar</h2>
    <div style="color: #e68a2e; font-size: 1.5rem; font-weight: 800; margin-bottom: 50px;">Stay Tuned dan Jangan Sampai Ketinggalan</div>
    
    <div class="seminar-grid">
        @forelse($seminars as $sem)
            <div class="seminar-card">
                <img src="{{ $sem->image_url ?? 'https://images.unsplash.com/photo-1544531586-fde5298cdd40' }}" alt="Seminar Event">
            </div>
        @empty
            <div class="seminar-card"><img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=600&q=80" alt="Seminar 1"></div>
            <div class="seminar-card"><img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&q=80" alt="Seminar 2"></div>
            <div class="seminar-card"><img src="https://images.unsplash.com/photo-1591115765373-5207764f72e7?w=600&q=80" alt="Seminar 3"></div>
        @endforelse
    </div>
</div>

@endsection