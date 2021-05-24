@extends('layouts.master')

@section('css')
<style>

</style>
@endsection
@section('content')

    <div id="app">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i id="running" class="fas fa-cog "></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Running</span>
                                <span class="info-box-number">
                                10
                                <!-- <small>%</small> -->
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i id="standby" class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Standby</span>
                                <span class="info-box-number">
                                10
                                <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Idle</span>
                                <span class="info-box-number">
                                10
                                <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i id="cleaning" class="fas fa-pump-medical"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cleaning</span>
                                <span class="info-box-number">
                                10
                                <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 style="margin:0 auto">All Devices</h3>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <th>S.N</th>
                                <th>Device Name</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Duration</th>
                                <th>Conductivity</th>
                                <th>Cycles</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr class="table-success">
                                    <td>1</td>
                                    <td>DiUse</td>
                                    <td>View Map</td>
                                    <td>Running</td>
                                    <td>00:01:15</td>
                                    <td>Within 5%</td>
                                    <td>120/500</td>
                                    <td>
                                        <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                            <a href="#" class="dropdown-item">
                                                <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i> View Users</a>
                                            <a href="#" class="dropdown-item"><i class="fas fa-database"></i> View Data</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-gamepad"></i> Control Device</a>
                                        </div>
                                        <!-- </div> -->
                                    </td>
                                </tr>
                                <tr class="table-warning">
                                    <td>2</td>
                                    <td>DiUse</td>
                                    <td>View Map</td>
                                    <td>Idle</td>
                                    <td>00:01:15</td>
                                    <td>Within 5%</td>
                                    <td>200/500</td>
                                    <td>
                                        <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                            <a href="#" class="dropdown-item">
                                                <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i> View Users</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-gamepad"></i> Control Device</a>
                                        </div>
                                        <!-- </div> -->
                                    </td>
                                </tr>
                                <tr class="table-info">
                                    <td>3</td>
                                    <td>DiUse</td>
                                    <td>View Map</td>
                                    <td>Cleaning</td>
                                    <td>00:01:15</td>
                                    <td>Within 5%</td>
                                    <td>50/500</td>
                                    <td>
                                        <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                            <a href="#" class="dropdown-item">
                                                <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i> View Users</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-gamepad"></i> Control Device</a>
                                        </div>
                                        <!-- </div> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="module" src="{{asset('js/home.js')}}"></script>

<script>

    $(document).ready(function () {
        // rotation
        var angle=0;
        setInterval(function(){
            angle += 3;
            $("#running").css('transform','rotate('+angle+'deg)');
        }, 50);

        //blink
        (function blink(){

            $("#standby").fadeOut(500).fadeIn(500, blink);
        })();

        //shake

    });
</script>

@endsection



