<div class="card-box" style="padding: 0; overflow: hidden;">
    
    @forelse($notifications as $index => $notif)
        @php
            // 1. Logika Warna Dot Status (Kecil di pojok avatar)
            $dotColor = '#3b82f6'; // Default Biru
            if(($notif['type'] ?? '') == 'danger') $dotColor = '#ef4444'; // Merah
            if(($notif['type'] ?? '') == 'warning') $dotColor = '#f97316'; // Orange
            
            // 2. Avatar Huruf (Ambil huruf pertama dari Judul)
            $initial = substr($notif['title'] ?? 'N', 0, 1);
            
            // Warna-warni background avatar huruf (Teal, Orange, Biru, dll)
            $colors = ['#14b8a6', '#f97316', '#3b82f6', '#8b5cf6'];
            $avatarBg = $colors[$index % 4]; 
        @endphp

        <div style="display: flex; gap: 20px; padding: 25px; border-bottom: 1px solid #f1f5f9; align-items: flex-start; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
            
            {{-- BAGIAN KIRI: AVATAR --}}
            <div style="position: relative; flex-shrink: 0;">
                @if(isset($notif['image']) && $notif['image'])
                    <img src="{{ $notif['image'] }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #eee;">
                @else
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: {{ $avatarBg }}; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.2rem;">
                        {{ $initial }}
                    </div>
                @endif

                <span style="position: absolute; bottom: 0; right: 0; width: 14px; height: 14px; background: {{ $dotColor }}; border: 2px solid white; border-radius: 50%;"></span>
            </div>

            {{-- BAGIAN KANAN: TEKS --}}
            <div style="flex-grow: 1;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 5px;">
                    <h4 style="margin: 0; color: #333; font-size: 1rem; font-weight: 700;">
                        {{ $notif['title'] ?? 'Notifikasi' }}
                    </h4>
                </div>
                
                <p style="margin: 0; color: #64748b; font-size: 0.9rem; line-height: 1.5;">
                    {{ $notif['message'] ?? '' }}
                </p>
                
                @if(isset($notif['date']))
                    <div style="margin-top: 8px; font-size: 0.75rem; color: #94a3b8; font-weight: 500;">
                        {{ $notif['date'] }}
                    </div>
                @endif
            </div>

        </div>
    @empty
        {{-- Tampilan Kosong --}}
        <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="60" style="opacity: 0.3; margin-bottom: 15px;">
            <p>Tidak ada notifikasi baru saat ini.</p>
        </div>
    @endforelse

</div>