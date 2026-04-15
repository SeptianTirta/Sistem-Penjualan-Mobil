@extends('backend.v_layouts.app')
@section('content')

<div class="mb-5 text-center">
    <a href="{{ route('backend.tipe.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block small">
        <i class="bi bi-arrow-left me-1"></i> Batal Perubahan
    </a>
    <h3 class="fw-bold" style="color: #001437; letter-spacing: -0.5px;">{{ $judul }}</h3>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm p-3" style="border-radius: 20px;">
            <div class="card-body">
                <form action="{{ route('backend.tipe.update', $tipe->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">Nama Tipe / Kategori</label>
                        <input type="text" name="nama_tipe" class="form-control form-control-lg border-0 bg-light @error('nama_tipe') is-invalid @enderror" 
                               value="{{ old('nama_tipe', $tipe->nama_tipe) }}" style="border-radius: 12px; font-size: 16px;">
                        @error('nama_tipe') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control border-0 bg-light" rows="5" 
                                  style="border-radius: 12px;">{{ old('deskripsi', $tipe->deskripsi) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn w-100 py-3 border-0 shadow-sm" 
                                style="background: #FFC107; color: #001437; border-radius: 12px; font-weight: 700; letter-spacing: 0.5px;">
                            Perbarui Data Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection