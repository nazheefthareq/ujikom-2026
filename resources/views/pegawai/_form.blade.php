@php
    $selectedGender = old('jenis_kelamin', $pegawai->jenis_kelamin ?? '');
    $selectedPendidikan = old('pendidikan_terakhir', $pegawai->pendidikan_terakhir ?? '');
    $valueTanggalLahir = old('tanggal_lahir', isset($pegawai->tanggal_lahir) ? $pegawai->tanggal_lahir->format('Y-m-d') : '');
@endphp

<div class="space-y-5">
    <!-- Input Nama Pegawai -->
    <div>
        <label for="nama" class="block text-sm font-medium text-slate-700 mb-1">
            Nama Pegawai <span class="text-red-500">*</span>
        </label>
        <input type="text" id="nama" name="nama"
               value="{{ old('nama', $pegawai->nama ?? '') }}"
               maxlength="100" required
               placeholder="Masukkan nama lengkap pegawai"
               class="w-full rounded-lg border {{ $errors->has('nama') ? 'border-red-500' : 'border-slate-300' }} px-3.5 py-2 text-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
        @error('nama')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Radio Button Jenis Kelamin -->
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">
            Jenis Kelamin <span class="text-red-500">*</span>
        </span>
        <div class="flex items-center space-x-6">
            <label class="inline-flex items-center cursor-pointer">
                <input type="radio" name="jenis_kelamin" value="L"
                       {{ $selectedGender === 'L' ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-slate-700">Laki-laki</span>
            </label>
            <label class="inline-flex items-center cursor-pointer">
                <input type="radio" name="jenis_kelamin" value="P"
                       {{ $selectedGender === 'P' ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-slate-700">Perempuan</span>
            </label>
        </div>
        @error('jenis_kelamin')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Select Pendidikan Terakhir -->
    <div>
        <label for="pendidikan_terakhir" class="block text-sm font-medium text-slate-700 mb-1">
            Pendidikan Terakhir <span class="text-red-500">*</span>
        </label>
        <select id="pendidikan_terakhir" name="pendidikan_terakhir" required
                class="w-full rounded-lg border {{ $errors->has('pendidikan_terakhir') ? 'border-red-500' : 'border-slate-300' }} px-3.5 py-2 text-sm bg-white focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            <option value="">-- Pilih Pendidikan Terakhir --</option>
            @foreach ($pendidikanList as $jenjang)
                <option value="{{ $jenjang }}" {{ $selectedPendidikan === $jenjang ? 'selected' : '' }}>
                    {{ $jenjang }}
                </option>
            @endforeach
        </select>
        @error('pendidikan_terakhir')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Input Tanggal Lahir -->
    <div>
        <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-1">
            Tanggal Lahir <span class="text-red-500">*</span>
        </label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
               value="{{ $valueTanggalLahir }}" required
               class="w-full rounded-lg border {{ $errors->has('tanggal_lahir') ? 'border-red-500' : 'border-slate-300' }} px-3.5 py-2 text-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
        <p class="mt-1 text-xs text-slate-500">Rentang usia pegawai yang diterima adalah 17 hingga 70 tahun.</p>
        @error('tanggal_lahir')
            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Tombol Aksi -->
    <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
        <a href="{{ route('pegawai.index') }}"
           class="px-4 py-2 rounded-lg text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
            Batal
        </a>
        <button type="submit"
                class="px-5 py-2 rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ $submitLabel ?? 'Simpan Data' }}
        </button>
    </div>
</div>