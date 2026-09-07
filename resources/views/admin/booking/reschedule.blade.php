@extends('layouts.admin')

@section('header_title', 'Reschedule Konseling')

@section('content')

<style>
    /* 1. KARTU UTAMA */
    .card-reschedule {
        border: none;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        overflow: hidden;
        background: white;
    }
    
    /* 2. HEADER GRADASI */
    .header-gradient {
        background: linear-gradient(135deg, #2c3e50 0%, #3b5d84 100%);
        padding: 35px 45px;
        color: white;
    }

    /* 3. INFO BOX */
    .info-box {
        background: #f8faff;
        border: 1px solid #e1e8f0;
        border-radius: 16px;
        padding: 25px;
    }

    /* 4. FORM INPUT MODERN */
    .input-wrapper {
        position: relative;
    }
    
    /* Ikon di dalam input */
    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #3b5d84;
        font-size: 1.2rem;
        z-index: 10;
        pointer-events: none;
    }

    /* Styling Input & Select */
    .form-control-modern, .form-select-modern {
        width: 100%;
        height: 58px; /* Tinggi fix agar seragam */
        padding: 10px 20px 10px 55px; /* Padding kiri besar untuk ikon */
        border-radius: 14px;
        border: 2px solid #eaedf2;
        background-color: #fdfdfd; /* Pakai background-color agar panah select tidak hilang */
        font-size: 1rem;
        font-weight: 500;
        color: #333;
        transition: all 0.3s ease;
        appearance: none; /* Reset style browser */
    }

    /* Efek Fokus */
    .form-control-modern:focus, .form-select-modern:focus {
        border-color: #3b5d84;
        background-color: white;
        box-shadow: 0 10px 20px rgba(59, 93, 132, 0.1);
        outline: none;
    }

    /* KHUSUS DROPDOWN (Memperbaiki Panah) */
    .select-wrapper {
        position: relative;
    }
    /* Kita buat panah custom agar rapih & konsisten di semua browser */
    .select-arrow {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        pointer-events: none;
    }

    /* LABEL FORM */
    .form-label-modern {
        font-size: 0.85rem;
        font-weight: 800;
        color: #666;
        margin-bottom: 12px;
        display: block;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* 5. TOMBOL */
    .btn-orange {
        background: linear-gradient(45deg, #FF8C00, #FFA500);
        color: white;
        padding: 15px 45px;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        box-shadow: 0 10px 25px rgba(255, 140, 0, 0.3);
        transition: all 0.3s;
        letter-spacing: 0.5px;
    }
    .btn-orange:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 140, 0, 0.4);
        color: white;
    }
    
    .btn-cancel {
        padding: 15px 35px;
        border-radius: 50px;
        font-weight: 600;
        color: #888;
        background: white;
        border: 2px solid #eee;
        transition: all 0.3s;
    }
    .btn-cancel:hover {
        background: #f1f1f1;
        color: #333;
        border-color: #ccc;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            
            <div class="card card-reschedule">
                
                {{-- HEADER --}}
                <div class="header-gradient d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="m-0 fw-bold">Reschedule Sesi</h4>
                        <p class="m-0 opacity-75 small mt-1">Atur ulang jadwal pertemuan konseling</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    {{-- INFO JADWAL LAMA --}}
                    <div class="info-box mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-history text-primary me-2"></i>
                            <h6 class="fw-bold m-0 text-dark">Jadwal Saat Ini</h6>
                        </div>
                        <div class="row g-2 small ps-4 border-start border-3 border-primary">
                            <div class="col-4 text-muted">Mahasiswa</div>
                            <div class="col-8 fw-bold text-dark">: {{ $booking->user->name }}</div>
                            
                            <div class="col-4 text-muted">Tanggal</div>
                            <div class="col-8 fw-bold text-dark">: {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</div>
                            
                            <div class="col-4 text-muted">Jam</div>
                            <div class="col-8 fw-bold text-dark">: {{ $booking->booking_time }}</div>
                        </div>
                    </div>

                    {{-- FORM INPUT --}}
                    <form action="{{ route('admin.booking.reschedule.process', $booking->id ?? $booking->booking_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- INPUT TANGGAL --}}
                        <div class="mb-4">
                            <label class="form-label-modern">Pilih Tanggal Baru</label>
                            <div class="input-wrapper">
                                <i class="far fa-calendar-check input-icon"></i>
                                <input type="date" name="new_date" class="form-control-modern" required min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        {{-- INPUT JAM (DROPDOWN RAPIH) --}}
                        <div class="mb-4">
                            <label class="form-label-modern">Pilih Jam Baru</label>
                            <div class="input-wrapper select-wrapper">
                                <i class="far fa-clock input-icon"></i>
                                
                                <select name="new_time" class="form-select-modern" required>
                                    <option value="" selected disabled>-- Pilih Waktu Sesi --</option>
                                    <option value="09:00 - 10:00">09:00 - 10:00</option>
                                    <option value="10:00 - 11:00">10:00 - 11:00</option>
                                    <option value="11:00 - 12:00">11:00 - 12:00</option>
                                    <option value="13:00 - 14:00">13:00 - 14:00</option>
                                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                                </select>
                                
                                {{-- Panah Custom (Agar rapih di semua browser) --}}
                                <i class="fas fa-chevron-down select-arrow"></i>
                            </div>
                        </div>

                        {{-- SPACER BESAR --}}
                        <div class="py-4"></div> 

                        {{-- TOMBOL AKSI (TERPISAH JAUH) --}}
                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="{{ route('admin.booking.list') }}" class="btn btn-cancel text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-orange">
                                Simpan Perubahan <i class="fas fa-check-circle ms-2"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection