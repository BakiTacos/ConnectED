@extends('layouts.admin')

@section('header_title', 'Dashboard')

@section('content')

<style>
    /* Grid Kartu Atas */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 4 Kolom */
        gap: 25px;
        margin-bottom: 25px;
    }

    /* Kartu Angka */
    .stat-card {
        background: white; border-radius: 15px; padding: 25px;
        text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        display: flex; flex-direction: column; justify-content: center;
        height: 180px;
    }
    .stat-label { color: #666; font-size: 0.9rem; font-weight: 600; margin-bottom: 15px; }
    .stat-value { font-size: 3rem; font-weight: 700; color: #333; }

    /* Kartu Grafik */
    .chart-card {
        background: white; border-radius: 15px; padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .chart-header { font-size: 0.95rem; font-weight: 600; margin-bottom: 15px; color: #444; }

    /* Layout Baris Kedua */
    .row-charts {
        display: grid;
        grid-template-columns: 1.5fr 1fr; /* Kiri lebih lebar */
        gap: 25px;
    }
</style>

{{-- BARIS 1: KARTU STATISTIK & PIE CHART --}}
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-label">Jumlah Siswa Dilayani</div>
        <div class="stat-value">72</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Jumlah Konseling</div>
        <div class="stat-value">51</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Jumlah Bookingan</div>
        <div class="stat-value">3</div>
    </div>
    <div class="chart-card" style="height: 180px; display:flex; flex-direction:column;">
        <div class="chart-header">Top 3 Topik Masalah</div>
        <div style="flex:1; position: relative;">
            <canvas id="topikChart"></canvas>
        </div>
    </div>
</div>

{{-- BARIS 2: GRAFIK GARIS & BAR --}}
<div class="row-charts">
    <div class="chart-card">
        <div class="chart-header">Jumlah Konsultasi 2 Tahun Terakhir</div>
        <div style="height: 250px;">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
    <div class="chart-card">
        <div class="chart-header">Jumlah Anak terindikasi Mental Illness</div>
        <div style="height: 250px;">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>

{{-- SCRIPT CHART.JS --}}
<script>
    // 1. PIE CHART
    const ctxPie = document.getElementById('topikChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Kecemasan', 'Percintaan', 'Akademik'],
            datasets: [{
                data: [40, 35, 25],
                backgroundColor: ['#3b5d84', '#e68a2e', '#4ade80'],
                borderWidth: 0
            }]
        },
        options: { maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { boxWidth: 10 } } } }
    });

    // 2. LINE CHART
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            datasets: [
                { label: '2024', data: [10, 25, 20, 35, 30, 40, 35, 50], borderColor: '#3b5d84', tension: 0.4, fill: true, backgroundColor: 'rgba(59, 93, 132, 0.1)' },
                { label: '2025', data: [15, 20, 25, 30, 25, 35, 30, 45], borderColor: '#e68a2e', tension: 0.4, borderDash: [5, 5] }
            ]
        },
        options: { maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
    });

    // 3. BAR CHART
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Anxiety', 'Depression', 'Bipolar', 'PTSD', 'ADHD'],
            datasets: [{ label: 'Kasus', data: [12, 19, 8, 5, 10], backgroundColor: '#a78bfa', borderRadius: 5 }]
        },
        options: { indexAxis: 'y', maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });
</script>

@endsection