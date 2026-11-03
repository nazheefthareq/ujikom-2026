@extends('layouts.app')

@section('title', 'Daftar Data Pegawai')

@section('content')
<div x-data="{
        modalOpen: false,
        deleteUrl: '',
        deleteName: '',
        confirmDelete(url, name) {
            this.deleteUrl = url;
            this.deleteName = name;
            this.modalOpen = true;
        }
    }"
    @keydown.escape.window="modalOpen = false">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Daftar Data Pegawai</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi pegawai, pendidikan terakhir, dan data usia</p>
        </div>
        <a href="{{ route('pegawai.create') }}"
           class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            + Tambah Pegawai
        </a>
    </div>

    <!-- Bar Pencarian Nama -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 mb-6">
        <form action="{{ route('pegawai.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <label for="q" class="sr-only">Cari Nama Pegawai</label>
                <input type="text" id="q" name="q" value="{{ $search }}"
                       placeholder="Cari berdasarkan nama pegawai..."
                       class="w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-slate-500">
                    Cari
                </button>
                @if ($search !== '')
                    <a href="{{ route('pegawai.index') }}"
                       class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-4 py-2 rounded-lg transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Data Pegawai Responsif -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="py-3.5 px-4 w-14">No</th>
                        <th class="py-3.5 px-4">Nama Pegawai</th>
                        <th class="py-3.5 px-4">Jenis Kelamin</th>
                        <th class="py-3.5 px-4">Pendidikan Terakhir</th>
                        <th class="py-3.5 px-4">Tanggal Lahir</th>
                        <th class="py-3.5 px-4">Usia</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($pegawai as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 text-slate-500">
                                {{ $pegawai->firstItem() + $loop->index }}
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-900">
                                {{ $item->nama }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->jenis_kelamin === 'L' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700' }}">
                                    {{ $item->label_jenis_kelamin }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-700">
                                {{ $item->pendidikan_terakhir }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-700">
                                {{ $item->tanggal_lahir->format('d-m-Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-700">
                                {{ $item->usia }} Tahun
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-2">
                                <a href="{{ route('pegawai.edit', $item) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-medium rounded-md transition focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    Ubah
                                </a>
                                <button type="button"
                                        @click="confirmDelete('{{ route('pegawai.destroy', $item) }}', '{{ addslashes($item->nama) }}')"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-medium rounded-md transition focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-4 text-center text-slate-500">
                                <p class="text-base font-medium text-slate-700">Belum ada data pegawai ditemukan</p>
                                <p class="text-xs mt-1">Silakan tambahkan pegawai baru atau ubah kata kunci pencarian Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pegawai->hasPages())
            <div class="px-4 py-3 border-t border-slate-200 bg-slate-50">
                {{ $pegawai->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Kustom Konfirmasi Hapus (Alpine.js) -->
    <div x-show="modalOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-xs p-4"
         role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div @click.away="modalOpen = false"
             class="bg-white rounded-xl shadow-lg border border-slate-200 max-w-md w-full p-6">
            <h2 id="modal-title" class="text-lg font-bold text-slate-900">Konfirmasi Penghapusan Data</h2>
            <p class="mt-2 text-sm text-slate-600">
                Apakah Anda yakin ingin menghapus data pegawai <strong class="text-slate-900" x-text="deleteName"></strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button"
                        @click="modalOpen = false"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 transition focus:outline-none focus:ring-2 focus:ring-slate-400">
                    Batal
                </button>
                <form :action="deleteUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-red-500">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection