<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Transaksi;

class FrontendController extends Controller
{
    // Fungsi untuk Halaman Utama (Katalog)
    public function index(Request $request)
    {
        // Ambil semua tipe untuk mengisi pilihan di Dropdown Kategori
        $tipes = \App\Models\Tipe::all();

        // Mulai memanggil data mobil
        $query = Mobil::with('tipe')->latest();

        // 1. Jika ada pencarian teks (nama mobil)
        if ($request->filled('search')) {
            $query->where('nama_mobil', 'like', '%' . $request->search . '%');
        }

        // 2. Jika ada filter kategori/tipe yang dipilih
        if ($request->filled('kategori')) {
            $query->where('tipe_id', $request->kategori);
        }

        // Eksekusi pengambilan data
        $mobils = $query->get();

        return view('frontend.index', compact('mobils', 'tipes'));
    }

    // Fungsi untuk Halaman Detail
    public function show($id)
    {
        $mobil = Mobil::with('tipe')->findOrFail($id);
        
        return view('frontend.detail', [
            'mobil' => $mobil
        ]);
    }

    // Menampilkan halaman form booking
    public function booking($id)
    {
        // Cukup panggil Mobil:: (Lebih bersih)
        $mobil = Mobil::findOrFail($id);
        return view('frontend.booking', compact('mobil'));
    }

    // Memproses data form booking ke database
    public function bookingStore(Request $request)
{
    $request->validate([
        'mobil_id' => 'required',
        'no_hp' => 'required|string|max:15',
        'alamat_pengiriman' => 'required',
        'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $nama_file = '';

    if ($request->hasFile('bukti_bayar')) {
        $file = $request->file('bukti_bayar');
        $nama_file = $file->store('bukti_bayar', 'public');
    }

    Transaksi::create([
        'user_id' => auth()->id(),
        'mobil_id' => $request->mobil_id,
        'kode_booking' => 'BKG-' . strtoupper(uniqid()),
        'no_hp' => $request->no_hp,
        'alamat_pengiriman' => $request->alamat_pengiriman,
        'booking_fee' => 5000000,
        'bukti_bayar' => $nama_file,
        'status' => 'Pending',
    ]);

    return redirect()->route('pesanan.saya')
        ->with('success', 'Hore! Booking Anda berhasil diterima.');
}

    // Menampilkan riwayat pesanan pelanggan
    public function pesananSaya()
    {
        // Ambil transaksi milik user yang sedang login, urutkan dari yang terbaru
        $pesanan = \App\Models\Transaksi::with('mobil')
                    ->where('user_id', auth()->user()->id)
                    ->latest()
                    ->get();
        
        return view('frontend.pesanan_saya', compact('pesanan'));
    }
}