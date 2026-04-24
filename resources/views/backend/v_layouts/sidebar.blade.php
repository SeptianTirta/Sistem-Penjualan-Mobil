<div class="sidebar d-flex flex-column shadow-sm bg-white"
    style="width: 260px; min-height: 100vh; transition: 0.3s; z-index: 1000; border-right: 1px solid #e9ecef;">

    {{-- BUNGKUSAN ATAS --}}
    <div class="flex-grow-1 w-100">

        {{-- AREA LOGO BRAND (BACKGROUND PUTIH AGAR LOGO JELAS) --}}
        <div class="sidebar-brand d-flex align-items-center justify-content-center py-4 mb-2 border-bottom">
            <img src="{{ asset('img/logo-sigma-automobil.png') }}" alt="Sigma Automobil"
                style="max-width: 75%; height: auto;">
        </div>

        {{-- MENU NAVIGASI --}}
        <ul class="nav flex-column mt-4 px-3">

            <li class="nav-item mb-2">
                <a href="{{ route('backend.beranda') }}"
                    class="nav-link {{ request()->is('backend/beranda') ? 'active-link' : 'text-dark' }}">
                    <i class="bi bi-speedometer2 me-3 fs-5"></i> Dashboard
                </a>
            </li>

            <hr class="my-3 opacity-25 mx-3" style="border-color: #001437;">
            <small class="fw-bold px-3 mb-2" style="color: #a0a5b1; font-size: 11px; letter-spacing: 1.5px;">KATALOG
                ARMADA</small>

            <li class="nav-item mb-1 mt-1">
                <a href="{{ route('backend.tipe.index') }}"
                    class="nav-link {{ request()->is('backend/tipe*') ? 'active-link' : 'text-dark' }}">
                    <i class="bi bi-tags-fill me-3 fs-5"></i> Data Tipe
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('backend.mobil.index') }}"
                    class="nav-link {{ request()->is('backend/mobil*') ? 'active-link' : 'text-dark' }}">
                    <i class="bi bi-car-front-fill me-3 fs-5"></i> Data Mobil
                </a>
            </li>

            <hr class="my-3 opacity-25 mx-3" style="border-color: #001437;">
            <small class="fw-bold px-3 mb-2"
                style="color: #a0a5b1; font-size: 11px; letter-spacing: 1.5px;">TRANSAKSI</small>

            <li class="nav-item mb-2 mt-1">
                <a href="{{ route('backend.pesanan.index') }}"
                    class="nav-link {{ request()->is('backend/pesanan*') ? 'active-link' : 'text-dark' }}">
                    <i class="bi bi-cart-check-fill me-3 fs-5"></i> Data Pesanan
                </a>
            </li>

            @if (auth()->user()->role == 1)
                <hr class="my-3 opacity-25 mx-3" style="border-color: #001437;">
                <small class="fw-bold px-3 mb-2"
                    style="color: #a0a5b1; font-size: 11px; letter-spacing: 1.5px;">PENGATURAN</small>

                <li class="nav-item mb-2 mt-1">
                    <a href="{{ route('backend.user.index') }}"
                        class="nav-link {{ request()->is('backend/user*') ? 'active-link' : 'text-dark' }}">
                        <i class="bi bi-people-fill me-3 fs-5"></i> Data User
                    </a>
                </li>
            @endif

        </ul>
    </div> {{-- Akhir dari Bungkusan Atas --}}

    {{-- BUNGKUSAN BAWAH: Trademark --}}
    <div class="px-4 py-3 mt-auto w-100 text-center bg-light border-top">
        <small class="text-muted" style="font-size: 11px; letter-spacing: 0.5px;">
            &copy; {{ date('Y') }} <strong>Sigma Automobil</strong>.<br>
            <span style="font-size: 10px;">Web Programming 3</span>
        </small>
    </div>
</div>

{{-- CSS KHUSUS SIDEBAR (LIGHT THEME + RED ACTIVE) --}}
<style>
    .nav-link {
        color: #495057;
        /* Abu-abu gelap untuk menu biasa */
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14.5px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .nav-link:hover {
        color: #EA5555 !important;
        /* Merah saat di-hover */
        background-color: rgba(234, 85, 85, 0.05);
        /* Latar merah sangat muda saat di-hover */
        transform: translateX(4px);
    }

    .active-link {
        color: #ffffff !important;
        background-color: #EA5555;
        /* Merah solid elegan saat sedang diklik */
        box-shadow: 0 4px 12px rgba(234, 85, 85, 0.25);
        font-weight: 600;
        border-radius: 8px;
    }

    .active-link i {
        color: #ffffff !important;
    }
</style>
