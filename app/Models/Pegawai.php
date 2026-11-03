<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    // Daftar pilihan pendidikan terakhir yang diizinkan
    public const PENDIDIKAN_LIST = [
        'SD',
        'SMP',
        'SMA/SMK',
        'D3',
        'S1',
        'S2',
        'S3',
    ];

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'tanggal_lahir',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    // Hitung usia secara otomatis dari tanggal_lahir menggunakan Carbon
    protected function usia(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_lahir ? Carbon::parse($this->tanggal_lahir)->age : 0,
        );
    }

    // Label lengkap untuk jenis kelamin
    protected function labelJenisKelamin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
        );
    }
}