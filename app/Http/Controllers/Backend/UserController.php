<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 1. Menampilkan semua pengguna (Fungsi yang kita buat tadi)
    public function index()
    {
        $users = User::latest()->get();
        return view('backend.v_user.index', [
            'judul' => 'Data Pengguna Terdaftar',
            'users' => $users
        ]);
    }

    // 2. Menampilkan form tambah pengguna (Buatanmu)
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User Baru'
        ]);
    }

    // 3. Menyimpan data pengguna baru dari Admin (Buatanmu, sudah diperbaiki typo-nya)
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama'   => 'required|max:255',
            'email'  => 'required|email|unique:users,email', // <-- Diperbaiki (users)
            'no_hp'  => 'required|min:10|max:13',
            'alamat' => 'required',
            'role'   => 'required',
            'password' => 'required|min:6'
        ]);

        // Simpan data
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'status' => 1,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => bcrypt($request->password),
        ]);

        // Setelah simpan, kembali ke halaman index
        return redirect()->route('backend.user.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }
    // 4. Menampilkan form ubah data
    public function edit($id)
    {
        $edit = User::findOrFail($id);
        return view('backend.v_user.edit', [
            'judul' => 'Ubah Data Pengguna',
            'edit' => $edit
        ]);
    }

    // 5. Menyimpan perubahan data ke database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'nama'   => 'required|max:255',
            'email'  => 'required|email|unique:users,email,' . $id, // Email boleh sama asalkan milik dia sendiri
            'no_hp'  => 'required|min:10|max:13',
            'role'   => 'required',
        ];

        // Jika Admin mengisi password baru, maka divalidasi. Jika kosong, abaikan.
        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        // Update data dasar
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->role = $request->role;

        // Jika password diisi, enkripsi dan simpan yang baru
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('backend.user.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // 6. Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('backend.user.index')->with('success', 'Akun pengguna berhasil dihapus!');
    }
}