<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Suzuki Ratan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body { 
            background-color: #f4f7f6; /* Abu-abu super terang untuk background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            overflow-x: hidden;
        }
        .navbar-custom { 
            background-color: #ffffff; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
            padding: 15px 30px;
        }
        .content-wrapper {
            padding: 40px;
        }
        /* Kustomisasi Scrollbar Khas Suzuki */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #001437; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #EA5555; }
        
        /* Tambahan sedikit CSS agar panah dropdown tidak merusak layout */
        .dropdown-toggle::after {
            vertical-align: middle;
            margin-left: 10px;
            color: #001437;
        }
    </style>
</head>
<body class="d-flex">

    @include('backend.v_layouts.sidebar')

    <div class="flex-grow-1 d-flex flex-column" style="min-height: 100vh; width: calc(100% - 260px);">
        
        <nav class="navbar navbar-expand-lg navbar-custom w-100 sticky-top">
            <div class="container-fluid px-0">
                <span class="navbar-brand fw-bold" style="color: #001437; font-size: 1.2rem;">
                    Admin Area Panel
                </span>
                
                <div class="dropdown ms-auto">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownProfil" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="me-3 text-end d-none d-md-block">
                            <span class="d-block fw-bold" style="color: #001437; font-size: 15px;">{{ auth()->user()->nama }}</span>
                            <span class="d-block text-muted" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">
                                {{ auth()->user()->role == 1 ? 'Super Admin' : 'Admin' }}
                            </span>
                        </div>
                        <div class="rounded-circle d-flex justify-content-center align-items-center shadow-sm" 
                             style="width: 45px; height: 45px; background: #001437; color: white; font-weight: bold; border: 2px solid #EA5555;">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 rounded-3" aria-labelledby="dropdownProfil" style="min-width: 250px;">
                        <li>
                            <div class="dropdown-item-text text-center py-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center mx-auto mb-2" 
                                     style="width: 60px; height: 60px; background: #f4f7f6; color: #001437; font-weight: bold; font-size: 20px;">
                                    {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                                </div>
                                <h6 class="fw-bold mb-0 text-dark">{{ auth()->user()->nama }}</h6>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider opacity-25"></li>
                        
                        <li>
                            <a class="dropdown-item py-2 text-danger fw-bold d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-bottom" href="{{ route('backend.logout') }}">
                                <i class="bi bi-box-arrow-right me-2 fs-5"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
        </nav>

        <div class="content-wrapper flex-grow-1">
            @yield('content')
        </div>

        <footer class="text-center py-4 mt-auto" style="color: #a0a5b1; font-size: 13px; border-top: 1px solid #e9ecef;">
            &copy; {{ date('Y') }} Dealer Resmi Suzuki Ratan. Hak cipta dilindungi.
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>