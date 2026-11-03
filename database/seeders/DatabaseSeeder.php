<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin default untuk uji kompetensi
        User::updateOrCreate(
            ['email' => 'admin@ukom.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
            ]
        );

        // 30 data pegawai contoh dengan variasi gender, pendidikan, dan tanggal lahir
        $dataPegawai = [
            ['nama' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1990-04-12'],
            ['nama' => 'Siti Aminah', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1995-08-23'],
            ['nama' => 'Agus Setiawan', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'SMA/SMK', 'tanggal_lahir' => '2003-01-15'],
            ['nama' => 'Dewi Lestari', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'D3', 'tanggal_lahir' => '1998-11-05'],
            ['nama' => 'Eko Prasetyo', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S2', 'tanggal_lahir' => '1982-06-30'],
            ['nama' => 'Rina Wulandari', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '2002-03-19'],
            ['nama' => 'Hendra Wijaya', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S3', 'tanggal_lahir' => '1969-12-10'],
            ['nama' => 'Maya Sari', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'SMA/SMK', 'tanggal_lahir' => '2004-07-21'],
            ['nama' => 'Rizky Pratama', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'D3', 'tanggal_lahir' => '1996-09-14'],
            ['nama' => 'Nurul Hidayah', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S2', 'tanggal_lahir' => '1987-02-28'],
            ['nama' => 'Joko Susilo', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'SMP', 'tanggal_lahir' => '1975-05-18'],
            ['nama' => 'Putri Rahayu', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1999-10-09'],
            ['nama' => 'Andi Saputra', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'SMA/SMK', 'tanggal_lahir' => '1993-04-02'],
            ['nama' => 'Ratna Kumala', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'D3', 'tanggal_lahir' => '1989-12-25'],
            ['nama' => 'Dedik Kurniawan', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1984-08-11'],
            ['nama' => 'Lestari Ningrum', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'SMA/SMK', 'tanggal_lahir' => '2005-02-17'],
            ['nama' => 'Fajar Nugroho', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1992-07-07'],
            ['nama' => 'Sri Wahyuni', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'SD', 'tanggal_lahir' => '1968-03-04'],
            ['nama' => 'Wahyu Hidayat', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'D3', 'tanggal_lahir' => '1979-11-29'],
            ['nama' => 'Indah Permatasari', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S2', 'tanggal_lahir' => '1991-06-16'],
            ['nama' => 'Arif Rahman', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1986-01-22'],
            ['nama' => 'Dian Kusuma', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1997-05-13'],
            ['nama' => 'Slamet Riyadi', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'SMP', 'tanggal_lahir' => '1970-09-01'],
            ['nama' => 'Yulia Citra', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'D3', 'tanggal_lahir' => '2003-10-30'],
            ['nama' => 'Bayu Anggara', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'SMA/SMK', 'tanggal_lahir' => '1994-03-27'],
            ['nama' => 'Nadia Vega', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1988-07-19'],
            ['nama' => 'Bambang Pamungkas', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S2', 'tanggal_lahir' => '1978-04-08'],
            ['nama' => 'Kartika Putri', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'SMA/SMK', 'tanggal_lahir' => '2001-12-03'],
            ['nama' => 'Gunawan Wibisono', 'jenis_kelamin' => 'L', 'pendidikan_terakhir' => 'S3', 'tanggal_lahir' => '1967-08-15'],
            ['nama' => 'Fitriani Zahra', 'jenis_kelamin' => 'P', 'pendidikan_terakhir' => 'S1', 'tanggal_lahir' => '1996-02-11'],
        ];

        Pegawai::truncate();

        foreach ($dataPegawai as $pegawai) {
            Pegawai::create($pegawai);
        }
    }
}