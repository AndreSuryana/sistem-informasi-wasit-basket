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
                                            <h4 class="card-title">Daftar Event Wasit</h4>
                                            <p class="card-description">
                                                Menampilkan daftar event wasit
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Level</th>
                                                            <th>Lokasi</th>
                                                            <th>Posisi</th>
                                                            <th>Tanggal</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($events as $event)
                                                            <tr>
                                                                <td>{{ $event->name }}</td>
                                                                <td>{{ $event->level->name }}</td>
                                                                <td>{{ $event->city->name }}</td>
                                                                <td>{{ $event->position }}</td>
                                                                <td>{{ format_date($event->start_date, "d/m/Y") }}</td>
                                                                <td>
                                                                    @if ($event->verified_status)
                                                                        <label class="badge badge-warning">Pending</label>
                                                                    @else
                                                                        <label class="badge badge-success">Verified</label>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($event->document_path)
                                                                    <a class="btn btn-primary" target="_blank" href="{{ $event->document_path }}"><i class="mdi mdi-download text-white"></i></a>
                                                                    @else
                                                                    <a class="btn btn-primary disabled"><i class="mdi mdi-download text-white"></i></a>
                                                                    @endif
                                                                    <a class="btn btn-success" href="{{ route('referee.event.update', [$event->id]) }}"><i class="mdi mdi-lead-pencil text-white"></i></a>
                                                                    <form class="" action="{{ route('referee.event.delete', [$event->id]) }}" method="POST">
                                                                      @csrf
                                                                      <button class="btn btn-danger" type="submit" href="{{ route('referee.event.delete', [$event->id]) }}"><i class="mdi mdi-delete-forever text-white"></i></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
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
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                    BootstrapDash.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights
                    reserved.</span>
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
    <script src="{{ asset('js/ajax/post-referee.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <!-- End custom js for this page-->
@endsection
