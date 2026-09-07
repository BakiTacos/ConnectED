@extends('layouts.app')

@section('title', 'Home - ConnectED')

@section('content')

<style>
    /* === 1. HERO SLIDER === */
    .hero-container {
        position: relative; 
        width: 100%; 
        height: 100vh; /* Full Height */
        margin-top: -100px; /* Tarik ke atas menutupi navbar */
        padding-top: 100px; /* Kompensasi isi */
        overflow: hidden; 
        background: #333;
    }
    .slide-item {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0; transition: opacity 1s ease-in-out;
        display: flex; align-items: center; justify-content: center;
        z-index: 0;
    }
    .slide-item.active { opacity: 1; z-index: 1; }
    
    .slide-bg {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover; filter: brightness(0.6); /* Gelapkan gambar */
    }
    
    .slide-content {
        position: relative; z-index: 2; color: white; text-align: center;
        max-width: 800px; padding: 20px; margin-top: 60px;
    }
    .slide-title { font-size: 3.5rem; font-weight: 800; margin-bottom: 20px; text-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .slide-desc { font-size: 1.2rem; margin-bottom: 40px; line-height: 1.6; }
    
    .btn-cta {
        padding: 15px 40px; background: #e68a2e; color: white; text-decoration: none;
        border-radius: 50px; font-weight: 700; transition: 0.3s; display: inline-block;
        box-shadow: 0 10px 20px rgba(230, 138, 46, 0.4);
    }
    .btn-cta:hover { background: #d97706; transform: translateY(-5px); }

    /* Tombol Navigasi Hero */
    .hero-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,0.2); border: none; color: white;
        width: 50px; height: 50px; border-radius: 50%; cursor: pointer;
        z-index: 10; display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
    }
    .hero-nav:hover { background: rgba(255,255,255,0.9); color: #333; }
    .hero-prev { left: 40px; }
    .hero-next { right: 40px; }


    /* === 2. LAYANAN SECTION === */
    .services-section-wrapper { margin-top: 0; }
    .section-container { max-width: 1100px; margin: 80px auto; padding: 0 20px; }
    .sec-head { text-align: center; margin-bottom: 50px; }
    .sec-title { font-size: 2rem; font-weight: 700; color: #3b5d84; margin-bottom: 10px; }
    .sec-sub { color: #666; max-width: 600px; margin: 0 auto; }

    .blue-bg-full {
        background-color: #537FA0; width: 100%; padding: 80px 0;
        margin-top: 50px;
    }
    .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1100px; margin: 0 auto; padding: 0 20px; }
    
    .svc-card {
        background: white; border-radius: 20px; overflow: hidden;
        text-align: center; transition: 0.3s; height: 100%;
        display: flex; flex-direction: column;
    }
    .svc-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
    .svc-img { width: 100%; height: 200px; object-fit: cover; }
    .svc-body { padding: 30px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .svc-name { font-size: 1.4rem; font-weight: 700; color: #333; margin-bottom: 15px; }
    .svc-txt { font-size: 0.95rem; color: #666; margin-bottom: 25px; line-height: 1.6; }
    .btn-svc { background: #3b5d84; color: white; padding: 10px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; align-self: center; }


    /* === 3. PSIKOLOG SLIDER (Split Layout) === */
    .psy-spotlight-container {
        display: flex; align-items: center; justify-content: space-between;
        gap: 60px; flex-wrap: wrap; margin: 100px auto;
    }
    .psy-left { flex: 1; min-width: 300px; }
    .psy-title { font-size: 2.2rem; font-weight: 700; color: #3b5d84; line-height: 1.3; margin-bottom: 20px; }
    .psy-desc { color: #666; margin-bottom: 30px; line-height: 1.8; font-size: 1rem; }
    .tag-container { display: flex; flex-wrap: wrap; gap: 10px; }
    .tag-pill { background: #e2e8f0; color: #475569; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; }

    /* Slider Card Kanan */
    .psy-right { flex: 0 0 350px; position: relative; }
    .psy-card-box {
        background: white; border-radius: 25px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08); border: 1px solid #f1f5f9;
        padding: 40px 30px; text-align: center;
        position: relative; overflow: hidden;
    }
    .avatar-sunburst {
        width: 130px; height: 130px; margin: 0 auto 20px; border-radius: 50%;
        background: repeating-conic-gradient(#ffffff 0% 10%, #dbeafe 10% 20%);
        padding: 6px;
    }
    .avatar-sunburst img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 3px solid white; }
    .psy-role { color: #3b5d84; font-weight: 700; font-size: 0.9rem; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px; }
    .psy-name { font-size: 1.3rem; font-weight: 800; color: #333; line-height: 1.3; margin-bottom: 5px; }
    .psy-degree { font-size: 0.9rem; color: #888; }

    /* Navigasi Slide Card */
    .card-nav { display: flex; justify-content: space-between; margin-top: 30px; padding: 0 10px; align-items: center; }
    .nav-arrow { cursor: pointer; color: #ccc; font-size: 1.5rem; transition: 0.2s; user-select: none; }
    .nav-arrow:hover { color: #3b5d84; transform: scale(1.2); }
    .dots { display: flex; gap: 6px; }
    .dot { width: 8px; height: 8px; background: #ddd; border-radius: 50%; transition: 0.3s; }
    .dot.active { background: #3b5d84; width: 20px; border-radius: 10px; }

    .slide-profile { display: none; animation: fadeUp 0.5s; }
    .slide-profile.active { display: block; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Responsive */
    @media(max-width: 992px) {
        .psy-spotlight-container { flex-direction: column; text-align: center; }
        .tag-container { justify-content: center; }
        .psy-right { width: 100%; max-width: 400px; }
    }
</style>

{{-- 1. HERO SLIDER --}}
<div class="hero-container">
    @if(isset($slides) && count($slides) > 0)
        @foreach($slides as $index => $slide)
            <div class="slide-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ $slide->image_url }}" class="slide-bg" alt="Hero">
                <div style="position:absolute; width:100%; height:100%; background:rgba(0,0,0,0.4);"></div>
                <div class="slide-content">
                    <h1 class="slide-title">{{ $slide->title }}</h1>
                    <p class="slide-desc">{{ $slide->description }}</p>
                    <a href="{{ url($slide->cta_link) }}" class="btn-cta">{{ $slide->cta_text }}</a>
                </div>
            </div>
        @endforeach
        <button class="hero-nav hero-prev" onclick="moveHero(-1)">&#10094;</button>
        <button class="hero-nav hero-next" onclick="moveHero(1)">&#10095;</button>
    @else
        <div style="height:100%; display:flex; align-items:center; justify-content:center; color:white;">
            <h2>Data Slide Sedang Dimuat...</h2>
        </div>
    @endif
</div>

{{-- 2. LAYANAN KONSELING --}}
<div class="services-section-wrapper">
    <div class="section-container" style="margin-bottom: 0;">
        <div class="sec-head">
            <div class="sec-title">Layanan Konseling</div>
            <div class="sec-sub">Temukan layanan yang cocok untuk menjaga kesehatan mental Anda</div>
        </div>
    </div>

    <div class="blue-bg-full">
        <div class="services-grid">
            <div class="svc-card">
                <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80" class="svc-img">
                <div class="svc-body">
                    <div>
                        <div class="svc-name">Individual</div>
                        <p class="svc-txt">Konseling privat antara individu dan psikolog langsung, tatap muka atau online.</p>
                    </div>
                    <a href="{{ route('konseling.individual') }}" class="btn-svc">Mulai Konseling</a>
                </div>
            </div>
            <div class="svc-card">
                <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?q=80" class="svc-img">
                <div class="svc-body">
                    <div>
                        <div class="svc-name">Kelompok</div>
                        <p class="svc-txt">Konseling kelompok dengan psikolog untuk menyelesaikan masalah bersama.</p>
                    </div>
                    <a href="{{ route('konseling.kelompok') }}" class="btn-svc">Mulai Konseling</a>
                </div>
            </div>
            <div class="svc-card">
                <img src="https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80" class="svc-img">
                <div class="svc-body">
                    <div>
                        <div class="svc-name">Request Narasumber</div>
                        <p class="svc-txt">Undang psikolog kami untuk menjadi pembicara seminar atau narasumber tugas.</p>
                    </div>
                    <a href="{{ route('konseling.narasumber') }}" class="btn-svc">Mulai Konseling</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 3. PSIKOLOG SPOTLIGHT (SLIDER FITUR) --}}
<div class="section-container">
    <div class="psy-spotlight-container">
        
        {{-- KIRI: TEKS --}}
        <div class="psy-left">
            <h2 class="psy-title">
                Bersama ConnectED,<br>
                <span style="color: #e68a2e;">psikolog kami akan mendengarkan kisahmu!</span>
            </h2>
            <p class="psy-desc">
                Anda bisa memilih psikolog sesuai dengan preferensi Anda. Temukan profesional yang tepat untuk mendampingi perjalanan kesehatan mental Anda dengan pendekatan yang hangat dan suportif.
            </p>
            <div class="tag-container">
                <span class="tag-pill">Depression</span><span class="tag-pill">Burnout</span>
                <span class="tag-pill">Insomnia</span><span class="tag-pill">Self-Harm</span>
                <span class="tag-pill">Trust Issues</span><span class="tag-pill">Anxiety</span>
                <span class="tag-pill">Toxic Relationship</span><span class="tag-pill">Trauma</span>
            </div>
        </div>

        {{-- KANAN: CARD SLIDER --}}
        <div class="psy-right">
            <div class="psy-card-box">
                
                @if(isset($psychologists) && count($psychologists) > 0)
                    @foreach($psychologists as $idx => $psy)
                        <div class="slide-profile {{ $idx == 0 ? 'active' : '' }}" id="psy-{{ $idx }}">
                            <div class="avatar-sunburst">
                                {{-- FOTO OTOMATIS (Fallback ke UI Avatars) --}}
                                <img src="{{ $psy['image'] ?? 'https://ui-avatars.com/api/?name='.urlencode($psy['name']).'&background=3b5d84&color=fff&size=200' }}">
                            </div>
                            <div class="psy-role">{{ $psy['role'] ?? 'Psikolog UMN' }}</div>
                            <div class="psy-name">{{ $psy['name'] }}</div>
                            <div class="psy-degree">Psikolog Klinis</div>
                        </div>
                    @endforeach

                    {{-- Navigasi Tombol --}}
                    <div class="card-nav">
                        <div class="nav-arrow" onclick="changePsy(-1)">&#10094;</div>
                        <div class="dots">
                            @foreach($psychologists as $idx => $psy)
                                <div class="dot {{ $idx == 0 ? 'active' : '' }}" id="dot-{{ $idx }}"></div>
                            @endforeach
                        </div>
                        <div class="nav-arrow" onclick="changePsy(1)">&#10095;</div>
                    </div>
                @else
                    <p>Data konselor belum tersedia.</p>
                @endif

            </div>
        </div>

    </div>
</div>

{{-- 4. TESTIMONI (Static untuk Home) --}}
<div class="section-container">
    <div class="sec-head">
        <div class="sec-title">Suara mereka yang sudah berkonsultasi</div>
        <div class="sec-sub" style="color:#e68a2e; font-weight:700;">bersama ConnectED</div>
    </div>
    </div>

{{-- JAVASCRIPT UNTUK 2 SLIDER --}}
<script>
    // === 1. HERO SLIDER LOGIC ===
    let heroIndex = 0;
    const heroSlides = document.querySelectorAll('.slide-item');
    
    function moveHero(n) {
        if(heroSlides.length === 0) return;
        heroSlides[heroIndex].classList.remove('active');
        heroIndex += n;
        if(heroIndex >= heroSlides.length) heroIndex = 0;
        if(heroIndex < 0) heroIndex = heroSlides.length - 1;
        heroSlides[heroIndex].classList.add('active');
    }
    // Auto Slide Hero
    setInterval(() => moveHero(1), 5000); 

    // === 2. PSIKOLOG SLIDER LOGIC ===
    let psyIndex = 0;
    const psySlides = document.querySelectorAll('.slide-profile');
    const psyDots = document.querySelectorAll('.dot');

    function changePsy(n) {
        if(psySlides.length === 0) return;
        
        // Hide Current
        psySlides[psyIndex].classList.remove('active');
        if(psyDots[psyIndex]) psyDots[psyIndex].classList.remove('active');

        // Calculate Next
        psyIndex += n;
        if(psyIndex >= psySlides.length) psyIndex = 0;
        if(psyIndex < 0) psyIndex = psySlides.length - 1;

        // Show Next
        psySlides[psyIndex].classList.add('active');
        if(psyDots[psyIndex]) psyDots[psyIndex].classList.add('active');
    }
</script>

@endsection