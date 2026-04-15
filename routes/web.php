<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\TipeController;
use App\Http\Controllers\Backend\MobilController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Publik & Pelanggan)
|--------------------------------------------------------------------------
*/
// GRUP FRONTEND UMUM (Hanya untuk Tamu & Pelanggan, Admin dilarang masuk!)
Route::middleware(['tolak_admin'])->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('beranda');
    Route::get('/mobil/{id}', [FrontendController::class, 'show'])->name('detail.mobil');
});

// GRUP FRONTEND KHUSUS PELANGGAN (Harus Login DAN Harus Role 2)
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/mobil/{id}/booking', [FrontendController::class, 'booking'])->name('booking.mobil');
    Route::post('/booking/store', [FrontendController::class, 'bookingStore'])->name('booking.store');
    Route::get('/pesanan-saya', [FrontendController::class, 'pesananSaya'])->name('pesanan.saya');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login & Logout)
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store')->middleware('guest');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('backend.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('backend.logout');

/*
|--------------------------------------------------------------------------
| BACKEND ROUTES (Khusus Admin & Super Admin)
|--------------------------------------------------------------------------
*/

// BLOK 1: ADMIN DEALER & SUPER ADMIN (Role 0 dan 1)
Route::middleware(['auth', 'role:0,1'])->prefix('backend')->name('backend.')->group(function () {
    // Dashboard Admin dengan Data Statistik & Grafik
    // Dashboard Admin dengan Data Statistik & Grafik REAL-TIME
    Route::get('/beranda', function () {
        // 1. Data Kartu Atas (Tetap)
        $total_mobil = \App\Models\Mobil::count();
        $total_pesanan = \App\Models\Transaksi::count();
        $total_user = \App\Models\User::where('role', 2)->count();
        $total_pendapatan = \App\Models\Transaksi::where('status', 'Selesai')->sum('booking_fee');

        // 2. Data Grafik: TIPE TERLARIS (Doughnut Chart)
        // Menghitung jumlah pesanan berdasarkan Tipe Mobil (Top 5)
        $tipeTerlaris = \Illuminate\Support\Facades\DB::table('transaksis')
            ->join('mobils', 'transaksis.mobil_id', '=', 'mobils.id')
            ->join('tipes', 'mobils.tipe_id', '=', 'tipes.id')
            ->select('tipes.nama_tipe', \Illuminate\Support\Facades\DB::raw('count(transaksis.id) as jumlah'))
            ->groupBy('tipes.id', 'tipes.nama_tipe')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        // Pisahkan nama dan jumlahnya untuk chart
        $label_tipe = $tipeTerlaris->pluck('nama_tipe');
        $data_tipe = $tipeTerlaris->pluck('jumlah');

        // Jika belum ada transaksi sama sekali, beri label default agar grafik tidak kosong/error
        if($label_tipe->isEmpty()) {
            $label_tipe = ['Belum Ada Penjualan'];
            $data_tipe = [1]; 
        }

        // 3. Data Grafik: TREN PESANAN 6 BULAN TERAKHIR REAL-TIME (Bar Chart)
        $label_bulan = [];
        $data_penjualan = [];

        // Menggunakan Carbon untuk mundur 5 bulan ke belakang sampai bulan saat ini
        for ($i = 5; $i >= 0; $i--) {
            $bulan = \Carbon\Carbon::now()->subMonths($i);
            // Simpan nama bulan & tahun (Contoh: "April 2026")
            $label_bulan[] = $bulan->translatedFormat('F Y'); 
            
            // Hitung transaksi riil di bulan & tahun tersebut
            $jumlahPesanan = \App\Models\Transaksi::whereMonth('created_at', $bulan->month)
                                      ->whereYear('created_at', $bulan->year)
                                      ->count();
            $data_penjualan[] = $jumlahPesanan;
        }

        return view('backend.v_beranda.index', [
            'judul' => 'Dashboard Statistik',
            'total_mobil' => $total_mobil,
            'total_pesanan' => $total_pesanan,
            'total_user' => $total_user,
            'total_pendapatan' => $total_pendapatan,
            'label_tipe' => $label_tipe,
            'data_tipe' => $data_tipe,
            'label_bulan' => $label_bulan,
            'data_penjualan' => $data_penjualan
        ]);
    })->name('beranda');

    // CRUD Tipe dan Mobil
    Route::resource('tipe', TipeController::class);
    Route::resource('mobil', MobilController::class);

    // ROUTE DATA PESANAN
    Route::get('/pesanan', [\App\Http\Controllers\Backend\PesananController::class, 'index'])->name('pesanan.index');
    Route::put('/pesanan/{id}/status', [\App\Http\Controllers\Backend\PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

});

// BLOK 2: SANGAT RAHASIA - HANYA SUPER ADMIN (Role 1)
Route::middleware(['auth', 'role:1'])->prefix('backend')->name('backend.')->group(function () {
    
    // ROUTE DATA USER (Terkunci rapat, hanya Bos yang bisa masuk)
    Route::resource('user', \App\Http\Controllers\Backend\UserController::class);

});