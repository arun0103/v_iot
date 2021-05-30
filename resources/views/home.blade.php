@extends('layouts.master')

@section('head')
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
                <div class="col-12">
                    <!-- Default box -->
                    @if($userDevices->count()>0 || Auth::user()->role == 'S')
                        @foreach($userDevices as $device)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$device->device_name}} </h3>
                                @if(Auth::user()->role == 'S' || Auth::user()->role == 'A')
                                    <button class="btn btn-primary btn-sm" style="margin-left:10px">Control</button>
                                @endif
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 box float-right ">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Status </h3>
                                                <div class="card-tools">
                                                <i class="btn fas fa-sync-alt "></i>
                                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                                </button> -->
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div><i id="device_status_pic" class="fas fa fa-certificate blink_me" style="color:green"></i>&nbsp;&nbsp;<span style="color:green" id="device_status">RUNNING</span>
                                                    <i id="info_device_status" class="fas fa-info-circle float-right" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i id="info_device_status_text"></i></b></p>
                                                                    <p class="text-sm" id="info_device_status_description"></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <br/>
                                                    <span><b>Duration  : </b> 02:10:20</span><br/>
                                                </div>
                                                <div><br>
                                                    <span><b>Connection:</b></span> <i id="device_connection_status" style="color:green">Connected</i>
                                                    <i id="info_device_connection" class="fas fa-info-circle float-right" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i><span id="info_device_connection_text"></span></i></b></p>
                                                                    <p class="text-sm" id="info_device_connection_description"></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->role == 'S' || Auth::user()->role == 'A')
                                                </br>
                                                <div>
                                                    <b>Device Health :</b><i style="color:green; font-weight:bold" id="device_health_status">Good</i>
                                                    <i id="info_device_health" class="fas fa-info-circle float-right" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i><span id="info_device_health_text"></span></i></b></p>
                                                                    <p class="text-sm" id="info_device_health_description"></p>
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
                                                    <button id="btn_device_start_stop" class="btn btn-danger center">Stop</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 box float-right ">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Conductivity </h3>

                                                <div class="card-tools">
                                                <i id="info_conductivity" class="btn fas fa-info-circle float-right" data-toggle="modal" data-target="#modal-conductivity-info"></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="info_displayed_conductivity">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i id="info_conductivity_text"></i></b></p>
                                                                <p class="text-sm" id="info_conductivity_description"></p>
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
                                                <i class="fas fa fa-certificate" style="color:green">&nbsp;&nbsp;<span id="device_conductivity_value">Below 5%</span></i>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-3 box float-right ">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Volume </h3>

                                                <div class="card-tools">
                                                    <i id="volume_chart" class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-volume-chart"></i>
                                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                                </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <p>Daily : <i>2 Gallons</i></p>
                                            <p>Monthly : <i>60 Gallons</i></p>
                                            <p>Yearly : <i>800 Gallons</i></p>

                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-3 box float-right ">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Alarms</h3>

                                                <div class="card-tools">
                                                <i class="btn fas fa-table"></i>
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
                            <!-- /.card-body -->
                            <div class="card-footer">

                                <p>Total Cycles : <b id="total_cycle_count">400/500</b> <button class="btn btn-outline-danger"  id="btn_device_reset"><i class=" fa fa-recycle"> Reset</i></button> <span id="last_reset_date"></span></p>

                                <p>Last Servicing: <b>01/01/2020</b></p>
                                <p><i><b>Recommended: </b>Replace carbon filter after next 100 cycles</i></p>
                            </div>
                            <!-- /.card-footer-->
                        </div>
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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-new-device">Add New Device</button>
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
                                    <label for="inputSerialNumber" class="control-label">Serial Number </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r" data-toggle="dropdown" ></i>
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
                                    <i id="info_device" class="fas fa-info-circle f-r" data-toggle="dropdown" ></i>
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
                                        <button id="reload_graph" class="btn btn-warning">Reload the Graph</button>
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
                        <button type="submit" class="btn btn-primary" onClick="getChart()" id="btn_confirm_view" value="View">View</button>
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
                                            <select name="timeFrame_volume" id="timeframe_volume" class="form-control">
                                                <option>-- Select --</option>
                                                <option value="last_hour">Last hour</option>
                                                <option value="last_24_hour">Last 24 Hours</option>
                                                <option value="custom">Custom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 volume_custom_time">
                                        <div class="form-group">
                                        <label for="inputFromDate_volume" class="control-label">From</label>
                                            <input class="form-control datepicker" id="inputFromDate_volume" name="from_date_volume" width="234" placeholder="MM/DD/YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 volume_custom_time">
                                        <div class="form-group">
                                        <label for="inputToDate_volume" class="control-label">To</label>
                                            <input class="form-control datepicker" id="inputToDate_volume" disabled name="to_date_volume" width="234" placeholder="MM/DD/YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="reload_graph" class="btn btn-warning">Reload the Graph</button>
                                    </div>
                                </div>

                                <p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <canvas id="volumeChart" width="400vh" height="200vh"></canvas>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onClick="getChart()" id="btn_confirm_view" value="View">View</button>
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="module" src="{{asset('js/home.js')}}"></script>

<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.conductivity_custom_time').hide();
        $('.volume_custom_time').hide();
        $('#reload_graph').hide();

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
            $('#last_reset_date') .html( "<span>Last Reset @ <em>"+ new Date().toJSON().slice(0,10).replace(/-/g,'/') +"</em></span>" );
            $('#total_cycle_count').text("0/500")
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
        $('#info_conductivity').on('click', function(){
            switch($('#device_conductivity_value').text()){
                case 'Below 5%':
                    $('#info_conductivity_text').text("Conductivity")
                    $('#info_conductivity_description').text('')
                    $('#info_conductivity_description').append("Conductivity is how we measure the amount of minerals content in the water.<br><b style=\"color:blue\">Within 5% : </b>The unit is removing the right amount of minerals.<br><b style=\"color:yellow\">Within 10% : </b>The unit is removing most of the minerals. <br><b style=\"color:orange\">Above 10% : </b>The unit is having a hard time keeping up removing the appropriate amount of minerals. Keep in mind this could be due to changes in feed water quality, startup of the unit or drop in unit’s performance. Allow some time for the unit to stabilize,   Contact specialized personnel if problem persists.")
                    break;
            }
        })
    });


    $('#btn_confirm_add_device').on('click', function() {
        var serial = $('#inputSerialNumber').val();
        var device = $('#inputDeviceNumber').val();
        //console.log(serial +  " ---- " + device);
        searchDevice();
        $.ajax({
            method: "POST",
            url: "api/addUserDevice",
            data: { "_token": "{{ csrf_token() }}","serial_number": serial, "device_number": device }
        })
        .done(function( msg ) {
            switch(msg['message']){
                case 'Error':
                    alert('Device Not Found In Database!');
                    break;
                case 'Success':
                    alert('Device Added');
                    $('#modal-add-new-device').modal('toggle');
                    break;
                default:
                alert('Default message: check in console')
                    console.log(msg);
            }
            console.log( msg );
        });
    });

    function searchDevice(){
        var serial = $('#inputSerialNumber').val();
        var device = $('#inputDeviceNumber').val();
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
    $('#timeframe_volume').on('change', function(){
        if($('#timeframe_volume').val() == 'custom'){
            $('.volume_custom_time').show();
        }else{
            $('.volume_custom_time').hide();
        }
        $('#reload_graph').show();
    })



</script>

@endsection



