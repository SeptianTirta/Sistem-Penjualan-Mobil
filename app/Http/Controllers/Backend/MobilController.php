<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Tipe;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        // Kita gunakan eager loading 'with' agar query lebih cepat saat mengambil data tipe
        $index = Mobil::with('tipe')
            ->when($search, function ($query, $search) {
                return $query->where('nama_mobil', 'like', "%{$search}%");
            })->latest()->get();

        return view('backend.v_mobil.index', [
            'judul' => 'Daftar Armada Suzuki',
            'index' => $index
        ]);
    }

    public function create()
    {
        return view('backend.v_mobil.create', [
            'judul' => 'Tambah Armada Baru',
            'tipe' => Tipe::all() // Mengambil semua kategori tipe untuk dropdown
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_id' => 'required',
            'nama_mobil' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar_mobil' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Logika Upload Gambar
        if ($request->hasFile('gambar_mobil')) {
            $file = $request->file('gambar_mobil');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/img_mobil'), $nama_file);
            $data['gambar_mobil'] = $nama_file;
        }

        Mobil::create($data);

        return redirect()->route('backend.mobil.index')->with('success', 'Mobil berhasil ditambahkan ke katalog!');
    }

    public function edit(string $id)
    {
        return view('backend.v_mobil.edit', [
            'judul' => 'Edit Data Mobil',
            'edit' => Mobil::findOrFail($id),
            'tipe' => Tipe::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $mobil = Mobil::findOrFail($id);
        
        $request->validate([
            'tipe_id' => 'required',
            'nama_mobil' => 'required',
            'gambar_mobil' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_mobil')) {
            // Hapus gambar lama jika ada
            if ($mobil->gambar_mobil && file_exists(public_path('storage/img_mobil/' . $mobil->gambar_mobil))) {
                unlink(public_path('storage/img_mobil/' . $mobil->gambar_mobil));
            }

            $file = $request->file('gambar_mobil');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/img_mobil'), $nama_file);
            $data['gambar_mobil'] = $nama_file;
        }

        $mobil->update($data);

        return redirect()->route('backend.mobil.index')->with('success', 'Data armada Suzuki berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $mobil = Mobil::findOrFail($id);
        if ($mobil->gambar_mobil && file_exists(public_path('storage/img_mobil/' . $mobil->gambar_mobil))) {
            unlink(public_path('storage/img_mobil/' . $mobil->gambar_mobil));
        }
        $mobil->delete();

        return redirect()->route('backend.mobil.index')->with('success', 'Armada berhasil dihapus dari sistem.');
    }
}