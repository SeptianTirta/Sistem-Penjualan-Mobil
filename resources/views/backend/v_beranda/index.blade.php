@extends('backend.v_layouts.app')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="p-4">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold" style="color: #001437; letter-spacing: -1px;">Halo, {{ auth()->user()->nama }}!</h3>
            <p class="text-muted">Selamat datang kembali di pusat kendali Suzuki Ratan.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; border-left: 5px solid #EA5555 !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-4 me-3"><i class="bi bi-car-front-fill text-danger fs-3"></i></div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Total Unit</small>
                        <h3 class="fw-bold m-0">{{ $total_mobil }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; border-left: 5px solid #0d6efd !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3"><i class="bi bi-cart-check-fill text-primary fs-3"></i></div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Pesanan Masuk</small>
                        <h3 class="fw-bold m-0">{{ $total_pesanan }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; border-left: 5px solid #ffc107 !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4 me-3"><i class="bi bi-people-fill text-warning fs-3"></i></div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Pelanggan</small>
                        <h3 class="fw-bold m-0">{{ $total_user }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; border-left: 5px solid #198754 !important;">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-4 me-3"><i class="bi bi-currency-dollar text-success fs-3"></i></div>
                    <div>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Revenue Booking</small>
                        <h4 class="fw-bold m-0 text-success">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <h6 class="fw-bold text-muted text-uppercase mb-4" style="letter-spacing: 1px;">Tren Pesanan (6 Bulan Terakhir)</h6>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="grafikPesanan"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <h6 class="fw-bold text-muted text-uppercase mb-4" style="letter-spacing: 1px;">Top 5 Tipe Terlaris</h6>
                <div style="position: relative; height: 250px; width: 100%; display: flex; justify-content: center;">
                    <canvas id="grafikTipe"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Inisialisasi Grafik Pesanan (Bar Chart)
        const ctxPesanan = document.getElementById('grafikPesanan').getContext('2d');
        new Chart(ctxPesanan, {
            type: 'bar',
            data: {
                labels: {!! json_encode($label_bulan) !!},
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: {!! json_encode($data_penjualan) !!},
                    backgroundColor: 'rgba(13, 110, 253, 0.8)', // Biru Primary
                    borderRadius: 8,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });

        // 2. Inisialisasi Grafik Tipe Mobil (Doughnut Chart)
        const ctxTipe = document.getElementById('grafikTipe').getContext('2d');
        new Chart(ctxTipe, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($label_tipe) !!},
                datasets: [{
                    data: {!! json_encode($data_tipe) !!},
                    backgroundColor: [
                        '#EA5555', // Merah Suzuki
                        '#001437', // Navy Blue
                        '#ffc107', // Kuning
                        '#198754', // Hijau
                        '#0dcaf0', // Cyan
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Membuat lubang donatnya besar ala dashboard modern
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                }
            }
        });
    });
</script>

@endsection