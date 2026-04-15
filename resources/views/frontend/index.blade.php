@extends('frontend.v_layouts.app')
@section('content')
    <style>
        /* HERO SECTION - Deep Blue Solid Overlay */
        /* HERO SECTION - Deep Blue Solid Overlay */
        .hero-section {
            /* Kita ubah URL-nya menunjuk ke folder public Laravel kita */
            background: linear-gradient(rgba(0, 20, 55, 0.7), rgba(0, 20, 55, 0.85)),
                url("{{ asset('img/suzuki-banner.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0, 20, 55, 0.2);
        }

        /* SEARCH BOX */
        .search-container {
            margin-top: -60px;
            z-index: 10;
            position: relative;
        }

        .search-card {
            background: white;
            border-radius: 20px;
            padding: 25px 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn-search {
            background-color: #EA5555;
            color: white;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.3s;
            border: none;
        }

        .btn-search:hover {
            background-color: #001437;
            transform: translateY(-2px);
        }

        /* MOBIL CARD */
        .car-card {
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            background: white;
            height: 100%;
        }

        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 20, 55, 0.1) !important;
            border-color: rgba(120, 152, 251, 0.3);
        }

        .car-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .car-image {
            height: 220px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .car-card:hover .car-image {
            transform: scale(1.08);
        }

        .price-tag {
            color: #EA5555;
            font-weight: 800;
            font-size: 1.3rem;
        }

        .btn-detail {
            background: #eef2ff;
            color: #001437;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.3s;
            border: none;
        }

        .btn-detail:hover {
            background: #EA5555;
            color: white;
        }
    </style>

    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3" style="letter-spacing: -1px;">Eksplorasi Suzuki Ratan</h1>
            <p class="fs-5 opacity-75 mb-0 fw-light">Kenyamanan, Performa, dan Gaya dalam Satu Genggaman</p>
            <div class="mt-4">
                <span class="badge px-4 py-2 rounded-pill shadow-sm" style="background-color: #EA5555; font-size: 14px;">
                    <i class="bi bi-shield-check me-1"></i> Dealer Resmi Terpercaya
                </span>
            </div>
        </div>
    </section>

    <div class="container search-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="search-card">
                    <form action="{{ route('beranda') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5 border-end d-none d-md-block">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"
                                            style="color: #001437;"></i></span>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control border-0 shadow-none fw-medium"
                                        placeholder="Cari model mobil...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="kategori" class="form-select border-0 shadow-none fw-bold"
                                    style="color: #001437; cursor: pointer;">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($tipes as $t)
                                        <option value="{{ $t->id }}"
                                            {{ request('kategori') == $t->id ? 'selected' : '' }}>
                                            {{ $t->nama_tipe }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-search w-100 py-3 shadow-sm">
                                    Temukan <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="katalog" class="py-5 mt-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold m-0" style="color: #001437; letter-spacing: -0.5px;">Temukan Gayamu</h2>
                    <p class="text-muted m-0 mt-1">Pilih unit terbaik untuk kebutuhan Anda hari ini</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($mobils as $row)
                    <div class="col-md-6 col-lg-4">
                        <div class="car-card shadow-sm">
                            <div class="car-image-wrapper">
                                <img src="{{ $row->gambar_mobil ? asset('storage/img_mobil/' . $row->gambar_mobil) : asset('storage/img_mobil/no-image.jpg') }}"
                                    class="car-image" alt="{{ $row->nama_mobil }}">
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-white shadow-sm px-3 py-2 rounded-pill fw-bold"
                                        style="color: #001437; font-size: 11px;">
                                        {{ $row->tipe->nama_tipe ?? 'Unit' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h4 class="fw-bold mb-1" style="color: #001437;">{{ $row->nama_mobil }}</h4>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-palette-fill me-1"></i> {{ $row->warna }} &bull; <i
                                        class="bi bi-people-fill me-1"></i> {{ $row->kapasitas }} Kursi
                                </p>
                                <hr class="opacity-25" style="border-color: #001437;">
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <small class="text-muted d-block fw-bold"
                                            style="font-size: 10px; text-transform: uppercase;">Harga OTR</small>
                                        <span class="price-tag">Rp {{ number_format($row->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('detail.mobil', $row->id) }}" class="btn btn-detail px-4 py-2">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search d-block mb-3" style="font-size: 3rem; color: #cbd5e1;"></i>
                        <h5 class="fw-bold text-muted">Mobil Tidak Ditemukan</h5>
                        <p class="text-muted">Coba gunakan kata kunci lain atau pilih kategori "Semua Kategori".</p>
                        <a href="{{ route('beranda') }}" class="btn btn-outline-danger mt-2 rounded-pill px-4">Reset
                            Pencarian</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="promo" class="py-5" style="background-color: #f1f4f9;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #001437;">Promo Eksklusif Bulan Ini</h2>
                <p class="text-muted">Jangan lewatkan penawaran terbatas khusus untuk Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="bg-danger py-3 text-center text-white fw-bold">PROMO LEBARAN</div>
                        <div class="card-body p-4 text-center">
                            <h4 class="fw-bold">DP Ringan 10%</h4>
                            <p class="text-muted small">Miliki Suzuki impian dengan uang muka sangat terjangkau khusus tipe
                                S-Presso & Baleno.</p>
                            <hr class="opacity-25">
                            <span class="badge bg-light text-danger p-2 px-3 rounded-pill fw-bold">*Syarat & Ketentuan
                                Berlaku</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100"
                        style="border: 2px solid #EA5555 !important;">
                        <div class="bg-dark py-3 text-center text-white fw-bold">BEST SELLER</div>
                        <div class="card-body p-4 text-center">
                            <h4 class="fw-bold">Bunga 0% (1 Tahun)</h4>
                            <p class="text-muted small">Cicilan tanpa bunga selama satu tahun pertama untuk setiap pembelian
                                All New Ertiga Hybrid.</p>
                            <hr class="opacity-25">
                            <span class="badge bg-danger p-2 px-3 rounded-pill fw-bold">PROMO TERLARIS</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="bg-primary py-3 text-center text-white fw-bold">EXTRA SERVICE</div>
                        <div class="card-body p-4 text-center">
                            <h4 class="fw-bold">Gratis Servis 3 Thn</h4>
                            <p class="text-muted small">Bebas biaya jasa servis dan suku cadang hingga 50.000 KM atau
                                selama 3 tahun penuh.</p>
                            <hr class="opacity-25">
                            <span class="badge bg-light text-primary p-2 px-3 rounded-pill fw-bold">AFTER SALES PLUS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang-kami" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="{{ asset('img/suzuki-banner.jpg') }}" class="img-fluid rounded-5 shadow-lg"
                        alt="Tentang Suzuki Ratan" style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <small class="text-danger fw-bold text-uppercase" style="letter-spacing: 2px;">Sejarah & Visi</small>
                    <h2 class="fw-bold mt-2 mb-4" style="color: #001437; font-size: 2.5rem;">Mengapa Memilih Suzuki Ratan?
                    </h2>
                    <p class="text-muted mb-4 lead">Suzuki Ratan telah melayani ribuan keluarga Indonesia selama lebih dari
                        15 tahun. Sebagai dealer resmi 3S (Sales, Service, Sparepart), kami berkomitmen memberikan
                        pengalaman membeli kendaraan yang transparan dan memuaskan.</p>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                <span class="fw-bold text-dark">Unit Ready Stock</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                <span class="fw-bold text-dark">Proses Kredit Cepat</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                <span class="fw-bold text-dark">Teknisi Tersertifikasi</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                <span class="fw-bold text-dark">Layanan Home Service</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 p-4 rounded-4" style="background-color: #001437; color: white;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="m-0 opacity-75 small">Hubungi Kami Sekarang</h6>
                                <h4 class="fw-bold m-0">+62 812-3456-7890</h4>
                            </div>
                            <a href="#" class="btn btn-danger rounded-pill px-4 fw-bold">Chat WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 border-top" style="background: #ffffff; margin-top: 60px;">
        <div class="container text-center">
            <h5 class="fw-bold mb-2" style="color: #001437;">SUZUKI RATAN</h5>
            <p class="text-muted small mb-0">&copy; {{ date('Y') }} Hak Cipta Dilindungi.</p>
        </div>
    </footer>
@endsection
