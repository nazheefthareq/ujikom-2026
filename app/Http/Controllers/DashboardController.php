<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPegawai = Pegawai::count();

        // 1. Agregasi perbandingan jenis kelamin dengan groupBy database
        $genderRaw = Pegawai::query()
            ->select('jenis_kelamin', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        $genderChart = [
            'labels' => ['Laki-laki', 'Perempuan'],
            'data' => [
                (int) ($genderRaw['L'] ?? 0),
                (int) ($genderRaw['P'] ?? 0),
            ],
        ];

        // 2. Agregasi jumlah pegawai per pendidikan terakhir sesuai urutan jenjang
        $pendidikanRaw = Pegawai::query()
            ->select('pendidikan_terakhir', DB::raw('COUNT(*) as total'))
            ->groupBy('pendidikan_terakhir')
            ->pluck('total', 'pendidikan_terakhir');

        $pendidikanData = [];
        foreach (Pegawai::PENDIDIKAN_LIST as $jenjang) {
            $pendidikanData[] = (int) ($pendidikanRaw[$jenjang] ?? 0);
        }

        $pendidikanChart = [
            'labels' => Pegawai::PENDIDIKAN_LIST,
            'data' => $pendidikanData,
        ];

        // 3. Agregasi rentang usia menggunakan batas tanggal lahir di database
        $today = Carbon::today();
        $batas25 = $today->copy()->subYears(25)->format('Y-m-d');
        $batas35 = $today->copy()->subYears(35)->format('Y-m-d');
        $batas45 = $today->copy()->subYears(45)->format('Y-m-d');
        $batas55 = $today->copy()->subYears(55)->format('Y-m-d');

        $usiaRaw = Pegawai::query()
            ->selectRaw("
                CASE
                    WHEN tanggal_lahir > ? THEN '< 25 Tahun'
                    WHEN tanggal_lahir > ? THEN '25 - 34 Tahun'
                    WHEN tanggal_lahir > ? THEN '35 - 44 Tahun'
                    WHEN tanggal_lahir > ? THEN '45 - 54 Tahun'
                    ELSE '55+ Tahun'
                END as kelompok_usia,
                COUNT(*) as total
            ", [$batas25, $batas35, $batas45, $batas55])
            ->groupBy('kelompok_usia')
            ->pluck('total', 'kelompok_usia');

        $kategoriUsia = ['< 25 Tahun', '25 - 34 Tahun', '35 - 44 Tahun', '45 - 54 Tahun', '55+ Tahun'];
        $usiaData = [];
        foreach ($kategoriUsia as $kategori) {
            $usiaData[] = (int) ($usiaRaw[$kategori] ?? 0);
        }

        $usiaChart = [
            'labels' => $kategoriUsia,
            'data' => $usiaData,
        ];

        return view('dashboard', compact(
            'totalPegawai',
            'genderChart',
            'pendidikanChart',
            'usiaChart'
        ));
    }
}