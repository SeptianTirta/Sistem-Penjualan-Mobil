<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Suzuki Ratan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== LEFT SIDE (IMAGE) ===== */
        .auth-left {
            flex: 1;
            background: linear-gradient(rgba(0,20,55,0.7), rgba(0,20,55,0.9)),
                        url("{{ asset('img/suzuki-walpaper-login.jpg') }}") center/cover no-repeat;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
        }

        .auth-left-content {
            max-width: 500px;
        }

        .auth-left h1 {
            font-weight: 800;
            font-size: 2.5rem;
        }

        .auth-left p {
            opacity: 0.9;
        }

        /* ===== RIGHT SIDE (FORM) ===== */
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }

        .brand-logo {
            font-size: 2.5rem;
            color: #EA5555;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #001437;
        }

        .btn-login {
            background: #EA5555;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #d14040;
            transform: translateY(-2px);
        }

        /* RESPONSIVE */
        @media(max-width: 768px){
            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    <!-- LEFT SIDE -->
    <div class="auth-left">
        <div class="auth-left-content">
            <h1>Temukan Mobil Impianmu</h1>
            <p>
                Sistem penjualan mobil modern untuk pengalaman terbaik.
                Jelajahi berbagai pilihan mobil dengan harga terbaik.
            </p>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="auth-right">
        <div class="auth-card">

            <div class="mb-3">
                <a href="{{ route('beranda') }}" class="text-muted small text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="text-center mb-4">
                <i class="bi bi-car-front-fill brand-logo"></i>
                <h4 class="fw-bold mt-2">SUZUKI RATAN</h4>
                <small class="text-muted">Silakan login ke akun Anda</small>
            </div>

            @if(session('success'))
                <div class="alert alert-success small">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger small">{{ session('error') }}</div>
            @endif

            <form action="{{ route('backend.login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-login w-100 text-white">
                    Masuk
                </button>

                <div class="text-center mt-4">
                    <small>Belum punya akun?</small>
                    <a href="{{ route('register') }}" class="fw-bold text-danger">Daftar</a>
                </div>
            </form>

        </div>
    </div>

</div>

</body>
</html>