@extends('frontend.v_layouts.app')
@section('content')

<style>
    body { background-color: #f8f9fa; }
    .ticket-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        position: relative;
        transition: transform 0.3s;
    }
    .ticket-card:hover { transform: translateY(-5px); }
    
    .ticket-header {
        background: linear-gradient(135deg, #001437, #0a2b6d);
        color: white;
        padding: 20px 25px;
        border-bottom: 2px dashed rgba(255,255,255,0.2);
    }
    
    .status-badge {
        font-size: 12px;
        font-weight: 700;
        padding: 8px 15px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .ticket-body { padding: 25px; }
    .car-thumbnail { width: 100px; height: 70px; object-fit: cover; border-radius: 10px; }
</style>

<div class="container py-5">
  @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-5 p-4 d-flex align-items-center" style="background-color: #e8f7f0;">
            <i class="bi bi-check-circle-fill flex-shrink-0 me-3" style="font-size: 2.5rem; color: #10b981;"></i>
            <div>
                <h5 class="fw-bold mb-1" style="color: #047857;">Transaksi Berhasil!</h5>
                <p class="mb-0" style="color: #065f46;">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h2 class="fw-bold m-0" style="color: #001437; letter-spacing: -1px;">Pesanan Saya</h2>
            <p class="text-muted m-0 mt-1">Pantau status proses pemesanan armada Anda di sini</p>
        </div>
        <a href="{{ route('beranda') }}" class="btn btn-outline-primary rounded-pill fw-bold px-4">
            <i class="bi bi-plus-circle me-2"></i>Booking Lagi
        </a>
    </div>

    <div class="row g-4">
        @forelse ($pesanan as $row)
        <div class="col-lg-6">
            <div class="ticket-card">
                <div class="ticket-header d-flex justify-content-between align-items-center">
                    <div>
                        <small class="opacity-75 d-block mb-1">Kode Booking</small>
                        <h5 class="fw-bold m-0 text-warning">{{ $row->kode_booking }}</h5>
                    </div>
                    <div>
                        @if($row->status == 'Pending')
                            <span class="status-badge bg-white text-dark shadow-sm"><i class="bi bi-hourglass-split me-1"></i> Menunggu Konfirmasi</span>
                        @elseif($row->status == 'Diproses')
                            <span class="status-badge bg-primary text-white shadow-sm"><i class="bi bi-gear-wide-connected me-1"></i> Sedang Diproses</span>
                        @elseif($row->status == 'Selesai')
                            <span class="status-badge bg-success text-white shadow-sm"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>
                        @else
                            <span class="status-badge bg-danger text-white shadow-sm"><i class="bi bi-x-circle-fill me-1"></i> Dibatalkan</span>
                        @endif
                    </div>
                </div>
                
                <div class="ticket-body">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <img src="{{ $row->mobil->gambar_mobil ? asset('storage/img_mobil/' . $row->mobil->gambar_mobil) : asset('storage/img_mobil/no-image.jpg') }}" class="car-thumbnail shadow-sm">
                        <div>
                            <h5 class="fw-bold mb-1" style="color: #001437;">{{ $row->mobil->nama_mobil ?? 'Unit Terhapus' }}</h5>
                            <p class="text-muted small m-0"><i class="bi bi-calendar-check me-1"></i> Dipesan pada: {{ $row->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="row bg-light p-3 rounded-3 g-0">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 11px;">Alamat Kirim</small>
                            <span class="fw-bold" style="color: #001437; font-size: 14px;">{{ Str::limit($row->alamat_pengiriman, 25) }}</span>
                        </div>
                        <div class="col-6 ps-3">
                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 11px;">Booking Fee</small>
                            <span class="fw-bold text-danger" style="font-size: 14px;">Rp {{ number_format($row->booking_fee, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-white p-5 rounded-4 shadow-sm border" style="max-width: 500px; margin: 0 auto;">
                <i class="bi bi-receipt d-block mb-3" style="font-size: 4rem; color: #cbd5e1;"></i>
                <h4 class="fw-bold" style="color: #001437;">Belum Ada Transaksi</h4>
                <p class="text-muted mb-4">Anda belum melakukan booking kendaraan apapun. Yuk, temukan mobil impian Anda sekarang!</p>
                <a href="{{ route('beranda') }}" class="btn btn-danger rounded-pill fw-bold px-4 py-2 shadow-sm">Lihat Katalog Mobil</a>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection