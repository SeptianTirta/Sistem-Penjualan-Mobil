<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleAuthController extends Controller
{
    // 1. Mengirim user ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Menerima balikan data dari Google setelah user berhasil login
    public function callback()
    {
        try {
            // Ambil data profil dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user ini sudah pernah login pakai Google sebelumnya
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Jika sudah ada, langsung loginkan
                Auth::login($user);
                return redirect()->route('beranda');
            } else {
                // Jika belum ada, cek apakah emailnya sudah terdaftar secara manual
                $existingUser = User::where('email', $googleUser->email)->first();

                if ($existingUser) {
                    // Update google_id ke akun yang sudah ada
                    $existingUser->update([
                        'google_id' => $googleUser->id,
                    ]);
                    Auth::login($existingUser);
                } else {
                    // Buat akun baru sepenuhnya sebagai Pelanggan (Role 2)
                    $newUser = User::create([
                        'nama' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'role' => 2, // 2 = Pelanggan
                        'password' => null, // Password dikosongkan karena pakai Google
                        'no_hp' => '-' // <--- TAMBAHKAN BARIS INI UNTUK MENGAKALI DATABASE
                    ]);
                    Auth::login($newUser);
                }

                return redirect()->route('beranda');
            }
        } catch (Exception $e) {
            // MATIKAN ERROR NYA
            // dd('ERROR ASLI: ' . $e->getMessage());

            // HIDUPKAN KEMBALI REDIRECT NYA
            return redirect()->route('login')->with('error', 'Gagal login menggunakan Google. Silakan coba lagi.');
        }
    }
}
