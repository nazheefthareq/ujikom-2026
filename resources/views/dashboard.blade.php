@extends('layouts.app')

@section('title', 'Dashboard Statistik Pegawai')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Statistik Pegawai</h1>
    <p class="text-sm text-slate-500 mt-1">Ringkasan visual komposisi gender, tingkat pendidikan, dan kelompok usia pegawai</p>
</div>

<!-- Kartu Ringkasan Total Pegawai -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Pegawai Terdaftar</p>
        <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalPegawai }} <span class="text-base font-normal text-slate-500">Orang</span></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Pegawai Laki-laki</p>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $genderChart['data'][0] }} <span class="text-base font-normal text-slate-500">Orang</span></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Pegawai Perempuan</p>
        <p class="text-3xl font-bold text-pink-600 mt-2">{{ $genderChart['data'][1] }} <span class="text-base font-normal text-slate-500">Orang</span></p>
    </div>
</div>

@if ($totalPegawai === 0)
    <!-- Empty State jika belum ada pegawai sama sekali -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
        <h2 class="text-lg font-semibold text-slate-800">Belum Ada Data Statistik untuk Ditampilkan</h2>
        <p class="text-sm text-slate-500 mt-1 mb-6">Tambahkan data pegawai terlebih dahulu untuk melihat grafik perbandingan.</p>
        <a href="{{ route('pegawai.create') }}"
           class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
            + Tambah Pegawai Pertama
        </a>
    </div>
@else
    <!-- Grid 3 Kartu Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Grafik 1: Perbandingan Laki-laki vs Perempuan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
            <h2 class="text-base font-bold text-slate-800 mb-4">Perbandingan Jenis Kelamin</h2>
            <div class="relative flex-1 min-h-[260px] flex items-center justify-center">
                <canvas id="genderChartCanvas"></canvas>
            </div>
        </div>

        <!-- Grafik 2: Pendidikan Terakhir Pegawai -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
            <h2 class="text-base font-bold text-slate-800 mb-4">Pendidikan Terakhir Pegawai</h2>
            <div class="relative flex-1 min-h-[260px]">
                <canvas id="pendidikanChartCanvas"></canvas>
            </div>
        </div>

        <!-- Grafik 3: Kelompok Usia Pegawai -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
            <h2 class="text-base font-bold text-slate-800 mb-4">Distribusi Usia Pegawai</h2>
            <div class="relative flex-1 min-h-[260px]">
                <canvas id="usiaChartCanvas"></canvas>
            </div>
        </div>
    </div>
@endif
@endsection

@if ($totalPegawai > 0)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const genderData = @json($genderChart);
        const pendidikanData = @json($pendidikanChart);
        const usiaData = @json($usiaChart);

        // 1. Doughnut Chart Jenis Kelamin
        new Chart(document.getElementById('genderChartCanvas'), {
            type: 'doughnut',
            data: {
                labels: genderData.labels,
                datasets: [{
                    data: genderData.data,
                    backgroundColor: ['#3b82f6', '#ec4899'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // 2. Bar Chart Pendidikan Terakhir
        new Chart(document.getElementById('pendidikanChartCanvas'), {
            type: 'bar',
            data: {
                labels: pendidikanData.labels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: pendidikanData.data,
                    backgroundColor: '#4f46e5',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // 3. Bar Chart Rentang Usia
        new Chart(document.getElementById('usiaChartCanvas'), {
            type: 'bar',
            data: {
                labels: usiaData.labels,
                datasets: [{
                    label: 'Jumlah Pegawai',
                    data: usiaData.data,
                    backgroundColor: '#0d9488',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    });
</script>
@endpush
@endif