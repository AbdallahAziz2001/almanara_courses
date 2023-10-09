@extends('dashboard.parent')

@section('title', 'Requests')
@section('icon', '')
@section('page-large-name', 'Requests')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Requests</li>
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
                                                        Student Name
                                                    </th>
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Request
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Expired At
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
                                                @foreach ($requests as $request)
                                                    <tr>
                                                        <td style="vertical-align: middle;">
                                                            {{ $request->id }}</td>
                                                        <td style="vertical-align: middle;">
                                                            {{ $request->student->first_name . ' ' . $request->student->last_name }}
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            @if ($request->request == 'Pending')
                                                                <span style="font-size: 15px; vertical-align:middle"
                                                                    class="badge bg-info">{{ $request->request }}
                                                                </span>
                                                            @elseif ($request->request == 'Accepted')
                                                                <span style="font-size: 15px; vertical-align:middle"
                                                                    class="badge bg-success">{{ $request->request }}
                                                                </span>
                                                            @else
                                                                <span style="font-size: 15px; vertical-align:middle"
                                                                    class="badge bg-danger">{{ $request->request }}
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            @if ($request->expired_at == null)
                                                                Null
                                                            @else
                                                                {{ $request->expired_at }}
                                                            @endif
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            {{ $request->created_at->format('d/m/Y h:i:s a') }}
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            {{ $request->updated_at->format('d/m/Y h:i:s a') }}
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            @if ($request->request == 'Pending')
                                                                <div class="btn-group">
                                                                    <a onclick="performAccepted({{ $request->id }}, this)"
                                                                        class="btn btn-success">
                                                                        <i class="fas fa-check"></i> </a>
                                                                    <a onclick="performCanceled({{ $request->id }}, this)"
                                                                        class="btn btn-danger">
                                                                        <i class="fas fa-times"></i> </a>
                                                                </div>
                                                            @elseif ($request->request == 'Accepted')
                                                                No Setting for Accepted
                                                            @else
                                                                No Setting for Canceled
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">#</th>
                                                    <th rowspan="1" colspan="1">Picture</th>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Email</th>
                                                    <th rowspan="1" colspan="1">Created At</th>
                                                    <th rowspan="1" colspan="1">Updated At</th>
                                                    <th rowspan="1" colspan="1">Settings</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        @if (count($requests) > 1)
                                            <div class="row">
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-6">
                                                    {{ $requests->links() }}
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
        function performAccepted(id) {
            let formData = new FormData();
            formData.append('_method', 'put');
            formData.append('request', 'Accepted');

            updateWithFormData('/dashboard/adminrequests/' + id, formData, '/dashboard/adminrequests');
        }

        function performCanceled(id) {
            let formData = new FormData();
            formData.append('_method', 'put');
            formData.append('request', 'Canceled');

            updateWithFormData('/dashboard/adminrequests/' + id, formData, '/dashboard/adminrequests');
        }
    </script>
@endsection
