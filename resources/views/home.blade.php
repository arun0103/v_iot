@extends('layouts.master')

@section('head')
<style>
    .card-tools i{
        padding-top:1px;
    }
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
    .modal-full {
        min-width: 100%;
        margin: 0;
    }
    .modal-full .modal-content {
        min-height: 100vh;
        min-width:100vw;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }

    .alarms-list{
        color:red;
    }
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
        /* background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249); */
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
        top: 0px;
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
        margin-right: 5%;
        background: #fff;
        position: relative;
        /* padding: 20px 15px; */
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
        margin-top: 5px
    }

    .timeline .timeline-body>div+div:last-child {
        margin-bottom: -20px;
        padding-bottom: 20px;
        border-radius: 0 0 6px 6px
    }

    .timeline-header {
        /* padding-bottom: 10px; */
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
                    @if($userDevices->count()>0)
                        @foreach($userDevices as $device)
                            <section id="{{$device->deviceDetails->id}}">
                                <div class="card">
                                    <h2 class="card-header"> <span id="device_name-{{$device->deviceDetails->id}}">{{$device->deviceDetails->serial_number}} </span>
                                        <!-- <button type="button" class="btn btn-primary btn_live_view" style="margin-left:10px">Live View</button> -->
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </h2>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-6 box">
                                                <div class="card card-outline card-success">
                                                    <h5 class="card-header">Status
                                                        <div class="card-tools">
                                                            <i class="btn fas fa-sync-alt btn-refresh" id="device-sync-{{$device->deviceDetails->id}}"></i>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </h5>
                                                    <div class="card-body">
                                                        <div>
                                                            <i id="device_status_pic-{{$device->deviceDetails->id}}" class="fas fa fa-certificate blink_me"></i>&nbsp;&nbsp;
                                                            <span id="device_status-{{$device->deviceDetails->id}}">{{$device->latest_log != null ? ($device->latest_log->step == 0 || $device->latest_log->step == 1 || $device->latest_log->step == 13 ?"Idle" : "RUNNING") : "No Data"}}</span>
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
                                                            <i id="device_connection_status-{{$device->deviceDetails->id}}">
                                                                @if($device->deviceDetails->latest_log != null)
                                                                    @if(Carbon\Carbon::now()->diffInMinutes($device->deviceDetails->latest_log->created_at) < 1)
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
                                                                            @if($device->deviceDetails->latest_log != null)
                                                                                <p>Last Data Received: <span id="last_data_received-{{$device->deviceDetails->id}}">{{$device->deviceDetails->latest_log->created_at}}</span></p>
                                                                            @endif
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
                                                    <h5 class="card-header">Volume
                                                        <div class="card-tools">
                                                            <i id="volume_chart-{{$device->deviceDetails->id}}" class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-volume-chart"></i>
                                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </h5>
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
                                                    <h5 class="card-header">Water Quality
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
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </h5>
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
                                                    <h5 class="card-header">Alarms
                                                        <div class="card-tools">
                                                        <i class="btn fas fa-table info_device_alarms_table" id="info_device_alarms_table-{{$device->deviceDetails->id}}"></i>

                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </h5>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                    @if($device->deviceDetails->latest_log != null)
                                                        <p hidden>Alarm Code: <span id="alarm_code_{{$device->deviceDetails->id}}">{{$device->deviceDetails->latest_log->alarm}}</span></p>
                                                        <section class="alarms-list" id="alarmsList_{{$device->deviceDetails->id}}" style="color:red"></section>
                                                    @endif
                                                    </div>
                                                    <!-- /.card-body -->
                                                    <div class="card-footer">
                                                        <div class="row flex">
                                                            <button id="btn_reset_alarms-{{$device->deviceDetails->id}}" class="btn btn-danger center btn_reset_alarms" hidden>Clear All Alarms</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="row" id="maintenance_tab-{{$device->deviceDetails->id}}">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <h5 class="card-header" >Routine Maintenance <button class="btn btn-sm btn-primary btn_edit_maintenance" id="btn_edit_maintenance-{{$device->deviceDetails->id}}">Edit</button>
                                                        <div class="card-tools">
                                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#{{$device->deviceDetails->id}}">
                                                                <i class="fas fa-minus"></i>
                                                            </button> -->
                                                        </div>
                                                    </h5>
                                                    <div class="card-body table-stripped table-responsive-md table-responsive-sm">
                                                        <table class="table ">
                                                            <tr>
                                                                <th><h3>Service</h3></th>
                                                                <th colspan="2" style="text-align:center"><h3>Setpoints</h3></th>
                                                                <th colspan="2" style="text-align:center"><h3>Actions</h3></th>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">Critic Acid</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="critic_acid_details-{{$device->deviceDetails->id}}">
                                                                        <b><span id="critic_acid_volume_left-{{$device->deviceDetails->id}}"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="critic_acid_error" id="critic_acid_error-{{$device->deviceDetails->id}}"></p>
                                                                </td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_critic_acid-{{$device->deviceDetails->id}}" class="form-control input_critic_acid" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->critic_acid: ''}}" disabled><span class="text-muted"> gal</span></td>
                                                                <td><button class="btn btn-primary btn-save-critic_acid" id="btn_save_critic_acid-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn_reset_critic_acid" id="btn_reset_critic_acid-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">Pre-filter</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="pre_filter_details-{{$device->deviceDetails->id}}">
                                                                        <b><span id="pre_filter_volume_left-{{$device->deviceDetails->id}}"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="pre_filter_error" id="pre_filter_error-{{$device->deviceDetails->id}}"></p></td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_pre_filter-{{$device->deviceDetails->id}}" class="form-control input_pre_filter" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->pre_filter: ''}}" disabled><span class="text-muted"> gal</span></td>
                                                                <td><button class="btn btn-primary btn-save-pre_filter" id="btn_save_pre_filter-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn_reset_pre_filter" id="btn_reset_pre_filter-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">Post-filter</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="post_filter_details-{{$device->deviceDetails->id}}">
                                                                        <b><span id="post_filter_volume_left-{{$device->deviceDetails->id}}"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="post_filter_error" id="post_filter_error-{{$device->deviceDetails->id}}"></p></td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_post_filter-{{$device->deviceDetails->id}}" class="form-control input_post_filter" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->post_filter: ''}}" disabled><span class="text-muted"> gal</span></td>
                                                                <td><button class="btn btn-primary btn-save-post_filter" id="btn_save_post_filter-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn_reset_post_filter" id="btn_reset_post_filter-{{$device->deviceDetails->id}}">Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">General</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="general_service_details-{{$device->deviceDetails->id}}">
                                                                        <b><span id="general_service_volume_left-{{$device->deviceDetails->id}}"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="general_service_error" id="general_service_error-{{$device->deviceDetails->id}}"></p></td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_general_service-{{$device->deviceDetails->id}}" class="form-control input_general_service" value="{{$device->deviceDetails->device_settings!= null ? $device->deviceDetails->device_settings->general_service: ''}}" disabled><span class="text-muted"> gal</span></td>
                                                                <td><button class="btn btn-primary  btn-save-general_service" id="btn_save_general_service-{{$device->deviceDetails->id}}" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger  btn_reset_general_service" id="btn_reset_general_service-{{$device->deviceDetails->id}}">Reset</button></td>
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
                                    <span>This is your dashboard. </br>
                                           Your access to the device have been revoked by the reseller <br/>
                                           Please contact your reseller
                                        </span></br>
                                    </div>
                                    <!-- /.card-body -->
                                    <!-- <div class="card-footer">
                                        @if(Auth::user()->role == 'U')
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-new-device">Add New Device</button>
                                        @endif
                                        @if(Auth::user()->role == 'R')
                                        <a href="{{route('devices')}}"><button class="btn btn-primary">Add New Device</button></a>
                                        @endif
                                    </div> -->
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
    <div class="modal fade" id="modal-live_view">
        <div class="modal-dialog modal-full" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-live-title"></h4>
                    <button type="button" class="close close_live_view btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <!-- begin timeline -->
                            <ul class="timeline" id="live_data_rows">
                                <li>
                                    <div class="timeline-time"><span class="time" id="live_start_time"></span></div>
                                    <div class="timeline-icon"><a href="javascript:;">&nbsp;</a></div>
                                    <div class="timeline-body">
                                        <div class="timeline-header">Live View Started</div>
                                        <div class="timeline-content">Waiting data from device</div>
                                    </div>
                                <li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left close_live_view"  data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-view_alarms_history">
        <div class="modal-dialog modal-full" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-alarms_history-title"></h4>
                    <button type="button" class="close close_alarms_history btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <!-- begin timeline -->
                            <ul class="timeline" id="alarms_history_row">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left close_alarms_history"  data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <!-- <script type="module" src="{{asset('js/home.js')}}"></script> -->

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // get all User devices latest setpoints

        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getMyDevicesSetpoints",
        })
        .done(function(response){
            // console.log("********** devices *******");
            // console.log(response)
        })

        // get the setpoints from the database and save for future calculations
        // CIP_cycle, volume unit are two setpoints that is needed to calculate live view data
        var userDevices;
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getUserDevicesSetpointsForCalculation",
        })
        .done(function(response){
            console.log(response);
            userDevices = response;
        });
        $('.volume_custom_time').hide();
        $('#btn_reload_graph').hide();
        $('#volumeChart').hide();
        $('.loader').hide();
        var start_stop_command_sent = [];
        var command_sent = "";
        var command_sent_time = null;
        // Live view
            var is_live_view = false;
            var view_live_device = null;
            setInterval(function(){
                if(view_live_device == null){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "GET",
                        url: "/refreshUserDashboardData",
                    })
                    .done(function(response){
                        console.log("% % % %  Refreshing Dashboad Data % % % % %")
                        console.log(response);
                        console.log("% % % % % % % % % % % % % % %  % % % % % % % ")
                        // console.log("command sent time: "+ command_sent_time)
                        for(var i=0; i<response.length;i++){
                            if(response[i]['deviceDetails'].latest_log != null){
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeAttr("hidden");

                                //change the status if new data is available
                                    if(start_stop_command_sent[response[i]['deviceDetails'].id] != true && +new Date(response[i]['deviceDetails'].latest_log.log_dt) >= command_sent_time){
                                        var status = "";
                                        var color = "";
                                        // change the status
                                        if(response[i]['deviceDetails'].latest_log.step == 0 || response[i]['deviceDetails'].latest_log.step == 1 || response[i]['deviceDetails'].latest_log.step == 13){
                                            status = "IDLE";
                                            color = "orange";
                                            $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).text("Start");
                                            $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeClass('btn-danger').addClass('btn-primary')
                                        }else{
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
                                            // console.log("*************** Response of command ****************");
                                            // console.log(response_command);
                                            if(response_command.device_read_at != null){
                                                start_stop_command_sent[response_command.device_id] = false;
                                                command_sent_time = +new Date(response_command.device_read_at);
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
                                // connection status
                                    var test_now = new Date();
                                    var test_created_at = new Date(response[i]['deviceDetails'].latest_log.created_at);
                                    var dd = test_now - test_created_at;
                                    if(dd < 25*1000){ // 25 seconds
                                        $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Connected").css("color","green")
                                    }else{
                                        $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Disconnected").css("color","red")
                                    }
                                    $('#last_data_received-'+response[i]['deviceDetails'].id ).text(new Date(response[i]['deviceDetails']['latest_log'].created_at))
                                // change volume
                                    $('#daily_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].daily +" gal" : "");
                                    $('#monthly_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].monthly +" gal" : "");
                                    $('#total_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].total +" gal" : "");
                                // change alarm
                                    var alarms = response[i]['deviceDetails'].latest_log.alarm;
                                    if(alarms >0){
                                        $('#btn_reset_alarms-'+response[i]['deviceDetails'].id).removeAttr("hidden");
                                    }else{
                                        $('#btn_reset_alarms-'+response[i]['deviceDetails'].id).attr("hidden","true");
                                    }
                                    var bin_alarms = (alarms >>> 0).toString(2); // changing alarms to binary
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
                                        $('#info_device_conductivity_text-'+response[i]['deviceDetails'].id).text("On Target").css("color","green")
                                        $('#info_device_conductivity_description-'+response[i]['deviceDetails'].id).text("The unit is removing the right amount of minerals.")
                                        // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'green';
                                        document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'green';
                                        document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'green';
                                    }else{
                                        water_quality = "Needs Attention ";
                                        $('#info_device_conductivity_text-'+response[i]['deviceDetails'].id).text("Needs Attention").css("color","red")
                                        $('#info_device_conductivity_description-'+response[i]['deviceDetails'].id).text("The unit is removing most of the minerals. ")
                                        // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'red';
                                        document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'red';
                                        document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'red';
                                    }
                                    $('#device-info-'+response[i]['deviceDetails'].id +' .ec').text(water_quality); // row water quality
                                    $('#device_conductivity_value-'+response[i]['deviceDetails'].id).text(water_quality); // device info water quality

                                // maintenance
                                //critic acid
                                var critic_acid_reset_value = response[i]['deviceDetails']['latest_maintenance_critic_acid']!=null?response[i]['deviceDetails']['latest_maintenance_critic_acid'].volume_value:0;
                                var pre_filter_reset_value = response[i]['deviceDetails']['latest_maintenance_pre_filter']!=null?response[i]['deviceDetails']['latest_maintenance_pre_filter'].volume_value:0;
                                var post_filter_reset_value = response[i]['deviceDetails']['latest_maintenance_post_filter']!=null?response[i]['deviceDetails']['latest_maintenance_post_filter'].volume_value:0;
                                var general_service_reset_value = response[i]['deviceDetails']['latest_maintenance_general_service']!=null?response[i]['deviceDetails']['latest_maintenance_general_service'].volume_value:0;

                                var volume_left_critic_acid = response[i]['deviceDetails']['device_settings'].critic_acid - response[i]['deviceVolume'].total + critic_acid_reset_value ;
                                var volume_left_pre_filter = response[i]['deviceDetails']['device_settings'].pre_filter - response[i]['deviceVolume'].total + pre_filter_reset_value ;
                                var volume_left_post_filter = response[i]['deviceDetails']['device_settings'].post_filter - response[i]['deviceVolume'].total + post_filter_reset_value ;
                                var volume_left_general_service = response[i]['deviceDetails']['device_settings'].general_service - response[i]['deviceVolume'].total + general_service_reset_value ;
                                //check if maintenance needed
                                var is_maintenance_needed = false;
                                if(volume_left_critic_acid < 0){
                                    volume_left_critic_acid = 0;
                                    is_maintenance_needed = true;
                                    $('#critic_acid_details-'+response[i]['deviceDetails'].id).attr("hidden","true");
                                    $('#critic_acid_error-'+response[i]['deviceDetails'].id).text("Critic acid refill needed!").css("color","red");
                                }
                                if(volume_left_pre_filter < 0){
                                    volume_left_pre_filter = 0;
                                    is_maintenance_needed = true;
                                    $('#pre_filter_details-'+response[i]['deviceDetails'].id).attr("hidden","true");
                                    $('#pre_filter_error-'+response[i]['deviceDetails'].id).text("Pre-filter replacement needed!").css("color","red");
                                }
                                if(volume_left_post_filter < 0){
                                    volume_left_post_filter = 0;
                                    is_maintenance_needed = true;
                                    $('#post_filter_details-'+response[i]['deviceDetails'].id).attr("hidden","true");
                                    $('#post_filter_error-'+response[i]['deviceDetails'].id).text("Post-filter replacement needed!").css("color","red");
                                }
                                if(volume_left_general_service < 0){
                                    volume_left_general_service = 0;
                                    is_maintenance_needed = true;
                                    $('#general_service_details-'+response[i]['deviceDetails'].id).attr("hidden","true");
                                    $('#general_service_error-'+response[i]['deviceDetails'].id).text("General service needed!").css("color","red");
                                }
                                if(is_maintenance_needed)
                                    $('section#alarmsList_'+response[i]['deviceDetails'].id).append('<a class="goto_maintenance" id="goto_maintenance-'+response[i]['deviceDetails'].id+'"><p><button class="btn btn-warning btn_goto_maintenance">Routine Maintenance Needed</button></p><a>');
                                $('#critic_acid_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_critic_acid.toFixed(2));
                                $('#pre_filter_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_pre_filter.toFixed(2));
                                $('#post_filter_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_post_filter.toFixed(2));
                                $('#general_service_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_general_service.toFixed(2));

                            }
                        }
                    });
                }
            }, 5000);
            //for live view
            var device_data_created_at = null;
            setInterval(function(){
                if(view_live_device != null){
                    console.log("view is not null")
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "GET",
                        url: "/deviceLiveData/"+ view_live_device,
                    })
                    .done(function(response){
                        console.log("LLLLLLLLLLL Live Data of id : " + view_live_device)
                        console.log(response);
                        if(device_data_created_at != response.created_at){
                            device_data_created_at = response.created_at;
                            var recorded_date = new Date(response.created_at);
                            recorded_date = recorded_date.toString();
                            var status = "";
                            if(response.step == 0 ||response.step == 1 || response.step ==13)
                                status = "IDLE"
                            else
                                status ="RUNNING"

                            //calculating step
                            var step_name = "";
                            switch(response.step){
                                case 255: step_name = " PCB restart";break;
                                case 0: step_name = " Free Run";break;
                                case 1: step_name = " Idle";break;
                                case 2: step_name = " Prepurify";break;
                                case 3: step_name = " Purify";break;
                                case 4: step_name = " Waste";break;
                                case 5: step_name = " High Flow Waste";break;
                                case 6: step_name = " Wait";break;
                                case 7: step_name = " CIP Dosing ON";break;
                                case 8: step_name = " CIP Dosing OFF";break;
                                case 9: step_name = " CIP Pulse ON";break;
                                case 10: step_name = " CIP Pulse OFF";break;
                                case 11: step_name = " CIP Flush";break;
                                case 12: step_name = " High Temperature";break;
                                case 13: step_name = " Wait High Temperature";break;
                                case 14: step_name = " SHUNT";break;
                                case 15: step_name = " Wait Before CIP Start";break;
                            }
                            // calculating input
                            var input_binary_string = response.input.toString(2);
                            if(input_binary_string.length < 5){
                                for(var i = input_binary_string.length; i<5;i++){
                                    input_binary_string = "0".concat(input_binary_string);
                                }
                            }
                            var input_names = [];
                            for(var i =0 ; i<input_binary_string.length; i++){
                                if(input_binary_string.charAt(i)=='1')
                                    input_names.push("HIGH");
                                else
                                    input_names.push("LOW");
                            }
                            // calculating output
                            var output_binary_string = response.output.toString(2);
                            if(output_binary_string.length < 9){
                                for(var i = output_binary_string.length; i<9; i++){
                                    output_binary_string = "0".concat(output_binary_string);
                                }
                            }
                            console.log("Output : "+output_binary_string);
                            var output_names = [];
                            for(var i =0 ; i<output_binary_string.length; i++){
                                if(output_binary_string.charAt(i)=='1') // 1 = OFF, 0 = ON
                                    output_names.push('<span style="color:red">OFF</span>');
                                else
                                    output_names.push('<span style="color:green">ON</span>');
                            }

                            // calculating alarms
                            var alarms = response.alarm;
                            var bin_alarms = (alarms >>> 0).toString(2);
                            for(var ii = bin_alarms.length; ii<24 ; ii++){
                                bin_alarms = "0"+bin_alarms;
                            }
                            var alarm_names = [];
                            for(var  j= 0 ; j < bin_alarms.length ; j++){
                                if(bin_alarms[j] == "1"){ // 1 states that there is alarm so find the location of alarm and display
                                    switch(j){
                                        case 0: alarm_names.push('<div style="color:red">&nbsp;Reserved For future</div>');break;
                                        case 1: alarm_names.push('<div style="color:red">&nbsp;Reserved For future</div>');break;
                                        case 2: alarm_names.push('<div style="color:red">&nbsp;Reserved For future</div>');break;
                                        case 3: alarm_names.push('<div style="color:red">&nbsp;FLOWMETER COMM ERROR</div>');break;
                                        case 4: alarm_names.push('<div style="color:red">&nbsp;ATLAS TEMPERATURE ERROR</div>');break;
                                        case 5: alarm_names.push('<div style="color:red">&nbsp;ZERO EC ALARM</div>');break;
                                        case 6: alarm_names.push('<div style="color:red">&nbsp;ATLAS I2C COM ERROR</div>');break;
                                        case 7: alarm_names.push('<div style="color:red">&nbsp;LOW PRESSURE ALARM</div>');break;
                                        case 8: alarm_names.push('<div style="color:red">&nbsp;PAE AC INPUT FAIL</div>');break;
                                        case 9: alarm_names.push('<div style="color:red">&nbsp;PAE AC POWER DOWN</div>');break;
                                        case 10:alarm_names.push('<div style="color:red">&nbsp;PAE HIGH TEMPERATURE</div>');break;
                                        case 11:alarm_names.push('<div style="color:red">&nbsp;PAE AUX OR SMPS FAIL</div>');break;
                                        case 12:alarm_names.push('<div style="color:red">&nbsp;PAE FAN FAIL</div>');break;
                                        case 13:alarm_names.push('<div style="color:red">&nbsp;PAE OVER TEMP SHUTDOWN</div>');break;
                                        case 14:alarm_names.push('<div style="color:red">&nbsp;PAE OVER LOAD SHUTDOWN</div>');break;
                                        case 15:alarm_names.push('<div style="color:red">&nbsp;PAE OVER VOLT SHUTDOWN</div>');break;
                                        case 16:alarm_names.push('<div style="color:red">&nbsp;PAE COMMUNICATION ERROR</div>');break;
                                        case 17:alarm_names.push('<div style="color:red">&nbsp;CIP LOW LEVEL ALARM</div>');break;
                                        case 18:alarm_names.push('<div style="color:red">&nbsp;WASTE VALVE ALARM</div>');break;
                                        case 19:alarm_names.push('<div style="color:red">&nbsp;LEAKAGE ALARM</div>');break;
                                        case 20:alarm_names.push('<div style="color:red">&nbsp;CABINET TEMP ALARM</div>');break;
                                        case 21:alarm_names.push('<div style="color:red">&nbsp;BYPASS ALARM</div>');break;
                                        case 22:alarm_names.push('<div style="color:red">&nbsp;LOW FLOW WASTE ALARM</div>');break;
                                        case 23:alarm_names.push('<div style="color:red">&nbsp;LOW FLOW PURE ALARM</div>');break;
                                    }
                                }
                            }
                            //calculate mode
                            var mode_name ="";
                            switch(response.mode){
                                case "0" : mode_name="LOGOUT";break;
                                case "1" : mode_name="AUTO";break;
                                case "2" : mode_name="MANUAL FLUSH";break;
                                case "3" : mode_name="MANUAL CIP";break;
                            }

                            //calculate volume and flow according to volume_unit setpoint
                            var volume, volume_unit;
                            var flow , flow_unit;
                            var device_setpoint_volume_unit = userDevices.find(device_id =>device_id = view_live_device).volume_unit;
                            switch(device_setpoint_volume_unit){
                                case 0 :
                                        volume = response.tpv;
                                        volume_unit = "L";
                                        flow = response.c_flow.toFixed(2);
                                        flow_unit = "LPM";
                                    break;
                                case 1 :
                                    volume = (response.tpv*0.2642007926).toFixed(2);
                                        volume_unit = "gal";
                                        flow = (response.c_flow*0.2642007926).toFixed(2);
                                        flow_unit = "GPM";
                                    break;
                            }
                            // calculate cycles left
                            var device_setpoint_CIP_cycles = userDevices.find(device_id =>device_id = view_live_device).CIP_cycles;
                            var cycles_left = device_setpoint_CIP_cycles - response.cycle;
                            if(cycles_left < 0)
                                cycles_left = 0;
                            $('#live_data_rows').prepend('<li><div class="timeline-time"><span class="time">'+recorded_date+'</span></div>'+
                                    '<div class="timeline-icon"><a href="javascript:;">&nbsp;</a></div>'+
                                    '<div class="timeline-body">'+
                                    '<div class="timeline-header">'+
                                            '<span class="userimage"><img src="/images/running.gif"></span>'+
                                            '<span class="username">'+status +'<small>'+step_name+'</small></span>'+
                                            '<span class="pull-right text-muted">[Run Sec:'+response.step_run_sec+'] </span>'+
                                            '<span style="float:right;"><i>[LOGGED AT:'+response.log_dt+'] UTC </i></span>'+
                                        '</div>'+
                                        '<div class="timeline-content">'+
                                            '<div class="row">'+
                                                '<div class="col-sm-6">'+
                                                    '<span>Cycles left before next CIP : '+cycles_left+' cycles</span><br/>'+
                                                    '<span>FLOW : '+flow+' '+flow_unit+'</span><br/>'+
                                                    '<span>PUMP SPEED : '+(response.aov/0.05).toFixed(2)+'%</span><br/>'+
                                                    '<span>CABINET TEMPERATURE : '+response.c_temp+' \xB0C</span><br/>'+
                                                    '<span>AVG. CONDUCTIVITY(EC) : '+response.ec+' \xB5s/cm</span><br/>'+
                                                    // '<span>MODE :'+mode_name+'</span>'+
                                                '</div>'+
                                                '<div class="col-sm-6">'+
                                                    // '<span>STEP :'+step_name+'</span><br/>'+
                                                    '<span>PRESSURE : '+response.pressure.toFixed(2)+' bar</span><br/>'+
                                                    '<span>PAE VOLTAGE : '+response.pae_volt+' V</span><br/>'+
                                                    '<span>RECOVERY : '+response.percentage_recovery+'%</span><br/>'+
                                                    '<span>WATER TEMPERATURE : '+response.w_temp+' \xB0C</span><br/>'+
                                                    '<span>TOTAL PURE VOLUME : '+volume+' '+volume_unit+'</span><br/>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-sm-12">'+
                                                    '<table class="table">'+
                                                        '<tr><th colspan="5" style="text-align:center;color:blue">DIGITAL INPUT</th></tr>'+
                                                        '<tr>'+
                                                            '<th>LEVEL</th>'+
                                                            '<th>BYPASS</th>'+
                                                            '<th>LEAKAGE</th>'+
                                                            '<th>SIGNAL</th>'+
                                                            '<th>SPARE</th>'+
                                                        '</tr>'+
                                                        '<tr>'+
                                                            '<td>'+input_names[4]+'</td>'+
                                                            '<td>'+input_names[3]+'</td>'+
                                                            '<td>'+input_names[2]+'</td>'+
                                                            '<td>'+input_names[1]+'</td>'+
                                                            '<td>'+input_names[0]+'</td>'+
                                                        '</tr>'+
                                                    '</table>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row">'+
                                                '<div class="col-sm-12">'+
                                                    '<table class="table">'+
                                                        '<tr><th colspan="9" style="text-align:center;color:blue">OUTPUT</th></tr>'+
                                                        '<tr>'+
                                                            '<th>MIV</th>'+
                                                            '<th>BYPASS</th>'+
                                                            '<th>POV</th>'+
                                                            '<th>WOV</th>'+
                                                            '<th>CIP</th>'+
                                                            '<th>SHUNT</th>'+
                                                            '<th>POLARITY</th>'+
                                                            '<th>PAE</th>'+
                                                            '<th>SPARE</th>'+
                                                        '</tr>'+
                                                        '<tr>'+
                                                            '<td>'+output_names[15]+'</td>'+
                                                            '<td>'+output_names[14]+'</td>'+
                                                            '<td>'+output_names[13]+'</td>'+
                                                            '<td>'+output_names[12]+'</td>'+
                                                            '<td>'+output_names[11]+'</td>'+
                                                            '<td>'+output_names[10]+'</td>'+
                                                            '<td>'+output_names[9]+'</td>'+
                                                            '<td>'+output_names[8]+'</td>'+
                                                            '<td>'+output_names[7]+'</td>'+
                                                        '</tr>'+
                                                    '</table>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row" style="border:1px solid black; margin:5px">'+
                                                '<div class="col-sm-12"><h4>ALARMS</h4></div>'+
                                                    alarm_names+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</li>');
                            highlight($('#live_data_rows:first .timeline-body:first'));
                        }
                    });
                }
            }, 5000);
            function highlight(obj){
                var orig = obj.css('background');
                obj.css('background', '#87bde6');
                setTimeout(function(){
                        obj.css('background',orig);
                }, 2000);
            }
            $('.close_live_view').on("click", function(){
                is_live_view = false;
                view_live_device = null;
            })
            $('.btn_live_view').on('click', function(){
                var now = new Date();
                $('#live_start_time').text(now);
                var device_id = $(this).closest('section').attr('id');
                is_live_view = true;
                view_live_device = device_id;
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "GET",
                    url: "/getUserDevicesSetpointsForCalculation",
                })
                .done(function(response){
                    console.log(response);
                    userDevices = response;
                });
                $("#modal-live-title").text($('#device_name-'+view_live_device).text() + " : Live View");
                $('#modal-live_view').modal('show');
            })
        // End of live view
        // Maintenance
            $('.alarms-list').on('click','.goto_maintenance', function(){
                // alert('Hi')
                var trid = $(this).closest('section').attr('id'); // table row ID
                console.log(trid)
                trid = trid.replace("alarmsList_","");
                var element = document.getElementById("maintenance_tab-"+trid);
                console.log(element)
                element.scrollIntoView({behavior: "smooth", block: "end"})
            })
            var old_critic_value =[], old_pre_filter=[], old_post_filter=[], old_general_service=[];
            $('.btn_edit_maintenance').on('click',function(){
                var trid = $(this).closest('section').attr('id'); // table row ID
                console.log("maintenance clicked for "+trid)
                old_critic_value[trid] = $('.input_critic_acid').val();
                old_pre_filter[trid] = $('.input_pre_filter').val();
                old_post_filter[trid] = $('.input_post_filter').val();
                old_general_service[trid] = $('.input_general_service').val();
                $('.input_critic_acid').removeAttr("disabled").addClass("border border-primary");
                $('.input_pre_filter').removeAttr("disabled").addClass("border border-primary");
                $('.input_post_filter').removeAttr("disabled").addClass("border border-primary");
                $('.input_general_service').removeAttr("disabled").addClass("border border-primary");
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
                if($('#input_critic_acid-'+trid).val() >0 && $('#input_critic_acid-'+trid).val() <= 100000){
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
                if($('#input_pre_filter-'+trid).val() >0 && $('#input_pre_filter-'+trid).val() <= 100000){
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
                if($('#input_post_filter-'+trid).val() >0 && $('#input_post_filter-'+trid).val() <= 100000){
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
                if($('#input_general_service-'+trid).val() >0 && $('#input_general_service-'+trid).val() <= 100000){
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

            $('.btn_reset_critic_acid').on('click', function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Resetting this confirms that you have done your routine maintenance according to Voltea???s User Manuals Maintenance protocols. \nDo you want to continue?",
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
                            $('#critic_acid_error-'+device_id).text("").trigger("change");
                            $('#critic_acid_details-'+device_id).removeAttr("hidden");
                            $('#critic_acid_volume_left-'+device_id).text(critic_acid_reset_value);
                            Swal.fire('Done!','Critic acid refilled.','success')
                        })

                    }
                })

            })
            $('.btn_reset_pre_filter').on('click', function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Resetting this confirms that you have done your routine maintenance according to Voltea???s User Manuals Maintenance protocols. \nDo you want to continue?",
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
                            $('#pre_filter_error-'+device_id).text("").trigger("change");
                            $('#pre_filter_details-'+device_id).removeAttr("hidden");
                            $('#pre_filter_volume_left-'+device_id).text(pre_filter_reset_value).trigger("change");
                            Swal.fire('Done!','Pre-filter replaced.','success')
                        })

                    }
                })

            })
            $('.btn_reset_post_filter').on('click', function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Resetting this confirms that you have done your routine maintenance according to Voltea???s User Manuals Maintenance protocols. \nDo you want to continue?",
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
                            $('#post_filter_error-'+device_id).text("").trigger("change");
                            $('#post_filter_details-'+device_id).removeAttr("hidden");
                            $('#post_filter_volume_left-'+device_id).text(post_filter_reset_value).trigger("change");
                            Swal.fire('Done!','Post filter replaced.','success')
                        })

                    }
                })

            })
            $('.btn_reset_general_service').on('click', function(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Resetting this confirms that you have done your routine maintenance according to Voltea???s User Manuals Maintenance protocols. Do you want to continue?",
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
                            $('#general_service_error-'+device_id).text("").trigger("change");
                            $('#general_service_details-'+device_id).removeAttr("hidden");
                            $('#general_service_volume_left-'+device_id).text(general_service_reset_value).trigger("change");
                            Swal.fire('Done!','General Service performed.','success')
                        })

                    }
                })

            })
        //end of maintenance

        $('.info-device-status').on('click', function(){
            console.log("hi")
            var trid = $(this).closest('section').attr('id'); // table row ID
            console.log(trid)
            switch($('#device_status-'+trid).text()){
                case 'RUNNING':
                    $('#info_device_status_text-'+trid).text("Running")
                    $('#info_device_status_description-'+trid).text('')
                    $('#info_device_status_description-'+trid).append("<b>(Don???t Worry)</b> Device is running and treating water ")
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
        // $('#info_conductivity').on('click', function(){
        //     $('#info_conductivity_text').text("Conductivity")
        //     $('#info_conductivity_description').text('')
        //     $('#info_conductivity_description').append("Conductivity is how we measure the amount of minerals content in the water.")
        // })
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
        $('.btn_reset_alarms').on('click', function(){
            var trid = $(this).closest('section').attr('id'); // table row ID
            Swal.fire({
                title: 'Are you sure?',
                text: "Have you resolved all the alarms?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clear it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Clearing alarms!',
                        html: 'Please Wait!',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/resetAllAlarms/"+ trid,
                    })
                    .done(function(response){
                        var read_database = true;
                        setInterval(function(){
                            if(read_database){

                                $.ajax({
                                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                    type: "GET",
                                    url: "/command_status/Reset-all-alarms/"+ trid,
                                })
                                .done(function(response){
                                    console.log(response);
                                    if(response.device_read_at != null){
                                        read_database = false;
                                        Swal.close();
                                        $('#btn_reset_alarms-'+trid).attr('hidden','true');
                                        Swal.fire({
                                            title: 'Restart Operation?',
                                            text: "Would you like to restart device?",
                                            icon: 'info',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes',
                                            cancelButtonText: 'No'
                                            }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({
                                                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                                    type: "POST",
                                                    url: "/command/start/"+ trid,
                                                })
                                                .done(function(response){
                                                    console.log(response);
                                                    Swal.fire('Success','Command recorded.','success')
                                                    start_stop_command_sent[trid] = true;
                                                    $('#device_status-'+trid).text('Pending')
                                                    document.getElementById('device_status-'+trid).style.color = 'black'
                                                    document.getElementById('device_status_pic-'+trid).style.color = 'black'
                                                    $('#btn_device_start_stop-'+trid).text('Starting')
                                                    $('#btn_device_start_stop-'+trid).removeClass('btn-primary').addClass('btn-danger')
                                                    $('#btn_device_start_stop-'+trid).attr('disabled','true');
                                                    // var date = new Date(response.created_at)
                                                    // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                                                });

                                            }
                                        })
                                    }
                                });
                            }
                        },5000);
                    });
                }
            })
        })
        $('.btn_device_start_stop').on('click', function(){
            var trid = $(this).closest('section').attr('id'); // table row ID
            switch($('#btn_device_start_stop-'+trid).text()){
                case "Stop":
                    command_sent = "Stop";
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/command/stop/"+ trid,
                    })
                    .done(function(response){
                        console.log(response);
                        Swal.fire('Success','Command recorded.','success')
                        start_stop_command_sent[trid] = true;
                        $('#device_status-'+trid).text('Pending')
                        document.getElementById('device_status-'+trid).style.color = 'black'
                        document.getElementById('device_status_pic-'+trid).style.color = 'black'
                        $('#btn_device_start_stop-'+trid).text('Stopping')
                        $('#btn_device_start_stop-'+trid).removeClass('btn-danger').addClass('btn-primary')
                        $('#btn_device_start_stop-'+trid).attr('disabled','true');
                        // var date = new Date(response.created_at)
                        // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                    break;
                case "Start":
                    command_sent = "Start";
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/command/start/"+ trid,
                    })
                    .done(function(response){
                        console.log(response);
                        Swal.fire('Success','Command recorded.','success')
                        start_stop_command_sent[trid] = true;
                        $('#device_status-'+trid).text('Pending')
                        document.getElementById('device_status-'+trid).style.color = 'black'
                        document.getElementById('device_status_pic-'+trid).style.color = 'black'
                        $('#btn_device_start_stop-'+trid).text('Starting')
                        $('#btn_device_start_stop-'+trid).removeClass('btn-primary').addClass('btn-danger')
                        $('#btn_device_start_stop-'+trid).attr('disabled','true');
                        // var date = new Date(response.created_at)
                        // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                    break;
            }

        })
        $('.info_device_alarms_table').on('click', function(){
            var trid = $(this).closest('section').attr('id'); // table row ID
            $('#modal-alarms_history-title').text("Alarms' History : " + $('#device_name-'+trid).text())
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/getDeviceAlarms/"+trid,
            })
            .done(function(response){
                console.log(response)
                for(var i=0 ;i< response.length; i++){
                    if(response[i].alarms != 0){
                        var alarm_names = calculateAlarm(response[i].alarms);
                        // console.log(alarm_names)
                        $('#alarms_history_row').prepend('<li><div class="timeline-time"><span class="time">'+ new Date(response[i].start)+'</span></div>'+
                            '<div class="timeline-icon"><a href="javascript:;">&nbsp;</a></div>'+
                            '<div class="timeline-body">'+
                                '<div class="timeline-header">'+
                                    '<span class="username">'+response[i].start +' - '+response[i].end+'</span>'+
                                '</div>'+
                                '<div class="timeline-content">'+
                                    alarm_names+
                                '</div>'+
                            '</div>'+
                        '</li>');
                    }
                }

            })

            $('#modal-view_alarms_history').modal('show');
        })

        function calculateAlarm(alarm_code){
            var alarms = alarm_code;
            var bin_alarms = (alarms >>> 0).toString(2);
            for(var ii = bin_alarms.length; ii<24 ; ii++){
                bin_alarms = "0"+bin_alarms;
            }
            var alarm_names = [];
            for(var  j= 0 ; j < bin_alarms.length ; j++){
                if(bin_alarms[j] == "1"){ // 1 states that there is alarm so find the location of alarm and display
                    switch(j){
                        case 0: alarm_names.push('<h5 style="color:red">&nbsp;Reserved For future</h5>');break;
                        case 1: alarm_names.push('<h5 style="color:red">&nbsp;Reserved For future</h5>');break;
                        case 2: alarm_names.push('<h5 style="color:red">&nbsp;Reserved For future</h5>');break;
                        case 3: alarm_names.push('<h5 style="color:red">&nbsp;FLOWMETER COMM ERROR</h5>');break;
                        case 4: alarm_names.push('<h5 style="color:red">&nbsp;ATLAS TEMPERATURE ERROR</h5>');break;
                        case 5: alarm_names.push('<h5 style="color:red">&nbsp;ZERO EC ALARM</h5>');break;
                        case 6: alarm_names.push('<h5 style="color:red">&nbsp;ATLAS I2C COM ERROR</h5>');break;
                        case 7: alarm_names.push('<h5 style="color:red">&nbsp;LOW PRESSURE ALARM</h5>');break;
                        case 8: alarm_names.push('<h5 style="color:red">&nbsp;PAE AC INPUT FAIL</h5>');break;
                        case 9: alarm_names.push('<h5 style="color:red">&nbsp;PAE AC POWER DOWN</h5>');break;
                        case 10:alarm_names.push('<h5 style="color:red">&nbsp;PAE HIGH TEMPERATURE</h5>');break;
                        case 11:alarm_names.push('<h5 style="color:red">&nbsp;PAE AUX OR SMPS FAIL</h5>');break;
                        case 12:alarm_names.push('<h5 style="color:red">&nbsp;PAE FAN FAIL</h5>');break;
                        case 13:alarm_names.push('<h5 style="color:red">&nbsp;PAE OVER TEMP SHUTDOWN</h5>');break;
                        case 14:alarm_names.push('<h5 style="color:red">&nbsp;PAE OVER LOAD SHUTDOWN</h5>');break;
                        case 15:alarm_names.push('<h5 style="color:red">&nbsp;PAE OVER VOLT SHUTDOWN</h5>');break;
                        case 16:alarm_names.push('<h5 style="color:red">&nbsp;PAE COMMUNICATION ERROR</h5>');break;
                        case 17:alarm_names.push('<h5 style="color:red">&nbsp;CIP LOW LEVEL ALARM</h5>');break;
                        case 18:alarm_names.push('<h5 style="color:red">&nbsp;WASTE VALVE ALARM</h5>');break;
                        case 19:alarm_names.push('<h5 style="color:red">&nbsp;LEAKAGE ALARM</h5>');break;
                        case 20:alarm_names.push('<h5 style="color:red">&nbsp;CABINET TEMP ALARM</h5>');break;
                        case 21:alarm_names.push('<h5 style="color:red">&nbsp;BYPASS ALARM</h5>');break;
                        case 22:alarm_names.push('<h5 style="color:red">&nbsp;LOW FLOW WASTE ALARM</h5>');break;
                        case 23:alarm_names.push('<h5 style="color:red">&nbsp;LOW FLOW PURE ALARM</h5>');break;

                    }
                }
            }
            return alarm_names
        }


        //chart
        var graph_time_frame, graph_custom_from, graph_custom_to;
        var graph_title, graph_labels, graph_x_label, graph_y_label, graph_data;
        var graph_displayed = "none";
        var volumeChart;
        $('#timeframe_volume').on('change', function(){
            graph_time_frame = $('#timeframe_volume').val();
            if(graph_time_frame != graph_displayed)
                $('#btn_reload_graph').prop('disabled', false);
            else
                $('#btn_reload_graph').prop('disabled', true);
            switch(graph_time_frame){
                case 'custom':
                    $('.volume_custom_time').show();
                    graph_title = "Water purified in "+ graph_custom_from + " to "+ graph_custom_to;
                    break;
                case 'last_hour':
                    $('.volume_custom_time').hide();
                    graph_title = "Water purified in Last Hour";
                    break;
                case 'last_24_hour':
                    graph_title = "Water purified in Last 24 Hours";
                    $('.volume_custom_time').hide();

                    break;
            }
            // volumeChart.update();
            $('#btn_reload_graph').show();
        })
        $('#btn_reload_graph').on('click', function(){
            //alert('reloading')
            var ctx_volume = document.getElementById('volumeChart').getContext('2d');
            switch(graph_time_frame){
                case 'custom':
                    graph_custom_from = $('#inputFromDate_volume').val();
                    graph_custom_to = $('#inputToDate_volume').val();
                    //fetch data from server
                    graph_labels = ['01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00'];
                    graph_data = [12,10,5,20,25,12,10,5,20,25,12,10,5,20,25];
                    graph_displayed = "custom";
                    break;
                case 'last_hour':
                    $('.volume_custom_time').hide();
                    //fetch data from server
                    graph_labels = ['01:00','02:00','03:00','04:00','05:00'];
                    graph_data = [12,10,5,20,25];
                    graph_displayed = "last_hour";
                    break;
                case 'last_24_hour':
                    $('.volume_custom_time').hide();
                    //fetch data from server
                    graph_labels = ['01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00'];
                    graph_data = [12,10,5,20,25,12,10,5,20,25];
                    graph_displayed = "last_24_hr";
                    break;
            }
            if(volumeChart){
                volumeChart.destroy();
            }
            volumeChart = new Chart(ctx_volume, {
                type: 'bar',
                data: {
                    labels: graph_labels,
                    datasets: [{
                        label: 'Volume purified',
                        position: 'right',
                        data: graph_data,
                        fill: true,
                        backgroundColor: 'cyan',
                        borderColor: 'blue',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    interaction: {
                        // Overrides the global setting
                        mode: 'index'
                    },
                    title: {
                        display: true,
                        text: graph_title,
                        position: 'top',
                        // padding: {
                        //     top: 10,
                        //     bottom: 30
                        // }
                    },
                    scales: {
                        xAxes:[{
                            scaleLabel: {
                                display: true,
                                labelString: "Time (HH::MM)"
                            }
                        }],
                        yAxes:[{
                            scaleLabel: {
                                display: true,
                                labelString: "Value (in gallons)"
                            }
                        }]
                    }
                }
            });
            $('#volumeChart').show();
            $('#btn_reload_graph').prop('disabled', true);

        })
        $('#inputFromDate_volume').on('change', function(){
            // console.log('HI from date')
            $('#inputToDate_volume').val($('#inputFromDate_volume').val()).change()
        })
    });


    $('#btn_confirm_add_device').on('click', function() {
        var serial = $('#inputSerialNumber').val();
        var device = $('#inputDeviceNumber').val();
        var name = $('#inputDeviceName').val();

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
                        text: "Device Added! \nDo you want to add another?",
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



