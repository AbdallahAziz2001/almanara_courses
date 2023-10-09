@extends('dashboard.students_dashboard.parent')

@section('title', 'Student Informations')
@section('icon', '')
@section('page-large-name', 'Student Informations')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('students_dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Student Informations</li>
@endsection

@section('styles')

@endsection

@section('content')
    @if ($studentHaveAcceptRequest)
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ Storage::url('students/' . $informations->student->account_picture) }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ $informations->student->first_name . ' ' . $informations->student->last_name }}</h3>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h6 style="text-align: center;">Nid</h6>
                                <h3 class="profile-username text-center">
                                    {{ $informations->nid }}
                                </h3>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center">
                                    Study Level → {{ $informations->study_level }}</h3>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h6 style="text-align: center;">Created At</h6>
                                <h3 class="profile-username text-center">
                                    {{ $informations->student->created_at->format('d/m/Y h:i:s a') }}
                                </h3>

                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="about">
                                        <!-- About Me Box -->
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">About
                                                    {{ $informations->student->first_name }}
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                                                <p class="text-muted">
                                                    {{ $informations->student->email }}
                                                </p>

                                                <hr>

                                                <strong><i class="fas fa-phone-alt mr-1"></i> Mobile</strong>

                                                <p class="text-muted">
                                                    {{ $informations->mobile }}
                                                </p>

                                                <hr>

                                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                                                <p class="text-muted">{{ $informations->address }}</p>

                                                <hr>

                                                <strong><i class="fas fa-venus-mars"></i> Gender</strong>

                                                <p class="text-muted">{{ $informations->gender }}</p>

                                                <hr>

                                                <strong><i class="fas fa-calendar mr-1"></i> Birthday</strong>

                                                <p class="text-muted">{{ $informations->birthday }}</p>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                @if ($informations->accomplishments)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <strong style="font-size: 20px;">
                                        Accomplishments
                                    </strong>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {!! $informations->accomplishments !!}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                @endif
            </div>
        </section>
    @else
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Your Request
                                </h3>
                            </div>
                            <div class="card-body">
                                @if ($studentHavePendingRequest)
                                    <div class="alert alert-warning alert-dismissible">
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                        Your Request is Under Review
                                    </div>
                                @else
                                    <div class="alert alert-danger alert-dismissible">
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                        You Need to Order a Request to The Admin
                                    </div>
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-block btn-success btn-lg">Order a Request</button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('scripts')

    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "paging": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        function performStore() {
            let formData = new FormData();
            formData.append('request', 'Pending');

            storeRequest('/dashboard/students/dashboard/requests', formData);
        }
    </script>
@endsection
