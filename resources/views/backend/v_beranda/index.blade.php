@extends('backend.v_layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h3 class="fw-bold m-0" style="color: #001437;">Dashboard Analitik</h3>
            <p class="text-muted m-0">Ringkasan performa penjualan Suzuki Ratan</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="bg-white px-4 py-2 rounded-pill shadow-sm d-inline-block border">
                <i class="bi bi-calendar3 text-danger me-2"></i>
                <span class="fw-bold text-dark">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3" style="border-left: 5px solid #001437 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-bold" style="font-size: 13px;">TOTAL ARMADA</p>
                        <h2 class="fw-bold mb-0" style="color: #001437;">{{ $total_mobil }} <span
                                class="fs-6 text-muted fw-normal">Unit</span></h2>
                    </div>
                    <div class="bg-light rounded-circle p-3 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class="bi bi-car-front-fill fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3" style="border-left: 5px solid #EA5555 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-bold" style="font-size: 13px;">TOTAL PESANAN</p>
                        <h2 class="fw-bold mb-0" style="color: #001437;">{{ $total_pesanan }} <span
                                class="fs-6 text-muted fw-normal">SPK</span></h2>
                    </div>
                    <div class="bg-light rounded-circle p-3 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class="bi bi-bag-check-fill fs-3 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3" style="border-left: 5px solid #198754 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-bold" style="font-size: 13px;">MEMBER TERDAFTAR</p>
                        <h2 class="fw-bold mb-0" style="color: #001437;">{{ $total_user }} <span
                                class="fs-6 text-muted fw-normal">Orang</span></h2>
                    </div>
                    <div class="bg-light rounded-circle p-3 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class="bi bi-people-fill fs-3 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3" style="border-left: 5px solid #ffc107 !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-bold" style="font-size: 13px;">PENDAPATAN BOOKING</p>
                        <h4 class="fw-bold mb-0" style="color: #001437;">Rp
                            {{ number_format($total_pendapatan, 0, ',', '.') }}</h4>
                    </div>
                    <div class="bg-light rounded-circle p-3 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class="bi bi-wallet2 fs-3 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold" style="color: #001437;"><i
                            class="bi bi-bar-chart-line-fill text-danger me-2"></i>Tren Pesanan (6 Bulan Terakhir)</h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="barChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4 text-center">
                    <h5 class="fw-bold" style="color: #001437;"><i class="bi bi-pie-chart-fill text-primary me-2"></i>Tipe
                        Mobil Terlaris</h5>
                </div>
                <div class="card-body p-4 d-flex justify-content-center align-items-center">
                    <canvas id="doughnutChart" height="250"></canvas>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Ambil data dari Controller (web.php) yang diubah ke format JSON
        const labelBulan = @json($label_bulan);
        const dataPenjualan = @json($data_penjualan);
        const labelTipe = @json($label_tipe);
        const dataTipe = @json($data_tipe);

        // 1. Konfigurasi Bar Chart (Tren Pesanan)
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labelBulan,
                datasets: [{
                    label: 'Jumlah SPK (Pesanan)',
                    data: dataPenjualan,
                    backgroundColor: '#001437', // Warna Navy Suzuki
                    borderRadius: 8,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // 2. Konfigurasi Doughnut Chart (Tipe Terlaris)
        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: labelTipe,
                datasets: [{
                    data: dataTipe,
                    backgroundColor: [
                        '#EA5555', // Merah
                        '#001437', // Navy
                        '#198754', // Hijau
                        '#ffc107', // Kuning
                        '#0dcaf0' // Cyan
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });
    </script>
@endsection
