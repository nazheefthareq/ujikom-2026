@extends('layouts.app')

@section('title', 'Tambah Pegawai Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Tambah Pegawai Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Lengkapi formulir di bawah ini untuk menambahkan data pegawai</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8">
        <form action="{{ route('pegawai.store') }}" method="POST" novalidate>
            @csrf
            @include('pegawai._form', ['submitLabel' => 'Tambah Pegawai'])
        </form>
    </div>
</div>
@endsection