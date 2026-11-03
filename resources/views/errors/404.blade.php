@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="min-h-[65vh] flex flex-col items-center justify-center text-center px-4">
    <p class="text-6xl font-extrabold text-indigo-600">404</p>
    <h1 class="mt-4 text-2xl font-bold text-slate-900">Halaman atau Data Tidak Ditemukan</h1>
    <p class="mt-2 text-sm text-slate-500 max-w-md">
        Maaf, halaman atau data pegawai yang Anda cari tidak tersedia atau mungkin telah dihapus.
    </p>
    <a href="{{ url('/') }}"
       class="mt-6 inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition">
        Kembali ke Halaman Utama
    </a>
</div>
@endsection