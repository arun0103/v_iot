@extends('layouts.master')

@section('head')
<!-- <script src="{{asset('js/require.js')}}"></script> -->
<style>
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
                                    <th>Water Quality</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($devices as $device)
                                        <tr class="table-info device-row" id="device-info-{{$device->id}}" >
                                            <td>{{$device->serial_number}}</td>
                                            <td>{{$device->model == 'U' ? 'DiUse' : 'DiEntry'}}</td>
                                            <td>{{$device->userDevices->count()}}</td>
                                            <td class="status">{{$device->logs->count()>0 ? ($device->logs[0]->step == 1 || $device->logs[0]->step == 13 ?"Idle" : "RUNNING") : "No Data"}}</td>
                                            <td><span class="ec">{{$device->logs->count() >0 ? ($device->logs[0]->ec >=0 && $device->logs[0]->ec < 200 ? "On Target" : "Needs Attention") : "No Data"}}</span></td>
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
                                            </td>
                                        </tr>
                                        <tr class="device-info" id="{{$device->id}}" style="display: none;" >
                                            <td colspan="7">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-info btn_edit_setpoints" id="btn_edit_setpoint-{{$device->id}}" hidden>Edit</button>
                                                                    <button type="button" class="btn btn-danger btn_save_setpoints" id="btn_save_setpoint-{{$device->id}}" hidden>Save</button>
                                                                    <button type="button" class="btn btn-light btn_cancel_setpoints" id="btn_cancel_setpoint-{{$device->id}}" hidden>Cancel</button>
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#{{$device->id}}">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                <!-- <nav>
                                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                        <a class="nav-item nav-link nav_link-avg_data active" id="nav_link-avg_data_{{$device->id}}" data-toggle="tab" href="#tab_avg_data_{{$device->id}}" role="tab" aria-controls="tab_avg_data_{{$device->id}}" aria-selected="true">Status</a>
                                                                        <a class="nav-item nav-link nav_link-live_data" id="nav_link-live_data" data-toggle="tab" href="#tab_live_data_{{$device->id}}" role="tab" aria-controls="tab_live_data_{{$device->id}}" aria-selected="false">Live Data <i id="btn_refresh_live_data_{{$device->id}}" class="btn fas fa-sync-alt" hidden></i></a>
                                                                        <a class="nav-item nav-link nav_link-control" id="nav_link-control" data-toggle="tab" href="#tab_control_{{$device->id}}" role="tab" aria-controls="tab_control_{{$device->id}}" aria-selected="false">Controls </a>
                                                                        <a class="nav-item nav-link nav_link-setpoints" id="nav_link-setpoints" data-toggle="tab" href="#tab_setpoints_{{$device->id}}" role="tab" aria-controls="tab_setpoints_{{$device->id}}" aria-selected="false">Setpoints </a>
                                                                    </div>
                                                                </nav> -->
                                                                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                                                    <li class="nav-item nav_link-avg_data"  >
                                                                        <a class="nav-link active" aria-current="page" href="#tab_avg_data_{{$device->id}}" data-toggle="tab" >Status</a>
                                                                    </li>
                                                                    <li class="nav-item nav_link-live_data" id="nav_link-live_data">
                                                                        <a class="nav-link" href="#tab_live_data_{{$device->id}}" data-toggle="tab">Live Data <i id="btn_refresh_live_data_{{$device->id}}" class="btn fas fa-sync-alt" hidden></i></a>
                                                                    </li>
                                                                    <li class="nav-item nav_link-control" id="nav_link-control">
                                                                        <a class="nav-link" href="#tab_control_{{$device->id}}" data-toggle="tab">Controls </a>
                                                                    </li>
                                                                    <li class="nav-item nav_link-setpoints" id="nav_link-setpoints">
                                                                        <a class="nav-link" href="#tab_setpoints_{{$device->id}}" data-toggle="tab">Setpoints </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="tab-content" style="max-height:500px; overflow-y:scroll; overflow-x:hidden;">
                                                                    <div class="tab-pane fade show active" role="tabpanel" id="tab_avg_data_{{$device->id}}" style="max-height:500px; overflow:hidden;">
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
                                                                                            <span style="color:green" id="device_status-{{$device->id}}">{{$device->logs->count()>0 ? ($device->logs[0]->step == 1 || $device->logs[0]->step == 13 ?"Idle" : "RUNNING") : "No Data"}}</span>
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
                                                                                                @if($device->logs->count() >0)
                                                                                                    @if(Carbon\Carbon::now()->diffInMinutes($device->logs[0]->created_at) < 2)
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
                                                                                        <span id="device_conductivity_value-{{$device->id}}">{{$device->logs->count() >0 ? ($device->logs[0]->ec >=0 && $device->logs[0]->ec < 200 ? "On Target" : "Needs Attention") : "No Data"}}</span></i>
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
                                                                                    @if($device->logs->count()< 1)
                                                                                    <p>No Data</p>
                                                                                    @else
                                                                                    <p hidden>Alarm Code: <span id="alarm_code_{{$device->id}}">{{$device->logs[0]->alarm}}</span></p>
                                                                                    <section class="alarms-list" id="alarmsList_{{$device->id}}"></section>
                                                                                    @endif

                                                                                    </div>
                                                                                    <!-- /.card-body -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" role="tabpanel" id="tab_live_data_{{$device->id}}" hidden>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                                                <!-- begin timeline -->
                                                                                <ul class="timeline" id="live_data_rows_{{$device->id}}">
                                                                                    <li>Live View Started
                                                                                        <div class="timeline-body">
                                                                                        Waiting data from device
                                                                                        </div>
                                                                                    <li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" role="tabpanel" id="tab_control_{{$device->id}}" hidden>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                                                <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_flush_module" id="btn_flush_module-{{$device->id}}">Flush Module</button></div>
                                                                                <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_start_cip" id="btn_start_cip-{{$device->id}}">Start CIP</button></div>
                                                                                <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_current_time" id="btn_current_time-{{$device->id}}">Current Time</button></div>
                                                                                <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_current_date" id="btn_current_date-{{$device->id}}">Current Date</button></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="card card-outline">
                                                                                    <div class="card-header"><h4 class="card-title">Control Logs</h4></div>
                                                                                    <div class="card-body">
                                                                                        <table class=" table-hover datatable">
                                                                                            <thead class="thead-dark">
                                                                                                <th>Date Time</th>
                                                                                                <th>Command</th>
                                                                                                <th>Status</th>
                                                                                                <th>Actions</th>
                                                                                            </thead>
                                                                                            <tbody id="command-{{$device->id}}" class="commands">

                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" role="tabpanel" id="tab_setpoints_{{$device->id}}" hidden>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-pure_EC_target">1. Pure EC Target</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-pure_EC_target" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-pre_purify_time">2. Pre-purify Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-pre_purify_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-purify_time">3. Purify Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-purify_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-waste_time">4. Waste Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-waste_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-HF_waste_time">5. HF Waste Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-HF_waste_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_dose">6. CIP Dose</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_dose" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_dose_rec">7. CIP Dose Rec</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_dose_rec" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_dose_total">8. CIP Dose Total</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_dose_total" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flow_total">9. CIP Flow Total</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flow_total" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flow_flush">10. CIP Flow Flush</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flow_flush" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flow_rec">11. CIP Flow Rec</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flow_rec" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flush_time">12. CIP Flush Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flush_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-WV_check_time">13. WV Check Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-WV_check_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-wait_HT_time">14. Wait HT Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-wait_HT_time" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-p_flow_target">15. P.Flow Target</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-p_flow_target" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-low_flow_purify_alarm">16. Low Flow Purify Alarm</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-low_flow_purify_alarm" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-low_flow_waste_alarm">17. Low Flow Waste Alarm</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-low_flow_waste_alarm" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_cycles">18. CIP Cycles</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_cycles" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-temperature_alarm">19. Temperature Alarm</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-temperature_alarm" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-max_CIP_prt">20. Max CIP P.R.T</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-max_CIP_prt" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-pump_p_factor">21. Pump P-Factor</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-pump_p_factor" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-dynamic_p_factor">22. Dynamic P-Factor</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-dynamic_p_factor" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-p_max_volt">23. P.Max Volt</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-p_max_volt" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-w_max_volt">24. W.Max Volt</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-w_max_volt" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-w_value">25. W_Value</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-w_value" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-flow_k_factor">26. Flow K Factor</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-flow_k_factor" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-volume_unit">27. Volume Unit</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <select class="form-control input-setpoints" id="input-volume_unit">
                                                                                    <option value="0">Litre</option>
                                                                                    <option value="1">Gallon</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-bypass_option">28. Bypass Option</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-bypass_option" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-start_pressure">29. Start Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-start_pressure" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-stop_pressure">30. Stop Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-stop_pressure" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-bypass_pressure">31. Bypass Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-bypass_pressure" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_pressure">32. CIP Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_pressure" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-wait_time_before_CIP">33. Wait Time Before CIP</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-wait_time_before_CIP" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <div class="modal fade modals-alarms-detail" id="modal-alarms-detail">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Alarm Logs</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12" id="all-device-alarms">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>

    </div>
    <div class="modal fade modals-device-detail" id="modal-device-detail">

            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Hello</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12" id="all-device-details">
                                    </div>
                                </div>


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
// Maintenance
    $('.input_critic_acid').on('keyup', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_save_critic_acid-'+trid).removeAttr("hidden");
    });
    $('.input_pre_filter').on('keyup', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_save_pre_filter-'+trid).removeAttr("hidden");
    });
    $('.input_post_filter').on('keyup', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_save_post_filter-'+trid).removeAttr("hidden");
    });
    $('.input_general_service').on('keyup', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_save_general_service-'+trid).removeAttr("hidden");
    });

    $('.btn-save-critic_acid').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "POST",
            url: "/saveCriticAcid/"+ trid,
            data: {"critic_acid":$('#input_critic_acid-'+trid).val()}

        })
        .done(function(response){
            console.log(response)
            Swal.fire('Success','Critic Acid Updated','success')
            $('#btn_save_critic_acid-'+trid).attr("hidden", true);
        });
    })
    $('.btn-save-pre_filter').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
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
    })
    $('.btn-save-post_filter').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
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
    })
    $('.btn-save-general_service').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
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
    })
//end of maintenance

    $('.btn_flush_module').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "POST",
            url: "/flush_module/"+ trid,
        })
        .done(function(response){
            Swal.fire('Success','Command recorded.','success')
            var date = new Date(response.created_at)
            $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
        });
    })

    var view_live_device = null; // to track whether user wants to view live data of particular device
    var view_mode = "average";
    $('.nav_link-avg_data').on('click', function(){
        view_mode = "average";
        view_live_device = null; // we are not in live mode
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#tab_live_data_'+trid).hide();
        $('#tab_avg_data_'+trid).show();
        $('#btn_refresh_live_data_'+trid).attr('hidden', true);
        $('#btn_edit_setpoint-'+trid).attr('hidden',true);
        $('#btn_save_setpoint-'+trid).attr('hidden',true)
        $('#btn_cancel_setpoint-'+trid).attr('hidden',true)

    })
    $('.nav_link-live_data').on('click', function(){
        view_mode = "live";
        var trid = $(this).closest('tr').attr('id'); // table row ID
        view_live_device = trid; // we are on live mode of device id = trid
        $('#btn_refresh_live_data_'+trid).attr('hidden', false);
        $('#tab_avg_data_'+trid).hide();
        $('#tab_live_data_'+trid).attr('hidden',false);
        $('#tab_live_data_'+trid).show();
        $('#btn_edit_setpoint-'+trid).attr('hidden',true);
        $('#btn_save_setpoint-'+trid).attr('hidden',true)
        $('#btn_cancel_setpoint-'+trid).attr('hidden',true)

        // collect live data and display
        //its doing in every 5 sec when the document is ready
    })
    $('.nav_link-control').on('click', function(){
        view_mode = "control";
        var trid = $(this).closest('tr').attr('id'); // table row ID
        view_live_device = null; // we are not in live mode
        $('#btn_refresh_live_data_'+trid).attr('hidden', true);
        $('#tab_avg_data_'+trid).hide();
        $('#tab_live_data_'+trid).hide();
        $('#tab_control_'+trid).attr('hidden',false);
        $('#tab_control_'+trid).show();
        $('#btn_edit_setpoint-'+trid).attr('hidden',true);
        $('#btn_save_setpoint-'+trid).attr('hidden',true)
        $('#btn_cancel_setpoint-'+trid).attr('hidden',true)
        // get the commands list
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/deviceCommands/"+ trid,

        })
        .done(function(response){
            console.log(response);
            response.forEach(addCommandRows)

            function addCommandRows(item, index, arr){
                var date = new Date(arr[index].created_at)
                var status = arr[index].device_read_at == null ?'Sent':(arr[index].device_executed_at == null ?'Executing':(arr[index].device_response_data == null ? 'Executed':arr[index].device_response_data))
                $('#command-'+trid).append('<tr id="'+arr[index].id+'"><td>'+date+'</td><td>'+arr[index].command+'</td><td>'+status+'</td><td><i class="fas fa-trash delete-command" ></i></td></tr>');
            }
        });
    })
    // variables needed for setpoints tab
    var pure_EC_target,prepurify_time,purify_time,waste_time,HF_waste_time,
        CIP_dose,CIP_dose_rec,CIP_dose_total,CIP_flow_total,CIP_flow_flush,CIP_flow_rec,CIP_flush_time,
        WV_check_time,wait_HT_time,p_flow_target,low_flow_purify_alarm,low_flow_waste_alarm,
        CIP_cycles,temperature_alarm,max_CIP_prt,pump_p_factor,dynamic_p_factor,p_max_volt,
        w_max_volt,w_value,flow_k_factor,volume_unit,bypass_option,start_pressure,stop_pressure,
        bypass_pressure,CIP_pressure,wait_time_before_CIP;

    $('.nav_link-setpoints').on('click', function(){
        view_mode = "setpoints";
        var trid = $(this).closest('tr').attr('id'); // table row ID
        view_live_device = null; // we are not in live mode
        $('#btn_refresh_live_data_'+trid).attr('hidden', true);
        $('#tab_avg_data_'+trid).hide();
        $('#tab_live_data_'+trid).hide();
        $('#tab_control_'+trid).hide();
        $('#tab_setpoints_'+trid).attr('hidden',false);
        // $('#tab_setpoints_'+trid).show();
        $('#btn_edit_setpoint-'+trid).attr('hidden',false);
        $('.input-setpoints').attr('disabled',true);

        // get the list of setpoints from the database
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getDeviceSetpoints/"+ trid,
        })
        .done(function(response){
            console.log("Setpoints from database")
            console.log(response);
            pure_EC_target = response.pure_EC_target;
            prepurify_time = resonse.prepurify_time;
            purify_time = response.purify_time;
            waste_time = response.waste_time
            HF_waste_time =response.HF_waste_time
            CIP_dose =response.CIP_dose
            CIP_dose_rec = response.CIP_dose_rec
            CIP_dose_total =response.CIP_dose_total
            CIP_flow_total =response.CIP_flow_total
            CIP_flow_flush =response.CIP_flow_flush
            CIP_flow_rec =response.CIP_flow_rec
            CIP_flush_time =response.CIP_flush_time
            WV_check_time =response.WV_check_time
            wait_HT_time =response.wait_HT_time
            p_flow_target =response.p_flow_target
            low_flow_purify_alarm =response.low_flow_purify_alarm
            low_flow_waste_alarm =response.low_flow_waste_alarm
            CIP_cycles =response.CIP_cycles
            temperature_alarm =response.temperature_alarm
            max_CIP_prt =response.max_CIP_prt
            pump_p_factor =response.pump_p_factor
            dynamic_p_factor =response.dynamic_p_factor
            p_max_volt =response.p_max_volt
            w_max_volt =response.w_max_volt
            w_value =response.w_value
            flow_k_factor =response.flow_k_factor
            volume_unit =response.volume_unit
            bypass_option =response.bypass_option
            start_pressure =response.start_pressure
            stop_pressure =response.stop_pressure
            bypass_pressure =response.bypass_pressure
            CIP_pressure =response.CIP_pressure
            wait_time_before_CIP =response.wait_time_before_CIP
            $('#input-pure_EC_target').val(pure_EC_target)
            $('#input-pre_purify_time').val(pre_purify_time)
            $('#input-purify_time').val(purify_time)
            $('#input-waste_time').val(waste_time)
            $('#input-HF_waste_time').val(HF_waste_time)
            $('#input-CIP_dose').val(CIP_dose)
            $('#input-CIP_dose_rec').val(CIP_dose_rec)
            $('#input-CIP_dose_total').val(CIP_dose_total)
            $('#input-CIP_flow_total').val(CIP_flow_total)
            $('#input-CIP_flow_flush').val(CIP_flow_flush)
            $('#input-CIP_flow_rec').val(CIP_flow_rec)
            $('#input-CIP_flush_time').val(CIP_flush_time)
            $('#input-WV_check_time').val(WV_check_time)
            $('#input-wait_HT_time').val(wait_HT_time)
            $('#input-p_flow_target').val(p_flow_target)
            $('#input-low_flow_purify_alarm').val(low_flow_purify_alarm)
            $('#input-low_flow_waste_alarm').val(low_flow_waste_alarm)
            $('#input-CIP_cycles').val(CIP_cycles)
            $('#input-temperature_alarm').val(temperature_alarm)
            $('#input-max_CIP_prt').val(max_CIP_prt)
            $('#input-pump_p_factor').val(pump_p_factor)
            $('#input-dynamic_p_factor').val(dynamic_p_factor)
            $('#input-p_max_volt').val(p_max_volt)
            $('#input-w_max_volt').val(w_max_volt)
            $('#input-w_value').val(w_value)
            $('#input-flow_k_factor').val(flow_k_factor)
            $('#input-volume_unit').val(volume_unit)
            $('#input-bypass_option').val(bypass_option)
            $('#input-start_pressure').val(start_pressure)
            $('#input-stop_pressure').val(stop_pressure)
            $('#input-bypass_pressure').val(bypass_pressure)
            $('#input-CIP_pressure').val(CIP_pressure)
            $('#input-wait_time_before_CIP').val(wait_time_before_CIP)

        });
    })
    $('.commands').on('click','.delete-command', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        Swal.fire({
            title: 'Do you want to delete the command?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Delete`,
            denyButtonText: `Cancel`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "Delete",
                    url: "/deleteCommand/"+ trid,

                })
                .done(function(response){
                    console.log(response);
                    $('.commands tr#'+trid).hide();
                    Swal.fire('Deleted!', '', 'success')
                    $('#command-'+trid).remove();
                });
            } else if (result.isDenied) {
                Swal.fire('Command is safe', '', 'info')
            }
        })
    })

    $('.btn-refresh').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        alert('Refreshing data')
        // Request server for recent logs
    })

    $('.btn_edit_setpoints').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_edit_setpoint-'+trid).attr('hidden',true)
        $('#btn_save_setpoint-'+trid).attr('hidden',false)
        $('#btn_cancel_setpoint-'+trid).attr('hidden',false)
        $('.input-setpoints').attr('disabled',false);
    })
    $('.btn_save_setpoints').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_edit_setpoint-'+trid).attr('hidden',false)
        $('#btn_save_setpoint-'+trid).attr('hidden',true)
        $('#btn_cancel_setpoint-'+trid).attr('hidden',true)
        $('.input-setpoints').attr('disabled',true);
        //save new values in the database and send commands to device to change the setpoints to new value
        var formData ={
            'pure_EC_target':$('#input-pure_EC_target').val(),
            'prepurify_time':$('#input-prepurify_time').val(),
            'purify_time':$('#input-purify_time').val(),
            'waste_time':$('#input-waste_time').val(),
            'HF_waste_time':$('#input-HF_waste_time').val(),
            'CIP_dose':$('#input-CIP_dose').val(),
            'CIP_dose_rec':$('#input-CIP_dose_rec').val(),
            'CIP_dose_total':$('#input-CIP_dose_total').val(),
            'CIP_flow_total':$('#input-CIP_flow_total').val(),
            'CIP_flow_flush':$('#input-CIP_flow_flush').val(),
            'CIP_flow_rec':$('#input-CIP_flow_rec').val(),
            'CIP_flush_time':$('#input-CIP_flush_time').val(),
            'WV_check_time':$('#input-WV_check_time').val(),
            'wait_HT_time':$('#input-wait_HT_time').val(),
            'p_flow_target':$('#input-p_flow_target').val(),
            'low_flow_purify_alarm':$('#input-low_flow_purify_alarm').val(),
            'low_flow_waste_alarm':$('#input-low_flow_waste_alarm').val(),
            'CIP_cycles':$('#input-CIP_cycles').val(),
            'temperature_alarm':$('#input-temperature_alarm').val(),
            'max_CIP_prt':$('#input-max_CIP_prt').val(),
            'pump_p_factor':$('#input-pump_p_factor').val(),
            'dynamic_p_factor':$('#input-dynamic_p_factor').val(),
            'p_max_volt':$('#input-p_max_volt').val(),
            'w_max_volt':$('#input-w_max_volt').val(),
            'w_value':$('#input-w_value').val(),
            'flow_k_factor':$('#input-flow_k_factor').val(),
            'volume_unit':$('#input-volume_unit').val(),
            'bypass_option':$('#input-bypass_option').val(),
            'start_pressure':$('#input-start_pressure').val(),
            'stop_pressure':$('#input-stop_pressure').val(),
            'bypass_pressure':$('#input-bypass_pressure').val(),
            'CIP_pressure':$('#input-CIP_pressure').val(),
            'wait_time_before_CIP':$('#input-wait_time_before_CIP').val(),
        };
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "POST",
            url: "/saveDeviceSetpoints/"+ trid,
            data: formData
        })
        .done(function(response){
            console.log("Saved Setpoints for device_id: "+trid);
            console.log(response);

        });

    })
    $('.btn_cancel_setpoints').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $('#btn_edit_setpoint-'+trid).attr('hidden',false)
        $('#btn_save_setpoint-'+trid).attr('hidden',true)
        $('#btn_cancel_setpoint-'+trid).attr('hidden',true)
        $('.input-setpoints').attr('disabled',true);

        // put old values in the input fields
        $('#input-pure_EC_target').val(pure_EC_target)
        $('#input-pre_purify_time').val(pre_purify_time)
        $('#input-purify_time').val(purify_time)
        $('#input-waste_time').val(waste_time)
        $('#input-HF_waste_time').val(HF_waste_time)
        $('#input-CIP_dose').val(CIP_dose)
        $('#input-CIP_dose_rec').val(CIP_dose_rec)
        $('#input-CIP_dose_total').val(CIP_dose_total)
        $('#input-CIP_flow_total').val(CIP_flow_total)
        $('#input-CIP_flow_flush').val(CIP_flow_flush)
        $('#input-CIP_flow_rec').val(CIP_flow_rec)
        $('#input-CIP_flush_time').val(CIP_flush_time)
        $('#input-WV_check_time').val(WV_check_time)
        $('#input-wait_HT_time').val(wait_HT_time)
        $('#input-p_flow_target').val(p_flow_target)
        $('#input-low_flow_purify_alarm').val(low_flow_purify_alarm)
        $('#input-low_flow_waste_alarm').val(low_flow_waste_alarm)
        $('#input-CIP_cycles').val(CIP_cycles)
        $('#input-temperature_alarm').val(temperature_alarm)
        $('#input-max_CIP_prt').val(max_CIP_prt)
        $('#input-pump_p_factor').val(pump_p_factor)
        $('#input-dynamic_p_factor').val(dynamic_p_factor)
        $('#input-p_max_volt').val(p_max_volt)
        $('#input-w_max_volt').val(w_max_volt)
        $('#input-w_value').val(w_value)
        $('#input-flow_k_factor').val(flow_k_factor)
        $('#input-volume_unit').val(volume_unit)
        $('#input-bypass_option').val(bypass_option)
        $('#input-start_pressure').val(start_pressure)
        $('#input-stop_pressure').val(stop_pressure)
        $('#input-bypass_pressure').val(bypass_pressure)
        $('#input-CIP_pressure').val(CIP_pressure)
        $('#input-wait_time_before_CIP').val(wait_time_before_CIP)
    })

    //when user clicks on the device row
    $('tr.device-row').on('click',function(){
        //$('#modal-device-detail').modal('show');
        var trid = $(this).closest('tr').attr('id'); // table row ID
        var device_trid = trid.replace("device-info-",'')
        console.log(device_trid)
        $('#tab_avg_data_'+device_trid).show();
        $('#tab_live_data_'+device_trid).hide();
        $('#btn_refresh_live_data_'+device_trid).attr('hidden', true);
        //get data from database
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/deviceDetail/"+ device_trid,

        })
        .done(function(response){
            console.log(response);

            if($('span#alarm_code_'+device_trid).text() != ""){
                //analyse bits of alarm
                var alarms =$('span#alarm_code_'+device_trid).text();

                var bin_alarms = (alarms >>> 0).toString(2);
                for(var i = bin_alarms.length; i<24 ; i++){
                    bin_alarms = "0"+bin_alarms;
                }
                $('section#alarmsList_'+device_trid).empty();
                for(var i = 0 ; i < bin_alarms.length ; i++){
                    if(bin_alarms[i] == "1"){ // 1 states that there is alarm so find the location of alarm and display
                        switch(i){
                            case 0: $('section#alarmsList_'+device_trid).append("<p>Reserved For future</p>");break;
                            case 1: $('section#alarmsList_'+device_trid).append("<p>Reserved For future</p>");break;
                            case 2: $('section#alarmsList_'+device_trid).append("<p>Reserved For future</p>");break;
                            case 3: $('section#alarmsList_'+device_trid).append("<p>FLOWMETER COMM ERROR</p>");break;
                            case 4: $('section#alarmsList_'+device_trid).append("<p>ATLAS TEMPERATURE ERROR</p>");break;
                            case 5: $('section#alarmsList_'+device_trid).append("<p>ZERO EC ALARM</p>");break;
                            case 6: $('section#alarmsList_'+device_trid).append("<p>ATLAS I2C COM ERROR</p>");break;
                            case 7: $('section#alarmsList_'+device_trid).append("<p>LOW PRESSURE ALARM</p>");break;
                            case 8: $('section#alarmsList_'+device_trid).append("<p>PAE AC INPUT FAIL</p>");break;
                            case 9: $('section#alarmsList_'+device_trid).append("<p>PAE AC POWER DOWN</p>");break;
                            case 10:$('section#alarmsList_'+device_trid).append("<p>PAE HIGH TEMPERATURE</p>");break;
                            case 11:$('section#alarmsList_'+device_trid).append("<p>PAE AUX OR SMPS FAIL</p>");break;
                            case 12:$('section#alarmsList_'+device_trid).append("<p>PAE FAN FAIL</p>");break;
                            case 13:$('section#alarmsList_'+device_trid).append("<p>PAE OVER TEMP SHUTDOWN</p>");break;
                            case 14:$('section#alarmsList_'+device_trid).append("<p>PAE OVER LOAD SHUTDOWN</p>");break;
                            case 15:$('section#alarmsList_'+device_trid).append("<p>PAE OVER VOLT SHUTDOWN</p>");break;
                            case 16:$('section#alarmsList_'+device_trid).append("<p>PAE COMMUNICATION ERROR</p>");break;
                            case 17:$('section#alarmsList_'+device_trid).append("<p>CIP LOW LEVEL ALARM</p>");break;
                            case 18:$('section#alarmsList_'+device_trid).append("<p>WASTE VALVE ALARM</p>");break;
                            case 19:$('section#alarmsList_'+device_trid).append("<p>LEAKAGE ALARM</p>");break;
                            case 20:$('section#alarmsList_'+device_trid).append("<p>CABINET TEMP ALARM</p>");break;
                            case 21:$('section#alarmsList_'+device_trid).append("<p>BYPASS ALARM</p>");break;
                            case 22:$('section#alarmsList_'+device_trid).append("<p>LOW FLOW WASTE ALARM</p>");break;
                            case 23:$('section#alarmsList_'+device_trid).append("<p>LOW FLOW PURE ALARM</p>");break;
                        }
                    }
                }
                $('tr#' + device_trid).toggle();
                $('html, body').animate({
                    scrollTop: $('tr#' + device_trid).prop("scrollHeight") + $("#"+device_trid).height()
                }, 1000);
            }else
                Swal.fire("Error", "No Data found! ", "info")


        });



        //display in modal

        //console.log($('span#alarm_code_'+device_trid).text());

    })
    var start_stop_command_sent = false;
    var command_sent = "";

    $(document).ready(function () {
        // check status

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
            console.log(time);
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/refreshDashboardData",
            })
            .done(function(response){
                console.log(response);
                for(var i=0; i<response.length;i++){
                    if(response[i]['deviceDetails'].logs.length != 0){
                        console.log("Displaying response data");
                        console.log(response[i]['deviceDetails']);
                        //change the status
                        if(!start_stop_command_sent){
                            var status = "";
                            var color = "";
                            if(response[i]['deviceDetails'].logs.step == 1 || response[i]['deviceDetails'].logs.step == 13){
                                status = "IDLE";
                                color = "orange";
                            }else{
                                status = "RUNNING";
                                color = "green";
                            }
                            $('#device-info-'+response[i]['deviceDetails'].id +' .status').text(status); // row status
                            $('#device_status-'+response[i]['deviceDetails'].id).text(status);   // device info status
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
                            .done(function(response){
                                console.log(response);
                                if(response.device_executed_at != null){
                                    start_stop_command_sent = false;
                                    $('#btn_device_start_stop-'+response.device_id).attr('disabled','false');
                                }
                            });
                        }
                        // change the water quality
                        var water_quality ="";
                        if(response[i]['deviceDetails'].logs.ec<200){
                            water_quality = "On Target";
                            // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'green';
                            document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'green';
                            document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'green';
                        }else{
                            water_quality = "Needs Attention";
                            // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'red';
                            document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'red';
                            document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'red';
                        }
                        $('#device-info-'+response[i]['deviceDetails'].id +' .ec').text(water_quality); // row water quality
                        $('#device_conductivity_value-'+response[i]['deviceDetails'].id).text(water_quality); // device info water quality
                        // change device connection status
                        var now = +new Date();
                        var last_date = new Date(response[i]['deviceDetails'].logs[0].log_dt).getTime();
                        var difference = now - last_date;
                        if(difference < 2*1000*60) // 2 minutes
                            $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Connected")
                        else
                            $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Disconnected")
                        // change volume
                        $('#daily_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].daily +" gal" : "");
                        $('#monthly_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].monthly +" gal" : "");
                        $('#total_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].total +" gal" : "");

                        // change alarm

                    }
                }
            });

        },5000);
        var device_data_created_at = null;
        setInterval(function(){
            if(view_live_device != null){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "GET",
                    url: "/deviceLiveData/"+ view_live_device,
                })
                .done(function(response){
                    console.log(response);
                    console.log(response.created_at);
                    if(device_data_created_at != response.created_at){
                        device_data_created_at = response.created_at;
                        var recorded_date = new Date(response.created_at);
                        console.log(recorded_date);
                        recorded_date = recorded_date.toString();
                        console.log(recorded_date);
                        $('#live_data_rows_'+view_live_device).prepend("<li><div class=\"timeline-time\"><span class=\"time\">"+recorded_date+"</span></div>"+
                        "<div class=\"timeline-icon\"><a href=\"javascript:;\">&nbsp;</a></div>"+
                        "<div class=\"timeline-body\"><div class=\"timeline-header\"><span class=\"userimage\"><img src=\"/images/running.gif\"></span>"+
                        "<span class=\"username\"><a href=\"javascript:;\">Running </a> <small></small></span>"+
                        "<span class=\"pull-right text-muted\">[Step Run Sec:"+response.step_run_sec+" </span><span style=\"float:right;\"><i>[LOG DATE TIME:"+response.log_dt+"] UTC </i></span></div>"+
                        "<div class=\"timeline-content\"><div class=\"row\"><div class=\"col-sm-04\">"+
                        "<p>AOV :"+response.aov+"</p>"+
                        "<p>CURRENT FLOW :"+response.c_flow+"</p>"+
                        "<p>CABINET TEMP :"+response.c_temp+"</p>"+
                        "<p>CYCLE :"+response.cycle+"</p>"+
                        "<p>EC :"+response.ec+"</p>"+
                        "<p>INPUT :"+response.input+"</p>"+
                        "<p>OUTPUT :"+response.output+"</p>"+
                        "<p>MODE :"+response.mode+"</p></div>"+
                        "<div class=\"col-sm-04\"></div><div class=\"col-sm-04\">"+
                        "<p>PAE VOLT :"+response.pae_volt+"</p>"+
                        "<p>PRESSURE :"+response.pressure+"</p>"+
                        "<p>STEP :"+response.step+"</p>"+
                        "<p>STEP RUN SEC :"+response.step_run_sec+"</p>"+
                        "<p>TPV :"+response.tpv+"</p>"+
                        "<p>WATER TEMP :"+response.w_temp+"</p>"+
                        "<p>ALARM CODE :"+response.alarm+"</p></div></div></div>"+
                        "<p>PERCENTAGE RECOVERY :"+response.percentage_recovery+"</p>"+
                        +"</div></li>");
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



