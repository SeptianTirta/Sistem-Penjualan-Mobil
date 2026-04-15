<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipe; // Panggil model Tipe

class TipeController extends Controller
{
    // Menampilkan halaman tabel data tipe
    public function index(Request $request)
    {
        // Fitur pencarian otomatis jika ada request 'search' dari view
        $search = $request->search;
        $index = Tipe::when($search, function ($query, $search) {
            return $query->where('nama_tipe', 'like', "%{$search}%");
        })->latest()->get();

        return view('backend.v_tipe.index', [
            'judul' => 'Data Tipe Mobil Suzuki',
            'index' => $index
        ]);
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('backend.v_tipe.create', [
            'judul' => 'Tambah Tipe Mobil'
        ]);
    }

    // Memproses penyimpanan data ke database
    public function store(Request $request)
    {
        // Validasi inputan user
        $request->validate([
            'nama_tipe' => 'required|max:255',
            'deskripsi' => 'nullable'
        ], [
            'nama_tipe.required' => 'Nama tipe wajib diisi!'
        ]);

        // Simpan ke database
        Tipe::create([
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('backend.tipe.index')->with('success', 'Data tipe berhasil ditambahkan!');
    }

    // Menampilkan form ubah (Edit)
    public function edit(string $id)
    {
        $tipe = Tipe::findOrFail($id);
        return view('backend.v_tipe.edit', [
            'judul' => 'Ubah Data Tipe',
            'tipe' => $tipe
        ]);
    }

    // Memproses perubahan data
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_tipe' => 'required|max:255',
            'deskripsi' => 'nullable'
        ]);

        $tipe = Tipe::findOrFail($id);
        $tipe->update([
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('backend.tipe.index')->with('success', 'Data tipe berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(string $id)
    {
        $tipe = Tipe::findOrFail($id);
        $tipe->delete();

        return redirect()->route('backend.tipe.index')->with('success', 'Data tipe berhasil dihapus!');
    }
}