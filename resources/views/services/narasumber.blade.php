@extends('layouts.app')
@section('title', 'Request Narasumber')
@section('content')

{{-- Gunakan Style yang sama --}}
<style>
    /* COPY STYLE DARI INDIVIDUAL.BLADE.PHP DI SINI */
    .service-bg-blue { background-color: #537FA0; padding-top: 140px; padding-bottom: 150px; text-align: center; }
    .hero-wrapper { position: relative; width: 90%; max-width: 1100px; height: 400px; margin: 0 auto; border-radius: 25px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
    .hero-bg-img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.5); }
    .hero-content-text { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center; width: 80%; z-index: 2; }
    .hero-title { font-size: 3rem; font-weight: 700; margin-bottom: 10px; }
    .hero-desc { font-size: 1.1rem; line-height: 1.6; font-weight: 400; }
    .overlap-cards { max-width: 1100px; margin: -100px auto 0; padding: 0 20px 80px; position: relative; z-index: 10; }
    .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; }
    .info-card { background: white; border-radius: 25px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s; }
    .info-card:hover { transform: translateY(-5px); }
    .card-icon svg { width: 60px; height: 60px; margin-bottom: 20px; color: #333; stroke-width: 1.5; }
    .card-title { font-size: 1.3rem; font-weight: 700; color: #333; margin-bottom: 20px; }
    .card-divider { width: 50px; height: 3px; background: #333; margin: 0 auto 25px; }
    .card-list { text-align: left; list-style: none; padding: 0; color: #555; font-size: 0.95rem; line-height: 1.8; }
    .card-list li { margin-bottom: 10px; padding-left: 25px; position: relative; }
    .card-list li::before { content: "✓"; position: absolute; left: 0; color: #333; font-weight: bold; }
</style>

<div class="service-bg-blue">
    <div class="hero-wrapper">
        <img src="https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80" class="hero-bg-img">
        
        <div class="hero-content-text">
            <div class="hero-title">Request Narasumber</div>
            <div class="hero-desc">
                Mahasiswa dapat request untuk menjadikan Psikolog untuk menjadi narasumber project maupun acara-acara seminar.
            </div>
        </div>
    </div>
</div>

<div class="overlap-cards">
    <div class="cards-grid">
        <div class="info-card">
            <div class="card-title">Wawancara & Tugas</div>
            <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></div>
            <div class="card-divider"></div>
            <ul class="card-list">
                <li>Narasumber untuk data Skripsi/ Tugas Akhir.</li>
                <li>Wawancara tugas mata kuliah (Assignment).</li>
                <li>Liputan berita untuk media kampus.</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="card-title">Seminar & Talkshow</div>
            <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
            <div class="card-divider"></div>
            <ul class="card-list">
                <li>Pembicara untuk Webinar atau Seminar Kampus.</li>
                <li>Narasumber Talkshow HIMA/UKM.</li>
                <li>Edukasi seputar topik kesehatan mental populer.</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="card-title">Workshop & Training</div>
            <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></div>
            <div class="card-divider"></div>
            <ul class="card-list">
                <li>Fasilitator pelatihan (Training).</li>
                <li>Sesi Workshop interaktif.</li>
                <li>Pengembangan skill praktis (Soft-skills).</li>
            </ul>
        </div>
    </div>
</div>
@endsection