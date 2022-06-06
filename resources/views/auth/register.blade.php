<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/basketball-icon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0 register-bg">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto card card-rounded">
            <div class="auth-form-light text-left py-5 px-4 px-sm-4">
              {{-- <div class="brand-logo">
                <img src="{{ asset('images/logo.svg') }}" alt="logo">
              </div> --}}
              <h4><strong>Selamat Datang!</strong></h4>
              <h6 class="fw-light">Daftar terlebih dahulu untuk melanjutkan ke sistem.</h6>
              <form class="pt-3" data-action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" id="form-register">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="Nama Depan" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Nama Belakang" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="full_name" name="full_name"  placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email"  placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" id="btn-register">DAFTAR</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                </div>
                <div class="text-center mt-4 fw-light">
                  Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary">Masuk</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- register background -->
  <style>
    .register-bg {
      background-size: cover;
      background-repeat: no-repeat;
      background-image: url({{ asset('images/auth/idn-team-bg.jpeg') }});
    }
  </style>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <script src="{{ asset('js/ajax/post-register.js') }}"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- endinject -->
</body>

</html>
