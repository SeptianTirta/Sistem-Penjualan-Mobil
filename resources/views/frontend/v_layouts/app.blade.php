<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suzuki Ratan | Dealer Resmi Mobil Suzuki</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        html {
            scroll-behavior: smooth;
        }

        /* NAVBAR KUSTOMISASI */
        .nav-link {
            color: #001437 !important;
            font-weight: 600;
            margin: 0 10px;
            transition: 0.3s;
            position: relative;
        }

        /* Efek garis bawah merah saat hover */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #EA5555;
            transition: width 0.3s ease;
            -webkit-transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active-link::after {
            width: 100%;
            left: 0;
            background: #EA5555;
        }

        .nav-link:hover,
        .nav-link.active-link {
            color: #EA5555 !important;
        }

        /* BUTTONS */
        .btn-outline-custom {
            color: #001437;
            border: 2px solid #001437;
            font-weight: 700;
            border-radius: 8px;
            padding: 8px 24px;
            transition: 0.3s;
        }

        .btn-outline-custom:hover {
            background-color: #001437;
            color: white;
        }

        .btn-solid-custom {
            background-color: #EA5555;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 10px 24px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 10px rgba(234, 85, 85, 0.2);
        }

        .btn-solid-custom:hover {
            background-color: #d14040;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(234, 85, 85, 0.4);
        }
    </style>
</head>

<body>

    <div class="py-2 d-none d-lg-block" style="background-color: #001437; font-size: 12px;">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="text-white-50 fw-medium">
                <i class="bi bi-geo-alt-fill text-danger me-1"></i> Jl.Cengkareng, Jakarta Barat
                <span class="mx-3 opacity-25">|</span>
                <i class="bi bi-clock-fill text-danger me-1"></i> Buka: Sen - Sab (08:00 - 17:00)
            </div>
            <div class="text-white-50 fw-medium d-flex align-items-center">
                <span class="me-4"><i class="bi bi-envelope-fill text-danger me-1"></i> cs@suzukiratan.com</span>
                <a href="#" class="text-white text-decoration-none fw-bold"><i
                        class="bi bi-whatsapp text-success me-1"></i> +62 858-9049-1005</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-2">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="{{ route('beranda') }}">
                <div class="me-2" style="color: #EA5555; font-size: 32px; line-height: 1;">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <span class="fw-bold"
                        style="color: #001437; font-size: 1.1rem; letter-spacing: 0.5px; line-height: 1.2;">SUZUKI</span>
                    <span class="fw-bold" style="color: #EA5555; font-size: 0.75rem; letter-spacing: 1px;">DEALER
                        RATAN</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1" style="color: #001437;"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active-link' : '' }}"
                            href="{{ route('beranda') }}">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#katalog">Katalog Mobil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#promo">Promo Spesial</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#tentang-kami">Tentang Kami</a>
                    </li>
                </ul>

                <div class="d-flex flex-column flex-lg-row align-items-lg-center mt-3 mt-lg-0 gap-2">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-solid-custom dropdown-toggle px-4 rounded-pill w-100" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="background: #001437; border: 2px solid #EA5555;">
                                <i class="bi bi-person-check-fill me-2 text-danger"></i>
                                Hai, {{ strtok(auth()->user()->nama, ' ') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2"
                                style="border-radius: 12px; min-width: 200px;">
                                @if (auth()->user()->role == 0 || auth()->user()->role == 1)
                                    <li>
                                        <a class="dropdown-item fw-bold" href="{{ route('backend.beranda') }}">
                                            <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif

                                <li>
                                    <a class="dropdown-item fw-bold text-secondary py-2" href="{{ route('pesanan.saya') }}">
                                        <i class="bi bi-bag-check-fill me-2 text-warning"></i> Pesanan Saya
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger fw-bold py-2" href="{{ route('backend.logout') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-custom text-center">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-solid-custom text-center">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
