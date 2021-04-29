@extends('layouts.master')

@section('content')
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
    <div class="content">
        <div class="container-fluid">
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
                                                    <span><i class="fas fa fa-certificate blink_me"> </i> RUNNING</span>
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
