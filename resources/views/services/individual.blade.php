@extends('layouts.app')
@section('title', 'Konseling Individual')
@section('content')

<style>
    /* CSS SERVICE HALAMAN */
    .service-bg-blue { background-color: #537FA0; padding-top: 140px; padding-bottom: 150px; text-align: center; }
    .hero-wrapper { position: relative; width: 90%; max-width: 1100px; height: 400px; margin: 0 auto; border-radius: 25px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
    .hero-bg-img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.5); }
    .hero-content-text { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; width: 80%; z-index: 2; }
    .hero-title { font-size: 3rem; font-weight: 700; margin-bottom: 10px; }
    .hero-desc { font-size: 1.1rem; line-height: 1.6; font-weight: 400; }
    .overlap-cards { max-width: 1100px; margin: -100px auto 0; padding: 0 20px 60px; position: relative; z-index: 10; }
    .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; }
    .info-card { background: white; border-radius: 25px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s; }
    .info-card:hover { transform: translateY(-5px); }
    .card-icon svg { width: 60px; height: 60px; margin-bottom: 20px; color: #333; stroke-width: 1.5; }
    .card-title { font-size: 1.3rem; font-weight: 700; color: #333; margin-bottom: 20px; }
    .card-divider { width: 50px; height: 3px; background: #333; margin: 0 auto 25px; }
    .card-list { text-align: left; list-style: none; padding: 0; color: #555; font-size: 0.95rem; line-height: 1.8; }
    .card-list li { margin-bottom: 10px; padding-left: 25px; position: relative; }
    .card-list li::before { content: "✓"; position: absolute; left: 0; color: #333; font-weight: bold; }

    /* CSS TESTIMONI KHUSUS */
    .testimoni-wrapper { text-align: center; margin-top: 80px; }
    .testi-title { color: #537FA0; font-size: 1.8rem; font-weight: 700; line-height: 1.3; }
    .testi-title span { color: #e68a2e; } /* Warna Orange */
    .testi-desc { color: #666; margin: 10px auto 40px; font-size: 0.95rem; max-width: 600px; }
    .testi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; text-align: left; }
    .testi-card { background: white; border-radius: 20px; padding: 25px; border: 1px solid #eee; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    .testi-header { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
    .avatar-circle { width: 45px; height: 45px; background: #e68a2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; }
    .testi-role { font-weight: 700; font-size: 0.9rem; color: #333; }
    .testi-text { font-size: 0.9rem; color: #555; line-height: 1.6; margin-bottom: 15px; }
    .testi-date { font-size: 0.75rem; color: #aaa; text-align: right; }
</style>

{{-- HERO --}}
<div class="service-bg-blue">
    <div class="hero-wrapper">
        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80" class="hero-bg-img">
        <div class="hero-content-text">
            <div class="hero-title">Individual</div>
            <div class="hero-desc">Konseling yang akan dilakukan antara individu dan psikolog langsung.</div>
        </div>
    </div>
</div>

{{-- KONTEN UTAMA --}}
<div class="overlap-cards">
    <div class="cards-grid">
        <div class="info-card">
            <div class="card-title">Akademik & Karir</div>
            <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></div>
            <div class="card-divider"></div>
            <ul class="card-list">
                <li>Mengalami burnout kuliah atau skripsi.</li>
                <li>Bingung menentukan arah karir.</li>
                <li>Merasa salah jurusan atau performa menurun.</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="card-title">Personal & Emosi</div>
            <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></div>
            <div class="card-divider"></div>
            <ul class="card-list">
                <li>Merasa cemas (anxiety) berlebihan.</li>
                <li>Insecure atau krisis kepercayaan diri.</li>
                <li>Kesulitan mengelola emosi atau stres.</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="card-title">Relasi & Sosial</div>
            <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></div>
            <div class="card-divider"></div>
            <ul class="card-list">
                <li>Masalah pertemanan atau percintaan.</li>
                <li>Merasa kesepian di lingkungan kampus.</li>
                <li>Konflik keluarga yang membebani pikiran.</li>
            </ul>
        </div>
    </div>

    {{-- TESTIMONI SECTION (BARU) --}}
    <div class="testimoni-wrapper">
        <div class="testi-title">Suara mereka yang sudah berkonsultasi<br><span>bersama ConnectED</span></div>
        <p class="testi-desc">Kisah mereka yang sudah berjuang bersama ConnectED, kamu juga bisa seperti mereka karena semua cerita layak didengar.</p>

        <div class="testi-grid">
            <div class="testi-card">
                <div class="testi-header">
                    <div class="avatar-circle">MJ</div>
                    <div class="testi-role">e-Counseling</div>
                </div>
                <p class="testi-text">"Awalnya ragu buat cerita soal burnout. Tapi ternyata psikolognya suportif dan nggak nge-judge. Plong banget rasanya."</p>
                <div class="testi-date">21 November 2025</div>
            </div>

            <div class="testi-card">
                <div class="testi-header">
                    <div class="avatar-circle">AL</div>
                    <div class="testi-role">Counseling</div>
                </div>
                <p class="testi-text">"Jujurly, sempet burnout parah gara-gara skripsi. Untung nyoba counseling, psikolognya keren abis solusinya."</p>
                <div class="testi-date">30 Oktober 2025</div>
            </div>

            <div class="testi-card">
                <div class="testi-header">
                    <div class="avatar-circle">KV</div>
                    <div class="testi-role">e-Counseling</div>
                </div>
                <p class="testi-text">"Vibe sesi nyaman banget, bener-bener safe space buat cerita masalah yang complicated. Beban hilang semua."</p>
                <div class="testi-date">08 November 2025</div>
            </div>
        </div>
    </div>
    
</div>
@endsection