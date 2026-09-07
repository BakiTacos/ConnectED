<style>
    /* Style Tambahan untuk Modal */
    .modal-overlay {
        display: none; /* Sembunyikan default */
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5); z-index: 2000;
        justify-content: center; align-items: center;
    }
    .modal-content {
        background: white; width: 100%; max-width: 500px;
        padding: 30px; border-radius: 20px; position: relative;
        animation: slideDown 0.3s ease;
    }
    @keyframes slideDown { from {transform: translateY(-20px); opacity:0;} to {transform: translateY(0); opacity:1;} }
    
    .close-modal {
        position: absolute; top: 15px; right: 20px; font-size: 1.5rem; cursor: pointer; color: #999;
    }
    .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; text-align: left; }
    .form-input { 
        width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 15px;
    }
</style>

<div class="card-box" style="text-align: center; padding: 50px;">
    
    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 10px; border-radius: 10px; margin-bottom: 20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div style="position: relative; display: inline-block; margin-bottom: 20px;">
        <img src="{{ $user->avatar_image ?? 'https://via.placeholder.com/150' }}" 
             style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        
        <button onclick="openEditModal()" style="position: absolute; bottom: 0; right: 0; background: white; border: 1px solid #ddd; border-radius: 50%; width: 35px; height: 35px; cursor: pointer; color: #3b5d84; transition:0.2s;">
            ✎
        </button>
    </div>
    
    <h2 style="color: #333; margin-bottom: 5px;">{{ $user->full_name }}</h2>
    <p style="color: #888; margin-bottom: 30px;">{{ $user->email }}</p>

    <div style="text-align: left; max-width: 600px; margin: 0 auto; display: grid; grid-template-columns: 150px 1fr; gap: 15px 10px; align-items: center;">
        
        <strong style="color: #555;">Nama Lengkap</strong>
        <div style="color: #333;">: {{ $user->full_name }}</div>

        <strong style="color: #555;">NIM</strong>
        <div style="color: #333;">: {{ $user->nim ?? '-' }}</div>

        <strong style="color: #555;">Pendidikan</strong>
        <div style="color: #333;">: S1/D4</div>

        <strong style="color: #555;">Program Studi</strong>
        <div style="color: #333;">: {{ $user->study_program ?? '-' }}</div>

        <strong style="color: #555;">Angkatan</strong>
        <div style="color: #333;">: {{ $user->batch_year ?? '2024' }}</div>

        <strong style="color: #555;">No. Whatsapp</strong>
        <div style="color: #333; display:flex; align-items:center; gap:10px;">
            : {{ $user->phone_number ?? '-' }} 
            <a href="javascript:void(0)" onclick="openEditModal()" style="font-size:0.8rem; color:#3b5d84; text-decoration:none;">Update</a>
        </div>

        <strong style="color: #555;">Wali</strong>
        <div style="color: #333;">
            : {{ $user->guardian_name ?? '-' }} <br> 
            <span style="margin-left: 12px; color:#666; font-size:0.9rem;">{{ $user->guardian_phone ?? '' }}</span>
        </div>
    </div>

    <div style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px; display:flex; justify-content:center; gap:15px;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-red-outline btn-xs" style="padding: 10px 30px;">
                <i class="fa fa-sign-out"></i> Keluar
            </button>
        </form>
    </div>
</div>

<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" onclick="closeEditModal()">&times;</span>
        <h3 style="margin-bottom: 20px; color: #3b5d84;">Edit Profil</h3>
        
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <label class="form-label">Ganti Foto Profil</label>
            <input type="file" name="avatar" class="form-input" accept="image/*">

            <label class="form-label">No. Whatsapp</label>
            <input type="text" name="phone_number" class="form-input" value="{{ $user->phone_number }}" placeholder="Contoh: 08123456789">

            <label class="form-label">Nama Wali</label>
            <input type="text" name="guardian_name" class="form-input" value="{{ $user->guardian_name }}" placeholder="Nama Orang Tua/Wali">

            <label class="form-label">No. Telp Wali</label>
            <input type="text" name="guardian_phone" class="form-input" value="{{ $user->guardian_phone }}" placeholder="Nomor Telepon Wali">

            <div style="text-align: right; margin-top: 20px;">
                <button type="button" onclick="closeEditModal()" class="btn-xs btn-outline" style="margin-right: 10px;">Batal</button>
                <button type="submit" class="btn-xs btn-blue">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editModal').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    // Tutup jika klik di luar modal
    window.onclick = function(event) {
        let modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>