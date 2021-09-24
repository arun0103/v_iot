@extends('layouts.master')

@section('head')
<!-- <script src="{{asset('js/require.js')}}"></script> -->
<script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AiNdCuOv2SfFYbx2Bl0PhUGtvOgwAC762wyq7NZtQ8ISA98uAlaHJa5X3vLeNp6r' async defer></script>
<style>
    .modal-body {
        max-height: calc(100vh - 60px);
        overflow-y: auto;
    }
    #map{position:absolute; left:0;right:0;top:0;bottom:0;z-index:2}
    .modal-full {
        min-width: 100%;
        margin: 0;
        background-color: #1672ce !important;
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

@endsection
@section('content')
    <div id="app">
        <div class="content-header content-header-dashboard">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                        <button type="button" class="btn btn-info" id="btn_map_view">Map View</button>
                    </div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">

                @if(count($devices)>0)
                    <div class="row" id="table-total-devices">
                        <div class="col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <table class=" table-hover datatable" data-turbolinks="false">
                                    <thead class="thead-dark">
                                        <th>S.N</th>
                                        <th>Device Name</th>
                                        <th>Model</th>
                                        <th>#Users</th>
                                        <th>Status</th>
                                        <th>Water Quality</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach($devices as $device)
                                            <tr class="table-info device-row" id="device-info-{{$device->id}}" >
                                                <td id="device-serial-number_{{$device->id}}">{{$device->serial_number}}</td>
                                                <td>{{$device->device_name !=null? $device->device_name:"-"}}</td>
                                                <td>{{$device->model != null?$device->model->name: "-"}}</td>
                                                <td>{{$device->userDevices->count()}}</td>
                                                <td class="status" id="status-{{$device->id}}">{{$device->latest_log != null ? ($device->latest_log->step == 0 || $device->latest_log->step == 1 || $device->latest_log->step == 13 ?"IDLE" : "RUNNING") : "No Data"}}</td>
                                                <td><span class="ec" id="ec-{{$device->id}}">{{$device->latest_log != null ? ($device->latest_log->ec >=0 && $device->latest_log->ec < 200 ? "On Target" : "Needs Attention") : "No Data"}}</span></td>
                                                <td>
                                                    <button class="btn btn-primary view_device_details">View</button>
                                                    <i class="btn fas fa-bell btn_notifications"></i>
                                                    <!-- <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                        <a href="#" class="dropdown-item">
                                                            <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a id="link_view_users" href="#" class="dropdown-item link_view_users"><i class="fa fa-eye" aria-hidden="true"></i> View Users</a>
                                                        <a id="link_view_data" href="#" class="dropdown-item"><i class="fas fa-database"></i> View Data</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-gamepad"></i> Control Device</a>
                                                    </div> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
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
                                <span>
                                    <p>This is your dashboard.</p>
                                    <p>You can view your device(s) information once you add them. </p>
                                    <p>If you have sold any devices, then lets begin by adding some devices by clicking on Add New Device</span></br>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('devices')}}"><button class="btn btn-primary">Add New Device</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
    <div class="modal fade modal-view_alarms_history" id="modal-view_alarms_history">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-alarms_history-title"></h4>
                    <button type="button" class="close close_alarms_history btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <ul class="timeline" id="alarms_history_row">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left close_alarms_history"  data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-volume-chart" id="modal-volume-chart">
        <form id="form_volume_chart" class="form-horizontal" method="post" action="" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-full" >
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
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade modals-device-detail" id="modal-device-detail">
        <div class="modal-dialog modal-full" >
            <div class="modal-content">
                <div class="modal-header" style="background-color: #87bde6">
                    <h4 class="modal-title" id="modal-detail-title"></h4><br>
                    <button type="button" class="close btn_close_modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="background-color: #3979a9">
                    <section class="device-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <h5 class="card-header">
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-info" id="btn_edit_setpoints" hidden>Edit</button>
                                            <button type="button" class="btn btn-danger" id="btn_save_setpoints" hidden>Save</button>
                                            <button type="button" class="btn btn-light" id="btn_cancel_setpoints" hidden>Cancel</button>
                                        </div>
                                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                            <li class="nav-item nav_link-avg_data"  >
                                                <a class="nav-link active" href="#tab_avg_data" data-toggle="tab" >Status</a>
                                            </li>
                                            <li class="nav-item nav_link-live_data" id="nav_link-live_data">
                                                <a class="nav-link" href="#tab_live_data" data-toggle="tab">Live Data <i id="btn_refresh_live_data" class="btn fas fa-sync-alt" hidden></i></a>
                                            </li>
                                            <li class="nav-item nav_link-control" id="nav_link-control">
                                                <a class="nav-link" href="#tab_control" data-toggle="tab">Controls </a>
                                            </li>
                                            <li class="nav-item nav_link-setpoints" id="nav_link-setpoints">
                                                <a class="nav-link" href="#tab_setpoints" data-toggle="tab">Setpoints </a>
                                            </li>
                                        </ul>
                                    </h5>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" role="tabpanel" id="tab_avg_data">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 col-sm-6 box">
                                                        <div class="card card-outline card-success">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Status </h3>
                                                                <div class="card-tools">
                                                                    <i class="btn fas fa-sync-alt btn-refresh" id="device-sync"></i>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    <i id="device_status_pic" class="fas fa fa-certificate"></i>&nbsp;&nbsp;
                                                                    <span id="device_status"></span>
                                                                    <i id="info_device_status" class="fas fa-info-circle float-right info-device-status" data-toggle="dropdown" ></i>
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
                                                                </div>
                                                                <div><br>
                                                                    <span><b>Connection :</b></span>
                                                                    <i id="device_connection_status" >
                                                                    </i>
                                                                    <i id="device_output" hidden></i>
                                                                    <i id="info_device_connection" class="fas fa-info-circle float-right info-device-connection" data-toggle="dropdown" ></i>
                                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <div class="media-body">
                                                                                    <p class="text-sm"><b><i><span id="info_device_connection_text"></span></i></b></p>
                                                                                    <p class="text-sm" id="info_device_connection_description"></p>

                                                                                        <p>Last Data Received: <span id="last_data_received"></span></p>

                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row flex">
                                                                    <button id="btn_device_start_stop" class="btn btn-danger center btn_device_start_stop" hidden>Stop</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 box ">
                                                        <div class="card card-outline card-success">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Volume </h3>
                                                                <div class="card-tools">
                                                                    <i id="volume_chart" class="btn fas fa-chart-bar" data-toggle="modal" data-target="#modal-volume-chart"></i>
                                                                </div>
                                                            </div>
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
                                                                <span><b>Daily :</b> <i id="daily_volume">...</i>
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
                                                                <span><b>Monthly :</b> <i id="monthly_volume">...</i>
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
                                                                <span><b>Total :</b> <i id="total_volume">...</i>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 box">
                                                        <div class="card card-outline card-success">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Water Quality </h3>
                                                                <div class="card-tools">
                                                                    <i id="info_conductivity" class="btn fas fa-info-circle float-right" data-toggle="dropdown"></i>
                                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="info_displayed_conductivity">
                                                                        <a href="#" class="dropdown-item">
                                                                            <div class="media">
                                                                                <div class="media-body">
                                                                                    <p class="text-sm"><b><i id="info_conductivity_text">Water Quality</i></b></p>
                                                                                    <p class="text-sm" id="info_conductivity_description">Conductivity is how we measure the amount of minerals content in the water.</p>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <i class="fas fa fa-certificate" id="device_condutivity_icon" style="color:green">&nbsp;&nbsp;
                                                                <span id="device_conductivity_value"></span></i>
                                                                <i id="info_device_conductivity" class="fas fa-info-circle float-right info_device_conductivity" data-toggle="dropdown" ></i>
                                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                                    <a href="#" class="dropdown-item">
                                                                        <div class="media">
                                                                            <div class="media-body">
                                                                                <p class="text-sm"><b><i><span id="info_device_conductivity_text"></span></i></b></p>
                                                                                <p class="text-sm" id="info_device_conductivity_description"></p>
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
                                                                    <i id="info_device_alarms_table" class="btn fas fa-table" data-toggle="modal" data-target="#modal-view_alarms_history" href="#modal-view_alarms_history"></i>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <p hidden>Alarm Code: <span id="alarm_code"></span></p>
                                                                <section class="alarms-list" id="alarmsList"></section>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row flex">
                                                                    <button id="btn_reset_alarms" class="btn btn-danger center btn_reset_alarms" hidden>Clear All Alarms</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" role="tabpanel" id="tab_live_data" hidden>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                        <ul class="timeline live_data_rows" id="live_data_rows">
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
                                            <div class="tab-pane fade" role="tabpanel" id="tab_control" hidden>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                        <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_flush_module" id="btn_flush_module">Flush Module</button></div>
                                                        <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_start_cip" id="btn_start_cip">Start CIP</button></div>
                                                        <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_current_time" id="btn_current_time">Current Time</button></div>
                                                        <div class="d-inline-flex p-2"><button class="btn btn-outline-primary btn_current_date" id="btn_current_date">Current Date</button></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card">
                                                            <h4 class="card-header">
                                                                <div class="card-title">Relays</div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" data-toggle="collapse" data-target="#">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                            </h4>
                                                            <div class="card-body">
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>1. MIV &nbsp;&nbsp; </h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_1">
                                                                        <span class="slider round btn_relay_1"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>2. Bypass &nbsp;&nbsp; </h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_2">
                                                                        <span class="slider round btn_relay_2"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>3. POV  &nbsp;&nbsp;</h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_3">
                                                                        <span class="slider round btn_relay_3"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>4. WOV &nbsp;&nbsp; </h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_4">
                                                                        <span class="slider round btn_relay_4"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>5. CIP  &nbsp;&nbsp;</h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_5">
                                                                        <span class="slider round btn_relay_5"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>6. SHUNT &nbsp;&nbsp; </h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_6">
                                                                        <span class="slider round btn_relay_6"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>7. POLARITY &nbsp;&nbsp; </h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_7">
                                                                        <span class="slider round btn_relay_7"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>8. PAE &nbsp;&nbsp; </h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_8">
                                                                        <span class="slider round btn_relay_8"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="d-inline-flex p-2">
                                                                    <h4>9. BUZZER &nbsp;&nbsp;</h4>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="btn_relay_9">
                                                                        <span class="slider round btn_relay_9"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" role="tabpanel" id="tab_setpoints" hidden>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="button" class="btn btn-primary btn_getDeviceSetpoints" id="btn_get_device_setpoints">Get Device Setpoints</button><br>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-pure_EC_target">1. Pure EC Target</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-pure_EC_target" id="input-pure_EC_target" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-pre_purify_time">2. Pre-purify Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-pre_purify_time" id="input-pre_purify_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-purify_time">3. Purify Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-purify_time" id="input-purify_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-waste_time">4. Waste Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-waste_time" id="input-waste_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-HF_waste_time">5. HF Waste Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-HF_waste_time" id="input-HF_waste_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_dose">6. CIP Dose</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_dose" id="input-CIP_dose" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_dose_rec">7. CIP Dose Rec</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_dose_rec" id="input-CIP_dose_rec" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_dose_total">8. CIP Dose Total</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_dose_total" id="input-CIP_dose_total" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_flow_total">9. CIP Flow Total</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_flow_total" id="input-CIP_flow_total" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_flow_flush">10. CIP Flow Flush</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_flow_flush" id="input-CIP_flow_flush" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_flow_rec">11. CIP Flow Rec</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_flow_rec" id="input-CIP_flow_rec" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_flush_time">12. CIP Flush Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_flush_time" id="input-CIP_flush_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-WV_check_time">13. WV Check Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-WV_check_time" id="input-WV_check_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-wait_HT_time">14. Wait HT Time</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-wait_HT_time" id="input-wait_HT_time" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-p_flow_target">15. P.Flow Target</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-p_flow_target" id="input-p_flow_target" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-low_flow_purify_alarm">16. Low Flow Purify Alarm</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-low_flow_purify_alarm" id="input-low_flow_purify_alarm" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-low_flow_waste_alarm">17. Low Flow Waste Alarm</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-low_flow_waste_alarm" id="input-low_flow_waste_alarm" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_cycles">18. CIP Cycles</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_cycles" id="input-CIP_cycles" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-temperature_alarm">19. Temperature Alarm</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-temperature_alarm" id="input-temperature_alarm" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-max_CIP_prt">20. Max CIP P.R.T</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-max_CIP_prt" id="input-max_CIP_prt" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-pump_p_factor">21. Pump P-Factor</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-pump_p_factor" id="input-pump_p_factor" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-dynamic_p_factor">22. Dynamic P-Factor</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-dynamic_p_factor" id="input-dynamic_p_factor" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-p_max_volt">23. P.Max Volt</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-p_max_volt" id="input-p_max_volt" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-w_max_volt">24. W.Max Volt</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-w_max_volt" id="input-w_max_volt" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-w_value">25. W_Value</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-w_value" id="input-w_value" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-flow_k_factor">26. Flow K Factor</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-flow_k_factor" id="input-flow_k_factor" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-volume_unit">27. Volume Unit</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <select class="form-control input-setpoints"  id="input-volume_unit">
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
                                                        <input class="form-control input-setpoints" type="number" name="input-bypass_option" id="input-bypass_option" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-start_pressure">29. Start Pressure</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-start_pressure" id="input-start_pressure" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-stop_pressure">30. Stop Pressure</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-stop_pressure" id="input-stop_pressure" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-bypass_pressure">31. Bypass Pressure</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-bypass_pressure" id="input-bypass_pressure" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-CIP_pressure">32. CIP Pressure</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-CIP_pressure" id="input-CIP_pressure" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <label for="input-wait_time_before_CIP">33. Wait Time Before CIP</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                                                        <input class="form-control input-setpoints" type="number" name="input-wait_time_before_CIP" id="input-wait_time_before_CIP" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" id="footer_maintenance">
                                        <div class="row" id="maintenance_tab">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <h5 class="card-header" >Routine Maintenance <button class="btn btn-sm btn-primary btn_edit_maintenance" id="btn_edit_maintenance">Edit</button>
                                                        <div class="card-tools">

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
                                                                    <span id="critic_acid_details">
                                                                        <b><span id="critic_acid_volume_left"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="critic_acid_error" id="critic_acid_error"></p>
                                                                </td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_critic_acid" class="form-control input_critic_acid" value="" disabled><span class="text-muted">&nbsp; gal</span></td>
                                                                <td><button class="btn btn-primary btn-save-critic_acid" id="btn_save_critic_acid" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn_reset_critic_acid" id="btn_reset_critic_acid" disabled>Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">Pre-filter</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="pre_filter_details">
                                                                        <b><span id="pre_filter_volume_left"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="pre_filter_error" id="pre_filter_error"></p></td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_pre_filter" class="form-control input_pre_filter" value="" disabled><span class="text-muted">&nbsp; gal</span></td>
                                                                <td><button class="btn btn-primary btn-save-pre_filter" id="btn_save_pre_filter" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn_reset_pre_filter" id="btn_reset_pre_filter" disabled>Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">Post-filter</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="post_filter_details">
                                                                        <b><span id="post_filter_volume_left"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="post_filter_error" id="post_filter_error"></p></td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_post_filter" class="form-control input_post_filter" value="" disabled><span class="text-muted">&nbsp; gal</span></td>
                                                                <td><button class="btn btn-primary btn-save-post_filter" id="btn_save_post_filter" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger btn_reset_post_filter" id="btn_reset_post_filter" disabled>Reset</button></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="line-height: 2.5em">General</th>
                                                                <td style="line-height: 2.5em;text-align:right">
                                                                    <span id="general_service_details">
                                                                        <b><span id="general_service_volume_left"></span></b> gal left before next service
                                                                    </span>
                                                                    <p style="text-align:center;font-weight:900" class="general_service_error" id="general_service_error"></p></td>
                                                                <td class="form-inline"><input style="width:100px" type="number" id="input_general_service" class="form-control input_general_service" value="" disabled><span class="text-muted">&nbsp; gal</span></td>
                                                                <td><button class="btn btn-primary  btn-save-general_service" id="btn_save_general_service" hidden>Save</button></td>
                                                                <td><button class="btn btn-danger  btn_reset_general_service" id="btn_reset_general_service" disabled>Reset</button></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
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
    <div class="modal fade" id="modal-map_view">
        <div class="modal-dialog modal-full" >
            <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

               <div id="myMap" style='position:relative;width:800px;height:500px;'></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-device_notifications">
        <div class="modal-dialog modal-full" >
            <div class="modal-header" style="background-color: #87bde6">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="modal-title" id="notifications_heading">Notifications</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-content" style="background-color: #3979a9">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item nav_maintenance_logs"  >
                                <a class="nav-link active" aria-current="page" href="#tab_maintenance_logs" data-toggle="tab" >Maintenance Logs</a>
                            </li>
                            <li class="nav-item nav_controls_logs">
                                <a class="nav-link" href="#tab_controls_logs" data-toggle="tab">Command Logs<i id="btn_refresh_live_data" class="btn fas fa-sync-alt" hidden></i></a>
                            </li>
                            <li class="nav-item nav_setpoints_logs">
                                <a class="nav-link" href="#tab_setpoints_logs" data-toggle="tab">Setpoints Logs<i id="btn_refresh_live_data" class="btn fas fa-sync-alt" hidden></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" role="tabpanel" id="tab_maintenance_logs">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 box">
                                        <table class="table" id="maintenance_logs_table">
                                            <thead>
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Old Value</th>
                                                    <th>New Value</th>
                                                    <th>Updated By</th>
                                                    <th>Updated At</th>
                                                </tr>
                                            </thead>
                                            <tbody id="maintenance_logs_body">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="tab_controls_logs">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 box">
                                        <table class="table" id="control_logs_table">
                                            <thead>
                                                <tr>
                                                    <th>Command</th>
                                                    <th>Executed at</th>
                                                    <th>Message</th>
                                                    <th>Created By</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody id="controls_logs_body">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="tab_setpoints_logs">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 box">
                                        <table class="table" id="setpoints_logs_table">
                                            <thead>
                                                <tr>
                                                    <th>Parameter</th>
                                                    <th>Old Value</th>
                                                    <th>New Value</th>
                                                    <th>Updated By</th>
                                                    <th>Updated At</th>
                                                </tr>
                                            </thead>
                                            <tbody id="setpoints_logs_body">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- //Bing map -->
    <script type='text/javascript'>
        function GetMap(){
            var map = new Microsoft.Maps.Map('#myMap', {
                center: new Microsoft.Maps.Location(51.50632, -0.12714),
                mapTypeId: Microsoft.Maps.MapTypeId.aerial,
                zoom: 1
            });
            //Add your post map load code here.
        }
    </script>
<!-- // -->
<script>
    var device_id = 0;
    let device_serial = null;
    var critic_acid_reset_value, pre_filter_reset_value, post_filter_reset_value, general_service_reset_value;
    var btn_clicked = null;
    $(document).ready(function () {
        $('.datatable').dataTable();
        setInterval(function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/refreshDashboardRows"
            }).done(function(response){
                for(let i= 0; i<response.length; i++){
                    let d_id = response[i].id;
                    if(response[i].latest_log != null){
                        // change the water quality
                        let water_quality ="";
                        let color;
                        let setpoint_pure_EC_target = response[i].setpoints.pure_EC_target;
                        let avg_EC_target = response[i].latest_log.ec;
                        let difference_ec = setpoint_pure_EC_target - avg_EC_target;
                        if(difference_ec<0){
                            difference_ec = difference_ec * (-1);
                        }
                        var percentage_EC_target = (difference_ec *100)/setpoint_pure_EC_target
                        if(percentage_EC_target <= 10){
                            water_quality = "On Target";
                            color = "green";
                        }else{
                            water_quality = "Needs Attention";
                            color = "red"
                        }
                        $('#ec-'+response[i].id).text(water_quality).css('color',color);
                        // change status
                        if(response[i].latest_log.step == 0 || response[i].latest_log.step == 1 || response[i].latest_log.step == 13){
                            status = "IDLE";
                            color = "orange";

                        }else{
                            status = "RUNNING";
                            color = "green";
                        }
                        $('#status-'+d_id).text(status).css("color", color); // row status
                    }
                }
            })
        },5000);
        let refresh_data;
        //when user clicks on the device row
            $('.view_device_details').on('click',function(){
                var trid = $(this).closest('tr').attr('id'); // table row ID
                device_id = trid.replace("device-info-",'') // device id  from table row
                //show average tab only
                view_mode = "average";
                view_live_device = null; // we are not in live mode
                $('#tab_avg_data').show();
                $('a[href="#tab_avg_data"]').tab('show');
                $('.card-header-tabs li a').removeClass('active');
                $('.nav_link-avg_data a').addClass('active');
                $('#btn_refresh_live_data').attr('hidden', true);
                $('#tab_live_data').hide();
                $('#tab_control').hide();
                $('#btn_edit_setpoints').attr('hidden',true);
                $('#btn_save_setpoints').attr('hidden',true)
                $('#btn_cancel_setpoints').attr('hidden',true)
                $('#footer_maintenance').attr('hidden',false)
                // get the setpoints from the database and save for future calculations
                // CIP_cycle, volume unit are two setpoints that is needed to calculate live view data
                var userDevices;
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "GET",
                    url: "/getDeviceSetpointsForCalculation/"+device_id,
                })
                .done(function(response){
                    userDevices = response;
                });
                $('#modal-detail-title').text($("#"+trid).find("td:first").html())
                device_serial = $("#"+trid).find("td:first").html();

                //get data from database every 5 seconds
                refresh_data = setInterval(function(){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "GET",
                        url: "/refreshStatusData/"+device_id,
                    })
                    .done(function(response){
                        // console.log("% % % %  Refreshing Dashboad Data :"+device_id + " % % % % %")
                        // console.log(response);
                        if(response['deviceDetails'].latest_log != null){
                            $('#btn_device_start_stop').removeAttr("hidden");

                            //change the status if new data is available
                            if(start_stop_command_sent != true && +new Date(response['deviceDetails'].latest_log.created_at) >= command_sent_time){
                                var status = "";
                                var color = "";
                                if(response['deviceDetails'].latest_log.step == 0 || response['deviceDetails'].latest_log.step == 1 || response['deviceDetails'].latest_log.step == 13){
                                    status = "IDLE";
                                    color = "orange";
                                    //enable all relay commands
                                        $('#btn_relay_1').removeAttr("disabled");
                                        $('#btn_relay_2').removeAttr("disabled");
                                        $('#btn_relay_3').removeAttr("disabled");
                                        $('#btn_relay_4').removeAttr("disabled");
                                        $('#btn_relay_5').removeAttr("disabled");
                                        $('#btn_relay_6').removeAttr("disabled");
                                        $('#btn_relay_7').removeAttr("disabled");
                                        $('#btn_relay_8').removeAttr("disabled");
                                        $('#btn_relay_9').removeAttr("disabled");
                                    //
                                    if($('#device_status_pic').hasClass("running"))
                                        $('#device_status_pic').removeClass("running")
                                    if(!$('#device_status_pic').hasClass("idle"))
                                        $('#device_status_pic').addClass("idle")
                                    $('#btn_device_start_stop').text("Start");
                                    $('#btn_device_start_stop').removeClass('btn-danger').addClass('btn-primary')
                                }else{
                                    status = "RUNNING";
                                    color = "green";
                                    // disable all the relay commands
                                        $('#btn_relay_1').attr("disabled","true");
                                        $('#btn_relay_2').attr("disabled","true");
                                        $('#btn_relay_3').attr("disabled","true");
                                        $('#btn_relay_4').attr("disabled","true");
                                        $('#btn_relay_5').attr("disabled","true");
                                        $('#btn_relay_6').attr("disabled","true");
                                        $('#btn_relay_7').attr("disabled","true");
                                        $('#btn_relay_8').attr("disabled","true");
                                        $('#btn_relay_9').attr("disabled","true");
                                    //
                                    if($('#device_status_pic').hasClass("idle"))
                                        $('#device_status_pic').removeClass("idle")
                                    if(!$('#device_status_pic').hasClass("running"))
                                        $('#device_status_pic').addClass("running")
                                    $('#btn_device_start_stop').text("Stop");
                                    $('#btn_device_start_stop').removeClass('btn-primary').addClass('btn-danger')
                                }
                                $('#device-info' +' .status').text(status); // row status
                                $('#device_status').text(status);   // device info status
                                document.getElementById('device_status').style.color = color;
                                document.getElementById('device_status_pic').style.color = color;
                            }else{
                                $('#device-info'+' .status').text("Pending"); // row status
                                $('#device_status').text("Pending");   // device info status
                                document.getElementById('device_status').style.color = "black";
                                document.getElementById('device_status_pic').style.color = "black";
                                // get the command status
                                $.ajax({
                                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                    type: "GET",
                                    url: "/command_status/"+command_sent+"/"+ response['deviceDetails'].id,
                                })
                                .done(function(response_command){
                                    // console.log("*************** Response of command ****************");
                                    // console.log(response_command);
                                    if(response_command.device_read_at != null){
                                        start_stop_command_sent = false;
                                        command_sent_time = +new Date(response_command.device_read_at);
                                        console.log("Changed Command sent time : "+ command_sent_time)
                                        $('#btn_device_start_stop').attr('disabled',false).change();
                                        switch(response.command){
                                            case "Start":
                                                $('#device-info'+' .status').text("Starting"); // row status
                                                break;
                                            case "Stop":
                                                $('#device-info'+' .status').text("Stopping"); // row status
                                                break;
                                        }
                                    }else{
                                        command_sent_time = +new Date(response_command.created_at)
                                        console.log("Command sent time : "+ command_sent_time)
                                    }
                                });
                            }
                            // change output value
                            $('#device_output').text(response['deviceDetails'].latest_log.output)
                            // calculating output
                            var output = response['deviceDetails'].latest_log.output
                            var output_binary_string = (output >>> 0).toString(2);

                            for(var index =1; index<10; index++ ){
                                // console.log("i = "+i+ " value = "+output_binary_string.charAt(i))
                                if(output_binary_string.charAt(16-index)=='1') // 1 = OFF, 0 = ON
                                    $('#btn_relay_'+index).attr("checked",false).trigger("change");
                                else
                                    $('#btn_relay_'+index).attr("checked", true).trigger("change");
                            }
                            // change the water quality
                            var water_quality ="";
                            var setpoint_pure_EC_target = response['deviceDetails']['setpoints'].pure_EC_target;
                            var avg_EC_target = response['deviceDetails'].latest_log.ec;
                            var difference_ec = setpoint_pure_EC_target - avg_EC_target;
                            if(difference_ec<0){
                                difference_ec = difference_ec * (-1);
                            }
                            var percentage_EC_target = (difference_ec *100)/setpoint_pure_EC_target
                            if(percentage_EC_target <= 10){
                                water_quality = "On Target";
                                $('#info_device_conductivity_text').text("On Target").css("color","green")
                                $('#info_device_conductivity_description').text("The unit is removing the right amount of minerals.")

                                // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'green';
                                document.getElementById('device_condutivity_icon').style.color = 'green';
                                document.getElementById('device_conductivity_value').style.color = 'green';
                            }else{
                                water_quality = "Needs Attention";
                                $('#info_device_conductivity_text').text("Needs Attention").css("color","red")
                                $('#info_device_conductivity_description').text("The unit is removing most of the minerals. ")
                                // document.getElementById('device-info-'+response[i]['deviceDetails'].id +' .ec').style.color = 'red';
                                document.getElementById('device_condutivity_icon').style.color = 'red';
                                document.getElementById('device_conductivity_value').style.color = 'red';
                            }
                            $('#ec-'+response['deviceDetails'].id).text(water_quality);
                            $('#device_conductivity_value').text(water_quality); // device info water quality
                            // change device connection status
                            var now = new Date();
                            var created_at = new Date(response['deviceDetails'].latest_log.created_at);
                            var dd = now - created_at;
                            if(dd < 60*1000){ // 60 seconds
                                $('#device_connection_status' ).text("Connected").css("color","green")
                                $('#device-info').css("color","green")
                            }else{
                                $('#device-info' ).css("color","black")
                                $('#device_connection_status').text("Disconnected").css("color","red")
                            }$('#last_data_received').text(new Date(response['deviceDetails']['latest_log'].created_at))
                            // change volume
                            switch(select_view_volume_by){
                                case "gallons":
                                        $('#daily_volume').text(response['deviceVolume']!=null?response['deviceVolume'].daily +" gal" : "");
                                        $('#monthly_volume').text(response['deviceVolume']!=null?response['deviceVolume'].monthly +" gal" : "");
                                        $('#total_volume').text(response['deviceVolume']!=null?response['deviceVolume'].total +" gal" : "");
                                    break;
                                case "litres":
                                        $('#daily_volume').text(response['deviceVolume']!=null?(response['deviceVolume'].daily/0.2642007926).toFixed(2) + " L" : "");
                                        $('#monthly_volume').text(response['deviceVolume']!=null?(response['deviceVolume'].monthly/0.2642007926).toFixed(2) +" L" : "");
                                        $('#total_volume').text(response['deviceVolume']!=null?(response['deviceVolume'].total/0.2642007926).toFixed(2) +" L" : "");
                                    break;
                            }
                            // change alarm
                            var alarms = response['deviceDetails'].latest_log.alarm;
                            if(alarms >0){
                                $('#btn_reset_alarms').removeAttr("hidden");
                            }else{
                                $('#btn_reset_alarms').attr("hidden","true");
                            }
                            var bin_alarms = (alarms >>> 0).toString(2);
                            for(var ii = bin_alarms.length; ii<24 ; ii++){
                                bin_alarms = "0"+bin_alarms;
                            }
                            $('section#alarmsList').empty();
                            for(var  j= 0 ; j < bin_alarms.length ; j++){
                                if(bin_alarms[j] == "1"){ // 1 states that there is alarm so find the location of alarm and display
                                    switch(j){
                                        case 0: $('section#alarmsList').append("<p>Reserved For future</p>");break;
                                        case 1: $('section#alarmsList').append("<p>Reserved For future</p>");break;
                                        case 2: $('section#alarmsList').append("<p>Reserved For future</p>");break;
                                        case 3: $('section#alarmsList').append("<p>FLOWMETER COMM ERROR</p>");break;
                                        case 4: $('section#alarmsList').append("<p>ATLAS TEMPERATURE ERROR</p>");break;
                                        case 5: $('section#alarmsList').append("<p>ZERO EC ALARM</p>");break;
                                        case 6: $('section#alarmsList').append("<p>ATLAS I2C COM ERROR</p>");break;
                                        case 7: $('section#alarmsList').append("<p>LOW PRESSURE ALARM</p>");break;
                                        case 8: $('section#alarmsList').append("<p>PAE AC INPUT FAIL</p>");break;
                                        case 9: $('section#alarmsList').append("<p>PAE AC POWER DOWN</p>");break;
                                        case 10:$('section#alarmsList').append("<p>PAE HIGH TEMPERATURE</p>");break;
                                        case 11:$('section#alarmsList').append("<p>PAE AUX OR SMPS FAIL</p>");break;
                                        case 12:$('section#alarmsList').append("<p>PAE FAN FAIL</p>");break;
                                        case 13:$('section#alarmsList').append("<p>PAE OVER TEMP SHUTDOWN</p>");break;
                                        case 14:$('section#alarmsList').append("<p>PAE OVER LOAD SHUTDOWN</p>");break;
                                        case 15:$('section#alarmsList').append("<p>PAE OVER VOLT SHUTDOWN</p>");break;
                                        case 16:$('section#alarmsList').append("<p>PAE COMMUNICATION ERROR</p>");break;
                                        case 17:$('section#alarmsList').append("<p>CIP LOW LEVEL ALARM</p>");break;
                                        case 18:$('section#alarmsList').append("<p>WASTE VALVE ALARM</p>");break;
                                        case 19:$('section#alarmsList').append("<p>LEAKAGE ALARM</p>");break;
                                        case 20:$('section#alarmsList').append("<p>CABINET TEMP ALARM</p>");break;
                                        case 21:$('section#alarmsList').append("<p>BYPASS ALARM</p>");break;
                                        case 22:$('section#alarmsList').append("<p>LOW FLOW WASTE ALARM</p>");break;
                                        case 23:$('section#alarmsList').append("<p>LOW FLOW PURE ALARM</p>");break;
                                    }
                                }
                            }
                            // maintenance
                            //get past reset values
                            critic_acid_reset_value = response['deviceDetails']['latest_maintenance_critic_acid']!=null?response['deviceDetails']['latest_maintenance_critic_acid'].volume_value:0;
                            pre_filter_reset_value = response['deviceDetails']['latest_maintenance_pre_filter']!=null?response['deviceDetails']['latest_maintenance_pre_filter'].volume_value:0;
                            post_filter_reset_value = response['deviceDetails']['latest_maintenance_post_filter']!=null?response['deviceDetails']['latest_maintenance_post_filter'].volume_value:0;
                            general_service_reset_value = response['deviceDetails']['latest_maintenance_general_service']!=null?response['deviceDetails']['latest_maintenance_general_service'].volume_value:0;
                            //maintenance setpoints
                            $('#input_critic_acid').val(response['deviceDetails']['device_settings'].critic_acid);
                            $('#input_pre_filter').val(response['deviceDetails']['device_settings'].pre_filter);
                            $('#input_post_filter').val(response['deviceDetails']['device_settings'].post_filter);
                            $('#input_general_service').val(response['deviceDetails']['device_settings'].general_service);
                            // calculate volume left
                            var volume_left_critic_acid = response['deviceDetails']['device_settings'].critic_acid - response['deviceVolume'].total + critic_acid_reset_value ;
                            $('#critic_acid_volume_left').text(volume_left_critic_acid.toFixed(2));
                            var volume_left_pre_filter = response['deviceDetails']['device_settings'].pre_filter - response['deviceVolume'].total + pre_filter_reset_value ;
                            $('#pre_filter_volume_left').text(volume_left_pre_filter.toFixed(2));
                            var volume_left_post_filter = response['deviceDetails']['device_settings'].post_filter - response['deviceVolume'].total + post_filter_reset_value ;
                            $('#post_filter_volume_left').text(volume_left_post_filter.toFixed(2));
                            var volume_left_general_service = response['deviceDetails']['device_settings'].general_service - response['deviceVolume'].total + general_service_reset_value ;
                            $('#general_service_volume_left').text(volume_left_general_service.toFixed(2));
                            //check if maintenance needed
                            var is_maintenance_needed = false;
                            if(volume_left_critic_acid < 0){
                                volume_left_critic_acid = 0;
                                is_maintenance_needed = true;
                                $('#critic_acid_details').attr("hidden","true");
                                $('#critic_acid_error').text("Critic acid refill needed!").css("color","red");
                                $('#btn_reset_critic_acid').attr('disabled',false);
                            }
                            if(volume_left_pre_filter < 0){
                                volume_left_pre_filter = 0;
                                is_maintenance_needed = true;
                                $('#pre_filter_details').attr("hidden","true");
                                $('#pre_filter_error').text("Pre-filter replacement needed!").css("color","red");
                                $('#btn_reset_pre_filter').attr('disabled',false);
                            }
                            if(volume_left_post_filter < 0){
                                volume_left_post_filter = 0;
                                is_maintenance_needed = true;
                                $('#post_filter_details').attr("hidden","true");
                                $('#post_filter_error').text("Post-filter replacement needed!").css("color","red");
                                $('#btn_reset_post_filter').attr('disabled',false);
                            }
                            if(volume_left_general_service < 0){
                                volume_left_general_service = 0;
                                is_maintenance_needed = true;
                                $('#general_service_details').attr("hidden","true");
                                $('#general_service_error').text("General service needed!").css("color","red");
                                $('#btn_reset_general_service').attr('disabled',false);
                            }
                            if(is_maintenance_needed)
                                $('section#alarmsList').append('<a class="goto_maintenance" id="goto_maintenance"><p><button class="btn btn-warning btn_goto_maintenance">Routine Maintenance Needed</button></p><a>');
                            //Show volumes left
                            $('#critic_acid_volume_left').text(volume_left_critic_acid.toFixed(2));
                            $('#pre_filter_volume_left').text(volume_left_pre_filter.toFixed(2));
                            $('#post_filter_volume_left').text(volume_left_post_filter.toFixed(2));
                            $('#general_service_volume_left').text(volume_left_general_service.toFixed(2));
                        }
                    });
                },5000);
                $('#modal-device-detail').modal('show');
            })
            $('.alarms-list').on('click','.goto_maintenance', function(){
                var element = document.getElementById("maintenance_tab");
                element.scrollIntoView({behavior: "smooth", block: "end"})
            })
            $('.btn_close_modal').on('click', function(){
                clearInterval(refresh_data);
            })
        // check status

        $('.loader').hide();
        $('#btn_map_view').on('click', function(){
            $('#modal-map_view').modal("show")
            GetMap();
        })
        // to show modal inside a modal
            $(document).on('show.bs.modal', '.modal', function (event) {
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            });
        //working codes..to show modal inside a modal

        // rotation of icon while the device is running
        var angle=0;
        setInterval(function(){
            if(angle==360)
                angle = 0
            angle += 3;
            $(".running").css('transform','rotate('+angle+'deg)');
        }, 50);

        //blink the icon while the device is idle
        (function blink(){
            $(".idle").fadeOut(1000).fadeIn(1000, blink);
        })();

        //shake

        //Notifications
            $('.btn_notifications').on('click',function(){
                var trid = $(this).closest('tr').attr('id'); // table row ID
                device_id = trid.replace("device-info-",'') // device id  from table row
                $('#notifications_heading').text("Notifications: "+$('#device-serial-number_'+device_id).text())
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "GET",
                    url: "/getDeviceNotifications/"+device_id,
                })
                .done(function(response){
                    // If table is initialized
                    if ($.fn.DataTable.isDataTable('#maintenance_logs_table')){
                        // Destroy existing table
                        $('#maintenance_logs_table').DataTable().destroy();
                    }
                    // update maintenance logs table
                    $('#maintenance_logs_body').html('');
                    if(response.maintenance.length == 0){
                        $('#maintenance_logs_table').attr('hidden', true);
                    }else{
                        $('#maintenance_logs_table').attr('hidden', false);
                    }
                    for(let i = 0; i<response.maintenance.length; i++){
                        $('#maintenance_logs_body').append('<tr id="'+response.maintenance[i].id +'"><td>'+response.maintenance[i].parameter+'</td>'
                            +'<td>'+response.maintenance[i].old_value +'</td>'
                            +'<td>'+response.maintenance[i].new_value +'</td>'
                            +'<td>'+response.maintenance[i].changer_details.name +'</td>'
                            +'<td>'+ new Date(response.maintenance[i].created_at) +'</td>'
                            +'</tr>'
                        )
                    }
                    // Initialize the table
                    $('#maintenance_logs_table').DataTable();
                    // If table is initialized
                    if ($.fn.DataTable.isDataTable('#control_logs_table')){
                        // Destroy existing table
                        $('#control_logs_table').DataTable().destroy();
                    }
                    // update controls logs table
                    $('#controls_logs_body').html('');
                    for(let i = 0; i<response.controls.length; i++){
                        let device_read_at = response.controls[i].device_read_at == null ? '-' : new Date(response.controls[i].device_read_at)
                        let device_response_data = response.controls[i].device_response_data == null ? '-': response.controls[i].device_response_data
                        $('#controls_logs_body').append('<tr id="'+response.controls[i].id +'"><td>'+response.controls[i].command+'</td>'
                            +'<td>'+device_read_at +'</td>'
                            +'<td>'+device_response_data+'</td>'
                            +'<td>'+response.controls[i].creator_details.name +'</td>'
                            +'<td>'+ new Date(response.controls[i].created_at) +'</td>'
                            +'</tr>'
                        )
                    }
                    // Initialize the table
                    $('#control_logs_table').DataTable();
                    // If table is initialized
                    if ($.fn.DataTable.isDataTable('#setpoints_logs_table')){
                        // Destroy existing table
                        $('#setpoints_logs_table').DataTable().destroy();
                    }
                    // update setpoints logs table
                    $('#setpoints_logs_body').html('');
                    for(let i = 0; i<response.setpoints.length; i++){
                        $('#setpoints_logs_body').append('<tr id="'+response.setpoints[i].id +'"><td>'+response.setpoints[i].parameter+'</td>'
                            +'<td>'+response.setpoints[i].old_value +'</td>'
                            +'<td>'+response.setpoints[i].new_value +'</td>'
                            +'<td>'+response.setpoints[i].changer_details.name +'</td>'
                            +'<td>'+ new Date(response.setpoints[i].created_at) +'</td>'
                            +'</tr>'
                        )
                    }
                    // Initialize the table
                    $('#setpoints_logs_table').DataTable();
                    $('#modal-device_notifications').modal('show');
                });
            })
            $('.nav_maintenance_logs').on('click',function(){
                $('#tab_maintenance_logs').show();
                $('#tab_controls_logs').hide();
                $('#tab_setpoints_logs').hide();
            })
            $('.nav_controls_logs').on('click',function(){
                $('#tab_controls_logs').show();
                $('#tab_setpoints_logs').hide();
                $('#tab_maintenance_logs').hide();
            })
            $('.nav_setpoints_logs').on('click',function(){
                $('#tab_setpoints_logs').show();
                $('#tab_controls_logs').hide();
                $('#tab_maintenance_logs').hide();
            })
        //
    });
    // Maintenance
        var old_critic_value, old_pre_filter, old_post_filter, old_general_service;
        $('.btn_edit_maintenance').on('click',function(){
            old_critic_value = $('.input_critic_acid').val();
            old_pre_filter = $('.input_pre_filter').val();
            old_post_filter = $('.input_post_filter').val();
            old_general_service = $('.input_general_service').val();
            $('.input_critic_acid').removeAttr("disabled");
            $('.input_pre_filter').removeAttr("disabled");
            $('.input_post_filter').removeAttr("disabled");
            $('.input_general_service').removeAttr("disabled");
        })
        $('.input_critic_acid').on('keyup', function(){
            $('#btn_save_critic_acid').removeAttr("hidden");
        });
        $('.input_pre_filter').on('keyup', function(){
            $('#btn_save_pre_filter').removeAttr("hidden");
        });
        $('.input_post_filter').on('keyup', function(){
            $('#btn_save_post_filter').removeAttr("hidden");
        });
        $('.input_general_service').on('keyup', function(){
            $('#btn_save_general_service').removeAttr("hidden");
        });

        $('.btn-save-critic_acid').on('click', function(){
            if($('#input_critic_acid').val() >0 && $('#input_critic_acid').val() <= 50000){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "POST",
                    url: "/saveCriticAcid/"+ device_id,
                    data: {"critic_acid":$('#input_critic_acid').val()}

                })
                .done(function(response){
                    Swal.fire('Success','Critic Acid Updated','success')
                    $('#btn_save_critic_acid').attr("hidden", true);
                });
            }else{
                Swal.fire("Error", "Value out of range[0-50,000]","error");
                $('#input_critic_acid').val(old_critic_value)
            }
        })
        $('.btn-save-pre_filter').on('click', function(){
            if($('#input_pre_filter').val() >0 && $('#input_pre_filter').val() <= 50000){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "POST",
                    url: "/savePreFilter/"+ device_id,
                    data: {"pre_filter":$('#input_pre_filter').val()}

                })
                .done(function(response){
                    Swal.fire('Success','Pre-filter Updated','success')
                    $('#btn_save_pre_filter').attr("hidden", true);
                });
            }else{
                Swal.fire("Error", "Value out of range[0-50,000]","error");
                $('#input_pre_filter').val(old_pre_filter)
            }
        })
        $('.btn-save-post_filter').on('click', function(){
            if($('#input_post_filter').val() >0 && $('#input_post_filter').val() <= 50000){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "POST",
                    url: "/savePostFilter/"+ device_id,
                    data: {"post_filter":$('#input_post_filter').val()}

                })
                .done(function(response){
                    Swal.fire('Success','Post-filter Updated','success')
                    $('#btn_save_post_filter').attr("hidden", true);
                });
            }else{
                Swal.fire("Error", "Value out of range[0-50,000]","error");
                $('#input_post_filter').val(old_post_filter)
            }
        })
        $('.btn-save-general_service').on('click', function(){
            if($('#input_general_service').val() >0 && $('#input_general_service').val() <= 50000){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "POST",
                    url: "/saveGeneralService/"+ device_id,
                    data: {"general_service":$('#input_general_service').val()}
                })
                .done(function(response){
                    Swal.fire('Success','General Service Updated','success')
                    $('#btn_save_general_service').attr("hidden", true);
                });
            }else{
                Swal.fire("Error", "Value out of range[0-50,000]","error");
                $('#input_general_service').val(old_general_service)
            }
        })
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
                        var v = $('#total_volume').text().split(" ");
                        var volume = parseFloat(v[0]);
                        $.ajax({
                            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "POST",
                            url: "/resetCriticAcid/"+ device_id +"/"+volume,
                        })
                        .done(function(response){
                            $('#critic_acid_error').text("").trigger("change");
                            $('#critic_acid_details').removeAttr("hidden");
                            $('#critic_acid_volume_left').text(critic_acid_reset_value);
                            Swal.fire('Done!','Critic acid refilled.','success')
                            $('#btn_reset_critic_acid')attr('disabled',true);
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
                        var v = $('#total_volume').text().split(" ");
                        var volume = parseFloat(v[0]);
                        $.ajax({
                            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "POST",
                            url: "/resetPreFilter/"+ device_id +"/"+volume,
                        })
                        .done(function(response){
                            $('#pre_filter_error').text("").trigger("change");
                            $('#pre_filter_details').removeAttr("hidden");
                            $('#pre_filter_volume_left').text(pre_filter_reset_value).trigger("change");
                            Swal.fire('Done!','Pre-filter replaced.','success')
                            $('#btn_reset_pre_filter')attr('disabled',true);
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
                        var v = $('#total_volume').text().split(" ");
                        var volume = parseFloat(v[0]);
                        $.ajax({
                            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "POST",
                            url: "/resetPostFilter/"+ device_id +"/"+volume,
                        })
                        .done(function(response){
                            $('#post_filter_error').text("").trigger("change");
                            $('#post_filter_details').removeAttr("hidden");
                            $('#post_filter_volume_left').text(post_filter_reset_value).trigger("change");
                            Swal.fire('Done!','Post filter replaced.','success')
                            $('#btn_reset_post_filter')attr('disabled',true);
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
                        var v = $('#total_volume').text().split(" ");
                        var volume = parseFloat(v[0]);
                        $.ajax({
                            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "POST",
                            url: "/resetGeneralService/"+ device_id +"/"+volume,
                        })
                        .done(function(response){
                            $('#general_service_error').text("").trigger("change");
                            $('#general_service_details').removeAttr("hidden");
                            $('#general_service_volume_left').text(general_service_reset_value).trigger("change");
                            Swal.fire('Done!','General Service performed.','success')
                            $('#btn_reset_general_service')attr('disabled',true);
                        })

                    }
                })

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
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "POST",
                url: "/flush_module/"+ device_id,
            })
            .done(function(response){
                Swal.fire('Success','Command recorded.','success')
                var date = new Date(response.created_at)
                $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
            });
        })
        //relays
        $('.btn_relay_1').on('click', function(){
            if(!$('#btn_relay_1').is('[disabled=disabled]')){
                if($('#btn_relay_1').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_1_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_1_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_2').on('click', function(){
            if(!$('#btn_relay_2').is('[disabled=disabled]')){
                if($('#btn_relay_2').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_2_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_2_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_3').on('click', function(){
            if(!$('#btn_relay_3').is('[disabled=disabled]')){
                if($('#btn_relay_3').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_3_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_3_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_4').on('click', function(){
            if(!$('#btn_relay_4').is('[disabled=disabled]')){
                if($('#btn_relay_4').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_4_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_4_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_5').on('click', function(){
            if(!$('#btn_relay_5').is('[disabled=disabled]')){
                if($('#btn_relay_5').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_5_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_5_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_6').on('click', function(){
            if(!$('#btn_relay_6').is('[disabled=disabled]')){
                if($('#btn_relay_6').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_6_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_6_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_7').on('click', function(){
            if(!$('#btn_relay_7').is('[disabled=disabled]')){
                if($('#btn_relay_7').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_7_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_7_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_8').on('click', function(){
            if(!$('#btn_relay_8').is('[disabled=disabled]')){
                if($('#btn_relay_8').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_8_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_8_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }
            }else{
                Swal.fire('Error',"Cannot operate while device is running", "error")
            }
        })
        $('.btn_relay_9').on('click', function(){
            if(!$('#btn_relay_9').is('[disabled=disabled]')){
                if($('#btn_relay_9').is(":checked")){
                // turning relay off
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_9_off/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                }else{
                    // turning relay on
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/turn_relay_9_on/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        var date = new Date(response.created_at)
                        $('#command').append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
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
        $('#btn_refresh_live_data').attr('hidden', true);
        $('#tab_live_data').hide();
        $('#tab_control').hide();
        $('#tab_avg_data').show();
        $('#btn_edit_setpoints').attr('hidden',true);
        $('#btn_save_setpoints').attr('hidden',true)
        $('#btn_cancel_setpoints').attr('hidden',true)
        $('#footer_maintenance').attr('hidden',false)
    })
    $('.nav_link-live_data').on('click', function(){
        view_mode = "live";
        view_live_device = device_id; // we are on live mode of device id = trid
        $('#btn_refresh_live_data').attr('hidden', false);
        $('#tab_avg_data').hide();
        $('#tab_live_data').attr('hidden',false);
        $('#tab_live_data').show();
        $('#btn_edit_setpoints').attr('hidden',true);
        $('#btn_save_setpoints').attr('hidden',true)
        $('#btn_cancel_setpoints').attr('hidden',true)
        $('#footer_maintenance').attr('hidden',true)
        var now = new Date();
        $('#live_start_time').text(now);
        // collect live data and display
        //its doing in every 5 sec when the document is ready
        var device_data_created_at = null;
        var userDevices;
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getDeviceSetpointsForCalculation/"+device_id,
        })
        .done(function(response){
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
                        var output_binary_string = (response.output >>> 0).toString(2);
                        if(output_binary_string.length < 16){
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
                        var device_setpoint_volume_unit = userDevices.volume_unit;
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
                        var device_setpoint_CIP_cycles = userDevices.CIP_cycles;
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
        view_live_device = null; // we are not in live mode
        $('#btn_refresh_live_data').attr('hidden', true);
        $('#tab_avg_data').hide();
        $('#tab_live_data').hide();
        $('#tab_control').attr('hidden',false);
        $('#tab_control').show();
        $('#btn_edit_setpoints').attr('hidden',true);
        $('#btn_save_setpoints').attr('hidden',true)
        $('#btn_cancel_setpoints').attr('hidden',true)
        $('#footer_maintenance').attr('hidden',true)
        // check the relays status and device step
        var output = $('#device_output').text();
        // calculating output
        var output_binary_string = (output >>> 0).toString(2);

        for(var i =7 ; i<output_binary_string.length; i++){
            if(output_binary_string.charAt(i)=='1') // 1 = OFF, 0 = ON
                $('#btn_relay_'+(i-6)).attr("checked",false).trigger("change");
            else
                $('#btn_relay_'+(i-6)).attr("checked", true).trigger("change");
        }

        if($('#status-'+device_id).text() =="RUNNING"){
            // disable all the relay commands
            $('#btn_relay_1').attr("disabled","true");
            $('#btn_relay_2').attr("disabled","true");
            $('#btn_relay_3').attr("disabled","true");
            $('#btn_relay_4').attr("disabled","true");
            $('#btn_relay_5').attr("disabled","true");
            $('#btn_relay_6').attr("disabled","true");
            $('#btn_relay_7').attr("disabled","true");
            $('#btn_relay_8').attr("disabled","true");
            $('#btn_relay_9').attr("disabled","true");
        }else{
            $('#btn_relay_1').removeAttr("disabled");
            $('#btn_relay_2').removeAttr("disabled");
            $('#btn_relay_3').removeAttr("disabled");
            $('#btn_relay_4').removeAttr("disabled");
            $('#btn_relay_5').removeAttr("disabled");
            $('#btn_relay_6').removeAttr("disabled");
            $('#btn_relay_7').removeAttr("disabled");
            $('#btn_relay_8').removeAttr("disabled");
            $('#btn_relay_9').removeAttr("disabled");
        }

        // get the commands list
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/deviceCommands/"+ device_id,

        })
        .done(function(response){
            response.forEach(addCommandRows)

            function addCommandRows(item, index, arr){
                var date = new Date(arr[index].created_at)
                var status = arr[index].device_read_at == null ?'Sent':(arr[index].device_executed_at == null ?'Executing':(arr[index].device_response_data == null ? 'Executed':arr[index].device_response_data))
                $('#command').append('<tr id="'+arr[index].id+'"><td>'+date+'</td><td>'+arr[index].command+'</td><td>'+status+'</td><td><i class="fas fa-trash delete-command" ></i></td></tr>');
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
        view_live_device = null; // we are not in live mode
        $('#btn_refresh_live_data').attr('hidden', true);
        $('#tab_avg_data').hide();
        $('#tab_live_data').hide();
        $('#tab_control').hide();
        $('#tab_setpoints').attr('hidden',false);
        // $('#tab_setpoints_'+trid).show();
        $('#btn_edit_setpoints').attr('hidden',false);
        $('.input-setpoints').attr('disabled',true);
        $('#footer_maintenance').attr('hidden',true)

        // get the list of setpoints from the database
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getDeviceSetpoints/"+ device_id,
        })
        .done(function(response){
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
            $('#input-pure_EC_target').val(pure_EC_target).change();
            $('#input-pre_purify_time').val(pre_purify_time).change();
            $('#input-purify_time').val(purify_time).change();
            $('#input-waste_time').val(waste_time).change();
            $('#input-HF_waste_time').val(HF_waste_time).change();
            $('#input-CIP_dose').val(CIP_dose).change();
            $('#input-CIP_dose_rec').val(CIP_dose_rec).change();
            $('#input-CIP_dose_total').val(CIP_dose_total).change();
            $('#input-CIP_flow_total').val(CIP_flow_total).change();
            $('#input-CIP_flow_flush').val(CIP_flow_flush).change();
            $('#input-CIP_flow_rec').val(CIP_flow_rec).change();
            $('#input-CIP_flush_time').val(CIP_flush_time).change();
            $('#input-WV_check_time').val(WV_check_time).change();
            $('#input-wait_HT_time').val(wait_HT_time).change();
            $('#input-p_flow_target').val(p_flow_target).change();
            $('#input-low_flow_purify_alarm').val(low_flow_purify_alarm).change();
            $('#input-low_flow_waste_alarm').val(low_flow_waste_alarm).change();
            $('#input-CIP_cycles').val(CIP_cycles).change();
            $('#input-temperature_alarm').val(temperature_alarm).change();
            $('#input-max_CIP_prt').val(max_CIP_prt).change();
            $('#input-pump_p_factor').val(pump_p_factor).change();
            $('#input-dynamic_p_factor').val(dynamic_p_factor).change();
            $('#input-p_max_volt').val(p_max_volt).change();
            $('#input-w_max_volt').val(w_max_volt).change();
            $('#input-w_value').val(w_value).change();
            $('#input-flow_k_factor').val(flow_k_factor).change();
            $('#input-volume_unit').val(volume_unit).change();
            $('#input-bypass_option').val(bypass_option).change();
            $('#input-start_pressure').val(start_pressure).change();
            $('#input-stop_pressure').val(stop_pressure).change();
            $('#input-bypass_pressure').val(bypass_pressure).change();
            $('#input-CIP_pressure').val(CIP_pressure).change();
            $('#input-wait_time_before_CIP').val(wait_time_before_CIP).change();
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
        //alert('Refreshing data')
        // Request server for recent logs
    })

    $('#btn_edit_setpoints').on('click', function(){
        $('#btn_edit_setpoints').attr('hidden',true)
        $('#btn_save_setpoints').attr('hidden',false)
        $('#btn_cancel_setpoints').attr('hidden',false)
        $('.input-setpoints').attr('disabled',false);
    })
    $('#btn_save_setpoints').on('click', function(){
        $('#btn_edit_setpoints').attr('hidden',false)
        $('#btn_save_setpoints').attr('hidden',true)
        $('#btn_cancel_setpoints').attr('hidden',true)
        $('.input-setpoints').attr('disabled',true);

        //save new values in the database and send commands to device to change the setpoints to new value
        var formData ={
            'pure_EC_target':$('#input-pure_EC_target').val(),
            'prepurify_time':$('#input-pre_purify_time').val(),
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
            url: "/saveDeviceSetpoints/"+ device_id,
            data: formData
        })
        .done(function(response){
            Swal.fire('Success','Set - Setpoints command sent to device.','success')
            // wait for response and notify if value error

        });

    })
    $('#btn_cancel_setpoints').on('click', function(){
        $('#btn_edit_setpoints').attr('hidden',false)
        $('#btn_save_setpoints').attr('hidden',true)
        $('#btn_cancel_setpoints').attr('hidden',true)
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
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "POST",
                url: "/command/getSetpointsFromDevice/" + device_id,
        })
        .done(function(response){
            Swal.fire('Success','Get - Setpoints command sent to device. Setpoints will be updated once the reply is received from the device','success')

            var is_response_received = false;
            setInterval(function(){
                if(!is_response_received){
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "GET",
                            url: "/command_status/Setpoints-get/" + device_id,
                    })
                    .done(function(response){
                        if(response.device_read_at != null){
                            is_response_received = true;
                            $.ajax({
                                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                    type: "GET",
                                    url: "/getDeviceSetpoints/" + device_id,
                            })
                            .done(function(response){
                                $('#input-pure_EC_target').val(response.pure_EC_target)
                                $('#input-pre_purify_time').val(response.prepurify_time)
                                $('#input-purify_time').val(response.purify_time)
                                $('#input-waste_time').val(response.waste_time)
                                $('#input-HF_waste_time').val(response.HF_waste_time)
                                $('#input-CIP_dose').val(response.CIP_dose)
                                $('#input-CIP_dose_rec').val(response.CIP_dose_rec)
                                $('#input-CIP_dose_total').val(response.CIP_dose_total)
                                $('#input-CIP_flow_total').val(response.CIP_flow_total)
                                $('#input-CIP_flow_flush').val(response.CIP_flow_flush)
                                $('#input-CIP_flow_rec').val(response.CIP_flow_rec)
                                $('#input-CIP_flush_time').val(response.CIP_flush_time)
                                $('#input-WV_check_time').val(response.WV_check_time)
                                $('#input-wait_HT_time').val(response.wait_HT_time)
                                $('#input-p_flow_target').val(response.p_flow_target)
                                $('#input-low_flow_purify_alarm').val(response.low_flow_purify_alarm)
                                $('#input-low_flow_waste_alarm').val(response.low_flow_waste_alarm)
                                $('#input-CIP_cycles').val(response.CIP_cycles)
                                $('#input-temperature_alarm').val(response.temperature_alarm)
                                $('#input-max_CIP_prt').val(response.max_CIP_prt)
                                $('#input-pump_p_factor').val(response.pump_p_factor)
                                $('#input-dynamic_p_factor').val(response.dynamic_p_factor)
                                $('#input-p_max_volt').val(response.p_max_volt)
                                $('#input-w_max_volt').val(response.w_max_volt)
                                $('#input-w_value').val(response.w_value)
                                $('#input-flow_k_factor').val(response.flow_k_factor)
                                $('#input-volume_unit').val(response.volume_unit)
                                $('#input-bypass_option').val(response.bypass_option)
                                $('#input-start_pressure').val(response.start_pressure)
                                $('#input-stop_pressure').val(response.stop_pressure)
                                $('#input-bypass_pressure').val(response.bypass_pressure)
                                $('#input-CIP_pressure').val(response.CIP_pressure)
                                $('#input-wait_time_before_CIP').val(response.wait_time_before_CIP)

                                Swal.fire('Success','Setpoints updated in server','success')
                            })
                        }
                    })
                }
            }, 5000); // 5 seconds
        })
    })

    // starting and stopping the device
        var start_stop_command_sent;
        var command_sent = "";
        var command_sent_time = null;
        $('.btn_device_start_stop').on('click', function(){
            switch($('#btn_device_start_stop').text()){
                case "Stop":
                    command_sent = "Stop";
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/command/stop/"+ device_id,
                    })
                    .done(function(response){
                        //console.log(response);
                        Swal.fire('Success','Command recorded.','success')
                        start_stop_command_sent = true;
                        $('#device_status').text('Pending')
                        document.getElementById('device_status').style.color = 'black'
                        document.getElementById('device_status_pic').style.color = 'black'
                        $('#btn_device_start_stop').text('Stopping')
                        $('#btn_device_start_stop').removeClass('btn-danger').addClass('btn-primary')
                        $('#btn_device_start_stop').attr('disabled','true');
                        // var date = new Date(response.created_at)
                        // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                    break;
                case "Start":
                    command_sent = "Start";
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "POST",
                        url: "/command/start/"+ device_id,
                    })
                    .done(function(response){
                        Swal.fire('Success','Command recorded.','success')
                        start_stop_command_sent = true;
                        $('#device_status').text('Pending')
                        document.getElementById('device_status').style.color = 'black'
                        document.getElementById('device_status_pic').style.color = 'black'
                        $('#btn_device_start_stop').text('Starting')
                        $('#btn_device_start_stop').removeClass('btn-primary').addClass('btn-danger')
                        $('#btn_device_start_stop').attr('disabled','true');
                        // var date = new Date(response.created_at)
                        // $('#command-'+trid).append('<tr><td>'+date+'</td><td>'+response.command+'</td><td></td><td></td></tr>');
                    });
                    break;
            }
        })

    // Info buttons on the status tab
        $('.info-device-status').on('click', function(){
            switch($('#device_status').text()){
                case 'RUNNING':
                    $('#info_device_status_text').text("Running")
                    $('#info_device_status_description').text('')
                    $('#info_device_status_description').append("<b>(Don’t Worry)</b> Device is running and treating water ")
                    break;
                case 'IDLE':
                    $('#info_device_status_text').text("Idle")
                    $('#info_device_status_description').text('')
                    $('#info_device_status_description').append("<b>(Oops!!!)</b> Device is not operational. It requires user intervention.")
                    break;
                case 'Pending':
                    $('#info_device_status_text').text("Pending")
                    $('#info_device_status_description').text('')
                    $('#info_device_status_description').append("<b>(Please Wait!!!)</b> Connecting with the device..")
                    break;
            }
        })
        $('.info-device-connection').on('click', function(){
            switch($('#device_connection_status').text()){
                case 'Connected':
                    $('#info_device_connection_text').text('Connected')
                    $('#info_device_connection_description').text('')
                    $('#info_device_connection_description').append("<b>Awesome!!!</b> Device is connected to the Internet ")
                    break;
                default:
                    $('#info_device_connection_text').text('Disconnected')
                    $('#info_device_connection_description').text('')
                    $('#info_device_connection_description').append("<b>Oops!!!</b> Device is not connected!")

            }
        })
        $('.info_device_health').on('click', function(){
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
        $('.info_device_conductivity').on('click', function(){
            switch($('#device_conductivity_value').text()){
                case "On Target":
                    $('#info_device_conductivity_text').text("On Target")
                    $('#info_device_conductivity_text').css("color","green")
                    $('#info_device_conductivity_description').text('')
                    $('#info_device_conductivity_description').append("The unit is removing the right amount of minerals.")
                    break;
                case "Needs Attention":
                    $('#info_device_conductivity_text').text("Needs Attention")
                    $('#info_device_conductivity_text').css("color","red")
                    $('#info_device_conductivity_description').text('')
                    $('#info_device_conductivity_description').append("The unit is removing most of the minerals. ")
                    break;
                case "No Data":
                    $('#info_device_conductivity_text').text("No Data")
                    $('#info_device_conductivity_text').css("color","orange")
                    $('#info_device_conductivity_description').text('')
                    $('#info_device_conductivity_description').append("Device is not sending data. Please Check the internet connection")
                    break;
            }
        })
    //
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
                    $('#btn_reload_graph').prop('disabled', true);
                    break;
                case 'last_hour':
                    $('.volume_custom_time').hide();
                    break;
                case 'last_24_hour':
                    $('.volume_custom_time').hide();
                    break;
                default:$('#btn_reload_graph').prop('disabled', true);
            }
            // volumeChart.update();
            $('#btn_reload_graph').show();
        })
        $('#btn_reload_graph').on('click', function(){
            var ctx_volume = document.getElementById('volumeChart').getContext('2d');
            switch(graph_time_frame){
                case 'custom':
                    graph_custom_from = $('#inputFromDate_volume').val();
                    graph_custom_to = $('#inputToDate_volume').val();
                    graph_title = "Water purified in "+ graph_custom_from + " to "+ graph_custom_to;
                    //fetch data from server
                    graph_labels = ['01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00','01:00','02:00','03:00','04:00','05:00'];
                    graph_data = [12,10,5,20,25,12,10,5,20,25,12,10,5,20,25];
                    graph_displayed = "custom";
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
                    break;
                case 'last_hour':
                    $('.volume_custom_time').hide();
                    graph_displayed = "last_hour";
                    graph_title = "Water purified in Last Hour";
                    //fetch data from server
                    // graph_labels = ['01:00','02:00','03:00','04:00','05:00'];
                    // graph_data = [12,10,5,20,25];
                    //fetch data from server
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "get",
                        url: "/getVolumeHour/"+ device_id,
                    })
                    .done(function(response){
                        graph_labels = Object.assign([],response.graph_labels);
                        graph_data = Object.assign([],response.graph_data);
                        graph_displayed = "last_hour";
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
                    break;
                case 'last_24_hour':
                    $('.volume_custom_time').hide();
                    graph_title = "Water purified in Last 24 Hours";
                    //fetch data from server
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "get",
                        url: "/getVolume24Hour/"+ device_id,
                    })
                    .done(function(response){
                        graph_labels = Object.assign([],response.graph_labels);
                        graph_data = Object.assign([],response.graph_data);
                        graph_displayed = "last_hour";
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
                    graph_displayed = "last_24_hr";
                    break;
            }
        })
        $('#inputFromDate_volume').on('change', function(){
            var from = new Date($('#inputFromDate_volume').val())

            from.setDate(from.getDate()+1)
            var to = from.toLocaleDateString()
            $('#inputToDate_volume').val(to).change()
            $('#btn_reload_graph').prop('disabled', false);
        })
    //
    // Alarms
        $('.btn_reset_alarms').on('click', function(){
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
                        url: "/resetAllAlarms/"+ device_id,
                    })
                    .done(function(response){
                        var read_database = true;
                        setInterval(function(){
                            if(read_database){
                                $.ajax({
                                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                    type: "GET",
                                    url: "/command_status/Reset-all-alarms/"+ device_id,
                                })
                                .done(function(response){
                                    if(response.device_read_at != null){
                                        read_database = false;
                                        Swal.close();
                                        $('#btn_reset_alarms').attr('hidden','true');
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
                                                    url: "/command/start/"+ device_id,
                                                })
                                                .done(function(response){
                                                    Swal.fire('Success','Command recorded.','success')
                                                    start_stop_command_sent = true;
                                                    $('#device_status').text('Pending')
                                                    document.getElementById('device_status').style.color = 'black'
                                                    document.getElementById('device_status_pic').style.color = 'black'
                                                    $('#btn_device_start_stop').text('Starting')
                                                    $('#btn_device_start_stop').removeClass('btn-primary').addClass('btn-danger')
                                                    $('#btn_device_start_stop').attr('disabled','true');
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
        // alarms history logs
        $('#info_device_alarms_table').on('click', function(){
            $('#modal-alarms_history-title').text("Alarms' History : " + device_serial)
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/getDeviceAlarms/"+device_id,
            })
            .done(function(response){
                for(var i=0 ;i< response.length; i++){
                    if(response[i].alarms != 0){
                        var alarm_names = calculateAlarm(response[i].alarms);
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
    //



</script>

@endsection



