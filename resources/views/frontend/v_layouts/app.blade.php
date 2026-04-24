<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigma Automobil | Dealer Resmi Mobil Suzuki</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 76px;
        }

        @media (min-width: 992px) {
            body {
                padding-top: 114px;
            }
        }

        section {
            scroll-margin-top: 120px;
        }

        .navbar {
            padding: 15px 0;
        }

        .nav-link {
            color: #001437 !important;
            font-weight: 700;
            margin: 0 15px;
            transition: 0.3s;
            position: relative;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #EA5555;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active-link::after {
            width: 100%;
            left: 0;
        }

        .nav-link:hover,
        .nav-link.active-link {
            color: #EA5555 !important;
        }

        .search-input-custom {
            border: none;
            border-bottom: 2px solid #001437;
            border-radius: 0;
            background: transparent;
            color: #001437;
        }

        .search-input-custom:focus {
            box-shadow: none;
            border-bottom: 2px solid #EA5555;
        }

        .dropdown-menu {
            border-radius: 15px;
            padding: 10px 0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }

        .dropdown-item {
            padding: 10px 20px;
            font-weight: 600;
            transition: 0.2s;
            color: #495057;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #EA5555;
            padding-left: 25px;
        }
    </style>
</head>

<body>

    <header class="fixed-top bg-white shadow-sm">
        <div class="py-2 d-none d-lg-block" style="background-color: #001437; font-size: 12px;">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="text-white-50 fw-medium">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Jl. Jendral Sudirman, Jakarta Pusat
                    <span class="mx-3 opacity-25">|</span>
                    <i class="bi bi-clock-fill text-danger me-1"></i> Buka: Sen - Sab (08:00 - 17:00)
                </div>
                <div class="text-white-50 fw-medium d-flex align-items-center">
                    <span class="me-4"><i class="bi bi-envelope-fill text-danger me-1"></i>
                        cs@sigmaautomobil.com</span>
                    <a href="#" class="text-white text-decoration-none fw-bold"><i
                            class="bi bi-whatsapp text-success me-1"></i> +62 812-3456-7890</a>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('beranda') }}">
                    <img src="{{ asset('img/Logo-Suzuki.png') }}" alt="Suzuki" height="30">
                    <div style="width: 2px; height: 35px; background-color: #ddd;"></div>
                    <img src="{{ asset('img/logo-sigma-automobil.png') }}" alt="Sigma Automobil" height="40">
                </a>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                    <i class="bi bi-list fs-1" style="color: #001437;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#mainCarousel">Beranda</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#katalog">Katalog Mobil</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#promosi">Promosi</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#berita">Berita</a></li>
                    </ul>

                    <div class="d-flex align-items-center mt-3 mt-lg-0 gap-4">

                        <button class="btn btn-link text-dark p-0 shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#searchBox">
                            <i class="bi bi-search fs-5 fw-bold" style="color: #001437;"></i>
                        </button>

                        @auth
                            <a href="{{ route('pesanan.saya') }}" class="btn btn-link p-0 shadow-none position-relative"
                                title="Pesanan Saya" style="color: #001437;">
                                <i class="bi bi-bag fs-5 fw-bold"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">Pesanan Aktif</span>
                                </span>
                            </a>

                            <div class="dropdown">
                                <a href="#"
                                    class="d-flex align-items-center text-decoration-none dropdown-toggle p-1 rounded-pill bg-white shadow-sm border"
                                    id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="color: #001437;">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=001437&color=fff"
                                        alt="User" width="35" height="35" class="rounded-circle me-2">
                                    <span class="fw-bold pe-3"
                                        style="font-size: 14px;">{{ strtok(auth()->user()->nama, ' ') }}</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2"
                                    aria-labelledby="dropdownUser" style="min-width: 250px;">

                                    <li>
                                        <a class="dropdown-item p-3 rounded-3 d-flex align-items-center"
                                            href="{{ route('profil.index') }}" style="background-color: #f8f9fa;">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=001437&color=fff"
                                                width="45" height="45" class="rounded-circle me-3 shadow-sm">
                                            <div class="overflow-hidden">
                                                <span class="fw-bold d-block text-truncate"
                                                    style="color: #001437; font-size: 15px;">{{ auth()->user()->nama }}</span>
                                                <small class="text-muted d-block mt-1"
                                                    style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Lihat
                                                    Profil Saya <i class="bi bi-chevron-right"></i></small>
                                            </div>
                                        </a>
                                    </li>

                                    @if (auth()->user()->role == 0 || auth()->user()->role == 1)
                                        <li>
                                            <hr class="dropdown-divider opacity-25 my-2">
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 fw-bold" href="{{ route('backend.beranda') }}">
                                                <i class="bi bi-speedometer2 me-2 text-primary"></i> Panel Admin
                                            </a>
                                        </li>
                                    @endif

                                    <li>
                                        <hr class="dropdown-divider opacity-25 my-2">
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-danger fw-bold py-2"
                                            href="{{ route('backend.logout') }}">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-link p-0 shadow-none me-3"
                                title="Pesanan Saya" style="color: #001437;">
                                <i class="bi bi-bag fs-5 fw-bold"></i>
                            </a>

                            <a href="{{ route('login') }}"
                                class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center"
                                style="background-color: #EA5555; border: none;">
                                <i class="bi bi-person-circle fs-5 me-2"></i> Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="collapse position-absolute w-100 bg-white" id="searchBox"
            style="z-index: 999; box-shadow: 0 15px 20px rgba(0,0,0,0.05);">
            <div class="container py-4">
                <form action="{{ route('beranda') }}" method="GET">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center w-100">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control shadow-none px-0 py-2 fs-5 search-input-custom"
                                    placeholder="Cari mobil impian Anda...">
                                <button type="submit" class="btn shadow-none px-3 py-2 fs-4"
                                    style="color: #EA5555;">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash) {
                document.documentElement.style.scrollBehavior = 'auto';
                setTimeout(() => {
                    document.documentElement.style.scrollBehavior = 'smooth';
                }, 50);
            }

            const navLinks = document.querySelectorAll('.nav-link');

            function onScroll() {
                let scrollPosition = window.scrollY + 150;
                navLinks.forEach(link => {
                    let href = link.getAttribute('href');
                    if (href.includes('#')) {
                        let sectionId = href.split('#')[1];
                        let section = document.getElementById(sectionId);
                        if (section && section.offsetTop <= scrollPosition && (section.offsetTop + section
                                .offsetHeight) > scrollPosition) {
                            navLinks.forEach(n => n.classList.remove('active-link'));
                            link.classList.add('active-link');
                        }
                    }
                });
            }
            window.addEventListener('scroll', onScroll);
            onScroll();
        });
    </script>
</body>

</html>
