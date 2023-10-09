@extends('dashboard.parent')

@section('title', 'Edit lecturer')
@section('icon', '')
@section('page-large-name', 'Edit lecturer')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('lecturers.index') }}">Lecturers</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Lecturer</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ $lecturer->first_name }}" id="first_name" placeholder="Enter First Name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ $lecturer->last_name }}" id="last_name" placeholder="Enter Last Name"
                                        required>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate('{{ $lecturer->id }}')"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $('.roles').select2({
            theme: 'bootstrap4'
        });

        $(function() {
            bsCustomFileInput.init();
        });

        function previewImage() {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("account_picture").files[0]);

            fileReader.onload = function(fileReaderEvent) {
                document.getElementById("picturePreview").src = fileReaderEvent.target.result;
            };
        };

        function performUpdate(id) {
            let formData = new FormData();
            formData.append('_method', 'put');
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);

            updateWithFormData('/dashboard/lecturers/' + id, formData, '/dashboard/lecturers');
        }
    </script>
@endsection
