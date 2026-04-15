@extends('frontend.v_layouts.app')
@section('content')

<style>
    body { background-color: #f4f7f6; }
    .auth-card { 
        border-radius: 20px; 
        border: none; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.05); 
        overflow: hidden; 
    }
    .auth-cover { 
        background: linear-gradient(rgba(0, 20, 55, 0.7), rgba(0, 20, 55, 0.9)), url('https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=2070&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .form-control { border-radius: 12px; padding: 12px 15px; background-color: #f8f9fa; border: 1px solid #e9ecef; }
    .form-control:focus { box-shadow: none; border-color: #EA5555; }
    .btn-auth { background-color: #001437; color: white; border-radius: 12px; padding: 14px; font-weight: 700; transition: 0.3s; }
    .btn-auth:hover { background-color: #EA5555; transform: translateY(-2px); color: white; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card auth-card">
                <div class="row g-0">
                    
                    <div class="col-md-5 auth-cover d-none d-md-flex">
                        <h2 class="fw-bold mb-3">Bergabung Bersama Suzuki Ratan</h2>
                        <p class="opacity-75">Buat akun sekarang untuk mendapatkan akses penuh ke katalog eksklusif, simulasi kredit, dan kemudahan booking armada secara online.</p>
                        <ul class="list-unstyled mt-4 opacity-75">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Transaksi Aman</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Update Harga OTR</li>
                            <li><i class="bi bi-check-circle-fill text-danger me-2"></i> Layanan Prioritas</li>
                        </ul>
                    </div>

                    <div class="col-md-7 p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold" style="color: #001437;">Pendaftaran Akun Baru</h4>
                            <p class="text-muted small">Lengkapi data diri Anda di bawah ini</p>
                        </div>

                        <div class="mb-4 text-end">
                            <a href="{{ route('beranda') }}" class="text-decoration-none text-muted small fw-bold">
                                <i class="bi bi-house-door-fill me-1"></i> Beranda
                            </a>
                        </div>

                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="fw-bold small text-muted text-uppercase mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required>
                                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-2">Email Aktif</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="budi@email.com" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold small text-muted text-uppercase mb-2">No. WhatsApp</label>
                                    <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="0812xxxx" required>
                                    @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="fw-bold small text-muted text-uppercase mb-2">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold small text-muted text-uppercase mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn w-100 btn-auth shadow-sm mb-3">
                                Buat Akun Saya
                            </button>
                            
                            <div class="text-center">
                                <span class="text-muted small">Sudah punya akun? </span>
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #EA5555;">Masuk di sini</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection