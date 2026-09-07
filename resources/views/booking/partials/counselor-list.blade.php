<style>
    .psy-card-result {
        background: white; border: 1px solid #eee; border-radius: 12px;
        padding: 20px; margin-bottom: 15px; display: flex; align-items: center;
        transition: 0.2s; gap: 20px;
    }
    .psy-card-result:hover {
        transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-color: #3b5d84;
    }
    .psy-img-result {
        width: 80px; height: 80px; border-radius: 50%; object-fit: cover;
        border: 3px solid #f0f2f5;
    }
    .btn-book-now {
        background-color: #3b5d84; color: white; border: none;
        padding: 8px 20px; border-radius: 50px; font-size: 0.9rem;
        text-decoration: none; font-weight: 600;
    }
    .btn-book-now:hover { background-color: #2c4663; color: white; }
    .empty-state-box {
        text-align: center; padding: 40px 20px; background: white;
        border-radius: 12px; border: 1px dashed #ccc;
    }
</style>

{{-- Pastikan menggunakan variabel $counselors --}}
@forelse($counselors as $psy)
    <div class="psy-card-result fade-in">
        <img src="{{ $psy->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($psy->name).'&background=random' }}" 
             alt="{{ $psy->name }}" class="psy-img-result">
        
        <div style="flex: 1;">
            <h5 style="margin: 0; font-weight: 700; color: #333;">{{ $psy->name }}</h5>
            <small style="color: #3b5d84; font-weight: 600;">{{ $psy->title ?? 'Psikolog' }}</small>
            <p style="margin: 5px 0 0; font-size: 0.85rem; color: #666;">
                <i class="fa-solid fa-stethoscope"></i> {{ Str::limit($psy->specialties ?? 'Konseling Umum', 50) }}
            </p>
        </div>

        <div>
            {{-- PERBAIKAN UTAMA DI SINI: Gunakan user_id sesuai database --}}
            <a href="{{ route('booking.details', ['id' => $psy->user_id, 'date' => $selected_date]) }}" class="btn-book-now">Pilih</a>
        </div>
    </div>
@empty
    <div class="empty-state-box">
        <div style="font-size: 3rem; color: #ccc; margin-bottom: 10px;">
            <i class="fa-regular fa-calendar-xmark"></i>
        </div>
        <h5 style="color: #555;">Tidak ada jadwal psikolog tersedia.</h5>
        <p style="color: #888; font-size: 0.9rem;">
            Silakan pilih tanggal lain.
        </p>
    </div>
@endforelse