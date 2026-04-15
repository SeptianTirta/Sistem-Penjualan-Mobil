@extends('frontend.v_layouts.app')
@section('content')

<style>
    body { background-color: #f8f9fa; }
    .car-image-container { 
        border-radius: 25px; 
        overflow: hidden; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.08); 
        background: white;
    }
    .car-image { width: 100%; height: auto; object-fit: cover; }
    .car-title { font-weight: 800; color: #001437; font-size: 2.8rem; letter-spacing: -1px; }
    .car-price { font-weight: 800; color: #EA5555; font-size: 2.2rem; }
    .badge-tipe { background: #eef2ff; color: #7898FB; font-weight: 600; padding: 10px 20px; border-radius: 50px; font-size: 14px; }
    
    .spec-box { 
        background: white; 
        border-radius: 15px; 
        padding: 20px; 
        margin-bottom: 20px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.03); 
        border-bottom: 4px solid #7898FB; 
        transition: 0.3s;
    }
    .spec-box:hover { transform: translateY(-5px); border-bottom-color: #EA5555; }
    .spec-title { font-size: 12px; color: #8a98ac; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .spec-value { font-size: 18px; color: #001437; font-weight: 700; }

    .btn-pesan { 
        background: #001437; 
        color: white; 
        width: 100%; 
        font-weight: 700; 
        border-radius: 15px; 
        padding: 18px; 
        font-size: 18px; 
        transition: 0.3s; 
        border: none;
    }
    .btn-pesan:hover { background: #EA5555; color: white; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(234,85,85,0.2); }
    
    .breadcrumb-item a { color: #8a98ac; font-weight: 500; text-decoration: none; }
    .breadcrumb-item.active { color: #001437; font-weight: 700; }
</style>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}#katalog">Katalog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $mobil->nama_mobil }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-7">
            <div class="car-image-container">
                <img src="{{ $mobil->gambar_mobil ? asset('storage/img_mobil/' . $mobil->gambar_mobil) : asset('storage/img_mobil/no-image.jpg') }}" 
                     class="car-image" alt="{{ $mobil->nama_mobil }}">
            </div>
            
            <div class="mt-4 p-4 bg-white rounded-4 shadow-sm">
                <h5 class="fw-bold mb-3" style="color: #001437;">Deskripsi Unit</h5>
                <p class="text-muted leading-relaxed">
                    Nikmati sensasi berkendara premium dengan <strong>{{ $mobil->nama_mobil }}</strong>. 
                    Kendaraan ini dirancang khusus untuk memberikan efisiensi bahan bakar maksimal tanpa mengorbankan performa. 
                    Cocok untuk keluarga Indonesia yang menginginkan keamanan dan kenyamanan dalam satu paket elegan.
                </p>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="ps-lg-4">
                <span class="badge-tipe d-inline-block mb-3 shadow-sm">
                    <i class="bi bi-tag-fill me-2"></i>{{ $mobil->tipe->nama_tipe ?? 'Unit Suzuki' }}
                </span>
                <h1 class="car-title mb-2">{{ $mobil->nama_mobil }}</h1>
                <div class="car-price mb-4">Rp {{ number_format($mobil->harga, 0, ',', '.') }}</div>

                <hr class="my-4 opacity-50">

                <h5 class="fw-bold mb-3" style="color: #001437;">Spesifikasi Armada</h5>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="spec-box">
                            <div class="spec-title">Tahun Rilis</div>
                            <div class="spec-value">{{ $mobil->tahun }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-box">
                            <div class="spec-title">Warna Unit</div>
                            <div class="spec-value">{{ $mobil->warna }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-box">
                            <div class="spec-title">Kapasitas</div>
                            <div class="spec-value">{{ $mobil->kapasitas }} Kursi</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="spec-box">
                            <div class="spec-title">Status Stok</div>
                            <div class="spec-value {{ $mobil->stok > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $row->stok ?? $mobil->stok }} <small class="fw-normal text-muted">Tersedia</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ route('booking.mobil', $mobil->id) }}" class="btn btn-pesan shadow-lg text-center flex-grow-1" style="text-decoration: none;">
                            <i class="bi bi-cart-check me-2"></i> Booking Unit
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalKredit" class="btn btn-outline-danger shadow-sm fw-bold flex-grow-1" style="border-radius: 15px; padding: 18px; font-size: 18px; transition: 0.3s;">
                            <i class="bi bi-calculator me-2"></i> Simulasi Kredit
                        </button>
                    </div>
                    <p class="text-center mt-3 text-muted small">
                        <i class="bi bi-info-circle me-1"></i> Booking Fee untuk mengamankan unit mulai dari Rp 5.000.000
                    </p>
                </div>
    </div>
</div>

{{-- FOOTER KHUSUS DETAIL (OPSIONAL) --}}
<section class="py-5 mt-5 bg-white shadow-sm">
    <div class="container text-center">
        <h4 class="fw-bold mb-4" style="color: #001437;">Butuh Bantuan?</h4>
        <div class="d-flex justify-content-center gap-3">
            <div class="p-3 border rounded-4 px-4">
                <i class="bi bi-telephone fs-4 text-danger d-block mb-2"></i>
                <span class="small fw-bold">0812-xxxx-xxxx</span>
            </div>
            <div class="p-3 border rounded-4 px-4">
                <i class="bi bi-geo-alt fs-4 text-danger d-block mb-2"></i>
                <span class="small fw-bold">Dealer Ratan Jakarta</span>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalKredit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
            
            <div class="modal-header bg-light" style="border-radius: 20px 20px 0 0; padding: 20px 30px;">
                <h5 class="modal-title fw-bold" style="color: #001437;">
                    <i class="bi bi-calculator-fill me-2 text-danger"></i>Kalkulator Kredit
                </h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 p-md-5">
                <p class="text-muted small mb-4">Simulasi ini menggunakan asumsi suku bunga <strong>Flat 8% per tahun</strong>. Hasil aktual bisa berbeda tergantung kebijakan leasing.</p>
                
                <input type="hidden" id="harga_otr_js" value="{{ $mobil->harga }}">
                
                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase text-muted">Harga OTR Mobil</label>
                    <input type="text" class="form-control bg-light fw-bold text-primary border-0" value="Rp {{ number_format($mobil->harga, 0, ',', '.') }}" readonly style="padding: 12px 15px;">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase text-muted">Uang Muka / DP (Rupiah)</label>
                    <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                        <span class="input-group-text bg-white border-end-0 fw-bold">Rp</span>
                        <input type="number" id="input_dp" class="form-control border-start-0" value="{{ $mobil->harga * 0.2 }}" style="padding: 12px 15px;" onkeyup="kalkulasiKredit()">
                    </div>
                    <small class="text-muted" style="font-size: 11px;">*Minimal DP yang disarankan adalah 20%.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-uppercase text-muted">Tenor Cicilan</label>
                    <select id="input_tenor" class="form-select shadow-sm border-0 bg-light" style="padding: 12px 15px; cursor: pointer;" onchange="kalkulasiKredit()">
                        <option value="12">1 Tahun (12 Bulan)</option>
                        <option value="24">2 Tahun (24 Bulan)</option>
                        <option value="36" selected>3 Tahun (36 Bulan)</option>
                        <option value="48">4 Tahun (48 Bulan)</option>
                        <option value="60">5 Tahun (60 Bulan)</option>
                    </select>
                </div>

                <div class="p-4 rounded-4 mt-4" style="background: linear-gradient(135deg, #001437, #0a2b6d); color: white;">
                    <div class="d-flex justify-content-between mb-2 opacity-75">
                        <span class="small">Pokok Pinjaman</span>
                        <span class="fw-bold" id="tampil_pokok">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 opacity-75">
                        <span class="small">Total Bunga</span>
                        <span class="fw-bold" id="tampil_bunga">Rp 0</span>
                    </div>
                    <hr class="opacity-25 border-white">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="small text-uppercase" style="letter-spacing: 1px;">Angsuran / Bulan</span>
                        <span class="fw-bold text-warning" style="font-size: 1.8rem;" id="tampil_cicilan">Rp 0</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk merapikan angka jadi format Rupiah (Contoh: 1000000 jadi 1.000.000)
    function formatRupiah(angka) {
        return Math.round(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi Utama Kalkulator
    function kalkulasiKredit() {
        // 1. Ambil data dari kotak input
        let hargaOtr = parseFloat(document.getElementById('harga_otr_js').value);
        let dp = parseFloat(document.getElementById('input_dp').value) || 0;
        let tenorBulan = parseInt(document.getElementById('input_tenor').value);
        
        // Asumsi bunga flat kendaraan bermotor = 8% (0.08)
        let bungaPerTahun = 0.08; 

        // 2. Cegah error jika DP lebih besar dari Harga Mobil
        if(dp >= hargaOtr) {
            document.getElementById('tampil_pokok').innerText = "Lunas";
            document.getElementById('tampil_bunga').innerText = "Lunas";
            document.getElementById('tampil_cicilan').innerText = "Lunas";
            return;
        }

        // 3. Rumus Matematika Leasing
        let pokokHutang = hargaOtr - dp;
        let tenorTahun = tenorBulan / 12;
        let totalBunga = pokokHutang * bungaPerTahun * tenorTahun;
        let grandTotalHutang = pokokHutang + totalBunga;
        let cicilanPerBulan = grandTotalHutang / tenorBulan;

        // 4. Tampilkan hasilnya ke layar (di dalam tag span)
        document.getElementById('tampil_pokok').innerText = "Rp " + formatRupiah(pokokHutang);
        document.getElementById('tampil_bunga').innerText = "Rp " + formatRupiah(totalBunga);
        document.getElementById('tampil_cicilan').innerText = "Rp " + formatRupiah(cicilanPerBulan);
    }

    // Jalankan mesin hitung otomatis SATU KALI saat halaman selesai dimuat (loading)
    document.addEventListener('DOMContentLoaded', function() {
        kalkulasiKredit();
    });
</script>

@endsection