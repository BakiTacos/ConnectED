{{-- LOOPING JADWAL --}}
@forelse($upcoming_schedules as $sched)
    <div class="card-box" style="display: flex; gap: 20px; align-items: flex-start; position: relative;">
        <img src="{{ $sched->psychologist->image_url }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">

        <div style="flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <h3 style="font-size: 1.1rem; margin: 0;">{{ $sched->psychologist->name }}, {{ $sched->psychologist->title }}</h3>
                
                @if($sched->status == 'Accepted')
                    <span class="badge bg-green">Accepted</span>
                @elseif($sched->status == 'Waiting')
                    <span class="badge bg-yellow">Waiting</span>
                @elseif($sched->status == 'Reschedule')
                    <span class="badge bg-blue" style="background:#dbeafe; color:#1e40af;">Reschedule</span>
                @else
                    <span class="badge bg-gray">{{ $sched->status }}</span>
                @endif
            </div>
            <div style="color: #6ca0c2; font-weight: 600; font-size: 0.9rem; margin-bottom: 15px;">
                {{ $sched->psychologist->role }}
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.9rem; color: #555; background: #f9f9f9; padding: 15px; border-radius: 10px;">
                <div><strong>Tanggal Sesi:</strong> {{ \Carbon\Carbon::parse($sched->booking_date)->translatedFormat('d M Y') }}</div>
                <div><strong>Metode:</strong> {{ $sched->method }}</div>
                <div><strong>Jam Sesi:</strong> {{ $sched->booking_time }}</div>
                <div><strong>Lokasi:</strong> {{ $sched->method == 'Offline' ? 'Gedung C, Lt. 2' : 'Zoom Meeting' }}</div>
            </div>

            <div style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
                
                <button type="button" 
                        onclick="openRescheduleModal('{{ $sched->booking_id }}', '{{ $sched->booking_date }}', '{{ $sched->booking_time }}')" 
                        class="btn-xs btn-outline">
                    Reschedule
                </button>

                <form action="{{ route('booking.cancel', $sched->booking_id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan jadwal ini?');">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-xs btn-red-outline">Batalkan</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="card-box" style="text-align: center; padding: 50px;">
        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" width="100" style="opacity: 0.5; margin-bottom: 20px;">
        <h3>Belum ada jadwal</h3>
        <p style="color: #888;">Kamu belum memiliki jadwal konseling aktif saat ini.</p>
        <a href="{{ route('booking.index') }}" class="btn-xs btn-blue" style="margin-top: 10px;">Buat Janji Baru</a>
    </div>
@endforelse

{{-- ================================================= --}}
{{-- MODAL DAN SCRIPT (DI LUAR LOOPING AGAR AMAN) --}}
{{-- ================================================= --}}

<div id="rescheduleModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center;">
    
    <div style="background: white; width: 100%; max-width: 400px; padding: 30px; border-radius: 20px; position: relative; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        
        <h3 style="margin-top:0; color:#333;">Ajukan Reschedule</h3>
        <p style="font-size:0.9rem; color:#666; margin-bottom:20px;">Pilih tanggal dan waktu baru untuk sesi ini.</p>
        
        <form id="formReschedule" action="" method="POST">
            @csrf
            @method('PATCH')
            
            <div style="margin-bottom:15px;">
                <label style="display:block; font-weight:600; font-size:0.9rem; margin-bottom:5px;">Tanggal Baru</label>
                <input type="date" name="new_date" id="resch_date" required class="form-control" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; font-weight:600; font-size:0.9rem; margin-bottom:5px;">Waktu Baru</label>
                <select name="new_time" id="resch_time" required class="form-control" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                    <option value="10:00 - 11:00">10:00 - 11:00</option>
                    <option value="13:00 - 14:00">13:00 - 14:00</option>
                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                </select>
            </div>

            <div style="text-align: right; display:flex; gap:10px; justify-content:flex-end;">
                <button type="button" onclick="closeRescheduleModal()" class="btn-xs btn-outline">Batal</button>
                <button type="submit" class="btn-xs btn-blue">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRescheduleModal(id, currentDates, currentTime) {
        // Debugging di Console Browser (Tekan F12 -> Console untuk cek)
        console.log("Tombol diklik. ID:", id); 

        // 1. Ambil Elemen Modal
        var modal = document.getElementById('rescheduleModal');
        
        // 2. Set Action Form secara dinamis
        var form = document.getElementById('formReschedule');
        form.action = "/booking/reschedule/" + id;
        
        // 3. Isi value input dengan data lama (Opsional)
        document.getElementById('resch_date').value = currentDates;
        document.getElementById('resch_time').value = currentTime;

        // 4. Tampilkan Modal
        modal.style.display = 'flex';
    }

    function closeRescheduleModal() {
        document.getElementById('rescheduleModal').style.display = 'none';
    }
    
    // Tutup jika klik area hitam di luar modal
    window.onclick = function(event) {
        var modal = document.getElementById('rescheduleModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>