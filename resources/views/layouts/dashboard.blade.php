@extends('layouts.admin')

@section('header_title', 'Dashboard')

@section('content')

<style>
    /* Grid Layout Utama */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
        margin-bottom: 25px;
    }

    /* KARTU ANGKA (Putih Bersih) */
    .stat-card {
        background: white; 
        border-radius: 12px; 
        padding: 30px 20px;
        text-align: center; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        display: flex; flex-direction: column; justify-content: center; align-items: center;
        height: 100%;
    }
    .stat-title { 
        color: #777; 
        font-size: 1rem; 
        font-weight: 600; 
        margin-bottom: 15px; 
        line-height: 1.4;
    }
    .stat-number { 
        font-size: 3.5rem; 
        font-weight: 700; 
        color: #444; 
    }

    /* KARTU GRAFIK */
    .chart-card {
        background: white; 
        border-radius: 12px; 
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .chart-title {
        font-size: 1rem; 
        font-weight: 600; 
        color: #555; 
        margin-bottom: 20px;
    }

    /* Layout Bawah (Line Chart & Bar Chart) */
    .row-charts {
        display: grid;
        grid-template-columns: 1.8fr 1.2fr; /* Line Chart lebih lebar */
        gap: 25px;
    }

    /* Styling Legend Chart Custom (Agar rapi) */
    .custom-legend { display: flex; gap: 15px; justify-content: center; margin-bottom: 10px; font-size: 0.85rem; color: #666; }
    .legend-item { display: flex; align-items: center; gap: 5px; }
    .dot { width: 10px; height: 10px; border-radius: 2px; }
</style>

{{-- BARIS 1: KARTU ANGKA & DONUT CHART --}}
<div class="dashboard-grid">
    
    <div class="stat-card">
        <div class="stat-title">Jumlah Siswa<br>Dilayani</div>
        <div class="stat-number">72</div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Jumlah<br>Konseling</div>
        <div class="stat-number">51</div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Jumlah<br>Bookingan</div>
        <div class="stat-number">3</div>
    </div>

    <div class="chart-card" style="display:flex; flex-direction:column; justify-content:space-between;">
        <div class="chart-title">Top 3 Topik Masalah Konsultasi</div>
        <div style="flex:1; position: relative; min-height: 140px;">
            <canvas id="topikChart"></canvas>
        </div>
    </div>
</div>

{{-- BARIS 2: LINE CHART & HORIZONTAL BAR --}}
<div class="row-charts">
    
    <div class="chart-card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div class="chart-title">Jumlah Konsultasi 2 Tahun Terakhir</div>
            <div class="custom-legend">
                <div class="legend-item"><div class="dot" style="background:#4dabf7; height:3px; width:15px;"></div> 2025</div>
                <div class="legend-item"><div class="dot" style="background:#ffa94d; height:3px; width:15px;"></div> 2024</div>
            </div>
        </div>
        
        <div style="height: 280px;">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-title">Jumlah Anak yang terindikasi Mental Illness</div>
        <div style="height: 280px;">
            <canvas id="barChart"></canvas>
        </div>
    </div>

</div>

{{-- CONFIGURASI CHART.JS --}}
<script>
    Chart.defaults.font.family = "'Poppins', sans-serif";
    Chart.defaults.color = '#888';

    // 1. DONUT CHART (Warna sesuai desain: Biru Tua, Biru Muda, Hijau Mint)
    new Chart(document.getElementById('topikChart'), {
        type: 'doughnut',
        data: {
            labels: ['Percintaan', 'Pertemanan', 'Akademik'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: [
                    '#34495e', // Percintaan (Biru Gelap)
                    '#3498db', // Pertemanan (Biru Terang)
                    '#2ecc71'  // Akademik (Hijau Mint)
                ],
                borderWidth: 5,
                borderColor: '#ffffff',
                hoverOffset: 4
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '65%', // Lubang tengah besar
            plugins: {
                legend: {
                    position: 'right',
                    labels: { usePointStyle: true, boxWidth: 8, font: {size: 11} }
                }
            }
        }
    });

    // 2. LINE CHART (Biru Solid & Orange Putus-Putus)
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei'],
            datasets: [
                {
                    label: '2025',
                    data: [15, 23, 18, 25, 20, 30, 25, 38], // Data Biru (Atas)
                    borderColor: '#4dabf7', // Biru Langit
                    backgroundColor: 'rgba(77, 171, 247, 0.1)',
                    tension: 0.4, // Garis melengkung halus
                    fill: true,
                    pointRadius: 0,
                    borderWidth: 2
                },
                {
                    label: '2024',
                    data: [12, 18, 15, 20, 18, 25, 22, 30], // Data Orange (Bawah)
                    borderColor: '#ffa94d', // Orange
                    borderDash: [5, 5], // Garis putus-putus
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }, // Legend disembunyikan (sudah custom di HTML)
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // 3. HORIZONTAL BAR CHART (Ungu)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Anxiety', 'Depression', 'Bipolar', 'PTSD', 'ADHD'],
            datasets: [{
                data: [12, 18, 8, 5, 10],
                backgroundColor: '#9f7aea', // Ungu Muda sesuai desain
                borderRadius: 20, // Ujung tumpul bulat
                barThickness: 15
            }]
        },
        options: {
            indexAxis: 'y', // PENTING: Membuat bar jadi horizontal
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { display: false }, // Hilangkan grid X
                y: { grid: { display: false } } // Hilangkan grid Y
            }
        }
    });
</script>

@endsection