@extends('layouts.admin')

@section('header_title', 'Edit Profile')

@section('content')

<div class="card-box" style="background: white; padding: 30px; border-radius: 15px; max-width: 800px;">
    <h3 style="margin-bottom: 25px; color: #333;">Edit Data Admin</h3>

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Lengkap --}}
        <div class="form-group mb-3">
            <label class="fw-bold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        {{-- Email --}}
        <div class="form-group mb-3">
            <label class="fw-bold">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        {{-- No Whatsapp --}}
        <div class="form-group mb-3">
            <label class="fw-bold">No. Whatsapp</label>
            {{-- Pastikan nama kolom sesuai DB, misal: whatsapp atau phone --}}
            <input type="text" name="phone" class="form-control" value="{{ $user->whatsapp ?? $user->phone }}">
        </div>

        {{-- Ganti Password (Opsional) --}}
        <div class="form-group mb-4">
            <label class="fw-bold">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin mengganti)</small></label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru...">
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary" style="background-color: #3b5d84; border:none; padding: 10px 25px;">Simpan Perubahan</button>
            <a href="{{ route('admin.profile') }}" class="btn btn-secondary" style="padding: 10px 25px; text-decoration:none; color:#555; background:#eee;">Batal</a>
        </div>
    </form>
</div>

@endsection