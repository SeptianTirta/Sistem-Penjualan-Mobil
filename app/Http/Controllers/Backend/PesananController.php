<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class PesananController extends Controller
{
    // Menampilkan semua daftar pesanan masuk
    public function index()
    {
        // Ambil data transaksi beserta relasi user dan mobilnya
        $pesanan = Transaksi::with(['user', 'mobil'])->latest()->get();
        
        return view('backend.v_pesanan.index', [
            'judul' => 'Kelola Data Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    // Mengubah status pesanan (Misal dari Pending jadi Diproses)
    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}