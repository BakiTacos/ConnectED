@extends('layouts.admin')
@section('header_title', 'Data Mahasiswa')
@section('content')

<style>
    .card-box { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table thead { background-color: #6a96b3; color: white; }
    .custom-table th, .custom-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    .top-bar { display: flex; justify-content: space-between; margin-bottom: 20px; }
    .search-input { padding: 8px 15px; border: 1px solid #ddd; border-radius: 5px; width: 250px; }
</style>

<div class="card-box">
    <div class="top-bar">
        <h3>Total: {{ $students->count() }} Mahasiswa</h3>
        <form action="{{ route('admin.master.student') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Cari Nama / NIM..." value="{{ request('search') }}">
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Email</th>
                    <th>Angkatan</th>
                    <th>Nomor WA</th>
                </tr>
            </thead>
            <tbody>
                {{-- HANYA BOLEH ADA SATU @FORELSE --}}
                @forelse($students as $mhs)
                <tr>
                    {{-- NIM --}}
                    <td>{{ $mhs->nim ?? '-' }}</td>
                    
                    {{-- NAMA --}}
                    <td>{{ $mhs->name }}</td>
                    
                    {{-- PRODI (Sesuai DB: study_program) --}}
                    <td>{{ $mhs->study_program ?? '-' }}</td>
                    
                    {{-- EMAIL --}}
                    <td>{{ $mhs->email }}</td>
                    
                    {{-- ANGKATAN (Sesuai DB: batch_year) --}}
                    <td>{{ $mhs->batch_year ?? '-' }}</td>
                    
                    {{-- NO WA (Sesuai DB: whatsapp) --}}
                    <td>{{ $mhs->whatsapp ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding: 20px; color: #888;">
                        Tidak ada data mahasiswa.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection