@extends('layouts.master')

@section('head')
<style>
    tr.device-info{
        position:relative;
    }
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
    .display-none{
        display: hidden;
    }
    /* #btn_edit_user_profile{
        margin-right:-15px;
    } */
    .edit_info{
        margin-top:-25px;
    }
    #info_member_since_edit, .edit_info{
        color:yellow;
        font-weight: bolder;
        float:right;
    }
    #btn_edit_user_profile, #btn_cancel_edit_user_profile{
        float:right;
    }
    #img_avatar_preview{
        width:450px;
        height:300px;
        border-radius: 5px;

    }

    /* /////////////////////////// */
    body{
        margin-top:20px;
        background:#eee;
    }
    input {
        border: none;
        display: inline;
        font-family: inherit;
        font-size: inherit;
        padding: none;
        width: auto;
    }

    .profile-header {
        position: relative;
        overflow: hidden
    }

    .profile-header .profile-header-cover {
        /* background-image: url(https://bootdey.com/img/Content/bg1.jpg); */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0
    }

    .profile-header .profile-header-cover:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, .75) 100%)
    }

    .profile-header .profile-header-content {
        color: #fff;
        padding: 25px
    }

    .profile-header-img {
        float: left;
        width: 120px;
        height: 120px;
        overflow: hidden;
        position: relative;
        /*z-index: 10;*/
        margin: 0 0 -20px;
        padding: 3px;
        border-radius: 4px;
        background: #fff
    }

    .profile-header-img img {
        max-width: 100%
    }

    .profile-header-info h4 {
        font-weight: 500;
        color: #fff
    }

    .profile-header-img+.profile-header-info {
        margin-left: 140px
    }

    .profile-header .profile-header-content,
    .profile-header .profile-header-tab {
        position: relative
    }

    .b-minus-1,
    .b-minus-10,
    .b-minus-2,
    .b-minus-3,
    .b-minus-4,
    .b-minus-5,
    .b-minus-6,
    .b-minus-7,
    .b-minus-8,
    .b-minus-9,
    .b-plus-1,
    .b-plus-10,
    .b-plus-2,
    .b-plus-3,
    .b-plus-4,
    .b-plus-5,
    .b-plus-6,
    .b-plus-7,
    .b-plus-8,
    .b-plus-9,
    .l-minus-1,
    .l-minus-2,
    .l-minus-3,
    .l-minus-4,
    .l-minus-5,
    .l-minus-6,
    .l-minus-7,
    .l-minus-8,
    .l-minus-9,
    .l-plus-1,
    .l-plus-10,
    .l-plus-2,
    .l-plus-3,
    .l-plus-4,
    .l-plus-5,
    .l-plus-6,
    .l-plus-7,
    .l-plus-8,
    .l-plus-9,
    .r-minus-1,
    .r-minus-10,
    .r-minus-2,
    .r-minus-3,
    .r-minus-4,
    .r-minus-5,
    .r-minus-6,
    .r-minus-7,
    .r-minus-8,
    .r-minus-9,
    .r-plus-1,
    .r-plus-10,
    .r-plus-2,
    .r-plus-3,
    .r-plus-4,
    .r-plus-5,
    .r-plus-6,
    .r-plus-7,
    .r-plus-8,
    .r-plus-9,
    .t-minus-1,
    .t-minus-10,
    .t-minus-2,
    .t-minus-3,
    .t-minus-4,
    .t-minus-5,
    .t-minus-6,
    .t-minus-7,
    .t-minus-8,
    .t-minus-9,
    .t-plus-1,
    .t-plus-10,
    .t-plus-2,
    .t-plus-3,
    .t-plus-4,
    .t-plus-5,
    .t-plus-6,
    .t-plus-7,
    .t-plus-8,
    .t-plus-9 {
        position: relative!important
    }

    .profile-header .profile-header-tab {
        background: #fff;
        list-style-type: none;
        margin: -10px 0 0;
        padding: 0 0 0 140px;
        white-space: nowrap;
        border-radius: 0
    }

    .text-ellipsis,
    .text-nowrap {
        white-space: nowrap!important
    }

    .profile-header .profile-header-tab>li {
        display: inline-block;
        margin: 0
    }

    .profile-header .profile-header-tab>li>a {
        display: block;
        color: #929ba1;
        line-height: 20px;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
        border: none
    }

    .profile-header .profile-header-tab>li.active>a,
    .profile-header .profile-header-tab>li>a.active {
        color: #242a30
    }

    .profile-content {
        padding: 25px;
        border-radius: 4px
    }

    .profile-content:after,
    .profile-content:before {
        content: '';
        display: table;
        clear: both
    }

    .profile-content .tab-content,
    .profile-content .tab-pane {
        background: 0 0
    }

    .profile-left {
        width: 200px;
        float: left
    }

    .profile-right {
        margin-left: 240px;
        padding-right: 20px
    }

    .profile-image {
        height: 300px;
        line-height: 175px;
        text-align: center;
        font-size: 72px;
        margin-bottom: 10px;
        border: 2px solid #E2E7EB;
        overflow: hidden;
        border-radius: 4px
    }

    .profile-image img {
        display: block;
        max-width: 100%
    }

    .profile-highlight {
        padding: 12px 15px;
        background: #FEFDE1;
        border-radius: 4px
    }

    .profile-highlight h4 {
        margin: 0 0 7px;
        font-size: 12px;
        font-weight: 700
    }

    .table.table-profile>thead>tr>th {
        border-bottom: none!important
    }

    .table.table-profile>thead>tr>th h4 {
        font-size: 20px;
        margin-top: 0
    }

    .table.table-profile>thead>tr>th h4 small {
        display: block;
        font-size: 12px;
        font-weight: 400;
        margin-top: 5px
    }

    .table.table-profile>tbody>tr>td,
    .table.table-profile>thead>tr>th {
        border: none;
        padding-top: 7px;
        padding-bottom: 7px;
        color: #242a30;
        background: 0 0
    }

    .table.table-profile>tbody>tr>td.field {
        width: 20%;
        text-align: right;
        font-weight: 600;
        color: #2d353c
    }

    .table.table-profile>tbody>tr.highlight>td {
        border-top: 1px solid #b9c3ca;
        border-bottom: 1px solid #b9c3ca
    }

    .table.table-profile>tbody>tr.divider>td {
        padding: 0!important;
        height: 10px
    }

    .profile-section+.profile-section {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #b9c3ca
    }

    .profile-section:after,
    .profile-section:before {
        content: '';
        display: table;
        clear: both
    }

    .profile-section .title {
        font-size: 20px;
        margin: 0 0 15px
    }

    .profile-section .title small {
        font-weight: 400
    }

    body.flat-black {
        background: #E7E7E7
    }

    .flat-black .navbar.navbar-inverse {
        background: #212121
    }

    .flat-black .navbar.navbar-inverse .navbar-form .form-control {
        background: #4a4a4a;
        border-color: #4a4a4a
    }

    .flat-black .sidebar,
    .flat-black .sidebar-bg {
        background: #3A3A3A
    }

    .flat-black .page-with-light-sidebar .sidebar,
    .flat-black .page-with-light-sidebar .sidebar-bg {
        background: #fff
    }

    .flat-black .sidebar .nav>li>a {
        color: #b2b2b2
    }

    .flat-black .sidebar.sidebar-grid .nav>li>a {
        border-bottom: 1px solid #474747;
        border-top: 1px solid #474747
    }

    .flat-black .sidebar .active .sub-menu>li.active>a,
    .flat-black .sidebar .nav>li.active>a,
    .flat-black .sidebar .nav>li>a:focus,
    .flat-black .sidebar .nav>li>a:hover,
    .flat-black .sidebar .sub-menu>li>a:focus,
    .flat-black .sidebar .sub-menu>li>a:hover,
    .sidebar .nav>li.nav-profile>a {
        color: #fff
    }

    .flat-black .sidebar .sub-menu>li>a,
    .flat-black .sidebar .sub-menu>li>a:before {
        color: #999
    }

    .flat-black .page-with-light-sidebar .sidebar .active .sub-menu>li.active>a,
    .flat-black .page-with-light-sidebar .sidebar .active .sub-menu>li.active>a:focus,
    .flat-black .page-with-light-sidebar .sidebar .active .sub-menu>li.active>a:hover,
    .flat-black .page-with-light-sidebar .sidebar .nav>li.active>a,
    .flat-black .page-with-light-sidebar .sidebar .nav>li.active>a:focus,
    .flat-black .page-with-light-sidebar .sidebar .nav>li.active>a:hover {
        color: #000
    }

    .flat-black .page-sidebar-minified .sidebar .nav>li.has-sub:focus>a,
    .flat-black .page-sidebar-minified .sidebar .nav>li.has-sub:hover>a {
        background: #323232
    }

    .flat-black .page-sidebar-minified .sidebar .nav li.has-sub>.sub-menu,
    .flat-black .sidebar .nav>li.active>a,
    .flat-black .sidebar .nav>li.active>a:focus,
    .flat-black .sidebar .nav>li.active>a:hover,
    .flat-black .sidebar .nav>li.nav-profile,
    .flat-black .sidebar .sub-menu>li.has-sub>a:before,
    .flat-black .sidebar .sub-menu>li:before,
    .flat-black .sidebar .sub-menu>li>a:after {
        background: #2A2A2A
    }

    .flat-black .page-sidebar-minified .sidebar .sub-menu>li:before,
    .flat-black .page-sidebar-minified .sidebar .sub-menu>li>a:after {
        background: #3e3e3e
    }

    .flat-black .sidebar .nav>li.nav-profile .cover.with-shadow:before {
        background: rgba(42, 42, 42, .75)
    }

    .bg-white {
        background-color: #fff!important;
    }
    .p-10 {
        padding: 10px!important;
    }
    .media.media-xs .media-object {
        width: 32px;
    }
    .m-b-2 {
        margin-bottom: 2px!important;
    }
    .media>.media-left, .media>.pull-left {
        padding-right: 15px;
    }
    .media-body, .media-left, .media-right {
        display: table-cell;
        vertical-align: top;
    }
    select.form-control:not([size]):not([multiple]) {
        height: 34px;
    }
    .form-control.input-inline {
        display: inline;
        width: auto;
        padding: 0 7px;
    }


    .timeline {
        list-style-type: none;
        margin: 0;
        padding: 0;
        position: relative
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 5px;
        bottom: 5px;
        width: 5px;
        background: #2d353c;
        left: 20%;
        margin-left: -2.5px
    }

    .timeline>li {
        position: relative;
        min-height: 50px;
        padding: 20px 0
    }

    .timeline .timeline-time {
        position: absolute;
        left: 0;
        width: 18%;
        text-align: right;
        top: 30px
    }

    .timeline .timeline-time .date,
    .timeline .timeline-time .time {
        display: block;
        font-weight: 600
    }

    .timeline .timeline-time .date {
        line-height: 16px;
        font-size: 12px
    }

    .timeline .timeline-time .time {
        line-height: 24px;
        font-size: 20px;
        color: #242a30
    }

    .timeline .timeline-icon {
        left: 15%;
        position: absolute;
        width: 10%;
        text-align: center;
        top: 40px
    }

    .timeline .timeline-icon a {
        text-decoration: none;
        width: 20px;
        height: 20px;
        display: inline-block;
        border-radius: 20px;
        background: #d9e0e7;
        line-height: 10px;
        color: #fff;
        font-size: 14px;
        border: 5px solid #2d353c;
        transition: border-color .2s linear
    }

    .timeline .timeline-body {
        margin-left: 23%;
        margin-right: 17%;
        background: #fff;
        position: relative;
        padding: 20px 25px;
        border-radius: 6px
    }

    .timeline .timeline-body:before {
        content: '';
        display: block;
        position: absolute;
        border: 10px solid transparent;
        border-right-color: #fff;
        left: -20px;
        top: 20px
    }

    .timeline .timeline-body>div+div {
        margin-top: 15px
    }

    .timeline .timeline-body>div+div:last-child {
        margin-bottom: -20px;
        padding-bottom: 20px;
        border-radius: 0 0 6px 6px
    }

    .timeline-header {
        padding-bottom: 10px;
        border-bottom: 1px solid #e2e7eb;
        line-height: 30px
    }

    .timeline-header .userimage {
        float: left;
        width: 34px;
        height: 34px;
        border-radius: 40px;
        overflow: hidden;
        margin: -2px 10px -2px 0
    }

    .timeline-header .username {
        font-size: 16px;
        font-weight: 600
    }

    .timeline-header .username,
    .timeline-header .username a {
        color: #2d353c
    }

    .timeline img {
        max-width: 100%;
        display: block
    }

    .timeline-content {
        letter-spacing: .25px;
        line-height: 18px;
        font-size: 13px
    }

    .timeline-content:after,
    .timeline-content:before {
        content: '';
        display: table;
        clear: both
    }

    .timeline-title {
        margin-top: 0
    }

    .timeline-footer {
        background: #fff;
        border-top: 1px solid #e2e7ec;
        padding-top: 15px
    }

    .timeline-footer a:not(.btn) {
        color: #575d63
    }

    .timeline-footer a:not(.btn):focus,
    .timeline-footer a:not(.btn):hover {
        color: #2d353c
    }

    .timeline-likes {
        color: #6d767f;
        font-weight: 600;
        font-size: 12px
    }

    .timeline-likes .stats-right {
        float: right
    }

    .timeline-likes .stats-total {
        display: inline-block;
        line-height: 20px
    }

    .timeline-likes .stats-icon {
        float: left;
        margin-right: 5px;
        font-size: 9px
    }

    .timeline-likes .stats-icon+.stats-icon {
        margin-left: -2px
    }

    .timeline-likes .stats-text {
        line-height: 20px
    }

    .timeline-likes .stats-text+.stats-text {
        margin-left: 15px
    }

    .timeline-comment-box {
        background: #f2f3f4;
        margin-left: -25px;
        margin-right: -25px;
        padding: 20px 25px
    }

    .timeline-comment-box .user {
        float: left;
        width: 34px;
        height: 34px;
        overflow: hidden;
        border-radius: 30px
    }

    .timeline-comment-box .user img {
        max-width: 100%;
        max-height: 100%
    }

    .timeline-comment-box .user+.input {
        margin-left: 44px
    }

    .lead {
        margin-bottom: 20px;
        font-size: 21px;
        font-weight: 300;
        line-height: 1.4;
    }

    .text-danger, .text-red {
        color: #ff5b57!important;
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
                                            <!-- <div class="device-details" style="background:red; z-index:1;"></div> -->
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
                                                                    <li class="nav-item" id="nav_link-avg_data">
                                                                        <a class="nav-link active" aria-current="page" href="#tab_avg_data" data-toggle="tab" >Avg. Data</a>
                                                                    </li>
                                                                    <li class="nav-item" id="nav_link-live_data">
                                                                        <a class="nav-link" href="#tab_live_data" data-toggle="tab">Live Data <i id="btn_refresh_live_data" class="btn fas fa-sync-alt" hidden></i></a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade active show" id="tab_avg_data">
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
                                                                                            <span><b>Duration  : </b> {{$device->logs->count()>0? $device->logs[0]->step_run_sec : "No Data"}}</span><br/>
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
                                                                    <div class="tab-pane fade active show" id="tab_live_data" hidden>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 box ">
                                                                                <!-- begin timeline -->
                                                                                <ul class="timeline" id="live_data_rows">
                                                                                    <li>
                                                                                        <!-- begin timeline-time -->
                                                                                        <div class="timeline-time">
                                                                                            <!-- <span class="date">today</span> -->
                                                                                            <span class="time">04:20:00</span>
                                                                                        </div>
                                                                                        <!-- end timeline-time -->
                                                                                        <!-- begin timeline-icon -->
                                                                                        <div class="timeline-icon">
                                                                                            <a href="javascript:;">&nbsp;</a>
                                                                                        </div>
                                                                                        <!-- end timeline-icon -->
                                                                                        <!-- begin timeline-body -->
                                                                                        <div class="timeline-body">
                                                                                            <div class="timeline-header">
                                                                                                <span class="userimage"><img src="/images/running.gif" alt=""></span>
                                                                                                <span class="username"><a href="javascript:;">Running </a> <small></small></span>
                                                                                                <span class="pull-right text-muted"></span>
                                                                                            </div>
                                                                                            <div class="timeline-content">

                                                                                                <p>Step : <b>Purify</b><br/><br/>
                                                                                                    Conductivity : <b>100 us/cm</b><br/><br/>
                                                                                                    Voltage : <b>1.0 V</b><br/><br/>
                                                                                                    Flow : <b>6 ltrs/min</b><br/><br/>
                                                                                                    Pressure : <b>1.5 bar</b>

                                                                                                </p>
                                                                                            </div>

                                                                                        </div>
                                                                                        <!-- end timeline-body -->
                                                                                    </li>
                                                                                </ul>
                                                                            <!-- end timeline -->
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


    $('#nav_link-avg_data').on('click', function(){
        $('#tab_live_data').hide();
        $('#tab_avg_data').show();
        $('#btn_refresh_live_data').attr('hidden', true);

    })
    $('#nav_link-live_data').on('click', function(){
        $('#btn_refresh_live_data').attr('hidden', false);
        $('#tab_avg_data').hide();
        $('#tab_live_data').attr('hidden',false);
        $('#tab_live_data').show();
    })
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
        $('.loader').hide();
        setInterval(function(){
            var dt = new Date();
            var hr = dt.getHours();
            if(parseInt(hr)<10)
                hr = "0"+hr;
            var min = dt.getMinutes();
            if(parseInt(min)<10)
                min = "0"+min;
            var sec = dt.getSeconds();
            if(parseInt(sec)<10)
                sec = "0"+sec;

            var time = hr + ":" + min + ":" + sec;
            $('#live_data_rows').prepend("<li><div class=\"timeline-time\"><span class=\"time\">"+time+"</span></div>"+
            "<div class=\"timeline-icon\"><a href=\"javascript:;\">&nbsp;</a></div>"+
            "<div class=\"timeline-body\"><div class=\"timeline-header\"><span class=\"userimage\"><img src=\"/images/running.gif\"></span>"+
            "<span class=\"username\"><a href=\"javascript:;\">Running </a> <small></small></span>"+
            "<span class=\"pull-right text-muted\"></span></div>"+
            "<div class=\"timeline-content\"><p>Step : <b>Purify</b><br/><br/>"+
            "Conductivity : <b>100 us/cm</b><br/><br/>"+
            "Voltage : <b>1.0 V</b><br/><br/>"+
            "Flow : <b>6 ltrs/min</b><br/><br/>"+
            "Pressure : <b>1.5 bar</b>"+
            "</p></div></div></li>");
            highlight($('#live_data_rows:first .timeline-body:first'));
        }, 5000);
        function highlight(obj){
            var orig = obj.css('background');
            obj.css('background', '#87bde6');
            setTimeout(function(){
                    obj.css('background',orig);
            }, 2000);
        }
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



