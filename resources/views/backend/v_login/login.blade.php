<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Sigma Automobil</title>

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
            background: linear-gradient(rgba(0, 20, 55, 0.7), rgba(0, 20, 55, 0.9)),
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
        @media(max-width: 768px) {
            .auth-left {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-left">
            <div class="auth-left-content">
                <h1>Temukan Mobil Impianmu</h1>
                <p>
                    Sistem penjualan mobil modern untuk pengalaman terbaik.
                    Jelajahi berbagai pilihan mobil dengan harga terbaik bersama Sigma Automobil.
                </p>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-card">

                <div class="mb-3">
                    <a href="{{ route('beranda') }}" class="text-muted small text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="text-center mb-4">
                    <img src="{{ asset('img/logo-sigma-automobil.png') }}" alt="Sigma Automobil" height="45"
                        class="mb-3">
                    <h5 class="fw-bold text-dark mb-1">Selamat Datang Kembali</h5>
                    <small class="text-muted">Silakan login ke akun Anda</small>
                </div>

                @if (session('success'))
                    <div class="alert alert-success small">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger small">{{ session('error') }}</div>
                @endif

                <form action="{{ route('backend.login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label fw-bold small m-0" style="color: #001437;">Kata Sandi</label>
                            <a href="#" class="small fw-bold text-danger text-decoration-none"
                                style="font-size: 13px;">Lupa Sandi?</a>
                        </div>

                        <div class="input-group">
                            <input type="password" name="password" id="passwordInput"
                                class="form-control form-control-lg fs-6" placeholder="Masukkan kata sandi..." required
                                style="border-right: none;">

                            <button class="btn btn-outline-secondary bg-white" type="button" id="togglePassword"
                                style="border-color: #dee2e6; border-left: none;">
                                <i class="bi bi-eye-slash text-muted" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button class="btn btn-login w-100 text-white shadow-sm mt-2">
                        Masuk
                    </button>
                </form>

                <div class="text-center mt-3 mb-3">
                    <span class="text-muted small fw-bold">ATAU</span>
                </div>

                <a href="{{ url('/auth/google') }}"
                    class="btn w-100 py-2 d-flex align-items-center justify-content-center"
                    style="border: 2px solid #e2e8f0; border-radius: 10px; font-weight: 600; color: #001437; transition: 0.3s; text-decoration: none;"
                    onmouseover="this.style.backgroundColor='#f1f4f9'"
                    onmouseout="this.style.backgroundColor='transparent'">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                        alt="Google Logo" style="width: 20px; height: 20px; margin-right: 10px;">
                    Lanjutkan dengan Google
                </a>

                <div class="text-center mt-4">
                    <small>Belum punya akun?</small>
                    <a href="{{ route('register') }}" class="fw-bold text-danger text-decoration-none">Daftar</a>
                </div>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#passwordInput');
            const eyeIcon = document.querySelector('#eyeIcon');

            togglePassword.addEventListener('click', function(e) {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('bi-eye');
                eyeIcon.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>

</html>
