<div class="card-box" style="padding: 15px; display: flex; gap: 10px;">
    <input type="text" placeholder="Cari Riwayat Konseling..." style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
    <button class="btn-xs btn-blue">Cari</button>
</div>

@forelse($history_schedules as $hist)
    <div class="card-box">
        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
            <div>
                <strong style="font-size: 1.1rem;">Informasi Sesi</strong>
            </div>
            <div style="text-align: right;">
                <span class="badge bg-gray">Selesai</span>
                <span style="font-size: 0.85rem; color: #888; margin-left: 10px;">{{ $hist->method }}</span>
            </div>
        </div>

        <div style="display: flex; gap: 20px;">
            <img src="{{ $hist->psychologist->image_url }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
            <div style="flex: 1;">
                <h4 style="margin: 0 0 5px;">{{ $hist->psychologist->name }}</h4>
                <div style="font-size: 0.85rem; color: #6ca0c2;">{{ $hist->psychologist->role }}</div>
                
                <div style="margin-top: 15px; font-size: 0.9rem; color: #555; line-height: 1.6;">
                    <strong>Catatan Tambahan:</strong><br>
                    {{ $hist->description ? Str::limit($hist->description, 100) : 'Tidak ada catatan khusus.' }}
                </div>
            </div>
            <div style="min-width: 150px; font-size: 0.85rem; color: #555;">
                <div style="margin-bottom: 5px;">📅 {{ \Carbon\Carbon::parse($hist->booking_date)->translatedFormat('d M Y') }}</div>
                <div style="margin-bottom: 5px;">⏰ {{ $hist->booking_time }}</div>
                <div>⏳ 60 Menit</div>
            </div>
        </div>

        <div style="margin-top: 20px; text-align: right; display: flex; gap: 10px; justify-content: flex-end;">
            <button class="btn-xs btn-blue">Hubungi</button>
            <a href="{{ route('booking.index') }}" class="btn-xs btn-outline">Booking Ulang</a>
        </div>
    </div>
@empty
    <div class="card-box" style="text-align: center; padding: 40px;">
        <p style="color: #888;">Belum ada riwayat konseling.</p>
    </div>
@endforelse