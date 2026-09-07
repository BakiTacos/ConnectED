@extends('layouts.admin')

@section('header_title', 'List Booking')

@section('content')

<style>
    /* Card Container */
    .card-box {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        min-height: 400px;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #555;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* TABLE STYLING */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .custom-table thead {
        background-color: #6a96b3;
        color: white;
    }

    .custom-table th {
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
        border-bottom: none;
    }

    .custom-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
        color: #555;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    .custom-table tr:hover {
        background-color: #fafafa;
    }

    /* Kolom Jadwal */
    .date-text { font-weight: 600; color: #444; display: block; margin-bottom: 2px; }
    .time-text { font-size: 0.85rem; color: #888; background: #f4f4f4; padding: 2px 8px; border-radius: 4px; }

    /* Kolom Jenis */
    .type-text { font-weight: 500; }
    .type-small { font-size: 0.8rem; line-height: 1.2; display: block; color: #666; }
    
    /* Badge Status */
    .badge-status {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .badge-Pending { background-color: #ffeeba; color: #856404; }
    .badge-Accepted { background-color: #d4edda; color: #155724; }
    .badge-Completed { background-color: #cce5ff; color: #004085; }
    .badge-Rescheduled { background-color: #d1ecf1; color: #0c5460; }
    .badge-Cancelled { background-color: #f8d7da; color: #721c24; }

    /* Buttons Actions */
    .btn-action {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 3px;
        text-decoration: none;
        text-align: center;
        transition: 0.2s;
    }

    /* Tombol Reschedule */
    .btn-reschedule {
        background-color: #fff;
        color: #e69c4e;
        border: 1px solid #e69c4e;
    }
    .btn-reschedule:hover { background-color: #e69c4e; color: white; }

    /* Tombol Terima */
    .btn-terima {
        background-color: #e69c4e;
        color: white;
        border: 1px solid #e69c4e;
    }
    .btn-terima:hover { background-color: #d68b3e; border-color: #d68b3e; }

    /* Tombol Selesai (BARU) */
    .btn-selesai {
        background-color: #3b5d84; /* Warna Biru Tema */
        color: white;
        border: 1px solid #3b5d84;
    }
    .btn-selesai:hover { background-color: #2a4463; border-color: #2a4463; }
    
    .table-responsive { overflow-x: auto; }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #999;
    }
</style>

<div class="card-box">
    <div class="page-title">
        <span>List Booking Masuk</span>
        <span style="font-size: 0.9rem; font-weight: 400; color: #888;">
            Total: {{ count($bookings) }}
        </span>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Jadwal</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th style="min-width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $item)
                <tr>
                    {{-- Kolom Jadwal --}}
                    <td>
                        <span class="date-text">{{ $item['date'] }}</span>
                        <span class="time-text"><i class="fas fa-clock"></i> {{ $item['time'] }}</span>
                    </td>
                    
                    {{-- ID --}}
                    <td>#{{ $item['id'] }}</td>
                    
                    {{-- Nama --}}
                    <td>
                        <strong>{{ $item['name'] }}</strong>
                    </td>
                    
                    {{-- NIM --}}
                    <td>{{ $item['nim'] }}</td>
                    
                    {{-- Jenis --}}
                    <td>
                        @if($item['type'] == 'Request Narasumber')
                            <span class="type-small">Request<br>Narasumber</span>
                        @else
                            {{ $item['type'] }}
                        @endif
                    </td>
                    
                    {{-- Status Badge --}}
                    <td>
                        <span class="badge-status badge-{{ $item['status'] }}">
                            {{ $item['status'] }}
                        </span>
                    </td>
                    
                    {{-- Aksi (LOGIKA DIPERBAIKI) --}}
                    <td>
                    @if($item['status'] == 'Pending')
                        <form action="{{ route('admin.booking.accept', $item['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            {{-- Tombol Terima (Warna Oranye/Kuning) --}}
                            <button type="submit" class="btn btn-warning btn-sm text-white" onclick="return confirm('Terima jadwal ini?')">
                                Terima
                            </button>
                        </form>

                        <a href="{{ route('admin.booking.reschedule.form', $item['id']) }}" class="btn-action btn-reschedule">
                            Reschedule
                        </a>
                    @endif

                    {{-- 2. JIKA SUDAH ACCEPTED (Sedang/Akan Berlangsung) --}}
                    @if($item['status'] == 'Accepted') 
                        {{-- Munculkan Tombol SELESAI --}}
                        <form action="{{ route('admin.booking.complete', $item['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tandai sesi ini sebagai selesai?');">
                            @csrf
                            {{-- Tombol Selesai (Warna Biru/Hijau) --}}
                            <button class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-check-double"></i> Selesai
                            </button>
                        </form>
                    @endif
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <i class="fas fa-calendar-times" style="font-size: 2rem; margin-bottom: 10px; display:block;"></i>
                        Belum ada booking baru yang masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection