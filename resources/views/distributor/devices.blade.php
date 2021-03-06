@extends ('layouts.master')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
<style>
    .error{
        border: 1px solid red;
    }

</style>
<style>
    /* ---- ---- --- For hiding up down arrow from number inputs --- --- -----  */
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
</style>

@endsection

@section('content')
    <div class="content-header" id="app_user_devices">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Devices</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @if(Auth::user()->role == 'S')
                        <li class="breadcrumb-item active">Users</li>
                        @endif
                        <li class="breadcrumb-item active">Devices</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h4 class="card-header">
                            <div class="card-title">List of Devices</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-new-device">Add New</button>
                            </div>
                        </h4>
                        <div class="card-body table-responsive">
                            <table class="table table-hover datatable" id="deviceTable">
                                <thead>
                                    <tr>
                                        <th>PCB Serial #</th>
                                        <th>Device Serial #</th>
                                        <th>Device Name</th>
                                        <th>Model</th>
                                        <th>Firmware</th>
                                        <!-- <th>Last Data Received @</th> -->
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody id="device_lists">
                                @foreach($devices as $device)
                                    <tr id="{{$device->id}}" class="device">
                                        <td id="device_serial-{{$device->id}}">{{$device->serial_number}}</td>
                                        <td>{{$device->device_number}}</td>
                                        <td id="device_name-{{$device->id}}">{{$device->device_name}}</td>
                                        <td>{{$device->model != null ? $device->model->name : "-"}}</td>
                                        <td>{{$device->firmware}}</td>
                                        <!-- <td>
                                            {{$device->latest_log!=null?$device->latest_log->created_at:"-"}}
                                        </td> -->
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item operation-assign_user" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"><i class="fa fa-user-plus"> Assign Users</i></a>
                                                <a class="dropdown-item operation-edit_device_name"><i class="fas fa-edit"></i> Edit Device Name</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item view-device-users"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Device</a>
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
    </div>
    <div class="modal fade" id="modal-add-new-device">
        <form id="form_addNewDevice" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-new_device">Add New Device</h4>
                        <button type="button" class="close" id="btn_close_add_new_device" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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
                                    <input type="text" min="1" class="form-control" id="inputDeviceNumber" placeholder="Device Number" name="deviceNumber" autocomplete="no">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_confirm_add_new_device" value="Add">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modal-assign-user">
        <form id="form_assign_user" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-full" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title_assign_user">Assign User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Existing Users</h5>
                                <select class="select2 form-control" id="select_existing_user" style="width:100%" name="select_existing_user">
                                    <option hidden selected>Select</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row roundPadding20">
                            <div class="col-lg-12"><h5>New User</h5></div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputUserName" class="control-label">Full Name </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Name of the person who bought the device</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control" id="inputUserName" placeholder="Full Name" name="userName" autocomplete="no" required>
                                    <span id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputUserEmail" class="control-label">Email </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Email of the person who bought the device</i></b></p>
                                                    <p class="text-sm"><b><i>This email will be used to login to the system</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="email" class="form-control" id="inputUserEmail" placeholder="Email" name="userEmail" autocomplete="no" required>
                                    <span id="error_email"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="inputUserMobile" class="control-label">Mobile # </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Contact number</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="number" class="form-control" id="inputUserMobile" placeholder="Mobile Number" name="UserMobile" autocomplete="no" required>
                                    <span id="error_mobile"></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row roundPadding20">
                            <div class="col-sm-6">
                                <h5>Address</h5>
                            </div>
                        </div>
                        <div class="row roundPadding20">
                            <div class="col-sm-3">
                                <label for="select_county" class="control-label"> Country</label><br/>
                                <select class="form-control select2" id="select_country" name="select_country" style="width:100%" required>
                                    <option selected hidden>-- Select --</option>
                                </select>
                                <span id="error_country"></span>
                            </div>
                            <div class="col-sm-3">
                                <label for="select_state" class="control-label"> State/District</label><br/>
                                <select class="form-control select2" id="select_state" name="select_state" style="width:100%" required>
                                    <option hidden selected>-- Select --</option>
                                </select>
                                <span id="error_state"></span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_city" class="control-label">City</label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>The city where user lives in</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control" id="input_city" placeholder="City" name="city" autocomplete="no" required>
                                    <span id="error_city"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_street_address_1" class="control-label">Street address </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Name of the street</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control" id="input_street_address_1" placeholder="Street address" name="street_address_1" autocomplete="no" required>
                                    <span id="error_street"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="input_house_address_1" class="control-label">House address </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>House number, nearby landmarks</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control" id="input_house_address_1" placeholder="House address" name="house_address_1" autocomplete="no" required>
                                    <span id="error_house"></span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="input_zip_code" class="control-label">Zip Code </label>
                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                        <a href="#" class="dropdown-item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-sm"><b><i>Zip Code / Postal Code</i></b></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control" id="input_zip_code" placeholder="Zip Code" name="zip_code" autocomplete="no" required>
                                    <span id="error_zip"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_confirm_assign_user" value="Add">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
    </div>
    <div class="modal fade" id="modal-edit-device">
        <form id="form_editDevice" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title_newDevice">Edit Device</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="editDevice">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="edit_selectModel" class="control-label">Model</label>
                                            <select name="model" id="edit_selectModel" class="form-control" title="Select Model">
                                                @foreach($models as $model)
                                                    <option value="{{$model->id}}">{{$model->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputSN_edit" class="control-label">PCB Serial Number</label>
                                            <input type="number" class="form-control" id="inputSN_edit" placeholder="Serial Number" name="serial_number" autocomplete="no">
                                            <span id="error_edit_sn"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputDN_edit" class="control-label">Device Serial Number</label>
                                            <input type="text" class="form-control" id="inputDN_edit" placeholder="Device Number" name="device_number" autocomplete="no">
                                            <span id="error_edit_dn"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="inputManufacturedDate_edit" class="control-label">Manufactured Date</label>
                                            <input class="form-control datepicker" id="inputManufacturedDate_edit" name="manufactured_date" width="234" placeholder="MM / DD / YYYY" autocomplete="off"/>
                                            <span id="error_edit_manufactured_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="inputFirmwareVersion_edit" class="control-label">Firmware Version</label>
                                            <input type="text" class="form-control" id="inputFirmwareVersion_edit" name="firmware" width="234" placeholder="E.G. 2021.01.01_test"/>
                                            <span id="error_edit_firmware"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="select_user_id_edit" class="control-label">User</label><br>
                                            <select name="user_id" id="select_user_id_edit" class="form-control" style="width:100%; height:100%">
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_confirm_save_edit_device" value="Add">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
    </div>
    <div class="modal fade" id="modal-view-device-users">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-user_device_list">Device users' List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row roundPadding20">
                        <div class="col-lg-12">
                            <table class="table table-stripped ">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Used Since</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody id="user_device_table_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-add-user-device">
        <form id="form_addUserDevice" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-full" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-user_device">Add Device and User</h4>
                        <button type="button" class="close" id="btn_close_add_device_user" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step" data-target="#device-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="device-part" id="device-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Device Information</span>
                                </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">User information</span>
                                </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <!-- your steps content here -->
                                <div id="device-part" class="content" role="tabpanel" aria-labelledby="device-part-trigger">
                                    <div class="row">
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
                                                <input type="text" min="1" class="form-control" id="inputDeviceNumber" placeholder="Device Number" name="deviceNumber" autocomplete="no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button class="btn btn-primary" id="btn_next_1">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3>Existing Users</h3>
                                            <select class="select2 form-control" id="select_existing_user" style="width:100%">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row roundPadding20">
                                        <div class="col-lg-12"><h3>New User</h3></div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputUserName" class="control-label">User's Full Name </label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Name of the person who bought the device</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="text" class="form-control" id="inputUserName" placeholder="Full Name" name="userName" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputUserEmail" class="control-label">User's Email </label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Email of the person who bought the device</i></b></p>
                                                                <p class="text-sm"><b><i>This email will be used to login to the system</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="email" class="form-control" id="inputUserEmail" placeholder="Email" name="userEmail" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputUserMobile" class="control-label">User's Mobile # </label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Contact number</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="number" class="form-control" id="inputUserMobile" placeholder="Mobile Number" name="UserMobile" autocomplete="no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row roundPadding20">
                                        <div class="col-sm-6">
                                            <h3>Address</h3>
                                        </div>
                                    </div>
                                    <div class="row roundPadding20">
                                        <div class="col-sm-3">
                                            <label for="select_county" class="control-label"> Country</label><br/>
                                            <select class="form-control select2" id="select_country" style="width:100%">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="select_state" class="control-label"> State/District</label><br/>
                                            <select class="form-control select2" id="select_state" style="width:100%">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="input_city" class="control-label">City</label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>The city where user lives in</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="text" class="form-control" id="input_city" placeholder="City" name="city" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="input_street_address_1" class="control-label">Street address </label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Name of the street</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="text" class="form-control" id="input_street_address_1" placeholder="Street address" name="street_address_1" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="input_house_address_1" class="control-label">House address </label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>House number, nearby landmarks</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="text" class="form-control" id="input_house_address_1" placeholder="House address" name="house_address_1" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="input_zip_code" class="control-label">Zip Code </label>
                                                <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                    <a href="#" class="dropdown-item">
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <p class="text-sm"><b><i>Zip Code / Postal Code</i></b></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <input type="text" class="form-control" id="input_zip_code" placeholder="House address" name="zip_code" autocomplete="no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_confirm_add_reseller_device" value="Add">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <!-- <script src="{{asset('js/device.js')}}"></script> -->
    <script src="{{asset('js/countries.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

<script type="text/javascript">
    function validate_assignUserForm(){
        let user_name = $('#inputUserName').val()
        let user_email = $('#inputUserEmail').val()
        let user_mobile= $('#inputUserMobile').val()
        let country = $('#select_country').val()
        let state = $('#select_state').val()
        let city = $('#input_city').val()
        let street = $('#input_street_address_1').val()
        let house = $('#input_house_address_1').val()
        let zip = $('#input_zip_code').val()
        // console.log(country);
        // console.log(state);
        let validated = true;
        if(user_name == null || user_name == ""){
            validated = false;
            $('#error_name').text("Name cannot be empty!").css('color','red');
        }else{
            $('#error_name').text("");
        }
        if(user_email == null || user_email == ""){
            validated = false;
            $('#error_email').text("Email cannot be empty!").css('color','red');
        }else{
            $('#error_email').text("");
        }
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(regex.test(user_email)){
            $('#error_email').text("");
        }else{
            $('#error_email').text("Email is invalid!").css('color','red');
            validated =  false;
        }
        if(user_mobile == null || user_mobile == ""){
            validated = false;
            $('#error_mobile').text("Mobile cannot be empty!").css('color','red');
        }else{
            $('#error_mobile').text("");
        }
        if(country == null || country == "-- Select --"){
            validated = false;
            $('#error_country').text("Please select a country!").css('color','red');
        }else{
            $('#error_country').text("");
        }
        if(state == null || state == "-- Select --"){
            validated = false;
            $('#error_state').text("Please select a state!").css('color','red');
        }else{
            $('#error_state').text("");
        }
        if(city == null || city == ""){
            validated = false;
            $('#error_city').text("City cannot be empty!").css('color','red');
        }else{
            $('#error_city').text("");
        }
        if(street == null || street == ""){
            validated = false;
            $('#error_street').text("Street address cannot be empty!").css('color','red');
        }else{
            $('#error_street').text("");
        }
        if(house == null || house == ""){
            validated = false;
            $('#error_house').text("House address cannot be empty!").css('color','red');
        }else{
            $('#error_house').text("");
        }
        if(zip == null || zip == ""){
            validated = false;
            $('#error_zip').text("Zip code cannot be empty!").css('color','red');
        }else{
            $('#error_zip').text("");
        }
        return validated;
    }
    let list_of_users;
    $(document).ready(function () {
        $('.datatable').dataTable();
        var stepper = new Stepper($('.bs-stepper')[0])
        $('.select2').select2({
            placeholder: 'Select an option',
            dropdownParent: $('#modal-add-user-device'),
            theme: "classic",
            width: 'resolve'
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        for(var i =0; i<countries.length; i++)
            $('#select_country').append('<option id="option_country_'+i+'" value ="'+countries[i].country+'">'+countries[i].country+'</option>');

        $('.loader').hide()
    })

    $('#btn_close_add_new_device').on('click', function(){
        $('#modal-add-new-device').modal('hide');
    })
    $('#btn_confirm_add_new_device').on('click', function(e){
        e.preventDefault();
        var formData = {
            'serial_number':$('#inputSerialNumber').val(),
            'device_number':$('#inputDeviceNumber').val(),
            "_token": "{{ csrf_token() }}"
        }
        $.ajax({
            method: "post",
            url: "/addNewDistributorDevice",
            data: formData,
            })
            .done(function(response) {
                switch(response['message']){
                    case 'Error':
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text:  response.description,
                            //footer: '<a href="../login">Login as Adminstrator?</a>'
                        });
                        break;
                    case 'Success':
                        $('tbody').prepend(
                            '<tr id="'+response.data.id+'" class="device">'
                                +'<td>'+response.data.serial_number
                                + '</td><td>'+ response.data.device_number
                                + '</td><td>-</td><td>'
                                + response.data.model.name
                                + '</td><td>'+response.data.firmware + '</td>'
                                + '<td><a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>'
                                        +'<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                            +'<a href="#" class="dropdown-item operation-assign_user"><i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i></a>'
                                            +'<a class="dropdown-item operation-edit_device_name"><i class="fas fa-edit"></i> Edit Device Name</a>'
                                            +'<div class="dropdown-divider"></div>'
                                            +'<a class="dropdown-item view-device-users"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>'
                                            +'<div class="dropdown-divider"></div>'
                                            +'<a href="#" class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Device</a>'
                                        +'</div>'
                                    +'</td>'
                            +'</tr>')
                        Swal.fire(
                            'Added!',
                            'Device has been added',
                            'success'
                        );
                        $('#modal-add-new-device').modal('hide');
                        location.reload();
                        break;
                    default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!' + response.description,
                            footer: response
                        })
                }
        });
    })
    $('#device_lists').on('click','.operation-assign_user', function(){
        let device_serial = $(this).closest('tr').find('td:eq(0)').text(); // table row ID
        $('#modal-title_assign_user').html('Assign User <small>[Device Serial # : <b id="selected_device_serial">'+device_serial+'</b>]</small>');
        //get all the users of reseller from database
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/getAllResellersUser",
        })
        .done(function(response){
            list_of_users = response
            $('#select_existing_user').html('<option selected hidden>-- Select --</option>')
            for(let i=0;i<response.length;i++)
                $('#select_existing_user').append('<option value ="'+response[i].id+'">'+response[i].name+' ('+response[i].email+')</option>');
        })
        // reset all input fields
        $('#inputUserName').val("")
        $('#inputUserEmail').val("")
        $('#inputUserMobile').val("")
        $('#select_country').val("-- Select --")
        $('#select_state').val("-- Select --").attr('disabled', true)
        $('#input_city').val("")
        $('#input_street_address_1').val("")
        $('#input_house_address_1').val("")
        $('#input_zip_code').val("")

    })
    $('#select_country').on('change',function(){
        var id = $(this).children(":selected").attr("value");
        var found = countries.filter(function(item) { return item.country === id; });

        $('#select_state').find('option').remove().end()
                .append('<option>-- Select --</option>')
        for(var i =0;i<found[0]['states'].length;i++)
            $('#select_state').append('<option value ="'+found[0].states[i]+'">'+found[0].states[i]+'</option>');
        $('#select_state').attr('disabled', false);

    })
    $('#btn_confirm_assign_user').on('click',function(e){
        e.preventDefault();
        if(validate_assignUserForm() == true){
            let formData = {
                // Device Info
                'serial_number': $('b#selected_device_serial').text(),
                //User Info
                'user_name': $('#inputUserName').val(),
                'user_email': $('#inputUserEmail').val(),
                'user_mobile': $('#inputUserMobile').val(),
                'user_address': {
                                    'country': $('#select_country').val(),
                                    'state': $('#select_state').val(),
                                    'city': $('#input_city').val(),
                                    'street_address': $('#input_street_address_1').val(),
                                    'house_address': $('#input_house_address_1').val(),
                                    'zip_code': $('#input_zip_code').val()
                                },
                "_token": "{{ csrf_token() }}"
            }
            $.ajax({
                method: "post",
                url: "/assignUserDeviceByReseller",
                data: formData,
            })
            .done(function( msg ) {
                switch(msg['message']){
                    case 'Error':
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text:  msg.desc,
                        });
                        break;
                    case 'Success':
                        var count = parseInt($('#count_userDevices-'+msg.data.device_id).text());
                        $('#count_userDevices-'+msg.data.device_id).text(count + 1);
                        Swal.fire(
                            'Added!',
                            msg.desc,
                            'success'
                        );
                        break;
                    default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! ' + msg.desc,
                        })
                }
            });
        }else{
            Swal.fire("Error","Please check the fields and correct them to continue","error");
        }
    })

    $('#device_lists').on('click','.view-device-users', function(){
        var device_id = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "get",
            url: "/viewDeviceUsers/"+device_id,
        })
        .done(function(response){
            if($.trim(response)){
                $('#modal-view-device-users').modal('toggle');
                $('#user_device_table_body tr').remove();
                for(var i=0 ; i<response.length ; i++){
                    let user_role = response[i].user_details.role == 'U'?"User":'-';
                    $('#user_device_table_body').append('<tr id="'+response[i].id+'">'+
                        "<td>"+(i+1)+"</td>"+
                        "<td>"+response[i].user_details['name']+"</td>"+
                        "<td>"+response[i].user_details.email+"</td>"+
                        "<td>"+user_role+"</td>"+
                        "<td>"+ new Date(response[i].user_details.created_at)+"</td>"+
                        '<td id="action_delete_user_device-'+response[i].user_details['id']+'"><i class="fa fa-trash delete_user_from_device"></i>Delete</td>'+
                    "</tr>")
                }
            }else{
                Swal.fire({title: 'Error!',
                    text: 'Users\' are not assigned to this device!',
                    icon: 'error',
                    confirmButtonText: 'OK'})
            }
        })
    })
    $('#user_device_table_body').on('click','.delete_user_from_device', function(){
        var user_device_id = $(this).closest('tr').attr('id'); // table row ID
        Swal.fire({
            title: ' Are you sure to delete?',
            text: "User will not be able to access this device!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "delete",
                    url: "/deleteUserAccessFromDevice/"+user_device_id,
                })
                .done(function(response){
                    if(response[0] == "deleted"){
                        $('#user_device_table_body #'+user_device_id).remove();
                        var count = parseInt($('#count_userDevices-'+response[1]).text());
                        $('#count_userDevices-'+response[1]).text(count -1);
                        Swal.fire({title: 'Success!',
                        text: 'Deleted!',
                            icon: 'success',
                            confirmButtonText: 'OK'})
                    }
                    else{
                        Swal.fire({title: 'Error!',
                            text: 'Unable to delete!',
                            icon: 'error',
                            confirmButtonText: 'OK'})
                    }
                })
            }
        })

    })
    //Delete device
    $('#device_lists').on('click','.operation-delete', function(){
        Swal.fire({
            title: ' Are you sure to delete?',
            text: "Users associated with this device will not be able to access the device!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var trid = $(this).closest('tr').attr('id'); // table row ID
                deleteUserDevice(trid);
            }
        })

    })
    $('#device_lists').on('click','.operation-edit_device_name', function(){
        var device_id = $(this).closest('tr').attr('id'); // table row ID
        Swal.fire({
            title: "Rename Device?",
            text: "Name something informative!",
            input: 'text',
            inputValue: $('#device_name-'+device_id).text(),
            showCancelButton: true
        }).then((result) => {
            if (result.value) {
                let formData = {
                    // Device Info
                    'serial_number': $('#device_serial-'+device_id).text(),
                    'device_name' : result.value
                }
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "POST",
                    url: "/nameResellerDevice",
                    data: formData,
                })
                .done(function(response){
                    $('#device_name-'+device_id).text(response.device_name)
                    Swal.fire({
                        title: 'Done!',
                        text: 'Device is added and named as '+ response.device_name,
                        icon: 'success',
                        confirmButtonText: 'Cool'
                    })
                });
            }
            // else{
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Device name cannot be empty!',
            //         icon: 'error',
            //         confirmButtonText: 'Cool'
            //     })
            // }
        });


    })

    function deleteUserDevice(id){
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "delete",
            url: "/deleteUserDevice/"+id,
        })
        .done(function(response){
            switch(response['status']){
                case 200:
                    Swal.fire(
                        'Deleted!',
                        'Device has been deleted from your account.',
                        'success'
                    );
                    $('tr#'+id).remove();
                    break;
                case 405:
                    Swal.fire(
                        'Sorry',
                        'This device is being used by users.',
                        'error'
                    );
                    break;
                default:
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href="">Why do I have this issue?</a>'
                    })
            }
        })
    }
    $('#select_existing_user').on('change',function(){
        let selected_user = list_of_users.find(el =>el.id == $('#select_existing_user').val())
        $('#inputUserName').val(selected_user.name)
        $('#inputUserEmail').val(selected_user.email)
        $('#inputUserMobile').val(selected_user.mobile)
        let address = JSON.parse(selected_user.address)
        $('#select_country').val(address.country).change()
        $('#select_state').val(address.state)
        $('#input_city').val(address.city)
        $('#input_street_address_1').val(address.street_address)
        $('#input_house_address_1').val(address.house_address)
        $('#input_zip_code').val(address.zip_code)
    })

    ///// Not needed ... to be deleted in future
    // function to add device and user together
    // $('#btn_confirm_add_reseller_device').on('click', function(e){
    //     e.preventDefault();
    //     let timerInterval
    //     Swal.fire({
    //         title: 'Please Wait!',
    //         html: 'Adding device and users.',
    //         didOpen: () => {
    //             Swal.showLoading()
    //         },
    //         willClose: () => {
    //             clearInterval(timerInterval)
    //         }

    //     })
    //     var formData = {
    //         // Device Info
    //         'serial_number': $('#inputSerialNumber').val(),
    //         'device_number': $('#inputDeviceNumber').val(),
    //         //User Info
    //         'user_name': $('#inputUserName').val(),
    //         'user_email': $('#inputUserEmail').val(),
    //         'user_mobile': $('#inputUserMobile').val(),
    //         'user_address': {
    //                             'country': $('#select_country').val(),
    //                             'state': $('#select_state').val(),
    //                             'city': $('#input_city').val(),
    //                             'street_address': $('#input_street_address_1').val(),
    //                             'house_address': $('#input_house_address_1').val(),
    //                             'zip_code': $('#input_zip_code').val()
    //                         }
    //     }
    //     $.ajax({
    //         headers: {'X-CSRF-Token': $('[name="_token"]').val()},
    //         type: "POST",
    //         url: "/addResellerDevice",
    //         data: formData,
    //     })
    //     .done(function(response){
    //         switch(response['message']){
    //         case 'Error':
    //             Swal.fire({
    //                 title: 'Error!',
    //                 text: 'Device Not Found In Database!',
    //                 icon: 'error',
    //                 confirmButtonText: 'Cool'
    //             })
    //             break;
    //         case 'Already registered':
    //             Swal.fire({
    //                 title: 'Error!',
    //                 text: 'Device is already registered to a reseller',
    //                 icon: 'error',
    //                 confirmButtonText: 'Cool'
    //             })
    //             break;
    //         case 'Success':
    //             Swal.fire({
    //                 title: "Do you want to name this device?",
    //                 text: "Name something informative!",
    //                 input: 'text',
    //                 showCancelButton: true
    //             }).then((result) => {
    //                 if (result.value) {
    //                     let formData = {
    //                         // Device Info
    //                         'serial_number': $('#inputSerialNumber').val(),
    //                         'device_name' : result.value
    //                     }
    //                     $.ajax({
    //                         headers: {'X-CSRF-Token': $('[name="_token"]').val()},
    //                         type: "POST",
    //                         url: "/nameResellerDevice",
    //                         data: formData,
    //                     })
    //                     .done(function(response){
    //                         Swal.fire({
    //                             title: 'Done!',
    //                             text: 'Device is added and named as '+ response.device_name,
    //                             icon: 'success',
    //                             confirmButtonText: 'Cool'
    //                         })
    //                     });
    //                 }
    //             });
    //             // Swal.fire({
    //             //     title: 'Hurray! Device Added!!!',
    //             //     text: " Do you want to add another?",
    //             //     icon: 'success',
    //             //     showCancelButton: true,
    //             //     confirmButtonColor: '#3085d6',
    //             //     cancelButtonColor: '#d33',
    //             //     confirmButtonText: 'Yes, I have more than one devices!',
    //             //     cancelButtonText: 'No'
    //             // }).then((result) => {
    //             //     if (!result.isConfirmed) {
    //             //         // alert("thank you for adding")
    //             //         $('#modal-add-user-device').modal('hide')
    //             //     }

    //             // })
    //             $('#modal-add-user-device').modal('hide')
    //             $('#device_lists .odd').remove();
    //             $('#device_lists').append('<tr id="'+response.data.device.id+'"><td>'+response.data.device.serial_number +'</td>'
    //                                         +'<td>'+response.data.device.device_number +'</td>'
    //                                         +'<td>'+response.data.device.model.name +'</td>'
    //                                         +'<td>'+response.data.device.firmware +'</td>'
    //                                         +'<td> -'+'</td>'
    //                                         +'<td>'
    //                                             +'<a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>'
    //                                             +'<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'

    //                                                 // +'<a href="#" class="dropdown-item operation-assign_user">'
    //                                                 //     +'<i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>'
    //                                                 // +'</a>'
    //                                                 +'<a class="dropdown-item operation-update_firmware"><i class="fas fa-wrench"></i> Update Firmware</a>'
    //                                                 +'<div class="dropdown-divider"></div>'
    //                                                 +'<a class="dropdown-item view-device-users" id="view_user_devices"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>'
    //                                                 +'<div class="dropdown-divider"></div>'
    //                                                 +'<a href="#" class="dropdown-item dropdown-footer operation-delete" id="operation-delete-device-"'+response.data.id+'><i class="far fa-trash-alt"></i> Delete Device</a>'
    //                                             +'</div>'
    //                                         +'</td>'
    //                                     +'</tr>'
    //             )
    //             break;
    //         default:
    //             Swal.fire({
    //                 title: 'Error!',
    //                 text: 'Unkown error occurred!',
    //                 icon: 'error',
    //                 confirmButtonText: 'Cool'
    //             })
    //     }
    //     })
    // })
    // $('#btn_confirm_add_device').on('click', function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         headers: {'X-CSRF-Token': $('[name="_token"]').val()},
    //         type: "POST",
    //         url: "/addUserDevice/",
    //         data: {"id":id},
    //     })
    //     .done(function(response){
    //         switch(response['status']){
    //             case 200:
    //                 Swal.fire(
    //                     'Added!',
    //                     'Device has been added to your account.',
    //                     'success'
    //                 );
    //                 // $('tr#'+id).remove();
    //                 break;
    //             default:
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Oops...',
    //                     text: 'Something went wrong!',
    //                     footer: '<a href="">Why do I have this issue?</a>'
    //                 })
    //         }
    //     })
    // })
    // $('#btn_next_1').on('click', function(e){
    //     e.preventDefault();
    //     //validate both inputs are registered
    //     if($('#inputSerialNumber').val().length > 0 && $('#inputDeviceNumber').val().length > 0){
    //         $('#inputSerialNumber').removeClass("error")
    //         $('#inputDeviceNumber').removeClass("error")
    //         $.ajax({
    //             headers: {'X-CSRF-Token': $('[name="_token"]').val()},
    //             type: "GET",
    //             url: "/searchRegisteredDevice",
    //             data : {
    //                 'serial_number' : $('#inputSerialNumber').val(),
    //                 'device_number' : $('#inputDeviceNumber').val()
    //             }
    //         })
    //         .done(function(response){
    //             if(!$.isEmptyObject(response)){
    //                 if(response.reseller_id != null){
    //                     Swal.fire("Error", "Device already registered to reseller!","error");
    //                 }else{
    //                     //get all the users of reseller from database
    //                     $.ajax({
    //                         headers: {'X-CSRF-Token': $('[name="_token"]').val()},
    //                         type: "GET",
    //                         url: "/getAllResellersUser",
    //                     })
    //                     .done(function(response){
    //                         list_of_users = response
    //                         for(let i=0;i<response.length;i++)
    //                             $('#select_existing_user').append('<option value ="'+response[i].id+'">'+response[i].name+' ('+response[i].email+')</option>');
    //                     })
    //                     var stepper = new Stepper(document.querySelector('.bs-stepper'));
    //                     stepper.next();
    //                 }
    //             }else{
    //                 Swal.fire("Error", "Device not found!", "error");
    //             }
    //         })
    //     }else{
    //         Swal.fire("Error", "Fields are empty! Fill them", "error")
    //         if($('#inputSerialNumber').val().length ==0){
    //             $('#inputSerialNumber').addClass("error")
    //         }
    //         if($('#inputDeviceNumber').val().length ==0){
    //             $('#inputDeviceNumber').addClass("error")
    //         }
    //     }
    // })

</script>
@endsection
