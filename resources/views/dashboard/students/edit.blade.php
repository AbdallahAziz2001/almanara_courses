@extends('dashboard.parent')

@section('title', 'Edit Student')
@section('icon', '')
@section('page-large-name', 'Edit Student')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('students.index') }}">Students</a></li>
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
                            <h3 class="card-title">Edit Student</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ $student->first_name }}" id="first_name" placeholder="Enter First Name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ $student->last_name }}" id="last_name" placeholder="Enter Last Name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        @if (!is_null($student->email)) value="{{ $student->email }}" @endif
                                        id="email" placeholder="Enter Email">
                                </div>

                                <div class="form-group">
                                    <label for="hh"><img id="picturePreview" class="img-circle img-bordered-sm"
                                            height="50" width="50"
                                            src="{{ Storage::url('students/' . $student->account_picture) }}"
                                            alt="Account Picture"> &nbsp; Account
                                        Picture</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label"
                                            for="account_picture">{{ $student->account_picture }}</label>
                                        <input type="file" class="custom-file-input" name="account_picture"
                                            value="{{ $student->account_picture }}" id="account_picture"
                                            onchange="previewImage();" required>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate('{{ $student->id }}')"
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
            formData.append('email', document.getElementById('email').value);
            if (document.getElementById('account_picture').files[0] != undefined) {
                formData.append('account_picture', document.getElementById('account_picture').files[0]);
            }
            updateWithFormData('/dashboard/students/' + id, formData, '/dashboard/students');
        }
    </script>
@endsection
