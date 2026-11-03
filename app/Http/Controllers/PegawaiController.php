<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PegawaiController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));

        $pegawai = Pegawai::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pegawai.index', compact('pegawai', 'search'));
    }

    public function create(): View
    {
        $pendidikanList = Pegawai::PENDIDIKAN_LIST;

        return view('pegawai.create', compact('pendidikanList'));
    }

    public function store(PegawaiRequest $request): RedirectResponse
    {
        Pegawai::create($request->validated());

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai): View
    {
        $pendidikanList = Pegawai::PENDIDIKAN_LIST;

        return view('pegawai.edit', compact('pegawai', 'pendidikanList'));
    }

    public function update(PegawaiRequest $request, Pegawai $pegawai): RedirectResponse
    {
        $pegawai->update($request->validated());

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        $nama = $pegawai->nama;
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', "Data pegawai {$nama} berhasil dihapus.");
    }
}