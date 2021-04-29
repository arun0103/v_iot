@extends ('layouts.master')

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
                <li class="breadcrumb-item active">Dashboard</li>
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
                                <input class="form-control" type="filter" placeholder="Filter User" aria-label="Filter">
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
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
                                    <tr v-for="(user,index) in users" :key="user.id">
                                        <td>@{{user.name}}
                                        Nabeen Amatya
                                        <!-- <span class="badge bg-danger">NEW</span> -->
                                        </td>
                                        <td>nabeenamatya@gmail.com</td>
                                        <td>Reseller</td>
                                        <td>3</td>
                                        <td>
                                        2021/04/25 13:00:01
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
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <div class="modal fade" id="modal-add">
        <form id="form_addUser" class="form-horizontal" method="post" action="/addUser" autocomplete="nope">

            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add User</h4>
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
                                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="branch_name" autocomplete="no">
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
                                            <select name="selectRole" id="role" class="form-control">
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


@endsection
