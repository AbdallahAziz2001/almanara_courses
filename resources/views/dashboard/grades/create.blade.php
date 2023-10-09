@extends('dashboard.parent')

@section('title', 'Create Grade')
@section('icon', '')
@section('page-large-name', 'Create Grade')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Create Grade</li>
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
                            <h3 class="card-title">Create Student</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Select Student</label>
                                    <select class="form-control" id="students_id">
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">
                                                {{ $student->first_name . ' ' . $student->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Select Course</label>
                                    <select class="form-control" id="courses_id">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">
                                                {{ $course->course }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Year</label>
                                            <select class="form-control" id="year_id">
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Select Semester</label>
                                            <select class="form-control" id="semester_id">
                                                <option value="1">First Semester</option>
                                                <option value="2">Second Semester</option>
                                                <option value="3">Summer Semester</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_grade">Course Grade</label>
                                    <input type="number" class="form-control" name="course_grade" id="course_grade"
                                        placeholder="Enter Course Grade" min="0" max="100" step="1">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performStore()" class="btn btn-primary">Submit</button>
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

        function performStore() {
            let formData = new FormData();
            formData.append('students_id', document.getElementById('students_id').value);
            formData.append('courses_id', document.getElementById('courses_id').value);
            formData.append('year_id', document.getElementById('year_id').value);
            formData.append('semester_id', document.getElementById('semester_id').value);
            formData.append('course_grade', document.getElementById('course_grade').value);

            store('/dashboard/grades', formData);
        }
    </script>
@endsection
