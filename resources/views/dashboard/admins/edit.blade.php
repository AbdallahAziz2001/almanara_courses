@extends('dashboard.parent')

@section('title', 'Edit Admin')
@section('icon', '')
@section('page-large-name', 'Edit Admin')

@extends('dashboard.parent')

@section('title', 'Edit Admin')
@section('icon', '')
@section('page-large-name', 'Edit Admin')

@extends('dashboard.parent')

@section('title', 'Edit Admin')
@section('icon', '')
@section('page-large-name', 'Edit Admin')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admins.index') }}">Admins</a></li>
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
                            <h3 class="card-title">Edit Admin</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name_{{ $admin->id }}">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ $admin->first_name }}" id="first_name_{{ $admin->id }}"
                                        placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name_{{ $admin->id }}">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ $admin->last_name }}" id="last_name_{{ $admin->id }}"
                                        placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="email_{{ $admin->id }}">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $admin->email }}"
                                        id="email_{{ $admin->id }}" placeholder="Enter Email">
                                </div>

                                <div class="form-group">
                                    <label for="hh"><img id="picturePreview" class="img-circle img-bordered-sm"
                                            height="50" width="50"
                                            src="{{ Storage::url('admins/' . $admin->account_picture) }}"
                                            alt="Account Picture"> &nbsp; Account Picture</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label"
                                            for="account_picture_{{ $admin->id }}">{{ $admin->account_picture }}</label>
                                        <input type="file" class="custom-file-input" name="account_picture"
                                            value="{{ $admin->account_picture }}" id="account_picture_{{ $admin->id }}"
                                            onchange="previewImage();" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate('{{ $admin->id }}')"
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
    <script>
        $('.roles').select2({
            theme: 'bootstrap4'
        });

        function performUpdate(id) {
            let formData = new FormData();
            formData.append('_method', 'put');
            formData.append('first_name', document.getElementById('first_name_' + id).value);
            formData.append('last_name', document.getElementById('last_name_' + id).value);
            formData.append('email', document.getElementById('email_' + id).value);
            if (document.getElementById('account_picture_' + id).files[0] != undefined) {
                formData.append('account_picture', document.getElementById('account_picture_' + id).files[0]);
            }
            updateWithFormData('/dashboard/admins/' + id, formData, '/dashboard/admins');
        }
    </script>
@endsection
