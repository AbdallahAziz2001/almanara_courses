@extends('dashboard.parent')

@section('title', 'Courses')
@section('icon', '')
@section('page-large-name', 'Courses')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Courses</li>
@endsection

@section('styles')

@endsection

@section('content')
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
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        #
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Course
                                                    </th>
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Lecture Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Created At
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Updated At
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Settings
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($courses as $course)
                                                    <tr>
                                                        <td style="vertical-align: middle;">
                                                            {{ $course->id }}</td>
                                                        <td style="vertical-align: middle;">
                                                            {{ $course->course }}</td>
                                                        <td style="vertical-align: middle;">
                                                            <a
                                                                href="{{ route('lecturers.show', ['lecturer' => $course->lecturer->id]) }}">
                                                                {{ $course->lecturer->first_name . ' ' . $course->lecturer->last_name }}
                                                            </a>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            {{ $course->created_at->format('d/m/Y h:i:s a') }}
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            {{ $course->updated_at->format('d/m/Y h:i:s a') }}
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <div class="btn-group">
                                                                <a href="{{ route('courses.edit', $course->id) }}"
                                                                    class="btn btn-info">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a onclick="performDelete({{ $course->id }}, this)"
                                                                    class="btn btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">#</th>
                                                    <th rowspan="1" colspan="1">Course</th>
                                                    <th rowspan="1" colspan="1">Lecture Name</th>
                                                    <th rowspan="1" colspan="1">Created At</th>
                                                    <th rowspan="1" colspan="1">Updated At</th>
                                                    <th rowspan="1" colspan="1">Settings</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        @if (count($courses) > 1)
                                            <div class="row">
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ $courses->links() }}
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
    </script>

    <script>
        function performDelete(id, reference) {
            confirmDestroy('/dashboard/courses', id, reference)
        }
    </script>
@endsection
