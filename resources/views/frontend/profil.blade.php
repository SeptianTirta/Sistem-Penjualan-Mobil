@extends('frontend.v_layouts.app')
@section('content')
    <style>
        body {
            background-color: #f4f6f9;
        }

        .member-sidebar {
            background: white;
            border-radius: 20px;
            padding: 20px 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        }

        .member-sidebar .nav-link {
            color: #6c757d;
            padding: 12px 25px;
            font-weight: 600;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }

        .member-sidebar .nav-link:hover,
        .member-sidebar .nav-link.active {
            color: #001437;
            background-color: #f8f9fa;
            border-left: 4px solid #EA5555;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: none;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #001437;
        }

        .btn-save {
            background-color: #001437;
            color: white;
            border-radius: 12px;
            font-weight: bold;
            padding: 12px 30px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #0a2b6d;
            transform: translateY(-2px);
        }
    </style>

    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3 mb-4">
                <div class="member-sidebar">
                    <div class="text-center mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=001437&color=fff"
                            class="avatar-img mb-3">
                        <h5 class="fw-bold mb-0 text-dark">{{ auth()->user()->nama }}</h5>
                        <small class="text-muted">Member Suzuki Ratan</small>
                    </div>

                    <div class="nav flex-column nav-pills">
                        <a class="nav-link active" href="#"><i class="bi bi-person me-2"></i> Profil Saya</a>
                        <a class="nav-link" href="{{ route('pesanan.saya') }}"><i class="bi bi-bag-check me-2"></i> Pesanan
                            Saya</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="profile-card">
                    <h4 class="fw-bold mb-4" style="color: #001437;">Informasi Akun</h4>

                    @if (session('success'))
                        <div class="alert alert-success rounded-3"><i
                                class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ auth()->user()->nama }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold mb-1">Nomor WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control"
                                    value="{{ auth()->user()->no_hp != '-' ? auth()->user()->no_hp : '' }}"
                                    placeholder="08123456789">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="small fw-bold mb-1">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control text-muted" value="{{ auth()->user()->email }}"
                                    readonly>
                                <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Email terhubung dengan
                                    Google, tidak dapat diubah demi keamanan.</small>
                            </div>
                        </div>

                        <hr class="opacity-25 mb-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block"><i class="bi bi-shield-lock me-1"></i> Kata Sandi</small>
                                <small class="fw-bold">Dikelola oleh Google (SSO)</small>
                            </div>
                            <button type="submit" class="btn btn-save border-0">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
