@extends('dashboard.students_dashboard.parent')

@section('title', 'Student Accomplishments')
@section('icon', '')
@section('page-large-name', 'Student Accomplishments')

@section('page-path')
    <li class="breadcrumb-item active"><a href="{{ route('students_dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Student Accomplishments</li>
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


                            <form class="form-horizontal" onsubmit="event.preventDefault(); editProfile();">
                                <div class="form-group row">
                                    <label for="accomplishments" class="col-sm-2 col-form-label">Accomplishments</label>
                                    <div class="col-sm-10">

                                        <textarea rows="40" id="accomplishments" class="form-control form-control-lg form-control-solid">{{ $studentPersonalInformationAccomplishments }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="submit-button">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('cms-assets/js/editor.js') }}"></script>
    <script src="{{ asset('js/editor.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#accomplishments',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });

        function editProfile() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('content', tinymce.get("accomplishments").getContent())

            updateWithFormData('/dashboard/students/dashboard/accomplishments/', formData,
                '/dashboard/students/dashboard/accomplishments');
        }
    </script>
@endsection
