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
                            <section id="{{$device->deviceDetails->id}}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{$device->device_name}} </h4>
                                        <button type="button" class="btn btn-primary" style="margin-left:10px">Live View</button>
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
                                                            <i class="btn fas fa-sync-alt btn-refresh" id="device-sync-{{$device->deviceDetails->id}}"></i>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div>
                                                            <i id="device_status_pic-{{$device->deviceDetails->id}}" class="fas fa fa-certificate blink_me" style="color:green"></i>&nbsp;&nbsp;
                                                            <span style="color:green" id="device_status-{{$device->deviceDetails->id}}">{{$device->latest_log != null ? ($device->latest_log->step == 0 || $device->latest_log->step == 1 || $device->latest_log->step == 13 ?"Idle" : "RUNNING") : "No Data"}}</span>
                                                            <i id="info_device_status-{{$device->deviceDetails->id}}" class="fas fa-info-circle float-right info-device-status" data-toggle="dropdown" ></i>
                                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <div class="media-body">
                                                                            <p class="text-sm"><b><i id="info_device_status_text-{{$device->deviceDetails->id}}"></i></b></p>
                                                                            <p class="text-sm" id="info_device_status_description-{{$device->deviceDetails->id}}"></p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div><br>
                                                            <span><b>Connection :</b></span>
                                                            <i id="device_connection_status-{{$device->deviceDetails->id}}" style="color:green">
                                                                @if($device->deviceDetails->latest_log != null)
                                                                    @if(Carbon\Carbon::now()->diffInMinutes($device->deviceDetails->latest_log->created_at) < 2)
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
                                                                            <p class="text-sm"><b><i><span id="info_device_connection_text-{{$device->deviceDetails->id}}"></span></i></b></p>
                                                                            <p class="text-sm" id="info_device_connection_description-{{$device->deviceDetails->id}}"></p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- @if(Auth::user()->role == 'S' || Auth::user()->role == 'A')
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
                                                        @endif -->
                                                    </div>
                                                    <!-- /.card-body -->
                                                    <div class="card-footer">
                                                        <div class="row flex">
                                                            <button id="btn_device_start_stop-{{$device->deviceDetails->id}}" class="btn btn-danger center btn_device_start_stop" hidden>Stop</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 box ">
                                                <div class="card card-outline card-success">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Volume </h3>
                                                        <div class="card-tools">
                                                            <i id="volume_chart-{{$device->deviceDetails->id}}" class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-volume-chart"></i>
                                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                                        </button>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                    <span><b>Daily :</b> <i id="daily_volume-{{$device->deviceDetails->id}}">...</i>
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
                                                    <span><b>Monthly :</b> <i id="monthly_volume-{{$device->deviceDetails->id}}">...</i>
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
                                                    <span><b>Total :</b> <i id="total_volume-{{$device->deviceDetails->id}}">...</i>
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
                                                            <i id="info_conductivity-{{$device->deviceDetails->id}}" class="btn fas fa-info-circle float-right" data-toggle="dropdown"></i>
                                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="info_displayed_conductivity-{{$device->deviceDetails->id}}">
                                                                <a href="#" class="dropdown-item">
                                                                    <div class="media">
                                                                        <div class="media-body">
                                                                            <p class="text-sm"><b><i id="info_conductivity_text-{{$device->deviceDetails->id}}">Water Quality</i></b></p>
                                                                            <p class="text-sm" id="info_conductivity_description-{{$device->deviceDetails->id}}">Conductivity is how we measure the amount of minerals content in the water.</p>
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
                                                        <i class="fas fa fa-certificate" id="device_condutivity_icon-{{$device->deviceDetails->id}}" style="color:green">&nbsp;&nbsp;
                                                        <span id="device_conductivity_value-{{$device->deviceDetails->id}}">{{$device->latest_log != null ? ($device->latest_log->ec >=0 && $device->latest_log->ec < 200 ? "On Target" : "Needs Attention") : "No Data"}}</span></i>
                                                        <i id="info_device_conductivity-{{$device->deviceDetails->id}}" class="fas fa-info-circle float-right info_device_conductivity" data-toggle="dropdown" ></i>
                                                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                            <a href="#" class="dropdown-item">
                                                                <div class="media">
                                                                    <div class="media-body">
                                                                        <p class="text-sm"><b><i><span id="info_device_conductivity_text-{{$device->deviceDetails->id}}"></span></i></b></p>
                                                                        <p class="text-sm" id="info_device_conductivity_description-{{$device->deviceDetails->id}}"></p>
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
                                                        <i class="btn fas fa-table" id="info_device_alarms_table-{{$device->deviceDetails->id}}"></i>
                                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                                        </button>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                    @if($device->deviceDetails->latest_log != null)
                                                        <p hidden>Alarm Code: <span id="alarm_code_{{$device->deviceDetails->id}}">{{$device->deviceDetails->latest_log->alarm}}</span></p>
                                                        <section class="alarms-list" id="alarmsList_{{$device->deviceDetails->id}}" style="color:red"></section>
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
                                                        <h2 class="card-title" style="margin-top:-9px!important">Maintenance <button class="btn btn-sm btn-primary btn_edit_maintenance" id="btn_edit_maintenance-{{$device->deviceDetails->id}}">Edit</button></h2>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#{{$device->deviceDetails->id}}">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Critic Acid</th>
                                                                <td style="line-height: 2em;text-align:right"><span id="critic_acid_volume_left-{{$device->deviceDetails->id}}"></td>
                                                                <td style="line-height: 2em;text-align:right">/</td>
                                                                <td><input type="number" id="input_critic_acid-{{$device->deviceDetails->id}}" class="small-inputs input_critic_acid" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->critic_acid: ''}}" disabled></td>
                                                                <td><button class="btn btn-primary btn-sm btn-save-critic_acid" id="btn_save_critic_acid-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn-sm btn_reset_critic_acid" id="btn_reset_critic_acid-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Pre-filter</th>
                                                                <td style="line-height: 2em;text-align:right"><span id="pre_filter_volume_left-{{$device->deviceDetails->id}}"></td>
                                                                <td style="line-height: 2em;text-align:right">/</td>
                                                                <td><input type="number" id="input_pre_filter-{{$device->deviceDetails->id}}" class="small-inputs input_pre_filter" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->pre_filter: ''}}" disabled></td>
                                                                <td><button class="btn btn-primary btn-sm btn-save-pre_filter" id="btn_save_pre_filter-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn-sm btn_reset_pre_filter" id="btn_reset_pre_filter-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Post-filter</th>
                                                                <td style="line-height: 2em;text-align:right"><span id="post_filter_volume_left-{{$device->deviceDetails->id}}"></td>
                                                                <td style="line-height: 2em;text-align:right">/</td>
                                                                <td><input type="number" id="input_post_filter-{{$device->deviceDetails->id}}" class="small-inputs input_post_filter" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->post_filter: ''}}" disabled></td>
                                                                <td><button class="btn btn-primary btn-sm btn-save-post_filter" id="btn_save_post_filter-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn-sm btn_reset_post_filter" id="btn_reset_post_filter-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th>General Service</th>
                                                                <td style="line-height: 2em;text-align:right"><span id="general_service_volume_left-{{$device->deviceDetails->id}}"></td>
                                                                <td style="line-height: 2em;text-align:right">/</td>
                                                                <td><input type="number" id="general_service_filter-{{$device->deviceDetails->id}}" class="small-inputs input_general_service" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->general_service: ''}}" disabled></td>
                                                                <td><button class="btn btn-primary btn-sm btn-save-general_service" id="btn_save_general_service-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn-sm btn_reset_general_service" id="btn_reset_general_service-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                        </table>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <!-- <script type="module" src="{{asset('js/home.js')}}"></script> -->

<script>


    $(document).ready(function () {
        $('.loader').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.volume_custom_time').hide();
        $('#btn_reload_graph').hide();
        $('#volumeChart').hide();

        var start_stop_command_sent = [];
        var command_sent = "";
        var command_sent_time = null;
        setInterval(function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/refreshUserDashboardData",
            })
            .done(function(response){
                console.log("% % % %  Refreshing Dashboad Data % % % % %")
                console.log(response);
                console.log("% % % % % % % % % % % % % % %  % % % % % % % ")
                console.log("command sent time: "+ command_sent_time)
                for(var i=0; i<response.length;i++){
                    if(response[i]['deviceDetails'].latest_log != null){
                        $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeAttr("hidden");

                        //change the status if new data is available
                        if(start_stop_command_sent[response[i]['deviceDetails'].id] != true && new Date(response[i]['deviceDetails'].latest_log.created_at) >= command_sent_time){
                            // console.log("Entered");
                            var status = "";
                            var color = "";
                            // change the status
                            if(response[i]['deviceDetails'].latest_log.step == 0 || response[i]['deviceDetails'].latest_log.step == 1 || response[i]['deviceDetails'].latest_log.step == 13){
                                // console.log("Entered: idle");
                                status = "IDLE";
                                color = "orange";
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).text("Start");
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeClass('btn-danger').addClass('btn-primary')
                            }else{
                                // console.log("Entered: running");
                                status = "RUNNING";
                                color = "green";
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).text("Stop");
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeClass('btn-primary').addClass('btn-danger')
                            }
                            // $('#device-info-'+response[i]['deviceDetails'].id +' .status').text(status); // row status
                            $('#device_status-'+response[i]['deviceDetails'].id).text(status).change();   // device info status
                            document.getElementById('device_status-'+response[i]['deviceDetails'].id).style.color = color;
                            document.getElementById('device_status_pic-'+response[i]['deviceDetails'].id).style.color = color;
                        }else{
                            $('#device-info-'+response[i]['deviceDetails'].id +' .status').text("Pending"); // row status
                            $('#device_status-'+response[i]['deviceDetails'].id).text("Pending");   // device info status
                            document.getElementById('device_status-'+response[i]['deviceDetails'].id).style.color = "black";
                            document.getElementById('device_status_pic-'+response[i]['deviceDetails'].id).style.color = "black";
                            // get the command status
                            $.ajax({
                                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                type: "GET",
                                url: "/command_status/"+command_sent+"/"+ response[i]['deviceDetails'].id,
                            })
                            .done(function(response_command){
                                console.log("*************** Response of command ****************");
                                console.log(response_command);
                                if(response_command.device_read_at != null){
                                    start_stop_command_sent[response_command.device_id] = false;
                                    command_sent_time = new Date(response_command.created_at);
                                    console.log("Changed Command sent time : "+ command_sent_time)
                                    $('#btn_device_start_stop-'+response_command.device_id).attr('disabled',false).change();
                                    switch(response_command.command){
                                        case "Start":
                                            $('#device-info-'+response_command.device_id +' .status').text("Starting"); // row status
                                            break;
                                        case "Stop":
                                            $('#device-info-'+response_command.device_id +' .status').text("Stopping"); // row status
                                            break;
                                    }
                                }
                            });
                        }
                        // change the water quality
                        var water_quality ="";
                        var setpoint_pure_EC_target = response[i]['deviceDetails']['setpoints'].pure_EC_target;
                        var avg_EC_target = response[i]['deviceDetails'].latest_log.ec;
                        var difference_ec = setpoint_pure_EC_target - avg_EC_target;
                        if(difference_ec<0){
                            difference_ec = difference_ec * (-1);
                        }
                        var percentage_EC_target = (difference_ec *100)/setpoint_pure_EC_target
                        if(percentage_EC_target <= 10){
                            water_quality = "On Target ";
                            // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'green';
                            document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'green';
                            document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'green';
                        }else{
                            water_quality = "Needs Attention ";
                            // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'red';
                            document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'red';
                            document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'red';
                        }
                        $('#device-info-'+response[i]['deviceDetails'].id +' .ec').text(water_quality); // row water quality
                        $('#device_conductivity_value-'+response[i]['deviceDetails'].id).text(water_quality); // device info water quality
                        // change device connection status
                        // var now = +new Date();
                        // console.log("NOW :" + now);
                        // var last_date = new Date(response[i]['deviceDetails'].latest_log.log_dt).getTime();
                        // console.log("Last Data DateTime: "+ last_date);
                        // var difference = now - last_date;
                        // console.log("Difference :" + difference/1000/60/60);

                        var test_now = new Date();
                        var test_created_at = new Date(response[i]['deviceDetails'].latest_log.created_at);

                        //console.log("Test now       : "+test_now);
                        //console.log("test Created_at: "+test_created_at);
                        var dd = test_now - test_created_at;
                        //console.log("Difference :"+dd/1000/60);
                        if(dd < 2*1000*60) // 2 minutes
                            $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Connected")
                        else
                            $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Disconnected")
                        // change volume
                        $('#daily_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].daily +" gal" : "");
                        $('#monthly_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].monthly +" gal" : "");
                        $('#total_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].total +" gal" : "");

                        // change alarm
                        var alarms = response[i]['deviceDetails'].latest_log.alarm;

                        var bin_alarms = (alarms >>> 0).toString(2);
                        for(var ii = bin_alarms.length; ii<24 ; ii++){
                            bin_alarms = "0"+bin_alarms;
                        }
                        $('section#alarmsList_'+response[i]['deviceDetails'].id).empty();
                        for(var  j= 0 ; j < bin_alarms.length ; j++){
                            if(bin_alarms[j] == "1"){ // 1 states that there is alarm so find the location of alarm and display
                                switch(j){
                                    case 0: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>Reserved For future</p>");break;
                                    case 1: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>Reserved For future</p>");break;
                                    case 2: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>Reserved For future</p>");break;
                                    case 3: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>FLOWMETER COMM ERROR</p>");break;
                                    case 4: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>ATLAS TEMPERATURE ERROR</p>");break;
                                    case 5: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>ZERO EC ALARM</p>");break;
                                    case 6: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>ATLAS I2C COM ERROR</p>");break;
                                    case 7: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>LOW PRESSURE ALARM</p>");break;
                                    case 8: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE AC INPUT FAIL</p>");break;
                                    case 9: $('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE AC POWER DOWN</p>");break;
                                    case 10:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE HIGH TEMPERATURE</p>");break;
                                    case 11:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE AUX OR SMPS FAIL</p>");break;
                                    case 12:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE FAN FAIL</p>");break;
                                    case 13:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE OVER TEMP SHUTDOWN</p>");break;
                                    case 14:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE OVER LOAD SHUTDOWN</p>");break;
                                    case 15:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE OVER VOLT SHUTDOWN</p>");break;
                                    case 16:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>PAE COMMUNICATION ERROR</p>");break;
                                    case 17:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>CIP LOW LEVEL ALARM</p>");break;
                                    case 18:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>WASTE VALVE ALARM</p>");break;
                                    case 19:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>LEAKAGE ALARM</p>");break;
                                    case 20:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>CABINET TEMP ALARM</p>");break;
                                    case 21:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>BYPASS ALARM</p>");break;
                                    case 22:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>LOW FLOW WASTE ALARM</p>");break;
                                    case 23:$('section#alarmsList_'+response[i]['deviceDetails'].id).append("<p>LOW FLOW PURE ALARM</p>");break;
                                }
                            }
                        }
                        // maintenance
                        //critic acid
                        var critic_acid_reset_value = response[i]['deviceDetails']['latest_maintenance_critic_acid']!=null?response[i]['deviceDetails']['latest_maintenance_critic_acid'].volume_value:0;
                        console.log("Critic reset value: "+response[i]['deviceDetails']['latest_maintenance_critic_acid'].volume_value);
                        var pre_filter_reset_value = response[i]['deviceDetails']['latest_maintenance_pre_filter']!=null?response[i]['deviceDetails']['latest_maintenance_pre_filter'].volume_value:0;
                        var post_filter_reset_value = response[i]['deviceDetails']['latest_maintenance_post_filter']!=null?response[i]['deviceDetails']['latest_maintenance_post_filter'].volume_value:0;
                        var general_service_reset_value = response[i]['deviceDetails']['latest_maintenance_general_service']!=null?response[i]['deviceDetails']['latest_maintenance_general_service'].volume_value:0;

                        var volume_left_critic_acid = response[i]['deviceDetails']['device_settings'].critic_acid - response[i]['deviceVolume'].total - critic_acid_reset_value ;
                        $('#critic_acid_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_critic_acid);
                        var volume_left_pre_filter = response[i]['deviceDetails']['device_settings'].pre_filter - response[i]['deviceVolume'].total - pre_filter_reset_value ;
                        $('#pre_filter_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_pre_filter);
                        var volume_left_post_filter = response[i]['deviceDetails']['device_settings'].post_filter - response[i]['deviceVolume'].total - post_filter_reset_value ;
                        $('#post_filter_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_post_filter);
                        var volume_left_general_service = response[i]['deviceDetails']['device_settings'].general_service - response[i]['deviceVolume'].total - general_service_reset_value ;
                        $('#general_service_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_general_service);
                    }
                }
            });
        },5000);

        // Maintenance
            var old_critic_value =[], old_pre_filter=[], old_post_filter=[], old_general_service=[];
            $('.btn_edit_maintenance').on('click',function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                console.log("maintenance clicked for "+trid)
                old_critic_value[trid] = $('.input_critic_acid').val();
                old_pre_filter[trid] = $('.input_pre_filter').val();
                old_post_filter[trid] = $('.input_post_filter').val();
                old_general_service[trid] = $('.input_general_service').val();
                $('.input_critic_acid').removeAttr("disabled");
                $('.input_pre_filter').removeAttr("disabled");
                $('.input_post_filter').removeAttr("disabled");
                $('.input_general_service').removeAttr("disabled");
            })
            $('.input_critic_acid').on('keyup', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                $('#btn_save_critic_acid-'+trid).removeAttr("hidden");
            });
            $('.input_pre_filter').on('keyup', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                $('#btn_save_pre_filter-'+trid).removeAttr("hidden");
            });
            $('.input_post_filter').on('keyup', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                $('#btn_save_post_filter-'+trid).removeAttr("hidden");
            });
            $('.input_general_service').on('keyup', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                $('#btn_save_general_service-'+trid).removeAttr("hidden");
            });

            $('.btn-save-critic_acid').on('click', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                if($('#input_critic_acid-'+trid).val() >0 && $('#input_critic_acid-'+trid).val() < 50000){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/saveCriticAcid/"+ trid,
                        data: {"critic_acid":$('#input_critic_acid-'+trid).val()}

                    })
                    .done(function(response){
                        // console.log(response)
                        Swal.fire('Success','Critic Acid Updated','success')
                        $('#btn_save_critic_acid-'+trid).attr("hidden", true);
                    });
                }else{
                    Swal.fire("Error", "Value out of range[0-50,000]","error");
                    $('#input_critic_acid-'+trid).val(old_critic_value[trid])
                }
            })
            $('.btn-save-pre_filter').on('click', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                if($('#input_pre_filter-'+trid).val() >0 && $('#input_pre_filter-'+trid).val() < 50000){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/savePreFilter/"+ trid,
                        data: {"pre_filter":$('#input_pre_filter-'+trid).val()}

                    })
                    .done(function(response){
                        Swal.fire('Success','Pre-filter Updated','success')
                        $('#btn_save_pre_filter-'+trid).attr("hidden", true);
                    });
                }else{
                    Swal.fire("Error", "Value out of range[0-50,000]","error");
                    $('#input_pre_filter-'+trid).val(old_pre_filter[trid])
                }
            })
            $('.btn-save-post_filter').on('click', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                if($('#input_post_filter-'+trid).val() >0 && $('#input_post_filter-'+trid).val() < 50000){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/savePostFilter/"+ trid,
                        data: {"post_filter":$('#input_post_filter-'+trid).val()}

                    })
                    .done(function(response){
                        Swal.fire('Success','Post-filter Updated','success')
                        $('#btn_save_post_filter-'+trid).attr("hidden", true);
                    });
                }else{
                    Swal.fire("Error", "Value out of range[0-50,000]","error");
                    $('#input_post_filter-'+trid).val(old_post_filter[trid])
                }
            })
            $('.btn-save-general_service').on('click', function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                if($('#input_general_service-'+trid).val() >0 && $('#input_general_service-'+trid).val() < 50000){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/saveGeneralService/"+ trid,
                        data: {"general_service":$('#input_general_service-'+trid).val()}
                    })
                    .done(function(response){
                        Swal.fire('Success','General Service Updated','success')
                        $('#btn_save_general_service-'+trid).attr("hidden", true);
                    });
                }else{
                    Swal.fire("Error", "Value out of range[0-50,000]","error");
                    $('#input_general_service-'+trid).val(old_general_service[trid])
                }
            })
        //end of maintenance
        $('.btn_reset_critic_acid').on('click', function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "Resetting this confirms that you have done your routine maintenance according to Voltea’s User Manuals Maintenance protocols. \nDo you want to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reset it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var device_id = $(this).closest('section').attr('id');
                    var v = $('#total_volume-'+device_id).text().split(" ");
                    var volume = parseFloat(v[0]);
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/resetCriticAcid/"+ device_id +"/"+volume,
                    })
                    .done(function(response){
                        console.log(response);
                        Swal.fire('Done!','General Service is reset.','success')
                    })

                }
            })

        })
        $('.btn_reset_pre_filter').on('click', function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "Resetting this confirms that you have done your routine maintenance according to Voltea’s User Manuals Maintenance protocols. \nDo you want to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reset it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var device_id = $(this).closest('section').attr('id');
                    var v = $('#total_volume-'+device_id).text().split(" ");
                    var volume = parseFloat(v[0]);
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/resetPreFilter/"+ device_id +"/"+volume,
                    })
                    .done(function(response){
                        console.log(response);
                        Swal.fire('Done!','General Service is reset.','success')
                    })

                }
            })

        })
        $('.btn_reset_post_filter').on('click', function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "Resetting this confirms that you have done your routine maintenance according to Voltea’s User Manuals Maintenance protocols. \nDo you want to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reset it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var device_id = $(this).closest('section').attr('id');
                    var v = $('#total_volume-'+device_id).text().split(" ");
                    var volume = parseFloat(v[0]);
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/resetPostFilter/"+ device_id +"/"+volume,
                    })
                    .done(function(response){
                        console.log(response);
                        Swal.fire('Done!','General Service is reset.','success')
                    })

                }
            })

        })
        $('.btn_reset_general_service').on('click', function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "Resetting this confirms that you have done your routine maintenance according to Voltea’s User Manuals Maintenance protocols. Do you want to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reset it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var device_id = $(this).closest('section').attr('id');
                    var v = $('#total_volume-'+device_id).text().split(" ");
                    var volume = parseFloat(v[0]);
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/resetGeneralService/"+ device_id +"/"+volume,
                    })
                    .done(function(response){
                        console.log(response);
                        Swal.fire('Done!','General Service is reset.','success')
                    })

                }
            })

        })

        $('#inputFromDate_volume').on('change', function(){
            console.log('HI from date')
            $('#inputToDate_volume').val($('#inputFromDate_volume').val()).change()
        })
        $('.info-device-status').on('click', function(){
            console.log("hi")
            var trid = $(this).closest('section').attr('id'); // table row ID
            console.log(trid)
            switch($('#device_status-'+trid).text()){
                case 'RUNNING':
                    $('#info_device_status_text-'+trid).text("Running")
                    $('#info_device_status_description-'+trid).text('')
                    $('#info_device_status_description-'+trid).append("<b>(Don’t Worry)</b> Device is running and treating water ")
                    break;
                case 'IDLE':
                    $('#info_device_status_text-'+trid).text("Idle")
                    $('#info_device_status_description-'+trid).text('')
                    $('#info_device_status_description-'+trid).append("<b>(Oops!!!)</b> Device is not operational. It requires user intervention.")
                    break;
                case 'Pending':
                    $('#info_device_status_text-'+trid).text("Pending")
                    $('#info_device_status_description-'+trid).text('')
                    $('#info_device_status_description-'+trid).append("<b>(Please Wait!!!)</b> Connecting with the device..")
                    break;
            }
        })
        $('.info-device-connection').on('click', function(){
            var trid = $(this).closest('section').attr('id'); // table row ID
            console.log(trid)
            switch($('#device_connection_status-'+trid).text()){
                case 'Connected':
                    $('#info_device_connection_text-'+trid).text('Connected')
                    //alert($('#info_device_connection_text').text())
                    $('#info_device_connection_description-'+trid).text('')
                    $('#info_device_connection_description-'+trid).append("<b>Awesome!!!</b> Device is connected to the Internet ")
                    break;
                default:
                    $('#info_device_connection_text-'+trid).text('Disconnected')
                    //alert($('#info_device_connection_text').text())
                    $('#info_device_connection_description-'+trid).text('')
                    $('#info_device_connection_description-'+trid).append("<b>Oops!!!</b> Device is not connected!")

            }
        })
        $('#info_conductivity').on('click', function(){
            $('#info_conductivity_text').text("Conductivity")
            $('#info_conductivity_description').text('')
            $('#info_conductivity_description').append("Conductivity is how we measure the amount of minerals content in the water.")
        })
        $('.info_device_conductivity').on('click', function(){
            var trid = $(this).closest('section').attr('id'); // table row ID
            switch($('#device_conductivity_value-'+trid).text()){
                case "On Target":
                    $('#info_device_conductivity_text-'+trid).text("On Target")
                    $('#info_device_conductivity_text-'+trid).css("color","green")
                    $('#info_device_conductivity_description-'+trid).text('')
                    $('#info_device_conductivity_description-'+trid).append("The unit is removing the right amount of minerals.")
                    break;
                case "Needs Attention":
                    $('#info_device_conductivity_text-'+trid).text("Needs Attention")
                    $('#info_device_conductivity_text-'+trid).css("color","red")
                    $('#info_device_conductivity_description-'+trid).text('')
                    $('#info_device_conductivity_description-'+trid).append("The unit is removing most of the minerals. ")
                    break;
                case "No Data":
                    $('#info_device_conductivity_text-'+trid).text("No Data")
                    $('#info_device_conductivity_text-'+trid).css("color","orange")
                    $('#info_device_conductivity_description-'+trid).text('')
                    $('#info_device_conductivity_description-'+trid).append("Device is not sending data. Please Check the internet connection")
                    break;
            }
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
                        text: "Device Added \nDo you want to add another?",
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


</script>

@endsection



