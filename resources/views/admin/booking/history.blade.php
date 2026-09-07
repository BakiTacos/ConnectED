@extends('layouts.admin')
@section('header_title', 'Riwayat Booking')
@section('content')

<style>
    .card-box { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table thead { background-color: #6a96b3; color: white; }
    .custom-table th, .custom-table td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #eee; }
    .badge { padding: 5px 10px; border-radius: 5px; font-size: 0.8rem; font-weight: 600; }
    .badge-done { background-color: #e8f5e9; color: #2e7d32; }
    .badge-cancel { background-color: #ffebee; color: #c62828; }
</style>

<div class="card-box">
    <div style="margin-bottom: 20px;">
        <form action="{{ route('admin.booking.history') }}" method="GET">
            <input type="text" name="search" placeholder="Cari Nama Mahasiswa..." style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 5px;">
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Jadwal</th>
                    <th>Booking ID</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tipe</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $item)
                <tr>
                    <td>
                        <div style="font-weight:600;">{{ $item->booking_date }}</div>
                        <div style="font-size:0.85rem; color:#888;">{{ $item->booking_time }}</div>
                    </td>
                    <td>#{{ $item->booking_id }}</td>
                    <td>{{ $item->user->name ?? 'User Terhapus' }}</td>
                    <td>{{ $item->type }}</td>
                    <td>
                        @if($item->status == 'Completed')
                            <span class="badge badge-done">Selesai</span>
                        @else
                            <span class="badge badge-cancel">{{ $item->status }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding: 20px;">Belum ada riwayat booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection