@extends('frontend.v_layouts.app')
@section('content')

    <style>
        body {
            background-color: #f4f6f9;
        }

        .booking-card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .summary-section {
            background: linear-gradient(135deg, #001437, #0a2b6d);
            color: white;
            padding: 40px;
        }

        .form-section {
            padding: 40px;
            background: white;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #7898FB;
        }

        .btn-booking {
            background-color: #EA5555;
            color: white;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-booking:hover {
            background-color: #d14040;
            transform: translateY(-2px);
        }
    </style>

    <div class="container py-5">

        <div class="mb-4">
            <a href="{{ route('detail.mobil', $mobil->id) }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Detail Unit
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="booking-card d-flex flex-column flex-lg-row">

                    <div class="summary-section col-lg-5">

                        <h4 class="fw-bold mb-4">Ringkasan Pemesanan</h4>

                        <img src="{{ $mobil->gambar_mobil ? asset('storage/img_mobil/' . $mobil->gambar_mobil) : asset('storage/img_mobil/no-image.jpg') }}"
                            class="img-fluid rounded-4 mb-4 shadow-sm"
                            style="object-fit: cover; height: 200px; width: 100%;">

                        <h5 class="fw-bold">{{ $mobil->nama_mobil }}</h5>
                        <p class="opacity-75 mb-4">
                            {{ $mobil->warna }} | {{ $mobil->tahun }}
                        </p>

                        <hr class="opacity-25">

                        <div class="d-flex justify-content-between">
                            <span>Harga</span>
                            <span class="fw-bold">
                                Rp {{ number_format($mobil->harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mt-2">
                            <span>Booking Fee</span>
                            <span class="fw-bold text-warning">
                                Rp 5.000.000
                            </span>
                        </div>

                        <div class="mt-4 text-center">
                            <small class="opacity-75"><i class="bi bi-shield-check me-1"></i> Transaksi dijamin aman oleh
                                Midtrans</small>
                        </div>

                    </div>

                    <div class="form-section col-lg-7">

                        <h4 class="fw-bold mb-4" style="color:#001437;">
                            Data Pelanggan
                        </h4>

                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                            <div class="mb-3">
                                <label class="small fw-bold">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ auth()->user()->nama }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="small fw-bold">No WhatsApp</label>
                                <input type="text" name="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ auth()->user()->no_hp != '-' ? auth()->user()->no_hp : '' }}"
                                    placeholder="08123456789" required>
                                @error('no_hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="small fw-bold">Alamat Pengiriman</label>
                                <textarea name="alamat_pengiriman" class="form-control @error('alamat_pengiriman') is-invalid @enderror" rows="3"
                                    required></textarea>
                            </div>

                            <button type="submit"
                                class="btn btn-booking w-100 py-3 d-flex justify-content-center align-items-center">
                                Lanjutkan ke Pembayaran <i class="bi bi-arrow-right ms-2"></i>
                            </button>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
