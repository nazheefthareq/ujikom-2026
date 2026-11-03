<?php

namespace App\Http\Requests;

use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Usia wajar kerja: minimal 17 tahun, maksimal 70 tahun
        $maxBirthDate = Carbon::today()->subYears(17)->format('Y-m-d');
        $minBirthDate = Carbon::today()->subYears(70)->format('Y-m-d');

        return [
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'pendidikan_terakhir' => ['required', Rule::in(Pegawai::PENDIDIKAN_LIST)],
            'tanggal_lahir' => [
                'required',
                'date',
                'before_or_equal:' . $maxBirthDate,
                'after_or_equal:' . $minBirthDate,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pegawai wajib diisi.',
            'nama.max' => 'Nama pegawai maksimal 100 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih.',
            'pendidikan_terakhir.in' => 'Pilihan pendidikan terakhir tidak sesuai daftar.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before_or_equal' => 'Usia pegawai minimal harus 17 tahun.',
            'tanggal_lahir.after_or_equal' => 'Usia pegawai maksimal adalah 70 tahun.',
        ];
    }
}