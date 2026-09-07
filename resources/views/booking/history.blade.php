@extends('layouts.app')

@section('title', 'Riwayat Konseling Saya')

@section('content')

<div class="container" style="margin-top: 120px; margin-bottom: 50px; max-width: 900px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h3 style="font-weight: 700; color: #333;">Riwayat Konseling Saya</h3>
        <a href="{{ route('booking.index') }}" class="btn btn-primary" style="border-radius: 20px; padding: 8px 20px;">
            <i class="fa-solid fa-plus"></i> Buat Janji Baru
        </a>
    </div>

    @if($bookings->isEmpty())
        <div style="text-align: center; padding: 50px; background: white; border-radius: 15px; border: 1px dashed #ccc;">
            <i class="fa-regular fa-folder-open" style="font-size: 3rem; color: #ccc; margin-bottom: 15px;"></i>
            <h5 style="color: #555;">Belum ada riwayat konseling.</h5>
            <p style="color: #888;">Yuk, buat jadwal konseling pertamamu sekarang!</p>
        </div>
    @else
        <div class="row">
            @foreach($bookings as $item)
            <div class="col-12 mb-3">
                <div style="background: white; padding: 20px; border-radius: 15px; border: 1px solid #f0f0f0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px;">
                    
                    {{-- CEK APAKAH PSIKOLOG ADA --}}
                    @if($item->psychologist)
                        <div style="flex-shrink: 0;">
                            <img src="{{ $item->psychologist->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($item->psychologist->name) }}" 
                                 style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 3px solid #f4f8fb;">
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <h5 style="margin: 0; font-weight: 700; font-size: 1.1rem; color: #333;">
                                    {{ $item->psychologist->name }}
                                </h5>
                                
                                {{-- BADGE STATUS (MANUAL) --}}
                                <div>
                                    @if($item->status == 'Pending')
                                        <span class="badge bg-warning text-dark" style="border-radius: 20px; padding: 6px 12px;">Menunggu</span>
                                    @elseif($item->status == 'Accepted')
                                        <span class="badge bg-success" style="border-radius: 20px; padding: 6px 12px;">Disetujui</span>
                                    @elseif($item->status == 'Completed')
                                        <span class="badge bg-primary" style="border-radius: 20px; padding: 6px 12px;">Selesai</span>
                                    @elseif($item->status == 'Cancelled')
                                        <span class="badge bg-danger" style="border-radius: 20px; padding: 6px 12px;">Dibatalkan</span>
                                    @endif
                                </div>
                            </div>

                    @else
                        {{-- JIKA PSIKOLOG TERHAPUS --}}
                        <div style="flex-shrink: 0;">
                            <img src="https://ui-avatars.com/api/?name=Unknown" 
                                 style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; filter: grayscale(100%);">
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <h5 style="margin: 0; font-weight: 700; font-size: 1.1rem; color: #999;">
                                    (Psikolog Tidak Ditemukan)
                                </h5>
                                
                                {{-- BADGE STATUS (MANUAL) --}}
                                <div>
                                    @if($item->status == 'Pending')
                                        <span class="badge bg-warning text-dark" style="border-radius: 20px; padding: 6px 12px;">Menunggu</span>
                                    @elseif($item->status == 'Accepted')
                                        <span class="badge bg-success" style="border-radius: 20px; padding: 6px 12px;">Disetujui</span>
                                    @elseif($item->status == 'Completed')
                                        <span class="badge bg-primary" style="border-radius: 20px; padding: 6px 12px;">Selesai</span>
                                    @elseif($item->status == 'Cancelled')
                                        <span class="badge bg-danger" style="border-radius: 20px; padding: 6px 12px;">Dibatalkan</span>
                                    @endif
                                </div>
                            </div>
                    @endif

                        <p style="margin: 0; color: #666; font-size: 0.9rem; margin-bottom: 8px;">
                            <i class="fa-solid fa-clipboard-list" style="color: #3b5d84; width: 20px;"></i> {{ $item->topic }} 
                            <span style="margin: 0 10px; color: #ddd;">|</span> 
                            {{ $item->type }} ({{ $item->method }})
                        </p>

                        <div style="font-size: 0.85rem; color: #3b5d84; font-weight: 600; background: #f4f8fb; display: inline-block; padding: 5px 15px; border-radius: 8px;">
                            <i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($item->booking_date)->translatedFormat('l, d F Y') }}
                            <span style="margin-left: 10px;">
                                <i class="fa-regular fa-clock"></i> {{ $item->booking_time }}
                            </span>
                        </div>
                    </div>

                    {{-- Tombol Cancel (Hanya jika Pending) --}}
                    @if($item->status == 'Pending')
                    <div style="border-left: 1px solid #eee; padding-left: 20px;">
                        <form action="{{ route('booking.cancel', $item->booking_id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan jadwal ini?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius: 50%; width: 40px; height: 40px;" title="Batalkan">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    </div>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@endsection