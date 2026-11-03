@extends('layouts.app')

@section('title', 'Ubah Data Pegawai')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Ubah Data Pegawai</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui informasi untuk pegawai {{ $pegawai->nama }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8">
        <form action="{{ route('pegawai.update', $pegawai) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('pegawai._form', ['submitLabel' => 'Simpan Perubahan'])
        </form>
    </div>
</div>
@endsection