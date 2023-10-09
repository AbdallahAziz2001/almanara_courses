@extends('dashboard.parent')

@section('title', 'Edit Course')
@section('icon', '')
@section('page-large-name', 'Edit Course')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('courses.index') }}">Courses</a></li>
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
                            <h3 class="card-title">Edit Course</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" class="form-control" name="course" value="{{ $course->course }}"
                                        id="course" placeholder="Enter Course" required>
                                </div>

                                <div class="form-group">
                                    <label>Select Lecturer</label>
                                    <select class="form-control" id="lecturers_id">
                                        @foreach ($lecturers as $lecturer)
                                            <option value="{{ $lecturer->id }}"
                                                @if ($course->lecturers_id == $lecturer->id) selected @endif>
                                                {{ $lecturer->first_name . ' ' . $lecturer->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate('{{ $course->id }}')"
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
            formData.append('course', document.getElementById('course').value);
            formData.append('lecturers_id', document.getElementById('lecturers_id').value);
            updateWithFormData('/dashboard/courses/' + id, formData, '/dashboard/courses');
        }
    </script>
@endsection
