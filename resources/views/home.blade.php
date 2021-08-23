@extends('layouts.master')

@section('head')
<style>
.f-r-info{
    float:right;
    line-height:25px;
    margin-right:10px;
}
.card-title{
    padding-top: 0.4em;
}
.info{
    padding-top: 0.3em;
}
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
                <div class="col-12">
                    <!-- Default box -->
                    @if($userDevices->count()>0 || Auth::user()->role == 'S')
                        @foreach($userDevices as $device)
                        <section id="{{$device->id}}">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$device->device_name}} </h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
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
                                                    <span style="color:green" id="device_status-{{$device->id}}">{{$device->latest_log != null ? ($device->latest_log->step == 0 || $device->latest_log->step == 1 || $device->latest_log->step == 13 ?"Idle" : "RUNNING") : "No Data"}}</span>
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
                                                </div>
                                                <div><br>
                                                    <span><b>Connection :</b></span>
                                                    <i id="device_connection_status-{{$device->id}}" style="color:green">
                                                        @if($device->latest_log != null)
                                                            @if(Carbon\Carbon::now()->diffInMinutes($device->latest_log->created_at) < 2)
                                                                {{"Connected"}}
                                                            @else
                                                                {{"Disconnected"}}
                                                            @endif
                                                        @endif
                                                    </i>
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
                                                    <b>Module Health :</b><i style="color:green; font-weight:bold" id="device_health_status-{{$device->id}}">Good</i>
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
                                            <span><b>Daily :</b> <i id="daily_volume-{{$device->id}}">...</i>
                                                <i class="fas fa-info-circle float-right" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                    <a class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Daily Volume</i></b></p>
                                                                <p class="text-sm">Volume produced during the last 24 hrs.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </span>
                                            <br/><br/>
                                            <span><b>Monthly :</b> <i id="monthly_volume-{{$device->id}}">...</i>
                                                <i class="fas fa-info-circle float-right" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                    <a class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Monthly Volume</i></b></p>
                                                                <p class="text-sm">Volume produced during the last 31 days.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </span>
                                            <br/><br/>
                                            <!-- <p><b>Yearly :</b> <i>800 Gallons</i></p> -->
                                            <span><b>Total :</b> <i id="total_volume-{{$device->id}}">...</i>
                                                <i class="fas fa-info-circle float-right" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                    <a class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Total Volume</i></b></p>
                                                                <p class="text-sm">Volume produced during the last 6 months.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </span>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 box">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Water Quality </h3>
                                                <div class="card-tools">
                                                    <i id="info_conductivity-{{$device->id}}" class="btn fas fa-info-circle float-right" data-toggle="dropdown"></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="info_displayed_conductivity-{{$device->id}}">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i id="info_conductivity_text-{{$device->id}}">Water Quality</i></b></p>
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
                                                <i class="fas fa fa-certificate" id="device_condutivity_icon-{{$device->id}}" style="color:green">&nbsp;&nbsp;
                                                <span id="device_conductivity_value-{{$device->id}}">{{$device->latest_log != null ? ($device->latest_log->ec >=0 && $device->latest_log->ec < 200 ? "On Target" : "Needs Attention") : "No Data"}}</span></i>
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
                                            @if($device->latest_log != null)
                                                <p hidden>Alarm Code: <span id="alarm_code_{{$device->id}}">{{$device->latest_log->alarm}}</span></p>
                                                <section class="alarms-list" id="alarmsList_{{$device->id}}"></section>
                                            @endif
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">Maintenance</h2>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#{{$device->id}}">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2"><span><b>Critic Acid:</b></span></div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <span id="critic_acid_volume_left-{{$device->id}}"></span>
                                                        <b> / </b><input type="number" id="input_critic_acid-{{$device->id}}" class="input_critic_acid" value="{{$device->device_settings!= null ? $device->device_settings->critic_acid: ''}}">
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <button class="btn btn-primary btn-sm btn-save-critic_acid" id="btn_save_critic_acid-{{$device->id}}" hidden>Save</button>
                                                        <button class="btn btn-danger btn-sm" id="btn_reset_critic_acid-{{$device->id}}">Reset</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2"><span><b>Pre-filter:</b></span></div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <span id="pre_filter_volume_left-{{$device->id}}"></span>
                                                        <b> / </b><input type="number" id="input_pre_filter-{{$device->id}}" class="input_pre_filter" value="{{$device->device_settings!= null ? $device->device_settings->pre_filter: ''}}">
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <button class="btn btn-primary btn-sm btn-save-pre_filter" id="btn_save_pre_filter-{{$device->id}}" hidden>Save</button>
                                                        <button class="btn btn-danger btn-sm" id="btn_reset_pre_filter-{{$device->id}}">Reset</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2"><span><b>Post-filter:</b></span></div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <span id="post_filter_volume_left-{{$device->id}}"></span>
                                                        <b> / </b><input type="number" id="input_post_filter-{{$device->id}}" class="input_post_filter" value="{{$device->device_settings!= null ? $device->device_settings->post_filter: ''}}">
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                    <button class="btn btn-primary btn-sm btn-save-post_filter" id="btn_save_post_filter-{{$device->id}}" hidden>Save</button>
                                                    <button class="btn btn-danger btn-sm" id="btn_reset_post_filter-{{$device->id}}">Reset</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2"><span><b>General Service:</b></span></div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <span id="general_service_volume_left-{{$device->id}}"></span>
                                                        <b> / </b><input type="number" id="input_general_service-{{$device->id}}" class="input_general_service" value="{{$device->device_settings!= null ? $device->device_settings->general_service: ''}}">
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <button class="btn btn-primary btn-sm btn-save-general_service" id="btn_save_general_service-{{$device->id}}" hidden>Save</button>
                                                        <button class="btn btn-danger btn-sm" id="btn_reset_general_service-{{$device->id}}">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        </section>
                        @endforeach
                    <!-- /.card -->
                    @endif
                    @if($userDevices->count()<=0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Welcome {{ Auth::user()->name }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                <span>This is your dashboard. You can view your device(s) information once you add them. </br>
                                        So lets begin by adding some devices by clicking on Add New Device</span></br>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    @if(Auth::user()->role == 'U')
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-new-device">Add New Device</button>
                                    @endif
                                    @if(Auth::user()->role == 'R')
                                    <a href="{{route('devices')}}"><button class="btn btn-primary">Add New Device</button></a>
                                    @endif
                                </div>
                                <!-- /.card-footer-->
                            </div>
                         </div>
                    </div>
                    @endif
                </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-add-new-device">
        <form id="form_addUser" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add New Device</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputSerialNumber" class="control-label">PCB Serial Number </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Power on your device!</i></b></p>
                                                    <p class="text-sm">You can find it in the screen of the device for serial number</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="number" min="1" class="form-control" id="inputSerialNumber" placeholder="Serial Number" name="serialNumber" autocomplete="no">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputDeviceNumber" class="control-label">Device Number </label>
                                    <i id="info_device" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Switch off your device</i></b></p>
                                                    <p class="text-sm">Open the panel and look into the board for device number</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="number" min="1" class="form-control" id="inputDeviceNumber" placeholder="Device Number" name="deviceNumber" autocomplete="no">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputDeviceName" class="control-label">Device Name </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Give your device a name</i></b></p>
                                                    <p class="text-sm">Give a unique name to each device so that you won't get confused later</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control" id="inputDeviceName" placeholder="Name of your device" name="deviceName" autocomplete="no">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_confirm_add_device" value="Add">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
    </div>
    <div class="modal fade" id="modal-conductivity-chart">
        <form id="form_addUser" class="form-horizontal" method="post" action="" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Conductivity Graph</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                        <label for="selectTimeFrame" class="control-label">Time Range</label>
                                            <select name="selectTimeFrame" id="timeframe_conductivity" class="form-control">
                                                <option>-- Select --</option>
                                                <option value="last_hour">Last hour</option>
                                                <option value="last_24_hour">Last 24 Hours</option>
                                                <option value="custom">Custom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 conductivity_custom_time">
                                        <div class="form-group">
                                        <label for="inputFromDate_conductivity" class="control-label">From</label>
                                            <input class="form-control datepicker" id="inputFromDate_conductivity" name="from_date_conductivity" width="234" placeholder="MM / DD / YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 conductivity_custom_time">
                                        <div class="form-group">
                                        <label for="inputToDate_conductivity" class="control-label">To</label>
                                            <input class="form-control datepicker" id="inputToDate_conductivity" disabled name="to_date_conductivity" width="234" placeholder="MM / DD / YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="reload_graph" class="btn btn-warning" type="button">Reload the Graph</button>
                                    </div>

                                </div>
                                    <p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <canvas id="conductivityChart" width="400vh" height="200vh"></canvas>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary" onClick="getChart()" id="btn_confirm_view" value="View">View</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-volume-chart">
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
    <!-- /.modal -->
    <div class="modal fade" id="modal-conductivity-info">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Conductivity</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" style="padding:10px">
                        <div class="row roundPadding20"  style="padding:20px">
                            <div class="col-lg-12">
                                <p><i>Conductivity is how we measure the amount of minerals content in the water.</i></p>
                                <p><b style="color:blue">Within 5%</b><br> <i>The unit is removing the right amount of minerals.</i></p>
                                <p><b style="color:#dcdc1f">Within 10%</b><br> <i>The unit is removing most of the minerals.</i></p>
                                <p><b style="color:orange">Above 10%</b><br> <i>The unit is having a hard time keeping up removing the appropriate amount of minerals. <br>Keep in mind this could be due to changes in feed water quality, startup of the unit or drop in unit’s performance. <br>Allow some time for the unit to stabilize   <br>Contact specialized personnel if problem persists.</i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script type="module" src="{{asset('js/home.js')}}"></script>

<script>
    $(document).ready(function () {
        $('.loader').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.conductivity_custom_time').hide();
        $('.volume_custom_time').hide();
        $('#btn_reload_graph').hide();
        $('#volumeChart').hide();

        $('#btn_device_start_stop').on('click', function(){
            switch($('#btn_device_start_stop').text()){
                case "Stop":
                    $('#device_status').text('Idle')
                    document.getElementById('device_status').style.color = 'orange'
                    document.getElementById('device_status_pic').style.color = 'orange'
                    $('#btn_device_start_stop').text('Start')
                    $('#btn_device_start_stop').removeClass('btn-danger').addClass('btn-primary')
                    break;
                case "Start":
                    $('#device_status').text('Running')
                    document.getElementById('device_status').style.color = 'green'
                    document.getElementById('device_status_pic').style.color = 'green'
                    $('#btn_device_start_stop').text('Stop')
                    $('#btn_device_start_stop').removeClass('btn-primary').addClass('btn-danger')
                    break;
            }

        })

        $('#btn_device_reset').on('click', function(){
            // $('#last_reset_date') .html( "<span>Last Reset @ <em>"+ new Date().toJSON().slice(0,10).replace(/-/g,'/') +"</em></span>" );
            var choice = confirm("Resetting this confirms that you have done your routine maintenance according to Voltea’s User Manuals Maintenance protocols. Do you want to continue?")
            if(choice)
                $('#total_cycle_count').text("0")
        })

        $('#inputFromDate_volume').on('change', function(){
            console.log('HI from date')
            $('#inputToDate_volume').val($('#inputFromDate_volume').val()).change()
        })

        $('#info_device_health').on('click', function(){

            switch($('#device_health_status').text()){
                case 'Good':
                    $('#info_device_health_text').text("Good")
                    $('#info_device_health_description').text('')
                    $('#info_device_health_description').append("<b>Great!!!</b> Device is in good condition! ")
                    break;
                case 'Idle':
                    $('#info_device_health_text').text("Idle")
                    $('#info_device_health_description').text('')
                    $('#info_device_health_description').append("<b>(Oops!!!)</b> Device is not operational. It requires user intervention.")
                    break;
            }
        })
        $('#info_device_connection').on('click', function(){

            switch($('#device_connection_status').text()){
                case 'Connected':
                    $('#info_device_connection_text').text('Connected').change()
                    //alert($('#info_device_connection_text').text())
                    $('#info_device_connection_description').text('')
                    $('#info_device_connection_description').append("<b>Awesome!!!</b> Device is connected to the Internet ")
                    break;
                default:
                alert('default')
            }
        })
        $('#info_device_status').on('click', function(){

            switch($('#device_status').text()){
                case 'RUNNING':
                    $('#info_device_status_text').text("Running")
                    $('#info_device_status_description').text('')
                    $('#info_device_status_description').append("<b>(Don’t Worry)</b> Device is running and treating water ")
                    break;
                case 'Idle':
                    $('#info_device_status_text').text("Idle")
                    $('#info_device_status_description').text('')
                    $('#info_device_status_description').append("<b>(Oops!!!)</b> Device is not operational. It requires user intervention.")
                    break;
            }
        })
        $('#info_device_conductivity').on('click', function(){
            switch($('#device_conductivity_value').text()){
                case 'Within 5%':
                    $('#info_device_conductivity_text').text("Within 5%")
                    $('#info_device_conductivity_text').css("color","green")
                    $('#info_device_conductivity_description').text('')
                    $('#info_device_conductivity_description').append("The unit is removing the right amount of minerals.")
                    break;
                case 'Within 10%':
                    $('#info_device_conductivity_text').text("Within 10%")
                    $('#info_device_conductivity_text').css("color","yellow")
                    $('#info_device_conductivity_description').text('')
                    $('#info_device_conductivity_description').append("The unit is removing most of the minerals. ")
                    break;
                case 'Above 10%':
                    $('#info_device_conductivity_text').text("Above 10%")
                    $('#info_device_conductivity_text').css("color","orange")
                    $('#info_device_conductivity_description').text('')
                    $('#info_device_conductivity_description').append("The unit is having a hard time keeping up removing the appropriate amount of minerals. <br>Keep in mind this could be due to changes in feed water quality, startup of the unit or drop in unit’s performance. <br>Allow some time for the unit to stabilize,   Contact specialized personnel if problem persists.")
                    break;
            }
        })
        $('#info_conductivity').on('click', function(){
            $('#info_conductivity_text').text("Conductivity")
            $('#info_conductivity_description').text('')
            $('#info_conductivity_description').append("Conductivity is how we measure the amount of minerals content in the water.")
        })

    });




    $('#btn_confirm_add_device').on('click', function() {
        var serial = $('#inputSerialNumber').val();
        var device = $('#inputDeviceNumber').val();
        var name = $('#inputDeviceName').val();

        //console.log(serial +  " ---- " + device);
        //searchDevice();
        $.ajax({
            method: "POST",
            url: "api/addUserDevice",
            data: { "_token": "{{ csrf_token() }}","serial_number": serial, "device_number": device , "device_name":name}
        })
        .done(function( msg ) {
            switch(msg['message']){
                case 'Error':
                    Swal.fire({
                        title: 'Error!',
                        text: 'Device Not Found In Database!',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                    break;
                case 'Success':
                    Swal.fire({
                        title: 'Hurray',
                        text: "Device Added /nDo you want to add another?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, I have more than one devices!',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            $('#modal-add-new-device').modal('toggle');
                            location.reload(true);
                        }
                    })

                    break;
                default:
                    Swal.fire({
                        title: 'Error!',
                        text: 'Unkown error occurred!',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
            }
        });
    });







    function searchDevice(){
        var serial = $('#inputSerialNumber').val();
        var device = $('#inputDeviceNumber').val();
        var name = $('#inputDeviceName').val();
        $data = {
            "_token": "{{ csrf_token() }}",
            "serial_number": serial,
            "device_number": device
        };
        $.ajax({
            type : 'get',
            url : '{{URL::to('api/searchDevice')}}',
            data: $data,
            success:function(data){
                // $('tbody').html(data);
                console.log(data);
                console.log("search");

            }
        });
    }
    $('#timeframe_conductivity').on('change', function(){
        if($('#timeframe_conductivity').val() == 'custom'){
            $('.conductivity_custom_time').show();
        }else{
            $('.conductivity_custom_time').hide();
        }
    })

</script>

@endsection



