<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Voltea') }}</title>
    <link rel="icon" type="image/png" href="{{URL::to('/img/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .card-title{
            height:15px;
            line-height:30px;
        }
        html{
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE10+/Edge */
            user-select: none; /* Standard */
        }
        .content-header{
            margin-top:55px;
        }
        .modal-full {
            min-width: 100%;
            margin: 0;
        }
        .modal-full .modal-content {
            min-height: 100vh;
            min-width:100vw;
        }
        /* h3.card-title{
            margin-top: 8px;
            margin-bottom: -8px;
        } */
    </style>
    @yield('head')

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="loader"></div>
<div class="wrapper" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed" style="z-index:1">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
         <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>-->


      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <h4><i class="far fa-bell"></i></h4>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><i class="far fa-bell mr-2"></i>15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-exclamation-circle"></i> 8 alerts
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <h4><i class="fas fa-expand-arrows-alt"></i></h4>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" href="#" role="button">
          <h4><i class="fas fa-th-large" id="control_sidebar_btn"></i></h4>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('../img/voltea-logo.png')}}" alt="Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">IOT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="margin-top:55px">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-1 mb-3 d-flex">
          <div class="row nav-item-routes">
              <div class="col-md-12">
                <a href="{{route('userProfile')}}" class="d-block">
                      <div class="image">
                          <img id="img_profile" src="/uploads/avatars/{{Auth::user()->avatar != null? Auth::user()->avatar : 'default-avatar.png'}}" class="img-circle  float-left" alt="User Image" style="max-width:60px;max-height:45px">
                      </div>
                      <div class="info" id="div_sidebar_userName">
                          {{Auth::check() ? Auth::user()->name : null}}
                      </div>
                  </a>
              </div>
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <!-- <span class="right badge badge-danger">New</span> -->
                    </p>
                </a>
            </li>
            @if(Auth::user()->role == 'S' || Auth::user()->role == 'R')
                <li class="nav-item nav-item-routes">
                    <a href="{{route('devices')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Devices
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            @endif
            @if(Auth::user()->role == 'S')
            <li class="nav-item nav-item-routes">
                <a href="{{route('resellers')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Resellers
                    </p>
                </a>
            </li>
            @endif
            @if(Auth::user()->role == 'S' || Auth::user()->role == 'R')
            <li class="nav-item nav-item-routes">
                <a href="{{route('users')}}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        End Users
                    </p>
                </a>
            </li>
            @endif
            @if(Auth::user()->role == 'S')
            <li class="nav-item nav-item-routes">
                <a href="{{route('superUsers')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-lock"></i>
                    <p>
                        Super Users
                    </p>
                </a>
            </li>
            <li class="nav-item nav-item-routes">
                <a href="{{route('firmwares')}}" class="nav-link">
                    &nbsp;<i class="fas fa-microchip"></i>
                    <p>
                    &nbsp;Firmwares
                    </p>
                </a>
            </li>
            @endif

            <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ChartJS</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/flot.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Flot</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/inline.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inline</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/uplot.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>uPlot</p>
                    </a>
                </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Settings
                    <span class="right badge badge-danger">New</span>
                </p>
                </a>
            </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <!-- <div class="sidebar-custom">
      <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
      <a href="#" class="btn btn-secondary hide-on-collapse pos-right float-right">Help</a>
    </div> -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside id="control_sidebar_main" class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3 flex justify-content-center">
      <a href="{{route('logout')}}">Logout</a>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Code By: Arun Amatya
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="https://www.voltea.com">Voltea</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    $(".content-wrapper").click(function() {
        if($("#control_sidebar_main").hasClass("control-sidebar-open")) {
            $("#control_sidebar_main").removeClass("control-sidebar-open");
        }
        $('#control_sidebar_main').css('display','none')
    });
    $('#control_sidebar_btn').on('click', function(){
        $('#control_sidebar_main').addClass("control-sidebar-open");
        $('#control_sidebar_main').show();
    })
    $('.nav-item-routes').on('click',function(){
        $('.loader').show();
    })
</script>
@yield('scripts')
</body>
</html>
