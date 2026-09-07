@extends('layouts.app')

@section('title', 'Jadwal Konseling - ConnectED')

@section('content')

@push('styles')
    <style>
        /* --- Layout Utama --- */
        .booking-wrapper {
            max-width: 1200px;
            margin: 100px auto 50px;
            padding: 0 20px;
            display: flex;
            gap: 30px;
            align-items: flex-start; /* Penting agar sidebar sticky jalan */
        }

        /* --- Sidebar Profil --- */
        .booking-sidebar {
            width: 280px;
            flex-shrink: 0;
            position: sticky;
            top: 110px; /* Jarak dari atas saat scroll */
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
            overflow: hidden;
            text-align: center;
            z-index: 10;
        }

        .sidebar-top {
            background: linear-gradient(135deg, #eef7ff 0%, #ffffff 100%);
            padding: 30px 20px 20px;
        }

        .sidebar-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 10px;
        }

        .sidebar-name { font-weight: 700; color: #333; font-size: 1.1rem; }
        .sidebar-nim { font-size: 0.9rem; color: #666; font-weight: 500; }
        .sidebar-email { font-size: 0.85rem; color: #888; padding-bottom: 20px; }

        /* --- Konten Utama --- */
        .booking-content { flex-grow: 1; min-width: 0; }

        .schedule-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        /* --- Tabs Tanggal --- */
        .date-tabs {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 10px;
            scrollbar-width: thin;
            -webkit-overflow-scrolling: touch;
        }

        .date-tab-item {
            min-width: 90px;
            height: 90px;
            background: white;
            border: 1px solid #eee;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
            user-select: none;
        }

        .date-tab-item:hover { border-color: #6ca0c2; transform: translateY(-3px); }
        
        .date-tab-item.active {
            background: #3b5d84;
            border-color: #3b5d84;
            color: white;
            box-shadow: 0 6px 15px rgba(59, 93, 132, 0.3);
        }

        .date-tab-item.active span, .date-tab-item.active strong { color: white; }

        /* Tombol Kalender */
        .calendar-btn { position: relative; border: 1px dashed #ccc; background: #f9f9f9; }
        .calendar-input {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0; cursor: pointer;
        }

        /* Loading & Animasi */
        .loading-spinner { text-align: center; padding: 50px; color: #6ca0c2; display: none; }
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 768px) {
            .booking-wrapper { flex-direction: column; margin-top: 80px; }
            .booking-sidebar { width: 100%; position: static; margin-bottom: 20px; }
        }
    </style>
@endpush

<div class="booking-wrapper">
    {{-- Sidebar Profil --}}
    <aside class="booking-sidebar">
        <div class="sidebar-top">
            <img src="{{ Auth::user()->avatar_image ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}" 
                 class="sidebar-avatar" alt="Avatar">
        </div>
        <div class="sidebar-name">{{ Auth::user()->name }}</div>
        <div class="sidebar-nim">{{ Auth::user()->nim ?? 'Mahasiswa' }}</div>
        <div class="sidebar-email">{{ Auth::user()->email }}</div>
    </aside>

    {{-- Konten Jadwal --}}
    <main class="booking-content">
        <div class="schedule-header">Jadwal Psikolog</div>

        <div class="date-tabs" id="dateTabsContainer">
            {{-- Tombol Kalender --}}
            <div class="date-tab-item calendar-btn" id="calendarBtnWrapper">
                <i class="fa-regular fa-calendar-days" style="font-size: 1.5rem; margin-bottom: 5px; color:#666;"></i>
                <span class="calendar-text" style="font-size:0.8rem; font-weight:600;">Lainnya</span>
                <input type="date" class="calendar-input" id="datePickerInput" min="{{ $tomorrow }}">
            </div>
            
            @php 
                $hari_indo = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu']; 
            @endphp

            @for ($i = 1; $i <= 14; $i++)
                @php
                    $loop_date = date('Y-m-d', strtotime("+$i days"));
                    $day_eng = date('l', strtotime($loop_date));
                    $day_name = $hari_indo[$day_eng]; 
                    $date_num = date('d M', strtotime($loop_date));
                @endphp
                <div class="date-tab-item" data-date="{{ $loop_date }}" onclick="loadCounselors('{{ $loop_date }}', this)">
                    <span style="font-size:0.85rem; color:#666; margin-bottom:4px;">{{ $date_num }}</span>
                    <strong style="font-size:1rem; color:#333;">{{ $day_name }}</strong>
                </div>
            @endfor
        </div>

        <div id="counselorListContainer" style="margin-top: 30px; min-height: 200px;">
            <div id="loadingSpinner" class="loading-spinner">
                <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 2rem;"></i>
                <p style="margin-top: 10px;">Memuat data...</p>
            </div>
            <div id="contentArea"></div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    const dateInput = document.getElementById('datePickerInput');
    const calendarText = document.querySelector('#calendarBtnWrapper .calendar-text');
    const calendarWrapper = document.getElementById('calendarBtnWrapper');
    
    // Pastikan route ini ada di web.php
    const ajaxUrl = "{{ route('booking.counselors') }}";

    function getFormattedDateHTML(dateStr) {
        const date = new Date(dateStr);
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
        
        // Fix timezone issue
        const parts = dateStr.split('-');
        const d = new Date(parts[0], parts[1] - 1, parts[2]); 
        
        return `<div style="line-height:1.2;">${d.getDate()} ${months[d.getMonth()]}<div style="font-size:0.85em; opacity:0.8;">${days[d.getDay()]}</div></div>`;
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Klik tab pertama otomatis saat load
        const firstTab = document.querySelector('.date-tab-item[data-date]');
        if(firstTab) firstTab.click(); 
    });

    dateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        const existingTab = document.querySelector(`.date-tab-item[data-date="${selectedDate}"]`);
        
        if (existingTab) {
            existingTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            existingTab.click();
        } else {
            document.querySelectorAll('.date-tab-item').forEach(t => t.classList.remove('active'));
            calendarWrapper.classList.add('active');
            calendarText.innerHTML = getFormattedDateHTML(selectedDate);
            loadCounselors(selectedDate, null, false); 
        }
    });

    function loadCounselors(dateStr, element, updateInput = true) {
        if (updateInput && dateInput) dateInput.value = dateStr;
        
        if (element) {
            document.querySelectorAll('.date-tab-item').forEach(item => item.classList.remove('active'));
            element.classList.add('active');
            if(calendarWrapper) {
                calendarWrapper.classList.remove('active');
                calendarText.innerHTML = "Lainnya";
            }
        }

        const contentArea = document.getElementById('contentArea');
        const spinner = document.getElementById('loadingSpinner');
        
        if(contentArea && spinner) {
            contentArea.style.opacity = '0.3';
            spinner.style.display = 'block';

            fetch(ajaxUrl + '?date=' + dateStr)
                .then(res => res.text())
                .then(html => {
                    contentArea.innerHTML = html;
                    contentArea.classList.remove('fade-in');
                    void contentArea.offsetWidth; // trigger reflow
                    contentArea.classList.add('fade-in');
                    contentArea.style.opacity = '1';
                    spinner.style.display = 'none';
                })
                .catch(err => {
                    console.error(err);
                    contentArea.innerHTML = '<p class="text-center text-danger mt-4">Gagal memuat jadwal. Periksa koneksi Anda.</p>';
                    spinner.style.display = 'none';
                    contentArea.style.opacity = '1';
                });
        }
    }
</script>
@endpush