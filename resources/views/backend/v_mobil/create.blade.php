@extends('backend.v_layouts.app')
@section('content')

    <div class="mb-5">
        <a href="{{ route('backend.mobil.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        <h3 class="fw-bold" style="color: #001437; letter-spacing: -0.5px;">{{ $judul }}</h3>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 20px;">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 12px;">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Gagal Menyimpan
                                Data!</div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('backend.mobil.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted small text-uppercase">Informasi Model</label>
                                <input type="text" name="nama_mobil" value="{{ old('nama_mobil') }}"
                                    class="form-control form-control-lg border-0 bg-light"
                                    placeholder="Contoh: Suzuki Jimny 5-Door" style="border-radius: 12px; font-size: 16px;">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small text-uppercase">Kategori Tipe</label>
                                <select name="tipe_id" class="form-select form-select-lg border-0 bg-light"
                                    style="border-radius: 12px;">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($tipe as $t)
                                        <option value="{{ $t->id }}"
                                            {{ old('tipe_id') == $t->id ? 'selected' : '' }}>{{ $t->nama_tipe }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small text-uppercase">Harga Jual (Rp)</label>
                                <input type="number" name="harga" value="{{ old('harga') }}"
                                    class="form-control form-control-lg border-0 bg-light" placeholder="Contoh: 450000000"
                                    style="border-radius: 12px;">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted small text-uppercase">Tahun</label>
                                <input type="number" name="tahun" value="{{ old('tahun') }}"
                                    class="form-control border-0 bg-light py-2" style="border-radius: 10px;">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted small text-uppercase">Warna</label>
                                <input type="text" name="warna" value="{{ old('warna') }}"
                                    class="form-control border-0 bg-light py-2" style="border-radius: 10px;">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted small text-uppercase">Kapasitas (Kursi)</label>
                                <input type="number" name="kapasitas" value="{{ old('kapasitas') }}"
                                    class="form-control border-0 bg-light py-2" style="border-radius: 10px;"
                                    placeholder="Cth: 7">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted small text-uppercase">Stok Unit</label>
                                <input type="number" name="stok" value="{{ old('stok') }}"
                                    class="form-control border-0 bg-light py-2" style="border-radius: 10px;">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted small text-uppercase">Upload Foto Unit</label>
                                <div class="border-2 border-dashed rounded-4 p-4 text-center bg-light"
                                    style="border: 2px dashed #cbd5e0 !important;">
                                    <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                                    <input type="file" name="gambar_mobil"
                                        class="form-control mt-2 shadow-none border-0 bg-transparent">
                                    <p class="text-muted small mt-2">Pastikan gambar berkualitas tinggi (JPG/PNG)</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-2">
                            <button type="submit" class="btn px-5 py-2 border-0 shadow-sm"
                                style="background: #001437; color: white; border-radius: 12px; font-weight: 600;">
                                Simpan ke Katalog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; background: #f8f9fa;">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-lightbulb text-warning fs-1"></i>
                    <h5 class="fw-bold mt-3">Tips Katalog</h5>
                    <p class="text-muted small">Gunakan foto mobil Suzuki dengan latar belakang bersih agar pelanggan lebih
                        tertarik melihat detail unit.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
