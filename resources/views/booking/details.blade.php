@extends('layouts.app')

@section('title', 'Detail Booking - ConnectED')

@section('content')

<style>
    /* Layout Utama */
    .booking-wrapper { max-width: 1100px; margin: 120px auto 50px; display: flex; gap: 40px; padding: 0 20px; align-items: flex-start; }
    .left-sidebar { width: 300px; flex-shrink: 0; position: sticky; top: 110px; }
    .right-content { flex-grow: 1; }

    /* Kartu Putih */
    .white-card { background: #fff; border-radius: 25px; padding: 35px; border: 1px solid #eee; box-shadow: 0 5px 20px rgba(0,0,0,0.03); }

    /* Sidebar Styles */
    .psy-profile { text-align: center; margin-bottom: 20px; }
    .sunburst-bg { width: 110px; height: 110px; margin: 0 auto 15px; border-radius: 50%; background: repeating-conic-gradient(#ffffff 0% 10%, #eef7ff 10% 20%); padding: 5px; }
    .sunburst-bg img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 3px solid white; }
    .psy-name { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 5px; }
    .psy-role { color: #6ca0c2; font-weight: 600; font-size: 0.9rem; margin-bottom: 15px; }
    
    .sidebar-info-row { font-size: 0.9rem; color: #666; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
    .sidebar-info-row i { width: 20px; text-align: center; }
    
    .btn-change-sched {
        width: 100%; padding: 10px; border: 1px solid #e68a2e; color: #e68a2e;
        background: white; border-radius: 30px; cursor: pointer; font-weight: 600;
        font-size: 0.9rem; transition: 0.3s; margin-top: 15px;
    }
    .btn-change-sched:hover { background: #e68a2e; color: white; }

    /* FORM STYLES */
    h3.section-title { font-size: 1.2rem; font-weight: 700; color: #333; margin-bottom: 20px; }
    label.lbl { display: block; font-weight: 600; margin-bottom: 10px; color: #333; font-size: 0.95rem; }

    /* Tombol Pilihan (Pill Buttons) */
    .btn-toggle {
        background: white; border: 1px solid #e0e0e0; color: #666;
        padding: 10px 25px; border-radius: 8px; cursor: pointer;
        font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 0.9rem;
        transition: all 0.2s; min-width: 100px; margin-right: 10px; margin-bottom: 10px;
    }
    .btn-toggle:hover { border-color: #6ca0c2; color: #6ca0c2; }
    .btn-toggle.active {
        background: #3b5d84; color: white; border-color: #3b5d84;
        box-shadow: 0 4px 10px rgba(59, 93, 132, 0.2);
    }

    /* Input Form Style */
    .form-group { margin-bottom: 25px; }
    .form-control {
        width: 100%; padding: 12px 15px; border: 1px solid #ddd;
        border-radius: 10px; font-size: 0.95rem; font-family: 'Poppins', sans-serif;
        transition: border 0.3s; background: #fff;
    }
    .form-control:focus { outline: none; border-color: #6ca0c2; }
    .form-note { font-size: 0.75rem; color: #999; margin-top: 5px; display: block; }

    /* Footer & Progress */
    .footer-action {
        margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;
        display: flex; justify-content: flex-end; align-items: center;
    }
    .btn-next {
        background: #e68a2e; color: white; border: none; padding: 12px 40px;
        border-radius: 30px; font-weight: 600; cursor: pointer; font-size: 1rem;
        box-shadow: 0 4px 15px rgba(230, 138, 46, 0.3); transition: 0.3s;
    }
    .btn-next:hover { background: #d37518; transform: translateY(-2px); }
    .btn-next:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }

    .progress-container { flex-grow: 1; display: flex; align-items: center; gap: 15px; }
    .circle-step {
        width: 40px; height: 40px; border-radius: 50%;
        border: 3px solid #e0e0e0; display: flex; align-items: center; justify-content: center;
        font-weight: 700; color: #3b5d84; font-size: 0.85rem;
    }
    .step-text { font-size: 0.85rem; color: #888; display: flex; flex-direction: column; line-height: 1.2; }
    .step-text strong { font-size: 0.95rem; color: #333; }
    
    /* Tag Spesialisasi */
    .tag-badge { background:#f0f4f8; padding:5px 12px; border-radius:15px; font-size:0.8rem; color:#555; }

    @media (max-width: 768px) {
        .booking-wrapper { flex-direction: column; }
        .left-sidebar { width: 100%; position: static; }
    }
</style>

<div class="booking-wrapper">
    
    {{-- SIDEBAR KIRI --}}
    <div class="left-sidebar">
        <div class="white-card">
            <div class="psy-profile">
                <div class="sunburst-bg">
                    {{-- FOTO DINAMIS --}}
                    <img src="{{ $psychologist->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($psychologist->name) }}" alt="Foto Psikolog">
                </div>
                {{-- ROLE & NAMA DINAMIS --}}
                <div class="psy-role">{{ ucfirst($psychologist->role) ?? 'Psikolog' }}</div>
                <div class="psy-name">{{ $psychologist->name }}</div>
                <div style="font-size:0.85rem; color:#888;">{{ $psychologist->title ?? 'Konselor UMN' }}</div>
            </div>

            <div id="sidebar-step-1">
                <div class="sidebar-info-row">
                    <i class="fa-regular fa-calendar"></i> 
                    {{ \Carbon\Carbon::parse($selected_date)->translatedFormat('l, d M Y') }}
                </div>
                <div class="sidebar-info-row">
                    <i class="fa-regular fa-clock"></i> <span id="display-time-step1">-</span>
                </div>
                <button class="btn-change-sched" onclick="window.history.back()">Ganti Jadwal</button>
            </div>

            <div id="sidebar-step-2" style="display:none; border-top:1px dashed #eee; margin-top:20px; padding-top:20px;">
                <label style="font-size:0.8rem; color:#999; text-transform:uppercase; letter-spacing:1px; font-weight:600;">Ringkasan</label>
                
                <div style="margin-top:10px;">
                    <div style="font-size:0.85rem; color:#888;">Metode</div>
                    <div style="font-weight:600; color:#333; margin-bottom:8px;" id="sum-method">-</div>

                    <div style="font-size:0.85rem; color:#888;">Tanggal & Jam</div>
                    <div style="font-weight:600; color:#333; margin-bottom:8px;">
                        {{ \Carbon\Carbon::parse($selected_date)->translatedFormat('d M Y') }}<br>
                        <span id="sum-time">-</span>
                    </div>

                    <div style="font-size:0.85rem; color:#888;">Jenis</div>
                    <div style="font-weight:600; color:#333;" id="sum-type">-</div>
                </div>
            </div>

        </div>
    </div>

    {{-- KONTEN KANAN --}}
    <div class="right-content">
        <div class="white-card">
            
            {{-- STEP 1: PILIH JADWAL --}}
            <div id="step-1-container">
                <h3 class="section-title">Detail Psikolog</h3>
                <p style="color:#666; font-size:0.95rem; line-height:1.6; margin-bottom:20px;">
                    {{-- DESKRIPSI DINAMIS --}}
                    {{ $psychologist->description ?? $psychologist->name . ' siap membantu mendengarkan keluh kesah Anda.' }}
                </p>
                
                {{-- Tags Dinamis --}}
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:30px;">
                    @php
                        $tags = !empty($psychologist->specialties) ? explode(',', $psychologist->specialties) : ['Konseling Umum'];
                    @endphp
                    @foreach($tags as $tag)
                        <span class="tag-badge">{{ trim($tag) }}</span>
                    @endforeach
                </div>

                <hr style="border:0; border-top:1px solid #eee; margin-bottom:25px;">

                <div class="form-group">
                    <label class="lbl">Layanan yang tersedia</label>
                    <div>
                        <button type="button" class="btn-toggle" onclick="selectMethod('Offline', this)">Offline</button>
                        <button type="button" class="btn-toggle" onclick="selectMethod('Online', this)">Online</button>
                    </div>
                </div>

                <div class="form-group" id="grp-time" style="display:none;">
                    <label class="lbl">Tanggal dan Jam Konseling</label>
                    <div style="display:flex; gap:10px; margin-bottom:10px;">
                         <button style="background:#3b5d84; color:white; border:none; padding:8px 15px; border-radius:8px; font-size:0.85rem;">
                            <i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($selected_date)->format('d M') }}
                         </button>
                    </div>
                    <div>
                        {{-- Jam --}}
                        <button type="button" class="btn-toggle" onclick="selectTime('10:00 - 11:00', this)">10:00 - 11:00</button>
                        <button type="button" class="btn-toggle" onclick="selectTime('13:00 - 14:00', this)">13:00 - 14:00</button>
                        <button type="button" class="btn-toggle" onclick="selectTime('14:00 - 15:00', this)">14:00 - 15:00</button>
                    </div>
                </div>

                <div class="form-group" id="grp-type" style="display:none;">
                    <label class="lbl">Jenis Konseling</label>
                    <div>
                        <button type="button" class="btn-toggle" onclick="selectType('Individual', this)">Individual</button>
                        <button type="button" class="btn-toggle" onclick="selectType('Kelompok', this)">Kelompok</button>
                        <button type="button" class="btn-toggle" onclick="selectType('Narasumber', this)">Narasumber</button>
                    </div>
                </div>

                <div class="footer-action">
                    <div class="progress-container">
                        <div class="circle-step" style="border-color:#3b5d84; color:#3b5d84;">1/3</div>
                        <div class="step-text">
                            <strong style="color:#3b5d84">Sesi Konseling</strong>
                            <span>Pilih jadwal & metode</span>
                        </div>
                    </div>
                    <button id="btn-goto-step2" class="btn-next" disabled onclick="goToStep2()">Buat Janji</button>
                </div>
            </div>


            {{-- STEP 2: ISI FORM --}}
            <div id="step-2-container" style="display:none;">
                
                <div id="online-media-options" style="display:none; margin-bottom:30px; background:#f9fbff; padding:20px; border-radius:15px; border:1px solid #eef2f6;">
                    <label class="lbl">Pilih Metode Konseling (Wajib)</label>
                    <div style="display:flex; gap:10px;">
                        <button type="button" class="btn-toggle" onclick="selectMedia('Chat', this)">Chat</button>
                        <button type="button" class="btn-toggle" onclick="selectMedia('Voice Call', this)">Voice Call</button>
                        <button type="button" class="btn-toggle" onclick="selectMedia('Video Call', this)">Video Call</button>
                    </div>
                    <small id="media-error" style="color:red; display:none; margin-top:5px;">Harap pilih salah satu media.</small>
                </div>

                <form action="{{ route('booking.process') }}" method="POST" id="bookingForm" onsubmit="return validateForm()">
                    @csrf
                    
                    {{-- INPUT HIDDEN PENTING: ID PSIKOLOG --}}
                    {{-- Ini yang menentukan booking masuk ke siapa --}}
                    <input type="hidden" name="psychologist_id" value="{{ $psychologist->user_id }}">
                    <input type="hidden" name="booking_date" value="{{ $selected_date }}">
                    
                    <input type="hidden" name="method" id="input_method">
                    <input type="hidden" name="booking_time" id="input_time">
                    <input type="hidden" name="type" id="input_type">
                    <input type="hidden" name="media" id="input_media"> 
                    
                    <div class="form-group">
                        <label class="lbl">Topik Konseling</label>
                        <select name="topic" class="form-control" required>
                            <option value="" disabled selected>Pilih Topik Masalah</option>
                            <option>Akademik</option>
                            <option>Pribadi & Emosi</option>
                            <option>Sosial & Keluarga</option>
                            <option>Karir</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="lbl">Deskripsi Masalah</label>
                        <textarea name="description" class="form-control" rows="6" placeholder="Ceritakan sedikit tentang apa yang kamu rasakan..." required minlength="20"></textarea>
                        <span class="form-note">*minimal 20 karakter</span>
                    </div>

                    <div class="form-group">
                        <label class="lbl">Harapan Setelah Konseling</label>
                        <textarea name="hope" class="form-control" rows="3" placeholder="Masukkan harapan setelah konseling" required></textarea>
                    </div>

                    <div class="footer-action">
                        <div class="progress-container">
                            <div class="circle-step" style="border-color:#3b5d84; color:#3b5d84;">2/3</div>
                            <div class="step-text">
                                <strong style="color:#3b5d84">Detail Masalah</strong>
                                <span>Isi form keluhan</span>
                            </div>
                        </div>
                        <button type="submit" class="btn-next">Selesaikan Janji</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
    // State Data
    let bookingData = {
        method: '',
        time: '',
        type: '',
        media: '' 
    };

    function setActive(btn) {
        let siblings = btn.parentElement.children;
        for (let i = 0; i < siblings.length; i++) {
            siblings[i].classList.remove('active');
        }
        btn.classList.add('active');
    }

    // --- STEP 1 ---
    function selectMethod(val, btn) {
        bookingData.method = val;
        setActive(btn);
        document.getElementById('grp-time').style.display = 'block';
        checkStep1();
    }

    function selectTime(val, btn) {
        bookingData.time = val;
        setActive(btn);
        document.getElementById('display-time-step1').innerText = val;
        document.getElementById('grp-type').style.display = 'block';
        checkStep1();
    }

    function selectType(val, btn) {
        bookingData.type = val;
        setActive(btn);
        checkStep1();
    }

    function checkStep1() {
        if (bookingData.method && bookingData.time && bookingData.type) {
            document.getElementById('btn-goto-step2').disabled = false;
        }
    }

    // --- GO TO STEP 2 ---
    function goToStep2() {
        document.getElementById('input_method').value = bookingData.method;
        document.getElementById('input_time').value = bookingData.time;
        document.getElementById('input_type').value = bookingData.type;

        document.getElementById('sidebar-step-1').style.display = 'none';
        document.getElementById('sidebar-step-2').style.display = 'block';
        
        document.getElementById('sum-method').innerText = bookingData.method;
        document.getElementById('sum-time').innerText = bookingData.time;
        document.getElementById('sum-type').innerText = bookingData.type;

        if (bookingData.method === 'Online') {
            document.getElementById('online-media-options').style.display = 'block';
        } else {
            document.getElementById('online-media-options').style.display = 'none';
            document.getElementById('input_media').value = 'Tatap Muka'; 
        }

        document.getElementById('step-1-container').style.display = 'none';
        document.getElementById('step-2-container').style.display = 'block';
        
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }

    // --- STEP 2 ---
    function selectMedia(val, btn) {
        bookingData.media = val;
        document.getElementById('input_media').value = val;
        document.getElementById('media-error').style.display = 'none';
        setActive(btn);
    }

    function validateForm() {
        if (bookingData.method === 'Online' && !bookingData.media) {
            document.getElementById('media-error').style.display = 'block';
            alert('Silakan pilih metode Chat, Voice Call, atau Video Call.');
            return false;
        }
        return true;
    }
</script>

@endsection