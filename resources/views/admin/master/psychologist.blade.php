@extends('layouts.admin')
@section('header_title', 'Data Psikolog')
@section('content')

<style>
    .card-box { 
        background: white; 
        border-radius: 15px; 
        padding: 25px; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.02); 
    }
    
    .custom-table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 10px;
    }
    .custom-table thead { 
        background-color: #6a96b3; 
        color: white; 
    }
    .custom-table th, .custom-table td { 
        padding: 12px 15px; 
        text-align: left; 
        border-bottom: 1px solid #eee; 
        font-size: 0.9rem;
    }
    .custom-table tr:hover {
        background-color: #f9f9f9;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-active { background: #e8f5e9; color: #2e7d32; } /* Hijau */
    .status-inactive { background: #ffebee; color: #c62828; } /* Merah */
</style>

<div class="card-box">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; align-items: center;">
        <h3 style="color: #444; font-size: 1.1rem;">Daftar Psikolog & Konselor</h3>
        <button style="background: #3b5d84; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
            <i class="fa-solid fa-plus"></i> Tambah Baru
        </button>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor WA</th>
                    <th>Peran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($psychologists as $psy)
                <tr>
                    <td>
                        <div style="font-weight: 600; color: #333;">{{ $psy->name }}</div>
                        <div style="font-size: 0.8rem; color: #888;">NIP/NIK: {{ $psy->nim ?? '-' }}</div>
                    </td>
                    <td>{{ $psy->email }}</td>
                    <td>{{ $psy->phone ?? '-' }}</td>
                    <td style="text-transform: capitalize;">{{ $psy->role }}</td>
                    <td>
                        <span class="status-badge status-active">Aktif</span>
                    </td>
                    <td>
                        <a href="#" style="color: #3b5d84; margin-right: 10px;"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" style="color: #e57373;"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding: 30px; color: #999;">
                        Tidak ada data psikolog.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection