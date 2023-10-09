@extends('dashboard.parent')

@section('title', 'Home')
@section('icon', '')
@section('page-large-name', 'Dashboard')

@section('page-path')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('styles')

@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <span>
                                <h3>Admins Count: <span style="font-size: 50px">{{ $adminsCount }}</span></h3>
                            </span>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admins.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <span>
                                <h3>Students Count: <span style="font-size: 50px">{{ $studentCount }}</span>
                                </h3>
                            </span>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('students.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <span>
                                <h3>Student Requests Count: <span style="font-size: 50px">{{ $studenrRequestsCount }}</span>
                                </h3>
                            </span>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('adminrequests.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <span>
                                <h3>Lecturers Count: <span style="font-size: 50px">{{ $lecturersCount }}</span></h3>
                            </span>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('lecturers.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <span>
                                <h3>Courses Count: <span style="font-size: 50px">{{ $coursesCount }}</span>
                                </h3>
                            </span>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('courses.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')

@endsection
