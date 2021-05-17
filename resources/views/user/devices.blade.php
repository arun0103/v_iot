@extends ('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection('css')

@section('content')
    <div class="content-header" id="app_user_devices">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Devices</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">Devices</li>
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
                    <!-- <users_list
                        v-for="user in users_list"

                        v-bind:key="user.id"
                    ></users_list> -->
                    <div class="card">
                        <div class="card-header border-0 bg-top-logo-color">
                            <div class="card-title">
                                    <h2>List of Devices</h2>
                                    <!-- <input class="form-control" type="filter" placeholder="Filter Device" aria-label="Filter"> -->
                            </div>
                            <!-- <i class="btn fas fa-sync-alt"></i> -->
                            <div class="card-tools">
                                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-device">Add New</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive table-striped p-0">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                            <table class="table table-striped table-valign-middle datatable" id="deviceTable">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Device Number</th>
                                        <th>Device Name / Model</th>
                                        <th>Location</th>
                                        <th># Assigned Users</th>
                                        <th>Last Data Received Time</th>
                                        <th>More</th>
                                    </tr>

                                </thead>
                                <tbody>
                                @foreach($devices as $device)
                                    <tr >
                                        <td>{{$device->serial_number}}</td>
                                        <td>{{$device->device_number}}</td>
                                        <td>{{$device->model}} DiUse</td>
                                        <td>{{$device->lat}}_0,0_{{$device->lng}}</td>
                                        <td>0</td>
                                        <td>
                                            date time
                                        </td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i> View Users</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item dropdown-footer"><i class="far fa-trash-alt"></i> Delete Device</a>
                                            </div>
                                            <!-- </div> -->
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
        <div class="modal fade" id="modal-add-device">
            <form id="form_addDevice" class="form-horizontal" method="post" action="/addNewDevice" autocomplete="no">
                {{ csrf_field() }}
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">Add New Device</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20" id="addNewDevice">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputName" class="control-label">Name</label>
                                                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputSN" class="control-label">Serial Number</label>
                                                <input type="text" class="form-control" id="inputSN" placeholder="Serial Number" name="serial_number" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputDN" class="control-label">Device Number</label>
                                                <input type="text" class="form-control" id="inputDN" placeholder="Device Number" name="device_number" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="reseller_id" class="control-label">Reseller</label>
                                                <select name="reseller_id" id="select_reseller_id" class="form-control">
                                                    <option value="-1"> --  Select  -- </option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="inputManufacturedDate" class="control-label">Manufactured Date</label>
                                                <input class="form-control datepicker" id="inputManufacturedDate" name="manufactured_date" width="234" placeholder="MM / DD / YYYY"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="inputInstallationDate" class="control-label">Installation Date</label>
                                                <input class="form-control datepicker" id="inputInstallationDate" name="installation_date" width="234" placeholder="MM / DD / YYYY"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="is_under_warranty" class="control-label">Warranty</label>
                                                <select name="is_under_warranty" id="is_under_warranty" class="form-control">
                                                    <option value="null"> --  Select  -- </option>
                                                    <option value="0">Yes</option>
                                                    <option value="1">No</option>
                                                </select>
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
        <div class="modal fade" id="modal-assign-user">
            <form id="form_assign_user" class="form-horizontal" method="post" action="/assignUserDevice" autocomplete="no">
                {{ csrf_field() }}
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">Assign User Device</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="user_type" class="control-label">User Type</label>
                                                <select name="user_type" id="select_user_type" class="form-control">
                                                    <option> --  Select  -- </option>
                                                    <option value="U">User</option>
                                                    <option value="R">Reseller</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="user_type" class="control-label">User</label>
                                                <select name="user_type" id="select_user" class="form-control">
                                                    <option value="null"> --  Select  -- </option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputSN_verify" class="control-label">Serial Number</label>
                                                <input type="text" class="form-control" id="inputSN_verify" placeholder="Serial Number" name="serial_number" autocomplete="no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_confirm_assign_user" value="Add">Add</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{asset('js/device.js')}}">

    </script>
@endsection
