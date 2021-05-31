@extends('layouts.master')

@section('css')

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

                            <div class="info-box-content" id="running-devices">
                                <span class="info-box-text">Running</span>
                                <span class="info-box-number">
                                {{$devices->count()}}
                                <small>/</small>
                                {{$devices->count()}}
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
                                0
                                <small>/</small>
                                {{$devices->count()}}
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
                                0
                                <small>/</small>
                                {{$devices->count()}}
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
                                0
                                <small>/</small>
                                {{$devices->count()}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                </div>
                <div class="row" id="table-total-devices">
                    <div class="col-lg-12 col-md-12">
                        <h3>All Devices</h3>
                        <table class="table table-hover table-responsive datatable">
                            <thead class="thead-dark">
                                <th>S.N</th>
                                <th>Model</th>
                                <th>#Users</th>
                                <th>Status</th>
                                <th>Duration</th>
                                <th>EC</th>
                                <th>Pure Flow</th>
                                <th>Waste Flow</th>
                                <th>Pure Voltage</th>
                                <th>Waste Voltage</th>
                                <th>Volume</th>
                                <th>Cycles</th>
                                <th>Module Health</th>
                                <th>Alarm Setpoints</th>
                                <th>Recovery</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <tr class="table-success" id="{{$device->id}}">
                                        <td>{{$device->serial_number}}</td>
                                        <td>{{$device->model != null ? $device->model : 'DiUse'}}</td>
                                        <td>{{$device->associatedUsers->count()}}</td>
                                        <td>Running</td>
                                        <td>00:01:15</td>
                                        <td>Within 5%</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>120/500</td>
                                        <td>Good</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a id="link_view_users" href="#" class="dropdown-item link_view_users"><i class="fa fa-eye" aria-hidden="true"></i> View Users</a>
                                                <a id="link_view_data" href="#" class="dropdown-item"><i class="fas fa-database"></i> View Data</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-gamepad"></i> Control Device</a>
                                            </div>
                                            <!-- </div> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="div-running-devices-container" class="no-display">
                    @include('super.table-running')
                </div>
            </div>
        </section>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="view_userDevices_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit {{Auth::user()->name}}'s Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="form_profile_info" action="api/updateProfile" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                    <h5 style="text-decoration:underline">Personal Information</h5>
                    <table class="table">
                        <tr><th>Name</th><td>&nbsp;:&nbsp;</td>  <td><input class="form-control" type="text" id="txt_name" value="{{Auth::user()->name}}"></td></tr>
                        <tr><th>Email</th><td>&nbsp;:&nbsp;</td>  <td><input class="form-control" type="email" id="txt_email" value="{{Auth::user()->email}}"></td></tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
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


        $('#running-devices').on('click', function(){
            console.log('Clicked on running')
            $("#div-running-devices-container").addClass('display-block').removeClass('no-display');
            $('#table-total-devices').addClass('no-display');
        })
    });


</script>

@endsection



