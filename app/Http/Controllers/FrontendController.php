<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;

class FrontendController extends Controller
{
    // Fungsi untuk Halaman Utama (Katalog)
    public function index(Request $request)
    {
        $tipes = \App\Models\Tipe::all();
        $query = Mobil::with('tipe')->latest();

        if ($request->filled('search')) {
            $query->where('nama_mobil', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('tipe_id', $request->kategori);
        }

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
        $mobil = Mobil::findOrFail($id);
        return view('frontend.booking', compact('mobil'));
    }

    // Memproses data form booking dan memanggil Midtrans
    public function bookingStore(Request $request)
    {
        // 1. Validasi tanpa bukti bayar
        $request->validate([
            'mobil_id' => 'required',
            'no_hp' => 'required|string|max:15',
            'alamat_pengiriman' => 'required',
        ]);

        // 2. Simpan Transaksi ke Database (Status Pending)
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'mobil_id' => $request->mobil_id,
            'kode_booking' => 'BKG-' . strtoupper(uniqid()),
            'no_hp' => $request->no_hp,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'booking_fee' => 5000000,
            'bukti_bayar' => '-', // Kita isi strip karena tidak pakai gambar lagi
            'status' => 'Pending',
        ]);

        // 3. Konfigurasi Kunci Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // 4. Siapkan Rincian Tagihan untuk Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi->kode_booking, // Pakai kode_booking agar mudah dilacak
                'gross_amount' => 5000000,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->nama,
                'email' => auth()->user()->email,
                'phone' => $request->no_hp,
            ),
        );

        // 5. Minta Snap Token
        $snapToken = Snap::getSnapToken($params);

        // 6. Lempar ke halaman pembayaran dengan membawa Token
        return view('frontend.pembayaran', compact('snapToken', 'transaksi'));
    }

    // Menampilkan riwayat pesanan pelanggan
    public function pesananSaya()
    {
        $pesanan = \App\Models\Transaksi::with('mobil')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->get();

        return view('frontend.pesanan_saya', compact('pesanan'));
    }
}
