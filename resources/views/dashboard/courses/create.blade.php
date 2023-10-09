@extends('dashboard.parent')

@section('title', 'Create Course')
@section('icon', '')
@section('page-large-name', 'Create Course')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('courses.index') }}">Courses</a></li>
    <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Create Course</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" class="form-control" name="course" id="course"
                                        placeholder="Enter Course">
                                </div>
                                <div class="form-group">
                                    <label>Select Lecturer</label>
                                    <select class="form-control" id="lecturers_id">
                                        @foreach ($lecturers as $lecturer)
                                            <option value="{{ $lecturer->id }}">
                                                {{ $lecturer->first_name . ' ' . $lecturer->last_name }}</option>
                                        @endforeach
                                    </select>
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
            formData.append('course', document.getElementById('course').value);
            formData.append('lecturers_id', document.getElementById('lecturers_id').value);
            store('/dashboard/courses', formData);
        }
    </script>
@endsection
