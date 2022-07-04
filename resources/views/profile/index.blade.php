@extends('partials.main')

@section('meta-injection')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('style-injection')
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- End plugin css for this page -->
@endsection

@section('main-panel')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="overview"> 
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Unggah Foto Profil</h4>
                    <p class="card-description">
                      Unggah foto profil Anda.
                    </p>
                    <img src="{{ $user->photo_path }}" class="rounded img-thumbnail img-fluid border-0" alt="{{ $user->full_name }}" style="max-width: 200px;">
                    <form class="forms-sample" data-action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="form-photo">
                      @csrf
                      <div class="form-group">
                        <label>Unggah Foto</label>
                        <input type="file" name="photo" id="photo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control form-control-lg file-upload-info" id="photo-input" disabled placeholder="Unggah Foto">
                          <span class="input-group-append">
                            <button class="file-upload-browse form-control-lg btn btn-primary text-white" type="button">Pilih File</button>
                          </span>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg text-white me-2 px-4">Unggah</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="overview"> 
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Formulir Data Diri</h4>
                    <p class="card-description">
                      Data diri akan digunakan pada saat mendaftar sebagai wasit atau pelatih pada sistem.
                      {{-- Data diri ini didapatkan secara otomatis oleh sistem, jika ingin mengubah data diri mohon mengubah di halaman Profil. --}}
                    </p>
                    <form class="forms-sample" data-action="{{ route('profile.update') }}" method="PUT" enctype="multipart/form-data" id="form-profile">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label for="first_name">Nama Depan</label>
                              <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="Nama Depan" value="{{ $user->first_name }}" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label for="last_name">Nama Belakang</label>
                              <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Nama Belakang" value="{{ $user->last_name }}" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-lg" id="full_name" name="full_name"  placeholder="Nama Lengkap" value="{{ $user->full_name }}" />
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"  placeholder="Email" value="{{ $user->email }}" />
                      </div>
                      <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="gender" value="L"
                            @if ($user->gender == 'L')
                              checked
                            @endif>
                            Laki-laki
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" id="gender" value="P"
                            @if ($user->gender == 'P')
                              checked
                            @endif>
                            Perempuan
                          </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label for="place_of_birth">Tempat Lahir</label>
                              <input type="text" class="form-control form-control-lg" id="place_of_birth" name="place_of_birth" placeholder="Tempat Lahir" value="{{ $user->place_of_birth }}" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row date" id="date-picker">
                            <div class="col-sm-12">
                              <label for="date_of_birth">Tanggal Lahir</label>
                              <div class="input-group">
                                <input type="text" class="form-control form-control-lg" id="date_of_birth" name="date_of_birth" placeholder="dd/mm/yyyy" value="@if($user->date_of_birth != null) {{ format_date($user->date_of_birth, "d/m/Y") }} @endif" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                <div class="input-group-append">
                                  <span class="input-group-text form-control-lg text-dark px-4"><i class="mdi mdi-calendar-today"></i></span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" class="form-control form-control-lg" id="phone" name="phone" placeholder="Nomor Telepon"  value="{{ $user->phone }}" />
                      </div>
                      <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Alamat"  value="{{ $user->address }}" />
                      </div>
                      <div class="form-group">
                        <label>Kabupaten/Kota</label>
                        <select class="js-example-basic-single w-100" id="select-city">
                          <div class="form-group">
                            <option value="0" disabled @if(empty($user->city_id)) {!! 'selected' !!} @else {!! '' !!} @endif>Pilih Kabupaten/Kota</option>
                            @foreach ($cities as $city)
                              @if (!empty($user->city_id) && $user->city_id == $city->id)
                              <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                              @else
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endif
                            @endforeach
                          </div>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="other_profession">Pekerjaan Lainnya <span class="text-danger" ><em>(*Jika ada)</em></span></label>
                        <input type="text" class="form-control form-control-lg" id="other_profession" name="other_profession" placeholder="Pekerjaan Lainnya" value="{{ $user->other_profession }}" />
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg text-white me-2 px-4">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
    </div>
  </footer>
  <!-- partial -->
</div>
<!-- main-panel ends -->
@endsection

@section('custom-injection')
  <!-- Plugin js for this page -->
  <script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('js/file-upload.js') }}"></script>
  <script src="{{ asset('js/typeahead.js') }}"></script>
  <script src="{{ asset('js/select2.js') }}"></script>
  <script src="{{ asset('js/ajax/put-profile.js') }}"></script>
  <script src="{{ asset('js/datepicker.js') }}"></script>
  <!-- End custom js for this page-->
@endsection