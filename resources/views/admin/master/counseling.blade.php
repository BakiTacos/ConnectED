@extends('layouts.admin')
@section('header_title', 'Data Konseling')
@section('content')

<style>
    .card-box { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .custom-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .custom-table thead { background-color: #6a96b3; color: white; }
    .custom-table th, .custom-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    .status-badge { padding: 4px 10px; border-radius: 15px; font-size: 0.75rem; font-weight: 600; }
    .status-ongoing { background: #fff3e0; color: #ef6c00; }
    .status-finished { background: #e8f5e9; color: #2e7d32; }
</style>

<div class="card-box">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; align-items: center;">
        <h3 style="color: #444; font-size: 1.1rem;">Laporan Konseling</h3>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    <th>Konselor</th>
                    <th>Isu Utama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($counselings) && count($counselings) > 0)
                    @foreach($counselings as $item)
                    <tr>
                        <td>#{{ $item->counseling_id }}</td>
                        <td>{{ $item->student->name ?? '-' }}</td>
                        <td>{{ $item->psychologist->name ?? '-' }}</td>
                        <td>{{ $item->mental_issue_tag ?? '-' }}</td>
                        <td><span class="status-badge status-finished">{{ $item->status }}</span></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 20px; color:#999;">
                            Belum ada data konseling.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection