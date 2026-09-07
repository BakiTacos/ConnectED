@extends('layouts.admin')
@section('header_title', 'Jadwal Booking')
@section('content')

<style>
    /* === CONTAINER & HEADER === */
    .schedule-card {
        background: white; border-radius: 15px; padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02); overflow-x: auto;
    }

    .top-controls {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 30px; flex-wrap: wrap; gap: 20px;
    }

    .date-filter select {
        padding: 8px 15px; border: 1px solid #ddd; border-radius: 8px;
        font-family: 'Poppins', sans-serif; color: #555;
    }

    .psy-legend { display: flex; gap: 15px; }
    .psy-item { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: #555; font-weight: 500; }
    .psy-avatar { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

    /* === GRID CALENDAR === */
    .calendar-grid {
        display: grid;
        grid-template-columns: 80px repeat(8, 1fr); 
        border: 1px solid #e0e0e0; border-radius: 12px; overflow: hidden;
        min-width: 900px;
    }

    .grid-head {
        background: white; padding: 15px 0; text-align: center;
        font-weight: 600; color: #666;
        border-bottom: 1px solid #eee; border-right: 1px solid #eee;
    }

    .day-row-group { display: contents; }

    .day-col {
        background: #fcfcfc; border-bottom: 1px solid #eee; border-right: 1px solid #eee;
        display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px 0;
    }
    .day-circle {
        width: 35px; height: 35px; background: #e1effe; color: #3b5d84;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-weight: 700; margin-bottom: 5px;
    }
    .day-name { font-size: 0.75rem; font-weight: 600; color: #888; text-transform: uppercase; }

    .events-track {
        grid-column: 2 / span 8; display: grid;
        grid-template-columns: repeat(8, 1fr);
        border-bottom: 1px solid #eee; position: relative; padding: 5px 0;
    }
    
    .grid-divider { border-right: 1px solid #f5f5f5; height: 100%; grid-row: 1; }

    .event-bar {
        height: 30px; border-radius: 15px; color: white; font-size: 0.7rem; font-weight: 600;
        display: flex; align-items: center; padding: 0 10px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1); z-index: 2; margin-top: 5px;
        cursor: pointer; transition: transform 0.2s;
    }
    .event-bar:hover { transform: scale(1.02); z-index: 5; }
    
    .bg-red { background: #ef5350; }
    .bg-green { background: #66bb6a; }
    .bg-blue { background: #42a5f5; }
    .bg-orange { background: #ffa726; }
</style>

<div class="schedule-card">
    <div class="top-controls">
        <div class="date-filter">
            <select name="month"><option value="09">September</option></select>
            <select name="year"><option value="2025">2025</option></select>
        </div>
        <div class="psy-legend">
            @foreach($psychologists as $psy)
            <div class="psy-item">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($psy->name) }}&background=random" class="psy-avatar">
                <span>{{ explode(' ', $psy->name)[0] }}</span> 
            </div>
            @endforeach
        </div>
    </div>

    <div class="calendar-grid">
        <div class="grid-head">WIB</div>
        <div class="grid-head">08:00</div>
        <div class="grid-head">09:00</div>
        <div class="grid-head">10:00</div>
        <div class="grid-head">11:00</div>
        <div class="grid-head">13:00</div>
        <div class="grid-head">14:00</div>
        <div class="grid-head">15:00</div>
        <div class="grid-head">16:00</div>

        @foreach($weekDates as $day)
            <div class="day-row-group">
                <div class="day-col">
                    <div class="day-circle">{{ $day['day_date'] }}</div>
                    <span class="day-name">{{ $day['day_name'] }}</span>
                </div>

                <div class="events-track">
                    @for($k=1; $k<=8; $k++)
                        <div class="grid-divider" style="grid-column: {{ $k }};"></div>
                    @endfor

                    @foreach($bookings as $booking)
                        @if(\Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') == $day['full_date'])
                            @php
                                // LOGIKA GRID
                                $timeStart = substr($booking->booking_time, 0, 5); 
                                $startHour = (int)substr($timeStart, 0, 2);
                                
                                $colStart = 1; 
                                if($startHour >= 8 && $startHour <= 11) {
                                    $colStart = $startHour - 7; 
                                } elseif($startHour >= 13 && $startHour <= 16) {
                                    $colStart = $startHour - 8; 
                                }

                                // LOGIKA WARNA
                                $colorClass = 'bg-green';
                                if($booking->type == 'Individu') $colorClass = 'bg-red';
                                elseif($booking->type == 'Kelompok') $colorClass = 'bg-orange';
                                elseif($booking->type == 'Request Narasumber') $colorClass = 'bg-blue';

                                // LOGIKA NAMA USER (Clean Code untuk menghindari error editor)
                                $userName = $booking->user ? $booking->user->name : 'Guest';
                                $shortName = explode(' ', $userName)[0];

                                // TRIK: Buat string style di dalam PHP supaya Editor tidak bingung
                                $styleAttr = "grid-column: {$colStart} / span 1;";
                            @endphp

                            {{-- Sekarang kita panggil variabel $styleAttr di dalam style --}}
                            <div class="event-bar {{ $colorClass }}" 
                                 style="{{ $styleAttr }}"
                                 title="{{ $booking->type }}">
                                {{ $booking->type }}: {{ $shortName }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection