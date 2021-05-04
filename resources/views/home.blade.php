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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Device Name </h3>

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
                                            <i class="btn fas fa-sync-alt"></i>
                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                            </button> -->
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <span style="color:green"><i class="fas fa fa-certificate blink_me"> </i> RUNNING</span>
                                            <br/>
                                            <span><b>Duration  : </b> 02:10:20</span><br/>
                                            <span><b>Last Data @ </b> 11:00:00</span>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-3 box float-right ">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Conductivity </h3>

                                            <div class="card-tools">
                                                <i class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-conductivity-chart" onClick="getChart()"></i>
                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                            </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                        <i class="fas fa fa-certificate" style="color:green">Good</i>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-3 box float-right ">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Volume </h3>

                                            <div class="card-tools">
                                                <i class="btn fas fa-chart-bar"></i>
                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                            </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                        <p>Daily : <i>2 L</i></p>
                                        <p>Monthly : <i>60 L</i></p>
                                        <p>Yearly : <i>800 L</i></p>

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
                            <p>Total Cycles : <b>400/500</b></p>
                            <p>Last Servicing: <b>01/01/2020</b></p>
                            <p><i><b>Recommended: </b>Replace carbon filter after next 100 cycles</i></p>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
                </div>
            </div>
        </section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 bg-top-logo-color">
                                <h2 class="card-title">Device Name here : Product [DiUse]</h2>
                                <div class="card-tools">
                                    <i class="btn fas fa-sync-alt"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="myAccordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne">
                                            <h2 class="mb-0">
                                                <h4>Status
                                                    <span>
                                                        <i class="fas fa fa-certificate blink_me {{'rotate'}} rotate" text="Status: running"> </i>
                                                    </span>
                                                </h4>

                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#myAccordion">
                                            <div class="card-body">
                                                <p>
                                                    <div class="row">
                                                        <div class="col-md-6 box" style="justify-content:right; font-size: 1.3em; color:green;">
                                                            <span><i class="fas fa fa-certificate blink_me"> </i> RUNNING</span>
                                                            <br/>
                                                            <span><b>Duration : </b> 02:10:20</span><br/>
                                                            <span><b>Last Data received </b>@ 11:00:00</span>
                                                        </div>
                                                        <div class="col-md-6 box float-right ">
                                                            <h2>Alarms</h2>
                                                            <p>No alarms!</p>
                                                            <p><i><b>Recommended: </b>Replace carbon filter after next 100 cycles</i></p>
                                                        </div>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <a href="#collapseOne"><div class="card-header " id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" >
                                            <h2 class="mb-0">
                                                <h4>Conductivity</h4>
                                            </h2>
                                        </div></a>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#myAccordion">
                                            <div class="card-body flex justify-content-center">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree">
                                            <h2 class="mb-0">
                                                <h4>Volume</h4>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#myAccordion">
                                            <div class="card-body">
                                                <p>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-sm-12">
                                                            <canvas id="volumeChart" width="400vh" height="200vh"></canvas>
                                                        </div>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Total Cycles : <b>400/500</b></p>
                                <p>Last Servicing: <b>01/01/2020</b></p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 bg-top-logo-color">
                                <h2 class="card-title">Status </h2>
                                <i class="btn fas fa-sync-alt"></i>
                                <div class="card-tools">
                                    <input class="form-control" type="filter" placeholder="Filter Device" aria-label="Filter">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 d-block">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">UK</h3>
                                                <div class="card-tools">
                                                    <span> <i class="fa fa-flag" aria-hidden="true" title="Alarms"></i></span>
                                                    <span> &nbsp;&nbsp;</span>
                                                    <span> <i class="fas fa-window-minimize" aria-hidden="true" title="View Details"></i></span>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive p-2"  style="overflow-x:hidden">
                                                <div class="row">
                                                    <div class="col-md-4" style="justify-content:right; font-size: 1.3em; color:green;">
                                                        <span><i class="fas fa fa-certificate rotate"> </i> RUNNING</span>
                                                    </div>
                                                    <div class="col-md-8 float-right">
                                                        <span style="float:right"><b>Duration : </b> 02:10:20</span><br/>
                                                        <span style="float:right"><b>Last Data received </b>@ 11:00:00</span>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span>Conductivity</span>
                                                    </div>
                                                    <div class="col-md-6" style="background:#3aea3a">
                                                        <p> 3.05</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- LINE CHART -->
                                                        <!-- <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 468px;" width="468" height="250" class="chartjs-render-monitor"></canvas>
                                                            </div>
                                                        </div> -->
                                                        <!-- /.card-body -->
                                                        <!-- </div> -->
                                                        <!-- /.card -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="card">
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-striped table-valign-middle">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2">Parameters</th>
                                                                    <th colspan="2" style="text-align:center">Values</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pure</th>
                                                                    <th>Waste</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Avg. EC</td>
                                                                    <td style="text-align:center; background:#3aea3a">3.05</td>
                                                                    <td style="text-align:center">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Volume</td>
                                                                    <td style="text-align:center">10 ltrs</td>
                                                                    <td style="text-align:center">2 ltrs</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Avg. Flow</td>
                                                                    <td style="text-align:center">2.00</td>
                                                                    <td style="text-align:center">0.05</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Avg. Voltage</td>
                                                                    <td style="text-align:center">15v</td>
                                                                    <td style="text-align:center">15v</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>CIP Cycle Count</td>
                                                                    <td colspan="2" style="text-align:center">5/200</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div><!--card-->
                                    </div>
                                    <div class="col-lg-6 d-block">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">Nepal</h3>
                                                <div class="card-tools">
                                                    <span> <i class="fa fa-flag" aria-hidden="true" title="Alarms"></i></span>
                                                    <span> &nbsp;&nbsp;</span>
                                                    <span> <i class="fas fa-window-minimize" aria-hidden="true" title="View Details"></i></span>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive p-2"  style="overflow-x:hidden">
                                                <div class="row">
                                                    <div class="col-md-4" style="justify-content:center; font-size: 20px; color:blue; ">
                                                        <span><i class="fas fa fa-certificate "> </i> BYPASS</span>
                                                    </div>
                                                    <div class="col-md-8 float-right">
                                                        <span style="float:right"><b>Duration : </b> 02:10:20</span><br/>
                                                        <span style="float:right"><b>Last Data received </b>@ 11:00:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="card">
                                                    <div class="card-body table-responsive p-0">
                                                        <canvas id="myChart" width="400" height="200"></canvas>
                                                        <table class="table table-striped table-valign-middle">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2">Parameters</th>
                                                                    <th colspan="2" style="text-align:center">Values</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pure</th>
                                                                    <th>Waste</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Avg. EC</td>
                                                                    <td style="text-align:center">3.05</td>
                                                                    <td style="text-align:center">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Volume</td>
                                                                    <td style="text-align:center">10 ltrs</td>
                                                                    <td style="text-align:center">2 ltrs</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Avg. Flow</td>
                                                                    <td style="text-align:center">2.00</td>
                                                                    <td style="text-align:center">0.05</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Avg. Voltage</td>
                                                                    <td style="text-align:center">15v</td>
                                                                    <td style="text-align:center">15v</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>CIP Cycle Count</td>
                                                                    <td colspan="2" style="text-align:center">5/200</td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-block">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">India</h3>
                                                <div class="card-tools">
                                                    <span> <i class="fa fa-flag" aria-hidden="true" title="Alarms"></i></span>
                                                    <span> &nbsp;&nbsp;</span>
                                                    <span> <i class="fas fa-window-maximize" aria-hidden="true" title="View Details"></i></span>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive p-2"  style="overflow-x:hidden">
                                                <div class="row">
                                                    <div class="col-md-4" style="justify-content:center; font-size: 20px; color:red; ">
                                                        <span><i class="fas fa fa-certificate "> </i> IDLE</span>
                                                    </div>
                                                    <div class="col-md-8 float-right">
                                                        <span style="float:right"><b>Duration : </b> 02:10:20</span><br/>
                                                        <span style="float:right"><b>Last Data received </b>@ 11:00:00</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="padding:5px">
                            <div class="card-header border-0">
                                <h3 class="card-title">Recent Logs</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">

                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Device Name</th>
                                            <th>Status</th>
                                            <th>Time [Start-End]</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            Nepal
                                            <span class="badge bg-danger">NEW</span>
                                            </td>
                                            <td>ByPass</td>
                                            <td>
                                            13:00
                                            </td>
                                            <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <!-- <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2"> -->
                                            India
                                            </td>
                                            <td>Idle</td>
                                            <td>
                                            <!-- <small class="text-success mr-1">
                                                <i class="fas fa-arrow-up"></i>
                                                12%
                                            </small> -->
                                            06:00-13:00
                                            </td>
                                            <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <!-- <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2"> -->
                                            UK
                                            </td>
                                            <td>Running</td>
                                            <td>
                                            <!-- <small class="text-warning mr-1">
                                                <i class="fas fa-arrow-down"></i>
                                                0.5%
                                            </small> -->
                                            05:45-05:59
                                            </td>
                                            <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <!-- <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2"> -->
                                            India
                                            </td>
                                            <td>Idle</td>
                                            <td>
                                            <!-- <small class="text-danger mr-1">
                                                <i class="fas fa-arrow-down"></i>
                                                3%
                                            </small> -->
                                            05:15-05:44
                                            </td>
                                            <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
    <div class="modal fade" id="modal-conductivity-chart">
        <form id="form_addUser" class="form-horizontal" method="post" action="" autocomplete="no">

            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Conductivity Graph</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="addNewUser">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                        <label for="selectTimeFrame" class="control-label">Time Frame</label>
                                            <select name="timeframe" id="timeframe_conductivity" class="form-control">
                                                <option>-- Select --</option>
                                                <option value="minutes">Minutes</option>
                                                <option value="hours">Hours</option>
                                                <option value="days">Days</option>
                                                <option value="months">Months</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="inputNumber" class="control-label">Number</label>
                                            <input type="number" min="1" class="form-control" id="inputNumber" placeholder="Number" name="number" autocomplete="no">
                                        </div>
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{asset('js/home.js')}}"></script>

<script>
var ctx_conductivity = document.getElementById('conductivityChart').getContext('2d');
var conductivityChart = new Chart(ctx_conductivity, {
    type: 'bar',
    data: {
        labels: ['12:10', '12:11', '12:12', '12:13', '12:14', '12:15'],
        datasets: [{
            // label: ['Good','OK','Poor'],
            data: [3.5, 4.0, 10.5, 12.3, 5.2, 5.3],
            backgroundColor: [
                'green',
                'green',
                'red',
                'red',
                'orange',
                'orange'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
jQuery(document).ready(function($){
    alert("Hello!")

});
</script>

@endsection




<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
