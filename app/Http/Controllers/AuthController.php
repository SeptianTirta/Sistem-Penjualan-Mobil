<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('backend.v_login.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // CEK ROLE PENGGUNA YANG LOGIN
            $role = auth()->user()->role;

            if ($role == 0 || $role == 1) {
                // Jika dia Admin (0) atau Super Admin (1), lempar ke Ruang Kendali
                return redirect()->route('backend.beranda');
            } else {
                // Jika dia Pelanggan Biasa (2), lempar ke Halaman Katalog Depan!
                return redirect()->route('beranda')->with('success', 'Selamat datang kembali, ' . auth()->user()->nama . '!');
            }
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Mengubah arah setelah logout menjadi kembali ke beranda, bukan ke login
        return redirect()->route('beranda')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    // Menampilkan halaman pendaftaran pelanggan
    public function register()
    {
        return view('frontend.register');
    }

    // Memproses data pendaftaran ke tabel users
    public function registerStore(Request $request)
    {
        // 1. Validasi data yang diisi pelanggan
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'no_hp' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed', // Harus cocok dengan password_confirmation
        ], [
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Simpan ke database dengan role 2 (Pelanggan Biasa)
        \App\Models\User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password), // Password diamankan dengan enkripsi
            'role' => 2, // 2 = Pelanggan / User Biasa (Bukan Admin)
            'status' => 1, // Langsung aktif
        ]);

        // 3. Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk menggunakan Email dan Password Anda.');
    }
}