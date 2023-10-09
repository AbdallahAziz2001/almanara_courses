<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>AlManara Courses</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form>
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <div class="icheck-primary">
                                <label>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="button" onclick="loginAsAdmin()" class="btn btn-primary btn-block">Sign In as
                                Admin</button>
                        </div>
                        <div class="col-4">
                            <button type="button" onclick="loginAsStudent()" class="btn btn-primary btn-block">Sign In
                                as Student</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>

    <script>
        function loginAsAdmin() {
            axios.post('/dashboard/admin/login', {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    guard: 'admin'
                }).then(function(response) {
                    console.log(response);
                    window.location.href = '/dashboard/home';
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message)
                });
        }

        function loginAsStudent() {
            axios.post('/dashboard/student/login', {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    guard: 'student'
                }).then(function(response) {
                    console.log(response);
                    window.location.href = 'students/dashboard/home';
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message)
                });
        }
    </script>
</body>

</html>
