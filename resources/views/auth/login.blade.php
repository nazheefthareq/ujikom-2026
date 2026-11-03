@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Login Admin</h1>
            <p class="text-sm text-slate-500 mt-1">Masuk untuk mengelola data dan statistik pegawai</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5" novalidate>
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       placeholder="admin@ukom.test"
                       class="w-full rounded-lg border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-300' }} px-3.5 py-2 text-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       placeholder="••••••••"
                       class="w-full rounded-lg border {{ $errors->has('password') ? 'border-red-500' : 'border-slate-300' }} px-3.5 py-2 text-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-lg text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Masuk ke Sistem
            </button>
        </form>
    </div>
</div>
@endsection