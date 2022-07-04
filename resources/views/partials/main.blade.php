<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta-injection')
    <title>{{ $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    @yield('style-injection')
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/basketball-icon.png') }}" />
    {{-- <!-- inject:js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- endinject --> --}}
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{ route('root') }}">
                        {{-- <img src="images/logo.svg" alt="logo" /> --}}
                        <h3><strong>Si<span class="text-primary">Basket</span></strong></h3>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route('root') }}">
                        <img src="{{ asset('images/basketball-icon.png') }}" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    @if (Route::is('dashboard'))
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                      <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ $user->first_name }}</span></h1>
                    </li>
                    @else
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                      <h1 class="welcome-text"><span class="text-black fw-bold">{{ $navbar_title }}</span></h1>
                    </li>
                    @endif
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ $user->photo_path }}" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ $user->photo_path }}" alt="Profile image" style="max-width: 60px; object-fit: cover;">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ $user->full_name }}</p>
                                <p class="fw-light text-muted mb-0">{{ $user->email }}</p>
                                <p class="fw-light text-muted mb-0">(<em>{{ $user->role->name }}</em>)</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit"><i
                                        class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar</button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Menu Utama</li>
                    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('profile.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('profile.index') }}">
                            <i class="mdi mdi-account-circle-outline menu-icon"></i>
                            <span class="menu-title">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Menu Wasit</li>
                    <li class="nav-item {{ Route::is('referee.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('referee.index') }}">
                            <i class="mdi mdi-pencil-box-outline menu-icon"></i>
                            <span class="menu-title">Edit Data Wasit</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('referee.event.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('referee.event.index') }}">
                            <i class="mdi mdi-pencil-box-outline menu-icon"></i>
                            <span class="menu-title">Data Event Wasit</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('referee.licence.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('referee.licence.index') }}">
                            <i class="mdi mdi-pencil-box-outline menu-icon"></i>
                            <span class="menu-title">Data Lisensi Wasit</span>
                        </a>
                    </li>
            </nav>
            <!-- main-panel -->
            @yield('main-panel')
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js' integrity='sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==' crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- endinject -->
    @yield('custom-injection')
</body>

</html>
