<div class="sidebar d-flex flex-column shadow-lg" style="width: 260px; background-color: #001437; min-height: 100vh; transition: 0.3s; z-index: 1000;">
    
    {{-- BUNGKUSAN ATAS: Menahan Logo & Menu agar selalu memakan sisa ruang atas --}}
    <div class="flex-grow-1 w-100">
        {{-- AREA LOGO BRAND --}}
        <div class="sidebar-brand d-flex align-items-center justify-content-center py-4 mb-3" style="background-color: #000c24; border-bottom: 3px solid #EA5555;">
            <i class="bi bi-car-front-fill me-2" style="font-size: 1.8rem; color: #EA5555;"></i>
            <span class="fs-4 fw-bold text-white tracking-wide">Suzuki Ratan</span>
        </div>

        {{-- MENU NAVIGASI --}}
        <ul class="nav flex-column mt-3">
        
            <li class="nav-item mb-2">
                <a href="{{ route('backend.beranda') }}" class="nav-link text-white {{ request()->is('backend/beranda') ? 'active-link' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <hr class="text-white-50 my-3 opacity-25"> 
            <small class="text-white-50 fw-bold px-3 mb-2" style="font-size: 11px; letter-spacing: 1px;">KATALOG ARMADA</small>
            
            <li class="nav-item mb-2 mt-1">
                <a href="{{ route('backend.tipe.index') }}" class="nav-link text-white {{ request()->is('backend/tipe*') ? 'active-link' : '' }}">
                    <i class="bi bi-tags-fill me-2"></i> Data Tipe
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('backend.mobil.index') }}" class="nav-link text-white {{ request()->is('backend/mobil*') ? 'active-link' : '' }}">
                    <i class="bi bi-car-front-fill me-2"></i> Data Mobil
                </a>
            </li>

            <hr class="text-white-50 my-3 opacity-25"> 
            <small class="text-white-50 fw-bold px-3 mb-2" style="font-size: 11px; letter-spacing: 1px;">TRANSAKSI</small>
            
            <li class="nav-item mb-2 mt-1">
                <a href="{{ route('backend.pesanan.index') }}" class="nav-link text-white {{ request()->is('backend/pesanan*') ? 'active-link' : '' }}">
                    <i class="bi bi-cart-check-fill me-2 text-warning"></i> Data Pesanan
                </a>
            </li>

            @if(auth()->user()->role == 1)
                <hr class="text-white-50 my-3 opacity-25"> 
                <small class="text-white-50 fw-bold px-3 mb-2" style="font-size: 11px; letter-spacing: 1px;">PENGATURAN</small>
                
                <li class="nav-item mb-2 mt-1">
                    <a href="{{ route('backend.user.index') }}" class="nav-link text-white {{ request()->is('backend/user*') ? 'active-link' : '' }}">
                        <i class="bi bi-people-fill me-2"></i> Data User
                    </a>
                </li>
            @endif

        </ul>
    </div> {{-- Akhir dari Bungkusan Atas --}}

    {{-- BUNGKUSAN BAWAH: Trademark / Watermark --}}
    <div class="px-4 py-3 mt-auto w-100 text-center" style="border-top: 1px solid rgba(255,255,255,0.05);">
        <small class="text-white-50" style="font-size: 11px; letter-spacing: 1px;">
            &copy; 2026 <strong>Suzuki Ratan</strong>.<br>
            <span style="font-size: 9px;">Web Programing 3</span>
        </small>
    </div>
</div> {{-- Akhir dari div pembungkus utama sidebar --}}

{{-- CSS KHUSUS SIDEBAR --}}
<style>
    .nav-link { 
        opacity: 0.7; 
        transition: all 0.3s ease; 
        border-radius: 8px;
        padding: 12px 20px;
        font-size: 15px;
    }
    .nav-link:hover { 
        opacity: 1; 
        background-color: rgba(255,255,255,0.08); 
        transform: translateX(5px); 
    }
    .active-link { 
        opacity: 1 !important; 
        background: linear-gradient(90deg, #EA5555 0%, rgba(234, 85, 85, 0) 100%); 
        border-left: 4px solid #EA5555; 
        font-weight: 600;
        border-radius: 0 8px 8px 0;
    }
    .sidebar .btn:hover { background-color: #ff6b6b !important; transform: translateY(-2px); }
</style>