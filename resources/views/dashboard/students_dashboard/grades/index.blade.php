@extends('dashboard.students_dashboard.parent')

@section('title', 'Student Grades')
@section('icon', '')
@section('page-large-name', 'Student Grades')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('students_dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Student Grades</li>
@endsection

@section('styles')

@endsection

@section('content')
    @if ($studentHaveAcceptRequest)
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1"
                                                class="table table-bordered table-striped dataTable dtr-inline"
                                                aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0"
                                                            aria-controls="example1" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="Rendering engine: activate to sort column descending">
                                                            Semester
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            Course Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            Lecturer Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            Course Grade
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($grades as $grade)
                                                        <tr>
                                                            <td style="vertical-align: middle;">
                                                                {{ $grade->semester }}</td>
                                                            <td style="vertical-align: middle;">
                                                                {{ $grade->course->course }}</td>
                                                            <td style="vertical-align: middle;">
                                                                {{ $grade->course->lecturer->first_name . ' ' . $grade->course->lecturer->last_name }}
                                                            </td>
                                                            @if ($grade->course_grade >= 60)
                                                                <td style="vertical-align: middle;">
                                                                    <span style="font-size: 15px; vertical-align:middle"
                                                                        class="badge bg-info">{{ $grade->course_grade }}</span>
                                                                </td>
                                                            @else
                                                                <td style="vertical-align: middle;">
                                                                    <span style="font-size: 15px; vertical-align:middle"
                                                                        class="badge bg-danger">{{ $grade->course_grade }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">Semester</th>
                                                        <th rowspan="1" colspan="1">Course Name</th>
                                                        <th rowspan="1" colspan="1">Lecturer Name</th>
                                                        <th rowspan="1" colspan="1">Course Grade</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            @if (count($grades) > 1)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{ $grades->links() }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
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
