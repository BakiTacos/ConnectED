@extends('layouts.app')

@section('title', 'Pengaturan Akun - ConnectED')

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 50px;">
    
    <div class="row">
        {{-- MENU TABS KIRI --}}
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                <div class="card-body p-0">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-left py-3 px-4" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#profil" type="button" role="tab">
                            <i class="fa-regular fa-user me-2"></i> Profil Saya
                        </button>
                        <button class="nav-link text-left py-3 px-4" id="v-pills-schedule-tab" data-bs-toggle="pill" data-bs-target="#jadwal" type="button" role="tab">
                            <i class="fa-regular fa-calendar-check me-2"></i> Jadwal Konseling
                        </button>
                        <button class="nav-link text-left py-3 px-4" id="v-pills-history-tab" data-bs-toggle="pill" data-bs-target="#riwayat" type="button" role="tab">
                            <i class="fa-solid fa-clock-rotate-left me-2"></i> Riwayat Konseling
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- KONTEN TABS KANAN --}}
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                
                {{-- TAB 1: PROFIL SAYA --}}
                <div class="tab-pane fade show active" id="profil" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-4">
                            <h5 class="mb-4 font-weight-bold">Edit Profil</h5>
                            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3 text-center mb-3">
                                        <img src="{{ $user->avatar_image ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                                             class="rounded-circle mb-2" width="100" height="100" style="object-fit: cover;">
                                        <div class="small text-muted">Foto Profil</div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Email</label>
                                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                            <small class="text-muted">Email tidak dapat diubah.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: JADWAL KONSELING --}}
                <div class="tab-pane fade" id="jadwal" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-4">
                            <h5 class="mb-4 font-weight-bold">Jadwal Konseling Akan Datang</h5>

                            @if($schedules->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fa-regular fa-calendar-xmark fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada jadwal konseling aktif.</p>
                                    <a href="{{ route('booking.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Buat Janji Baru</a>
                                </div>
                            @else
                                @foreach($schedules as $item)
                                    <div class="card mb-3 border border-light bg-light">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            
                                            {{-- PENGAMAN ERROR NULL (INI YANG MEMPERBAIKI ERROR 500) --}}
                                            @if($item->psychologist)
                                                <img src="{{ $item->psychologist->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($item->psychologist->name) }}" 
                                                     class="rounded-circle" width="60" height="60" style="object-fit:cover;">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 font-weight-bold">{{ $item->psychologist->name }}</h6>
                                                    <small class="text-muted">{{ $item->topic }} | {{ $item->method }}</small>
                                                </div>
                                            @else
                                                <img src="https://ui-avatars.com/api/?name=Unknown" 
                                                     class="rounded-circle grayscale" width="60" height="60" style="object-fit:cover; filter: grayscale(100%); opacity:0.5;">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 font-weight-bold text-muted">(Psikolog Tidak Ditemukan)</h6>
                                                    <small class="text-muted">{{ $item->topic }}</small>
                                                </div>
                                            @endif

                                            <div class="text-end">
                                                <div class="text-primary font-weight-bold" style="font-size: 0.9rem;">
                                                    {{ date('d M Y', strtotime($item->booking_date)) }}
                                                </div>
                                                <small>{{ $item->booking_time }}</small>
                                                <div class="mt-1">
                                                    @if($item->status == 'Pending')
                                                        <span class="badge bg-warning text-dark rounded-pill">Menunggu</span>
                                                    @elseif($item->status == 'Accepted')
                                                        <span class="badge bg-success rounded-pill">Disetujui</span>
                                                    @else
                                                        <span class="badge bg-secondary rounded-pill">{{ $item->status }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{-- TAB 3: RIWAYAT KONSELING --}}
                <div class="tab-pane fade" id="riwayat" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-4">
                            <h5 class="mb-4 font-weight-bold">Arsip Konseling Selesai</h5>

                            @if($history->isEmpty())
                                <div class="text-center py-5">
                                    <p class="text-muted">Belum ada riwayat konseling.</p>
                                </div>
                            @else
                                @foreach($history as $item)
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        
                                        {{-- PENGAMAN ERROR NULL --}}
                                        @if($item->psychologist)
                                            <img src="{{ $item->psychologist->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($item->psychologist->name) }}" 
                                                 class="rounded-circle grayscale me-3" width="50" height="50" style="object-fit:cover; filter: grayscale(100%);">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-muted">{{ $item->psychologist->name }}</h6>
                                                <small class="text-muted">{{ date('d M Y', strtotime($item->booking_date)) }}</small>
                                            </div>
                                        @else
                                            <img src="https://ui-avatars.com/api/?name=Unknown" 
                                                 class="rounded-circle grayscale me-3" width="50" height="50" style="object-fit:cover; filter: grayscale(100%); opacity:0.5;">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-muted">(Data Psikolog Terhapus)</h6>
                                                <small class="text-muted">{{ date('d M Y', strtotime($item->booking_date)) }}</small>
                                            </div>
                                        @endif

                                        <div>
                                            @if($item->status == 'Completed')
                                                <span class="badge bg-primary rounded-pill">Selesai</span>
                                            @elseif($item->status == 'Cancelled')
                                                <span class="badge bg-danger rounded-pill">Dibatalkan</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Tambahan untuk Tab Navigasi */
    .nav-pills .nav-link {
        color: #555;
        border-radius: 0;
        border-left: 3px solid transparent;
    }
    .nav-pills .nav-link.active {
        background-color: #f8f9fa;
        color: #3b5d84;
        border-left: 3px solid #3b5d84;
        font-weight: 600;
    }
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }
    .grayscale { filter: grayscale(100%); }
</style>
@endsection