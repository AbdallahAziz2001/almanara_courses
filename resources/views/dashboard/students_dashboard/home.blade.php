@extends('dashboard.students_dashboard.parent')

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
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('scripts')

@endsection
