@extends('layouts.app')

@section('title', 'Booking Berhasil')

@section('content')

<div class="container" style="margin-top: 100px; margin-bottom: 50px; text-align: center;">
    
    <div class="white-card" style="background: white; padding: 50px; border-radius: 20px; max-width: 600px; margin: 0 auto; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        
        {{-- Icon Sukses --}}
        <div style="margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check" style="font-size: 4rem; color: #28a745;"></i>
        </div>

        <h2 style="font-weight: 700; color: #333; margin-bottom: 15px;">Booking Berhasil!</h2>
        <p style="color: #666; margin-bottom: 40px;">
            Jadwal konseling Anda telah berhasil dibuat. Silakan cek riwayat Anda secara berkala.
        </p>

        {{-- KARTU DETAIL BOOKING --}}
        <div style="border: 1px dashed #3b5d84; background: #f4f8fb; padding: 25px; border-radius: 15px; text-align: left;">
            
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; border-bottom: 1px solid #e1e5eb; padding-bottom: 15px;">
                {{-- FOTO (DINAMIS) --}}
                <img src="{{ $booking->psychologist->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($booking->psychologist->name) }}" 
                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                
                <div>
                    <div style="font-size: 0.75rem; color: #888; text-transform: uppercase; letter-spacing: 1px;">Konselor Anda</div>
                    
                    {{-- NAMA (DINAMIS) --}}
                    <div style="font-weight: 700; color: #333; font-size: 1.1rem;">
                        {{ $booking->psychologist->name }}
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <div>
                    <div style="font-size: 0.85rem; color: #888;">Metode</div>
                    <div style="font-weight: 600; color: #333;">{{ $booking->method }}</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.85rem; color: #888;">Jenis</div>
                    <div style="font-weight: 600; color: #333;">{{ $booking->type }}</div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.85rem; color: #888;">Tanggal</div>
                    <div style="font-weight: 600; color: #333;">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.85rem; color: #888;">Waktu</div>
                    <div style="font-weight: 600; color: #333;">{{ $booking->booking_time }}</div>
                </div>
            </div>
        </div>

        <div style="margin-top: 40px;">
            {{-- Pastikan route ini ada, atau ganti url('/settings') jika error --}}
            <a href="{{ route('booking.history') }}" style="color: #3b5d84; font-weight: 600; text-decoration: none; display: block; margin-bottom: 10px;">Lihat Riwayat</a>
            <a href="/" style="color: #888; font-size: 0.9rem; text-decoration: none;">Kembali ke Beranda</a>
        </div>

    </div>
</div>

@endsection