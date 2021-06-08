@extends('layouts.master')

@section('head')
<style>
    tr.device-info{
        position:relative;
    }
</style>
@endsection
@section('content')

    <div id="app">
        <!-- Content Header (Page header) -->
        <div class="content-header content-header-dashboard">
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
                <!-- <div class="row">
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
                        </div>
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

                        </div>

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

                        </div>

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

                        </div>

                    </div>
                </div> -->
                <div class="row" id="table-total-devices">
                    <div class="col-lg-12 col-md-12">
                        <!-- <h3>All Devices</h3> -->
                        <div class="table-responsive">
                            <table class=" table-hover datatable">
                                <thead class="thead-dark">
                                    <th>S.N</th>
                                    <th>Model</th>
                                    <th>#Users</th>
                                    <th>Status</th>
                                    <th>Duration</th>
                                    <th>EC</th>
                                        <!-- <th>Pure Flow</th>
                                        <th>Waste Flow</th>
                                        <th>Pure Voltage</th>
                                        <th>Waste Voltage</th>
                                        <th>Volume</th>
                                        <th>Cycles</th>
                                        <th>Module Health</th>
                                        <th>Alarm Setpoints</th>
                                        <th>Recovery</th> -->
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($devices as $device)
                                        <tr class="table-info device-row" id="device-info-{{$device->id}}" >
                                            <td>{{$device->serial_number}}</td>
                                            <td>{{$device->model == 'U' ? 'DiUse' : 'DiEntry'}}</td>
                                            <td>{{$device->userDevices->count()}}</td>
                                            <td>Running</td>
                                            <td>00:01:15</td>
                                            <td>Within 5%</td>
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
                                            <div class="device-details" style="background:red; z-index:1;"></div>
                                        </tr>
                                        <tr class="device-info" id="{{$device->id}}" style="display: none;">
                                            <td colspan="7">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                <ul class="nav nav-tabs">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#">Flow</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#">Voltage</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#">Alarm Setpoints</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Control</a>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                            <div class="card-body">
                                                                <div class="tab-pane fade active show" id="profile-personal-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-6 col-sm-6 box">
                                                                            <div class="card card-outline card-success">
                                                                                <div class="card-header">
                                                                                    <h3 class="card-title">Status </h3>
                                                                                    <div class="card-tools">
                                                                                        <i class="btn fas fa-sync-alt btn-refresh" id="device-sync-{{$device->id}}"></i>
                                                                                    </div>
                                                                                    <!-- /.card-tools -->
                                                                                </div>
                                                                                <!-- /.card-header -->
                                                                                <div class="card-body">
                                                                                    <div>
                                                                                        <i id="device_status_pic-{{$device->id}}" class="fas fa fa-certificate blink_me" style="color:green"></i>&nbsp;&nbsp;
                                                                                        <span style="color:green" id="device_status-{{$device->id}}">RUNNING</span>
                                                                                        <i id="info_device_status-{{$device->id}}" class="fas fa-info-circle float-right info-device-status" data-toggle="dropdown" ></i>
                                                                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                                            <a href="#" class="dropdown-item">
                                                                                                <div class="media">
                                                                                                    <div class="media-body">
                                                                                                        <p class="text-sm"><b><i id="info_device_status_text-{{$device->id}}"></i></b></p>
                                                                                                        <p class="text-sm" id="info_device_status_description-{{$device->id}}"></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <br/>
                                                                                        <span><b>Duration  : </b> 02:10:20</span><br/>
                                                                                    </div>
                                                                                    <div><br>
                                                                                        <span><b>Connection :</b></span> <i id="device_connection_status-{{$device->id}}" style="color:green">Connected</i>
                                                                                        <i id="info_device_connection" class="fas fa-info-circle float-right info-device-connection" data-toggle="dropdown" ></i>
                                                                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                                            <a href="#" class="dropdown-item">
                                                                                                <div class="media">
                                                                                                    <div class="media-body">
                                                                                                        <p class="text-sm"><b><i><span id="info_device_connection_text-{{$device->id}}"></span></i></b></p>
                                                                                                        <p class="text-sm" id="info_device_connection_description-{{$device->id}}"></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    @if(Auth::user()->role == 'S' || Auth::user()->role == 'A')
                                                                                    </br>
                                                                                    <div>
                                                                                        <b>Device Health :</b><i style="color:green; font-weight:bold" id="device_health_status-{{$device->id}}">Good</i>
                                                                                        <i id="info_device_health-{{$device->id}}" class="fas fa-info-circle float-right info_device_health" data-toggle="dropdown" ></i>
                                                                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                                            <a href="#" class="dropdown-item">
                                                                                                <div class="media">
                                                                                                    <div class="media-body">
                                                                                                        <p class="text-sm"><b><i><span id="info_device_health_text-{{$device->id}}"></span></i></b></p>
                                                                                                        <p class="text-sm" id="info_device_health_description-{{$device->id}}"></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                </div>
                                                                                <!-- /.card-body -->
                                                                                <div class="card-footer">
                                                                                    <div class="row flex">
                                                                                        <button id="btn_device_start_stop-{{$device->id}}" class="btn btn-danger center btn_device_start_stop">Stop</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 col-sm-6 box ">
                                                                            <div class="card card-outline card-success">
                                                                                <div class="card-header">
                                                                                    <h3 class="card-title">Volume </h3>

                                                                                    <div class="card-tools">
                                                                                        <i id="volume_chart-{{$device->id}}" class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-volume-chart"></i>
                                                                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                                                                    </button>
                                                                                    </div>
                                                                                    <!-- /.card-tools -->
                                                                                </div>
                                                                                <!-- /.card-header -->
                                                                                <div class="card-body">
                                                                                <p><b>Daily :</b> <i>2 Gallons</i></p>
                                                                                <p><b>Monthly :</b> <i>60 Gallons</i></p>
                                                                                <p><b>Yearly :</b> <i>800 Gallons</i></p>
                                                                                <p><b>Total :</b> <i>1800 Gallons</i></p>

                                                                                </div>
                                                                                <!-- /.card-body -->
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 col-sm-6 box">
                                                                            <div class="card card-outline card-success">
                                                                                <div class="card-header">
                                                                                    <h3 class="card-title">Conductivity </h3>

                                                                                    <div class="card-tools">
                                                                                    <i id="info_conductivity-{{$device->id}}" class="btn fas fa-info-circle float-right" data-toggle="dropdown"></i>
                                                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="info_displayed_conductivity-{{$device->id}}">
                                                                                        <a href="#" class="dropdown-item">
                                                                                            <div class="media">
                                                                                                <div class="media-body">
                                                                                                    <p class="text-sm"><b><i id="info_conductivity_text-{{$device->id}}">Conductivity</i></b></p>
                                                                                                    <p class="text-sm" id="info_conductivity_description-{{$device->id}}">Conductivity is how we measure the amount of minerals content in the water.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                        <!-- <i id="conductivity_chart" class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-conductivity-chart" ></i> -->
                                                                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                                                                    </button>
                                                                                    </div>
                                                                                    <!-- /.card-tools -->
                                                                                </div>
                                                                                <!-- /.card-header -->
                                                                                <div class="card-body">
                                                                                    <i class="fas fa fa-certificate" style="color:green">&nbsp;&nbsp;
                                                                                    <span id="device_conductivity_value-{{$device->id}}">Within 5%</span></i>
                                                                                    <i id="info_device_conductivity-{{$device->id}}" class="fas fa-info-circle float-right info_device_conductivity" data-toggle="dropdown" ></i>
                                                                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                                            <a href="#" class="dropdown-item">
                                                                                                <div class="media">
                                                                                                    <div class="media-body">
                                                                                                        <p class="text-sm"><b><i><span id="info_device_conductivity_text-{{$device->id}}"></span></i></b></p>
                                                                                                        <p class="text-sm" id="info_device_conductivity_description-{{$device->id}}"></p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                </div>
                                                                                <!-- /.card-body -->
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-3 col-md-6 col-sm-6 box">
                                                                            <div class="card card-outline card-success">
                                                                                <div class="card-header">
                                                                                    <h3 class="card-title">Alarms</h3>

                                                                                    <div class="card-tools">
                                                                                    <i class="btn fas fa-table" id="info_device_alarms_table-{{$device->id}}"></i>
                                                                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                                                                    </button>
                                                                                    </div>
                                                                                    <!-- /.card-tools -->
                                                                                </div>
                                                                                <!-- /.card-header -->
                                                                                <div class="card-body">
                                                                                <p>No alarms!</p>

                                                                                </div>
                                                                                <!-- /.card-body -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <div class="modal fade modal-volume-chart" id="modal-volume-chart">
        <form id="form_volume_chart" class="form-horizontal" method="post" action="" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Volume Graph</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <label for="timeFrame_volume" class="control-label">Time Frame</label>
                                            <select name="timeFrame_volume" id="timeframe_volume" class="form-control" title="Selct">
                                                <option>-- Select --</option>
                                                <option value="last_hour">Last hour</option>
                                                <option value="last_24_hour">Last 24 Hours</option>
                                                <option value="custom">Custom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 volume_custom_time">
                                        <div class="form-group">
                                        <label for="inputFromDate_volume" class="control-label">From</label>
                                            <input class="form-control datepicker" id="inputFromDate_volume" name="from_date_volume" width="234" placeholder="MM/DD/YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 volume_custom_time">
                                        <div class="form-group">
                                        <label for="inputToDate_volume" class="control-label">To</label>
                                            <input class="form-control datepicker" id="inputToDate_volume" disabled name="to_date_volume" width="234" placeholder="MM/DD/YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-grid gap-2">
                                        <button id="btn_reload_graph"  class="btn btn-warning btn-lg btn-block" type="button">Load the Graph</button>
                                    </div>
                                </div>

                                <p>
                                    <div class="row" id="div_report">
                                        <div class="col-md-12">
                                            <canvas id="volumeChart" width="400vh" height="200vh"></canvas>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary" id="btn_download_pdf_graph">Download PDF</button> -->
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary" onClick="getChart()" id="btn_confirm_view" value="View">View</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
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

<script type="module" src="{{asset('js/home.js')}}"></script>

<script>

    $('.btn-refresh').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        alert('Refreshing data')
        // Request server for recent logs
    })

    //when user clicks on the device row
    $('tr.device-row').on('click',function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        var device_trid = trid.replace("device-info-",'')
        $('tr#' + device_trid).toggle();
    })

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



