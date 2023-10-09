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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <label for="hh">
                                    <img id="picturePreview" class="img-circle img-bordered-sm" height="100"
                                        width="100"
                                        src="{{ Storage::url('students/' . $informations->student->account_picture) }}"
                                        alt="Account Picture">
                                </label>
                            </div>

                            <h3 class="profile-username text-center">
                                {{ $informations->student->first_name . ' ' . $informations->student->last_name }}</h3>

                        </div>
                        <!-- /.card-body -->
                    </div>

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
                                    <form class="form-horizontal">

                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="first_name"
                                                    placeholder="Enter First Name"
                                                    value="{{ $informations->student->first_name }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="last_name"
                                                    placeholder="Enter Last Name"
                                                    value="{{ $informations->student->last_name }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Enter Email" value="{{ $informations->student->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nid" class="col-sm-2 col-form-label">Nid</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nid"
                                                    placeholder="Enter Nid" value="{{ $informations->nid }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="address"
                                                    placeholder="Enter Address" value="{{ $informations->address }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="mobile"
                                                    placeholder="Enter Mobile" value="{{ $informations->mobile }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-10">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="gender_male" name="gender"
                                                            @if (!is_null($informations->gender)) value="Male" @endif
                                                            @if ($informations->gender == 'Male') checked @endif>
                                                        <label for="gender_male">
                                                            Male
                                                        </label>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="gender_female" name="gender"
                                                            @if (!is_null($informations->gender)) value="Female" @endif
                                                            @if ($informations->gender == 'Female') checked @endif>
                                                        <label for="gender_female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="birthday" class="col-sm-2 col-form-label">Birthday</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="birthday"
                                                    @if (!is_null($informations->birthday)) value="{{ $informations->birthday }}" @endif
                                                    id="birthday" placeholder="Enter Birthday" min="0.0"
                                                    max="999999.99" step="0.01">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="study_level" class="col-sm-2 col-form-label">Study Level</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="study_level"
                                                    placeholder="Enter Study Level"
                                                    value="{{ $informations->study_level }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="account_picture" class="col-sm-2 col-form-label">Account
                                                Picture</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <label class="custom-file-label"
                                                        for="account_picture">{{ $informations->student->account_picture }}</label>
                                                    <input type="file" class="custom-file-input"
                                                        name="account_picture"
                                                        value="{{ $informations->student->account_picture }}"
                                                        id="account_picture" onchange="previewImage();">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="button" onclick="performUpdate()"
                                                class="btn btn-primary">Submit</button>
                                        </div>

                                    </form>
                                    <!-- /.card -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
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
    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

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

        function performUpdate() {
            let formData = new FormData();
            formData.append('_method', 'put');
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('nid', document.getElementById('nid').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('mobile', document.getElementById('mobile').value);
            var radioValues = document.forms[0].elements['gender'];
            for (var i = 0; i < radioValues.length; i++) {
                if (radioValues[i].checked) {
                    formData.append('gender', radioValues[i].value);
                    console.log(radioValues.value);
                    break;
                }
            }
            formData.append('birthday', document.getElementById('birthday').value);
            formData.append('study_level', document.getElementById('study_level').value);
            if (document.getElementById('account_picture').files[0] != undefined) {
                formData.append('account_picture', document.getElementById('account_picture').files[0]);
            }
            updateWithFormData('/dashboard/students/dashboard/informations', formData,
                '/dashboard/students/dashboard/informations');
        }
    </script>
@endsection
