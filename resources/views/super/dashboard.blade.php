@extends('layouts.master')

@section('head')
<!-- <script src="{{asset('js/require.js')}}"></script> -->
<style>
    .small-inputs{
        width:100px;
        border:1px solid blue;t
    }
    #map{position:absolute; left:0;right:0;top:0;bottom:0;z-index:2}
    .modal-full {
        min-width: 100%;
        margin: 0;
    }

    .modal-full .modal-content {
        min-height: 100vh;
        min-width:99vw;
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
<!-- switch button styles -->
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
    }

    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #FF0000;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

@endsection
@section('content')
    <div id="app">
        <!-- Content Header (Page header) -->
        <div class="content-header content-header-dashboard">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                        <button type="button" class="btn btn-info" id="btn_map_view">Map View</button>
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
                                            <td class="status" id="status-{{$device->id}}">{{$device->latest_log != null ? ($device->latest_log->step == 0 || $device->latest_log->step == 1 || $device->latest_log->step == 13 ?"IDLE" : "RUNNING") : "No Data"}}</td>
                                            <td><span class="ec">{{$device->latest_log != null ? ($device->latest_log->ec >=0 && $device->latest_log->ec < 200 ? "On Target" : "Needs Attention") : "No Data"}}</span></td>
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
                                                                    <div class="tab-pane fade show active" role="tabpanel" id="tab_avg_data_{{$device->id}}" style="max-height:600px; overflow:hidden;">
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
                                                                                            <i id="device_status_pic-{{$device->id}}" class="fas fa fa-certificate blink_me"></i>&nbsp;&nbsp;
                                                                                            <span id="device_status-{{$device->id}}">{{$device->latest_log != null ? ($device->latest_log->step == 0 || $device->latest_log->step == 1 || $device->latest_log->step == 13 ?"Idle" : "RUNNING") : "No Data"}}</span>
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
                                                                                            <i id="device_mode-{{$device->id}}" hidden>{{$device->latest_log != null?$device->latest_log->output:""}}</i>
                                                                                            <i id="device_connection_status-{{$device->id}}" >
                                                                                                @if($device->latest_log != null)
                                                                                                    @if(Carbon\Carbon::now()->diffInMinutes($device->latest_log->created_at) < 2)
                                                                                                        {{"Connected"}}
                                                                                                    @else
                                                                                                        {{"Disconnected"}}

                                                                                                    @endif
                                                                                                @endif
                                                                                            </i>
                                                                                            <i id="device_output-{{$device->id}}" hidden>{{$device->latest_log != null?$device->latest_log->output:""}}</i>
                                                                                            <i id="info_device_connection" class="fas fa-info-circle float-right info-device-connection" data-toggle="dropdown" ></i>
                                                                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                                                <a href="#" class="dropdown-item">
                                                                                                    <div class="media">
                                                                                                        <div class="media-body">
                                                                                                            <p class="text-sm"><b><i><span id="info_device_connection_text-{{$device->id}}"></span></i></b></p>
                                                                                                            <p class="text-sm" id="info_device_connection_description-{{$device->id}}"></p>
                                                                                                            @if($device->latest_log != null)
                                                                                                                <p>Last Data Received: <span id="last_data_received-{{$device->id}}">{{$device->latest_log->created_at}}</span></p>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                        @if(Auth::user()->role == 'S' || Auth::user()->role == 'A')
                                                                                            </br>
                                                                                            <div><b>Module Health :</b><i style="color:green; font-weight:bold" id="device_health_status-{{$device->id}}">Good</i>
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
                                                                                            <button id="btn_device_start_stop-{{$device->id}}" class="btn btn-danger center btn_device_start_stop" hidden>Stop</button>
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
                                                                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> </button>-->
                                                                                        </div>
                                                                                        <!-- /.card-tools -->
                                                                                    </div>
                                                                                    <!-- /.card-header -->
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-12">
                                                                                                <label for="select_view_volume_by">View in</label>
                                                                                                <select id="select_view_volume_by">
                                                                                                    <option value="gallons">Gallons</option>
                                                                                                    <option value="litres">Litres</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
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
                                                                                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
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
                                                                    <div class="tab-pane fade" role="tabpanel" id="tab_live_data_{{$device->id}}" hidden>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                                                <!-- begin timeline -->
                                                                                <ul class="timeline live_data_rows" id="live_data_rows_{{$device->id}}">
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
                                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                <div class="card">
                                                                                    <div class="card-header">
                                                                                        <h2 class="card-title">Relays</h2>
                                                                                        <div class="card-tools">
                                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#{{$device->id}}">
                                                                                                <i class="fas fa-minus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>1. MIV &nbsp;&nbsp; </h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_1-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_1"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>2. Bypass &nbsp;&nbsp; </h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_2-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_2"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>3. POV  &nbsp;&nbsp;</h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_3-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_3"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>4. WOV &nbsp;&nbsp; </h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_4-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_4"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>5. CIP  &nbsp;&nbsp;</h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_5-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_5"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>6. SHUNT &nbsp;&nbsp; </h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_6-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_6"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>7. POLARITY &nbsp;&nbsp; </h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_7-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_7"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>8. PAE &nbsp;&nbsp; </h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_8-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_8"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="d-inline-flex p-2">
                                                                                            <h4>9. BUZZER &nbsp;&nbsp;</h4>
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" id="btn_relay_9-{{$device->id}}">
                                                                                                <span class="slider round btn_relay_9"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                                                                            <div class="col-lg-12">
                                                                                <button type="button" class="btn btn-primary btn_getDeviceSetpoints" id="btn_get_device_setpoints-{{$device->id}}">Get Device Setpoints</button><br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-pure_EC_target">1. Pure EC Target</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-pure_EC_target" id="input-pure_EC_target-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-pre_purify_time">2. Pre-purify Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-pre_purify_time" id="input-pre_purify_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-purify_time">3. Purify Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-purify_time" id="input-purify_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-waste_time">4. Waste Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-waste_time" id="input-waste_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-HF_waste_time">5. HF Waste Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-HF_waste_time" id="input-HF_waste_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_dose">6. CIP Dose</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_dose" id="input-CIP_dose-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_dose_rec">7. CIP Dose Rec</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_dose_rec" id="input-CIP_dose_rec-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_dose_total">8. CIP Dose Total</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_dose_total" id="input-CIP_dose_total-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flow_total">9. CIP Flow Total</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flow_total" id="input-CIP_flow_total-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flow_flush">10. CIP Flow Flush</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flow_flush" id="input-CIP_flow_flush-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flow_rec">11. CIP Flow Rec</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flow_rec" id="input-CIP_flow_rec-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_flush_time">12. CIP Flush Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_flush_time" id="input-CIP_flush_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-WV_check_time">13. WV Check Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-WV_check_time" id="input-WV_check_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-wait_HT_time">14. Wait HT Time</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-wait_HT_time" id="input-wait_HT_time-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-p_flow_target">15. P.Flow Target</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-p_flow_target" id="input-p_flow_target-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-low_flow_purify_alarm">16. Low Flow Purify Alarm</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-low_flow_purify_alarm" id="input-low_flow_purify_alarm-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-low_flow_waste_alarm">17. Low Flow Waste Alarm</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-low_flow_waste_alarm" id="input-low_flow_waste_alarm-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_cycles">18. CIP Cycles</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_cycles" id="input-CIP_cycles-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-temperature_alarm">19. Temperature Alarm</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-temperature_alarm" id="input-temperature_alarm-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-max_CIP_prt">20. Max CIP P.R.T</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-max_CIP_prt" id="input-max_CIP_prt-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-pump_p_factor">21. Pump P-Factor</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-pump_p_factor" id="input-pump_p_factor-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-dynamic_p_factor">22. Dynamic P-Factor</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-dynamic_p_factor" id="input-dynamic_p_factor-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-p_max_volt">23. P.Max Volt</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-p_max_volt" id="input-p_max_volt-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-w_max_volt">24. W.Max Volt</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-w_max_volt" id="input-w_max_volt-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-w_value">25. W_Value</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-w_value" id="input-w_value-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-flow_k_factor">26. Flow K Factor</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-flow_k_factor" id="input-flow_k_factor-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-volume_unit">27. Volume Unit</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <select class="form-control input-setpoints"  id="input-volume_unit-{{$device->id}}">
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
                                                                                <input class="form-control input-setpoints" type="number" name="input-bypass_option" id="input-bypass_option-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-start_pressure">29. Start Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-start_pressure" id="input-start_pressure-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-stop_pressure">30. Stop Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-stop_pressure" id="input-stop_pressure-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-bypass_pressure">31. Bypass Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-bypass_pressure" id="input-bypass_pressure-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-CIP_pressure">32. CIP Pressure</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-CIP_pressure" id="input-CIP_pressure-{{$device->id}}" value=""/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <label for="input-wait_time_before_CIP">33. Wait Time Before CIP</label>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                                                <input class="form-control input-setpoints" type="number" name="input-wait_time_before_CIP" id="input-wait_time_before_CIP-{{$device->id}}" value=""/>
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
                                                                <h3 class="card-title" style="margin-top: 0px;">Maintenance <button class="btn btn-sm btn-primary btn_edit_maintenance" id="btn_edit_maintenance-{{$device->id}}" style="margin-bottom:5px">Edit</button></h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#{{$device->id}}">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-3"><span><b>Critic Acid</b></span></div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <span id="critic_acid_volume_left-{{$device->id}}" ></span><b> / </b>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <input type="number" id="input_critic_acid-{{$device->id}}" class="small-inputs input_critic_acid" value="{{$device->device_settings!= null ? $device->device_settings->critic_acid: ''}}" disabled>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4">
                                                                        <button class="btn btn-primary btn-sm btn-save-critic_acid" id="btn_save_critic_acid-{{$device->id}}" hidden>Save</button>
                                                                        <button class="btn btn-danger btn-sm" id="btn_reset_critic_acid-{{$device->id}}">Reset</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-3"><span><b>Pre-filter:</b></span></div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <span id="pre_filter_volume_left-{{$device->id}}"></span><b> / </b>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <input type="number" id="input_pre_filter-{{$device->id}}" class="small-inputs input_pre_filter" value="{{$device->device_settings!= null ? $device->device_settings->pre_filter: ''}}"  disabled>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4">
                                                                        <button class="btn btn-primary btn-sm btn-save-pre_filter" id="btn_save_pre_filter-{{$device->id}}" hidden>Save</button>
                                                                        <button class="btn btn-danger btn-sm" id="btn_reset_pre_filter-{{$device->id}}">Reset</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-3"><span><b>Post-filter:</b></span></div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <span id="post_filter_volume_left-{{$device->id}}"></span><b> / </b>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <input type="number" id="input_post_filter-{{$device->id}}" class="small-inputs input_post_filter" value="{{$device->device_settings!= null ? $device->device_settings->post_filter: ''}}" disabled>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4">
                                                                    <button class="btn btn-primary btn-sm btn-save-post_filter" id="btn_save_post_filter-{{$device->id}}" hidden>Save</button>
                                                                    <button class="btn btn-danger btn-sm" id="btn_reset_post_filter-{{$device->id}}">Reset</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-3"><span><b>General Service:</b></span></div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <span id="general_service_volume_left-{{$device->id}}"></span><b> / </b>
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2">
                                                                        <input type="number" id="input_general_service-{{$device->id}}" class="small-inputs input_general_service" value="{{$device->device_settings!= null ? $device->device_settings->general_service: ''}}" disabled>
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
    </div><!-- dont know where it came from  -->

    <div class="modal fade" id="modal-map_view">
        <div class="modal-dialog modal-full" >
            <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <div id="map" style="height:550px"></div>

            </div>
            <!-- /.modal-content -->
        </div>

    </div>

<script type="module" src="{{asset('js/home.js')}}"></script>
<!-- <script type="module" src="{{asset('js/map.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
//Map
    var greenIcon = new L.Icon({
        iconUrl: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|2ecc71&chf=a,s,ee00FFFF',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    var redIcon = new L.Icon({
        iconUrl: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|e85141&chf=a,s,ee00FFFF',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    $('#btn_map_view').on('click', function(){
        $('#modal-map_view').modal("show");
        var map = L.map('map').setView([0, 0], 1);
        L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}@2x.png?key=Eec27UocQRrQ00QVoo14', {
            //tileSize: 512,
            zoomOffset: -1,
            minZoom: 1,
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
            crossOrigin: true
        }).addTo(map);
        L.marker([51.5, -0.09], {icon: greenIcon}).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();
        L.marker([55.5, -1.09], {icon: redIcon}).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();

    })
//
    // Maintenance
        var old_critic_value =[], old_pre_filter=[], old_post_filter=[], old_general_service=[];
        $('.btn_edit_maintenance').on('click',function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
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
            var trid = $(this).closest('tr').attr('id'); // table row ID
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
            var trid = $(this).closest('tr').attr('id'); // table row ID
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
            var trid = $(this).closest('tr').attr('id'); // table row ID
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
    // end of maintenance
    var select_view_volume_by = "gallons";
    $('#select_view_volume_by').on('change',function(){
        select_view_volume_by = $('#select_view_volume_by').val();
        var trid = $(this).closest('tr').attr('id'); // table row ID
        var vol_gal_daily,vol_lit_daily,vol_gal_monthly,vol_lit_monthly,vol_gal_total,vol_lit_total;
        switch(select_view_volume_by){
            case "gallons":
                vol_gal_daily =$("#daily_volume-"+trid).text();
                vol_lit_daily = parseFloat(vol_gal_daily)*0.2642007926;
                $('#daily_volume-'+trid).text(vol_lit_daily.toFixed(2) + " gal");
                vol_gal_monthly =$("#monthly_volume-"+trid).text();
                vol_lit_monthly = parseFloat(vol_gal_monthly)*0.2642007926;
                $('#monthly_volume-'+trid).text(vol_lit_monthly.toFixed(2) + " gal");
                vol_gal_total =$("#total_volume-"+trid).text();
                vol_lit_total = parseFloat(vol_gal_total)*0.2642007926;
                $('#total_volume-'+trid).text(vol_lit_total.toFixed(2) + " gal");
                break;
            case "litres":
                vol_lit_daily =$("#daily_volume-"+trid).text();
                vol_gal_daily = parseFloat(vol_lit_daily)/0.2642007926;
                $('#daily_volume-'+trid).text(vol_gal_daily.toFixed(2) + " L");
                vol_lit_monthly =$("#monthly_volume-"+trid).text();
                vol_gal_monthly = parseFloat(vol_lit_monthly)/0.2642007926;
                $('#monthly_volume-'+trid).text(vol_gal_monthly.toFixed(2) + " L");
                vol_lit_total =$("#total_volume-"+trid).text();
                vol_gal_total = parseFloat(vol_lit_total)/0.2642007926;
                $('#total_volume-'+trid).text(vol_gal_total.toFixed(2) + " L");
                break;
        }
    })
    // controls
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
        //relays
        $('.btn_relay_1').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_1-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_1-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_1_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_1_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_2').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_2-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_2-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_2_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_2_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_3').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_3-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_3-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_3_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_3_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_4').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_4-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_4-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_4_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_4_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_5').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_5-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_5-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_5_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_5_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_6').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_6-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_6-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_6_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_6_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_7').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_7-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_7-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_7_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_7_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_8').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_8-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_8-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_8_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_8_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_9').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            if(!$('#btn_relay_9-'+trid).is('[disabled=disabled]')){
                if($('#btn_relay_9-'+trid).is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_9_off/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_9_on/"+ trid,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })


    // end of controls

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
        var now = new Date();
        $('#live_start_time').text(now);
        // collect live data and display
        //its doing in every 5 sec when the document is ready
        var device_data_created_at = null;
        var userDevices = [];
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getUserDevicesSetpointsForCalculation",
        })
        .done(function(response){
            // console.log(response);
            userDevices = response;
        });
        setInterval(function(){
            if(view_live_device != null){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "GET",
                    url: "/deviceLiveData/"+ view_live_device,
                })
                .done(function(response){
                    // console.log("LLLLLLLLLLL Live Data of id : " + view_live_device)
                    // console.log(response);
                    // console.log(response.created_at);
                    if(device_data_created_at != response.created_at){
                        device_data_created_at = response.created_at;
                        var recorded_date = new Date(response.created_at);
                        // console.log(recorded_date);
                        recorded_date = recorded_date.toString();
                        // console.log(recorded_date);
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
                        var output_binary_string = (response.output >>> 0).toString(2);
                        if(output_binary_string.length < 9){
                            for(var i = output_binary_string.length; i<9; i++){
                                output_binary_string = "0".concat(output_binary_string);
                            }
                        }
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
                                    case 0: alarm_names.push('<div style="color:red">&nbsp; Reserved For future</div>');break;
                                    case 1: alarm_names.push('<div style="color:red">&nbsp; Reserved For future</div>');break;
                                    case 2: alarm_names.push('<div style="color:red">&nbsp; Reserved For future</div>');break;
                                    case 3: alarm_names.push('<div style="color:red">&nbsp; FLOWMETER COMM ERROR</div>');break;
                                    case 4: alarm_names.push('<div style="color:red">&nbsp; ATLAS TEMPERATURE ERROR</div>');break;
                                    case 5: alarm_names.push('<div style="color:red">&nbsp; ZERO EC ALARM</div>');break;
                                    case 6: alarm_names.push('<div style="color:red">&nbsp; ATLAS I2C COM ERROR</div>');break;
                                    case 7: alarm_names.push('<div style="color:red">&nbsp; LOW PRESSURE ALARM</div>');break;
                                    case 8: alarm_names.push('<div style="color:red">&nbsp; PAE AC INPUT FAIL</div>');break;
                                    case 9: alarm_names.push('<div style="color:red">&nbsp; PAE AC POWER DOWN</div>');break;
                                    case 10:alarm_names.push('<div style="color:red">&nbsp; PAE HIGH TEMPERATURE</div>');break;
                                    case 11:alarm_names.push('<div style="color:red">&nbsp; PAE AUX OR SMPS FAIL</div>');break;
                                    case 12:alarm_names.push('<div style="color:red">&nbsp; PAE FAN FAIL</div>');break;
                                    case 13:alarm_names.push('<div style="color:red">&nbsp; PAE OVER TEMP SHUTDOWN</div>');break;
                                    case 14:alarm_names.push('<div style="color:red">&nbsp; PAE OVER LOAD SHUTDOWN</div>');break;
                                    case 15:alarm_names.push('<div style="color:red">&nbsp; PAE OVER VOLT SHUTDOWN</div>');break;
                                    case 16:alarm_names.push('<div style="color:red">&nbsp; PAE COMMUNICATION ERROR</div>');break;
                                    case 17:alarm_names.push('<div style="color:red">&nbsp; CIP LOW LEVEL ALARM</div>');break;
                                    case 18:alarm_names.push('<div style="color:red">&nbsp; WASTE VALVE ALARM</div>');break;
                                    case 19:alarm_names.push('<div style="color:red">&nbsp; LEAKAGE ALARM</div>');break;
                                    case 20:alarm_names.push('<div style="color:red">&nbsp; CABINET TEMP ALARM</div>');break;
                                    case 21:alarm_names.push('<div style="color:red">&nbsp; BYPASS ALARM</div>');break;
                                    case 22:alarm_names.push('<div style="color:red">&nbsp; LOW FLOW WASTE ALARM</div>');break;
                                    case 23:alarm_names.push('<div style="color:red">&nbsp; LOW FLOW PURE ALARM</div>');break;
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
                        $('#live_data_rows_'+view_live_device).prepend('<li><div class="timeline-time"><span class="time">'+recorded_date+'</span></div>'+
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
                                                    '<tr><th colspan="5" style="text-align:center;color:blue">INPUT</th></tr>'+
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
        // check the relays status and device step
        var output = $('#device_output-'+trid).text();
        // calculating output
        var output_binary_string = (output >>> 0).toString(2);

        for(var i =1; i<10; i++ ){
            console.log("i = "+i+ " value = "+output_binary_string.charAt(i))
            if(output_binary_string.charAt(16-i)=='1') // 1 = OFF, 0 = ON
                $('#btn_relay_'+i+'-'+trid).attr("checked",false).trigger("change");
            else
                $('#btn_relay_'+i+'-'+trid).attr("checked", true).trigger("change");

        }

        if($('#device_status-'+trid).text() !="IDLE"){
            // disable all the relay commands
            $('#btn_relay_1-'+trid).attr("disabled","true");
            $('#btn_relay_2-'+trid).attr("disabled","true");
            $('#btn_relay_3-'+trid).attr("disabled","true");
            $('#btn_relay_4-'+trid).attr("disabled","true");
            $('#btn_relay_5-'+trid).attr("disabled","true");
            $('#btn_relay_6-'+trid).attr("disabled","true");
            $('#btn_relay_7-'+trid).attr("disabled","true");
            $('#btn_relay_8-'+trid).attr("disabled","true");
            $('#btn_relay_9-'+trid).attr("disabled","true");
        }else{
            $('#btn_relay_1-'+trid).removeAttr("disabled");
            $('#btn_relay_2-'+trid).removeAttr("disabled");
            $('#btn_relay_3-'+trid).removeAttr("disabled");
            $('#btn_relay_4-'+trid).removeAttr("disabled");
            $('#btn_relay_5-'+trid).removeAttr("disabled");
            $('#btn_relay_6-'+trid).removeAttr("disabled");
            $('#btn_relay_7-'+trid).removeAttr("disabled");
            $('#btn_relay_8-'+trid).removeAttr("disabled");
            $('#btn_relay_9-'+trid).removeAttr("disabled");
        }

        // get the commands list
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/deviceCommands/"+ trid,

        })
        .done(function(response){
            // console.log(response);
            response.forEach(addCommandRows)

            function addCommandRows(item, index, arr){
                var date = new Date(arr[index].created_at)
                var status = arr[index].device_read_at == null ?'Sent':(arr[index].device_executed_at == null ?'Executing':(arr[index].device_response_data == null ? 'Executed':arr[index].device_response_data))
                $('#command-'+trid).append('<tr id="'+arr[index].id+'"><td>'+date+'</td><td>'+arr[index].command+'</td><td>'+status+'</td><td><i class="fas fa-trash delete-command" ></i></td></tr>');
            }
        });
    })
    // variables needed for setpoints tab
    var pure_EC_target,pre_purify_time,purify_time,waste_time,HF_waste_time,
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
            console.log("***** Setpoints from database")
            console.log(response);
            console.log("*****************************")
            pure_EC_target = response.pure_EC_target;
            pre_purify_time = response.prepurify_time;
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
            $('#input-pure_EC_target-'+ trid).val(pure_EC_target).change();
            $('#input-pre_purify_time-'+ trid).val(pre_purify_time).change();
            $('#input-purify_time-'+ trid).val(purify_time).change();
            $('#input-waste_time-'+ trid).val(waste_time).change();
            $('#input-HF_waste_time-'+ trid).val(HF_waste_time).change();
            $('#input-CIP_dose-'+ trid).val(CIP_dose).change();
            $('#input-CIP_dose_rec-'+ trid).val(CIP_dose_rec).change();
            $('#input-CIP_dose_total-'+ trid).val(CIP_dose_total).change();
            $('#input-CIP_flow_total-'+ trid).val(CIP_flow_total).change();
            $('#input-CIP_flow_flush-'+ trid).val(CIP_flow_flush).change();
            $('#input-CIP_flow_rec-'+ trid).val(CIP_flow_rec).change();
            $('#input-CIP_flush_time-'+ trid).val(CIP_flush_time).change();
            $('#input-WV_check_time-'+ trid).val(WV_check_time).change();
            $('#input-wait_HT_time-'+ trid).val(wait_HT_time).change();
            $('#input-p_flow_target-'+ trid).val(p_flow_target).change();
            $('#input-low_flow_purify_alarm-'+ trid).val(low_flow_purify_alarm).change();
            $('#input-low_flow_waste_alarm-'+ trid).val(low_flow_waste_alarm).change();
            $('#input-CIP_cycles-'+ trid).val(CIP_cycles).change();
            $('#input-temperature_alarm-'+ trid).val(temperature_alarm).change();
            $('#input-max_CIP_prt-'+ trid).val(max_CIP_prt).change();
            $('#input-pump_p_factor-'+ trid).val(pump_p_factor).change();
            $('#input-dynamic_p_factor-'+ trid).val(dynamic_p_factor).change();
            $('#input-p_max_volt-'+ trid).val(p_max_volt).change();
            $('#input-w_max_volt-'+ trid).val(w_max_volt).change();
            $('#input-w_value-'+ trid).val(w_value).change();
            $('#input-flow_k_factor-'+ trid).val(flow_k_factor).change();
            $('#input-volume_unit-'+ trid).val(volume_unit).change();
            $('#input-bypass_option-'+ trid).val(bypass_option).change();
            $('#input-start_pressure-'+ trid).val(start_pressure).change();
            $('#input-stop_pressure-'+ trid).val(stop_pressure).change();
            $('#input-bypass_pressure-'+ trid).val(bypass_pressure).change();
            $('#input-CIP_pressure-'+ trid).val(CIP_pressure).change();
            $('#input-wait_time_before_CIP-'+ trid).val(wait_time_before_CIP).change();

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
                    // console.log(response);
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

        console.log(" ' ' ' ' ' ' ' ' ' ' ' ' '' ");
        console.log("Pure EC Target: "+ $('#input-pure_EC_target-'+trid).val());
        console.log(" ' ' ' ' ' ' ' ' ' ' ' ' '' ");

        //save new values in the database and send commands to device to change the setpoints to new value
        var formData ={
            'pure_EC_target':$('#input-pure_EC_target-'+trid).val(),
            'prepurify_time':$('#input-pre_purify_time-'+trid).val(),
            'purify_time':$('#input-purify_time-'+trid).val(),
            'waste_time':$('#input-waste_time-'+trid).val(),
            'HF_waste_time':$('#input-HF_waste_time-'+trid).val(),
            'CIP_dose':$('#input-CIP_dose-'+trid).val(),
            'CIP_dose_rec':$('#input-CIP_dose_rec-'+trid).val(),
            'CIP_dose_total':$('#input-CIP_dose_total-'+trid).val(),
            'CIP_flow_total':$('#input-CIP_flow_total-'+trid).val(),
            'CIP_flow_flush':$('#input-CIP_flow_flush-'+trid).val(),
            'CIP_flow_rec':$('#input-CIP_flow_rec-'+trid).val(),
            'CIP_flush_time':$('#input-CIP_flush_time-'+trid).val(),
            'WV_check_time':$('#input-WV_check_time-'+trid).val(),
            'wait_HT_time':$('#input-wait_HT_time-'+trid).val(),
            'p_flow_target':$('#input-p_flow_target-'+trid).val(),
            'low_flow_purify_alarm':$('#input-low_flow_purify_alarm-'+trid).val(),
            'low_flow_waste_alarm':$('#input-low_flow_waste_alarm-'+trid).val(),
            'CIP_cycles':$('#input-CIP_cycles-'+trid).val(),
            'temperature_alarm':$('#input-temperature_alarm-'+trid).val(),
            'max_CIP_prt':$('#input-max_CIP_prt-'+trid).val(),
            'pump_p_factor':$('#input-pump_p_factor-'+trid).val(),
            'dynamic_p_factor':$('#input-dynamic_p_factor-'+trid).val(),
            'p_max_volt':$('#input-p_max_volt-'+trid).val(),
            'w_max_volt':$('#input-w_max_volt-'+trid).val(),
            'w_value':$('#input-w_value-'+trid).val(),
            'flow_k_factor':$('#input-flow_k_factor-'+trid).val(),
            'volume_unit':$('#input-volume_unit-'+trid).val(),
            'bypass_option':$('#input-bypass_option-'+trid).val(),
            'start_pressure':$('#input-start_pressure-'+trid).val(),
            'stop_pressure':$('#input-stop_pressure-'+trid).val(),
            'bypass_pressure':$('#input-bypass_pressure-'+trid).val(),
            'CIP_pressure':$('#input-CIP_pressure-'+trid).val(),
            'wait_time_before_CIP':$('#input-wait_time_before_CIP-'+trid).val(),
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
            Swal.fire('Success','Set - Setpoints command sent to device.','success')
            // wait for response and notify if value error

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
    $('.btn_getDeviceSetpoints').on('click', function(){
        var trid = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "POST",
                url: "/command/getSetpointsFromDevice/" + trid,
        })
        .done(function(response){
            Swal.fire('Success','Get - Setpoints command sent to device. Setpoints will be updated once the reply is received from the device','success')

            var is_response_received = false;
            setInterval(function(){
                if(!is_response_received){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "GET",
                            url: "/command_status/Setpoints-get/" + trid,
                    })
                    .done(function(response){
                        console.log(response)
                        if(response.device_read_at != null){
                            is_response_received = true;
                            $.ajax({
                                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                    type: "GET",
                                    url: "/getDeviceSetpoints/" + trid,
                            })
                            .done(function(response){
                                console.log(response)
                                $('#input-pure_EC_target-'+trid).val(response.pure_EC_target)
                                $('#input-pre_purify_time-'+trid).val(response.prepurify_time)
                                $('#input-purify_time-'+trid).val(response.purify_time)
                                $('#input-waste_time-'+trid).val(response.waste_time)
                                $('#input-HF_waste_time-'+trid).val(response.HF_waste_time)
                                $('#input-CIP_dose-'+trid).val(response.CIP_dose)
                                $('#input-CIP_dose_rec-'+trid).val(response.CIP_dose_rec)
                                $('#input-CIP_dose_total-'+trid).val(response.CIP_dose_total)
                                $('#input-CIP_flow_total-'+trid).val(response.CIP_flow_total)
                                $('#input-CIP_flow_flush-'+trid).val(response.CIP_flow_flush)
                                $('#input-CIP_flow_rec-'+trid).val(response.CIP_flow_rec)
                                $('#input-CIP_flush_time-'+trid).val(response.CIP_flush_time)
                                $('#input-WV_check_time-'+trid).val(response.WV_check_time)
                                $('#input-wait_HT_time-'+trid).val(response.wait_HT_time)
                                $('#input-p_flow_target-'+trid).val(response.p_flow_target)
                                $('#input-low_flow_purify_alarm-'+trid).val(response.low_flow_purify_alarm)
                                $('#input-low_flow_waste_alarm-'+trid).val(response.low_flow_waste_alarm)
                                $('#input-CIP_cycles-'+trid).val(response.CIP_cycles)
                                $('#input-temperature_alarm-'+trid).val(response.temperature_alarm)
                                $('#input-max_CIP_prt-'+trid).val(response.max_CIP_prt)
                                $('#input-pump_p_factor-'+trid).val(response.pump_p_factor)
                                $('#input-dynamic_p_factor-'+trid).val(response.dynamic_p_factor)
                                $('#input-p_max_volt-'+trid).val(response.p_max_volt)
                                $('#input-w_max_volt-'+trid).val(response.w_max_volt)
                                $('#input-w_value-'+trid).val(response.w_value)
                                $('#input-flow_k_factor-'+trid).val(response.flow_k_factor)
                                $('#input-volume_unit-'+trid).val(response.volume_unit)
                                $('#input-bypass_option-'+trid).val(response.bypass_option)
                                $('#input-start_pressure-'+trid).val(response.start_pressure)
                                $('#input-stop_pressure-'+trid).val(response.stop_pressure)
                                $('#input-bypass_pressure-'+trid).val(response.bypass_pressure)
                                $('#input-CIP_pressure-'+trid).val(response.CIP_pressure)
                                $('#input-wait_time_before_CIP-'+trid).val(response.wait_time_before_CIP)

                                Swal.fire('Success','Setpoints updated in server','success')
                            })
                        }
                    })
                }
            }, 10000); // 10 seconds
        })
    })

    //when user clicks on the device row
    $('tr.device-row').on('click',function(){
        //$('#modal-device-detail').modal('show');
        var trid = $(this).closest('tr').attr('id'); // table row ID
        var device_trid = trid.replace("device-info-",'')
        console.log("#### TR Clicked of device id: "+device_trid)
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
            console.log("Device Detail response of id: "+response.id)
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
            }
            if(response.logs.length > 0){
                $('tr#' + device_trid).toggle();
                var element = document.getElementById(device_trid);
                element.scrollIntoView()
                // $('html, body').animate({
                //     scrollTop: -20
                // }, 1000);
            }else
                Swal.fire("Error", "No Data found! ", "info")
        });



        //display in modal

        //console.log($('span#alarm_code_'+device_trid).text());

    })
    var start_stop_command_sent = [];
    var command_sent = "";
    var command_sent_time = null;

    $(document).ready(function () {
        // check status

        $('.loader').hide();
        setInterval(function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/refreshDashboardData",
            })
            .done(function(response){
                console.log("% % % %  Refreshing Dashboad Data % % % % %")
                console.log(response);
                console.log("% % % % % % % % % % % % % % %  % % % % % % % ")
                // console.log("command sent time: "+ command_sent_time)
                for(var i=0; i<response.length;i++){
                    if(response[i]['deviceDetails'].latest_log != null){
                        $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeAttr("hidden");
                        // console.log("Displaying response data");
                        // console.log(response[i]['deviceDetails']);

                        //change the status if new data is available
                        if(start_stop_command_sent[response[i]['deviceDetails'].id] != true && +new Date(response[i]['deviceDetails'].latest_log.created_at) >= command_sent_time){
                            var status = "";
                            var color = "";
                            if(response[i]['deviceDetails'].latest_log.step == 0 || response[i]['deviceDetails'].latest_log.step == 1 || response[i]['deviceDetails'].latest_log.step == 13){
                                status = "IDLE";
                                color = "orange";
                                //enable all relay commands
                                $('#btn_relay_1-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_2-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_3-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_4-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_5-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_6-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_7-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_8-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_relay_9-'+response[i]['deviceDetails'].id).removeAttr("disabled");
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).text("Start");
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeClass('btn-danger').addClass('btn-primary')
                            }else{
                                status = "RUNNING";
                                color = "green";
                                // disable all the relay commands
                                $('#btn_relay_1-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_2-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_3-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_4-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_5-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_6-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_7-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_8-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_relay_9-'+response[i]['deviceDetails'].id).attr("disabled","true");
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).text("Stop");
                                $('#btn_device_start_stop-'+response[i]['deviceDetails'].id).removeClass('btn-primary').addClass('btn-danger')
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
                            .done(function(response_command){
                                console.log("*************** Response of command ****************");
                                console.log(response_command);
                                if(response_command.device_read_at != null){
                                    start_stop_command_sent[response_command.device_id] = false;
                                    command_sent_time = new Date(response_command.created_at);
                                    console.log("Changed Command sent time : "+ command_sent_time)
                                    $('#btn_device_start_stop-'+response_command.device_id).attr('disabled',false).change();
                                    switch(response.command){
                                        case "Start":
                                            $('#device-info-'+response.device_id +' .status').text("Starting"); // row status
                                            break;
                                        case "Stop":
                                            $('#device-info-'+response.device_id +' .status').text("Stopping"); // row status
                                            break;
                                    }
                                }
                            });
                        }
                        // change mode
                        $('#device_mode-'+response[i]['deviceDetails'].id).text(response[i]['deviceDetails'].latest_log.mode)
                        // change output value
                        $('#device_output-'+response[i]['deviceDetails'].id).text(response[i]['deviceDetails'].latest_log.output)
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
                            water_quality = "On Target";
                            $('#info_device_conductivity_text-'+response[i]['deviceDetails'].id).text("On Target").css("color","green")
                            $('#info_device_conductivity_description-'+response[i]['deviceDetails'].id).text("The unit is removing the right amount of minerals.")

                            // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'green';
                            document.getElementById('device_condutivity_icon-'+response[i]['deviceDetails'].id).style.color = 'green';
                            document.getElementById('device_conductivity_value-'+response[i]['deviceDetails'].id).style.color = 'green';
                        }else{
                            water_quality = "Needs Attention";
                            $('#info_device_conductivity_text-'+response[i]['deviceDetails'].id).text("Needs Attention").css("color","red")
                            $('#info_device_conductivity_description-'+response[i]['deviceDetails'].id).text("The unit is removing most of the minerals. ")
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
                        if(dd < 25*1000){ // 25 seconds
                            $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Connected").css("color","green")
                            $('#device-info-'+response[i]['deviceDetails'].id ).css("color","green")
                        }else{
                            $('#device-info-'+response[i]['deviceDetails'].id ).css("color","black")
                            $('#device_connection_status-'+response[i]['deviceDetails'].id ).text("Disconnected").css("color","red")
                        }$('#last_data_received-'+response[i]['deviceDetails'].id ).text(new Date(response[i]['deviceDetails']['latest_log'].created_at))
                        // change volume
                        switch(select_view_volume_by){
                            case "gallons":
                                    $('#daily_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].daily +" gal" : "");
                                    $('#monthly_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].monthly +" gal" : "");
                                    $('#total_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?response[i]['deviceVolume'].total +" gal" : "");
                                break;
                            case "litres":
                                    $('#daily_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?(response[i]['deviceVolume'].daily/0.2642007926).toFixed(2) + " L" : "");
                                    $('#monthly_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?(response[i]['deviceVolume'].monthly/0.2642007926).toFixed(2) +" L" : "");
                                    $('#total_volume-'+response[i]['deviceDetails'].id).text(response[i]['deviceVolume']!=null?(response[i]['deviceVolume'].total/0.2642007926).toFixed(2) +" L" : "");
                                break;
                        }
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
                        var pre_filter_reset_value = response[i]['deviceDetails']['latest_maintenance_pre_filter']!=null?response[i]['deviceDetails']['latest_maintenance_pre_filter'].volume_value:0;
                        var post_filter_reset_value = response[i]['deviceDetails']['latest_maintenance_post_filter']!=null?response[i]['deviceDetails']['latest_maintenance_post_filter'].volume_value:0;
                        var general_service_reset_value = response[i]['deviceDetails']['latest_maintenance_general_service']!=null?response[i]['deviceDetails']['latest_maintenance_general_service'].volume_value:0;

                        var volume_left_critic_acid = response[i]['deviceDetails']['device_settings'].critic_acid - response[i]['deviceVolume'].total + critic_acid_reset_value ;
                        $('#critic_acid_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_critic_acid.toFixed(2));
                        var volume_left_pre_filter = response[i]['deviceDetails']['device_settings'].pre_filter - response[i]['deviceVolume'].total + pre_filter_reset_value ;
                        $('#pre_filter_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_pre_filter.toFixed(2));
                        var volume_left_post_filter = response[i]['deviceDetails']['device_settings'].post_filter - response[i]['deviceVolume'].total + post_filter_reset_value ;
                        $('#post_filter_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_post_filter.toFixed(2));
                        var volume_left_general_service = response[i]['deviceDetails']['device_settings'].general_service - response[i]['deviceVolume'].total + general_service_reset_value ;
                        $('#general_service_volume_left-'+response[i]['deviceDetails'].id).text(volume_left_general_service.toFixed(2));
                    }
                }
            });
        },5000);

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



