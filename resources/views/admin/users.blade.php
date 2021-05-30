@extends ('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection('css')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header" id="app_users">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
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
                            <h2 class="card-title">List of Users
                                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
                            </h2>
                            <!-- <i class="btn fas fa-sync-alt"></i> -->
                            <div class="card-tools">
                                <!-- <input class="form-control" type="filter" placeholder="Filter User" aria-label="Filter"> -->
                            </div>
                        </div>
                        <div class="card-body table-responsive p-2">
                            <table class="table table-striped table-valign-middle datatable" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Category</th>
                                        <th># Devices</th>
                                        <th>Last login</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr >
                                        <td>{{$user->name}}
                                        @if($user->last_login==null)
                                        <span class="badge bg-danger">NEW</span>
                                        @endif
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role=='R'?'Reseller':($user->role=='U'?'User':($user->role=='S'?'Super Admin':'N/A'))}}</td>
                                        <td>3</td>
                                        <td>
                                        {{$user->last_login != null ? $user->last_login : '-'}}
                                        </td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="fa fa-edit" aria-hidden="true"></i> Edit User</a>
                                                <a href="#" class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="fas fa-trash"></i> Delete User</a>
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
        </div>
        <!-- /.container-fluid -->
        <div class="modal fade" id="modal-add">
            <form id="form_addUser" class="form-horizontal" method="post" action="/addNewUser" autocomplete="nope">

                {{ csrf_field() }}
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">Add New User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20" id="addNewUser">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputName" class="control-label">Name</label>
                                                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="inputEmail" class="control-label">Email</label>
                                                <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <label for="selectRole" class="control-label">Role</label>
                                                <select name="role" id="role" class="form-control">
                                                    <option>-- Select --</option>
                                                    <option value="R">Reseller</option>
                                                    <option value="S">Super Admin</option>
                                                    <option value="U">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <button type="button" id="btn_add_device" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New Device</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <button type="button" id="btn_select_device" class="btn btn-secondary">Select From Devices</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_confirm" value="Add">Add</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->"
            </form>
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.content -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{asset('js/user.js')}}"> -->
@endsection
