@extends ('layouts.master')

@section('head')

@endsection

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
                    <div class="card">
                        <div class="card-header border-0 bg-top-logo-color">
                            <h2 class="card-title">List of Devices</h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" id="btn_add_new_device" data-toggle="modal" data-target="#modal-add-new-device">Add New</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover datatable" id="deviceTable">
                                <thead>
                                    <tr>
                                        <th>PCB Serial #</th>
                                        <th>Device Serial #</th>
                                        <th>Device Name</th>
                                        <th>Model</th>
                                        <th>Reseller</th>
                                        <th># Users</th>
                                        <!-- <th>Last Data @</th> -->
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody id="device_lists">
                                @foreach($devices as $device)
                                    <tr id="{{$device->id}}" class="device">
                                        <td id="device_serial-{{$device->id}}">{{$device->serial_number}}</td>
                                        <td>{{$device->device_number}}</td>
                                        <td id="device_name-{{$device->id}}">{{$device->device_name != null ?$device->device_name : "-"}}</td>
                                        <td>{{$device->model != null ? $device->model->name : "-"}}</td>
                                        <td>{{$device->reseller != null ? $device->reseller->company_name : "-"}}</td>
                                        <td id="count_userDevices-{{$device->id}}">{{count($device->userDevices)}}</td>
                                        <!-- <td>
                                            {{$device->latest_log!=null?$device->latest_log->created_at:"-"}}
                                        </td> -->
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown"><i class="fas fa-angle-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a class="dropdown-item operation-update_firmware"><i class="fas fa-wrench"></i> Upgrade Firmware</a>
                                                <a class="dropdown-item operation-edit_device"><i class="fas fa-edit" aria-hidden="true"> Edit Device</i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item operation-edit_device_name"><i class="fas fa-edit"></i> Edit Device Name</a>
                                                <!-- <a href="#" class="dropdown-item operation-assign_user">
                                                    <i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>
                                                </a> -->
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item view-device-users"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Device</a>
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
    </div>
    <!-- /.content -->
    <div class="modal fade" id="modal-add-new-device">
        <form id="form_addDevice" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title_newDevice">Add New Device</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="addNewDevice">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="selectModel" class="control-label">Model</label>
                                            <select name="model" id="selectModel" class="form-control" title="Select Model">
                                                <option value="-1" selected hidden>-- Select --</option>
                                                @foreach($models as $model)
                                                    <option value="{{$model->id}}">{{$model->name}}</option>
                                                @endforeach
                                            </select>
                                            <span id="error_model"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputSN" class="control-label">PCB Serial Number</label>
                                            <input type="number" class="form-control" id="inputSN" placeholder="Serial Number" name="serial_number" autocomplete="no">
                                            <span id="error_serial_number"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputDN" class="control-label">Device Serial Number</label>
                                            <input type="text" class="form-control" id="inputDN" placeholder="Device Number" name="device_number" autocomplete="no">
                                            <span id="error_device_number"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="inputManufacturedDate" class="control-label">Manufactured Date</label>
                                            <input class="form-control datepicker" id="inputManufacturedDate" name="manufactured_date" width="234" placeholder="MM / DD / YYYY" autocomplete="off"/>
                                            <span id="error_manufactured_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="inputFirmwareVersion" class="control-label">Firmware Version</label>
                                            <input type="text" class="form-control" id="inputFirmwareVersion" name="firmware" width="234" placeholder="e.g. P1.B1.H1.F1.D1.0"/>
                                            <span id="error_firmware_version"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_confirm_add_new_device" value="Add">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-assign-user">
        <form id="form_assign_user" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title_assign_user">Assign User Device</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                                            <label for="user_type" class="control-label">User's Name</label>
                                            <select name="user_type" id="select_user" class="form-control">
                                                <option value="null"> --  Select  -- </option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" class="{{$user->role}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputSN_verify" class="control-label">PCB Serial Number</label>
                                            <input type="number" class="form-control" id="inputSN_verify" placeholder="PCB Serial Number" name="serial_number" autocomplete="no">
                                        </div>
                                    </div>
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
    <!-- /.modal -->
    <div class="modal fade" id="modal-add-user-device">
        <form id="form_addUserDevice" class="form-horizontal" autocomplete="no">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-user_device">Add New Device</h4>
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
                        <button type="button" class="btn btn-primary" id="btn_confirm_add_reseller_device" value="Add">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </form>
    </div>
    <!-- /.modal -->
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
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                        <label for="inputFirmwareVersion_edit" class="control-label">Firmware Version</label>
                                            <input type="text" class="form-control" id="inputFirmwareVersion_edit" name="firmware" width="234" placeholder="E.G. P1.B1.H1.F1.D1.0"/>
                                            <span id="error_edit_firmware"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="select_user_id_edit" class="control-label">User</label><br>
                                            <select name="user_id" id="select_user_id_edit" class="form-control" style="width:100%; height:100%">
                                                <option></option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
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
                                    <th>User Name</th>
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->"
    </div>

    <div class="modal fade" id="modal-view-firmwares">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-firmwares_list">Firmwares' List</h4>
                    <span id="selected_device_id" hidden></span>
                    <span id="selected_firmware_id" hidden></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row roundPadding20">
                        <div class="col-lg-12">
                            <label for="firmware_select">Select Firmware</label>
                            <select name="firmware_select" id="firmware_select" class="form-control select2">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-lg-12" id="description_col" hidden>
                            <label for="firmware_description">Firmware Description</label>
                            <textarea class="form-control" name="firmware_description" id="firmware_description" cols="30" rows="10"></textarea>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_update_firmware" disabled>Upgrade</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->"
    </div>


@endsection

@section('scripts')
    <!-- <script src="{{asset('js/device.js')}}"></script> -->
    <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.select2').select2({
            placeholder: 'Select an option',
            width: 'resolve',
            theme: "classic"
        });
        $('.datatable').dataTable();

        $('.loader').hide();
    })
    //Add
    $('#btn_add_new_device').on('click', function(){
        // alert('hi')
        $('#selectModel').val(-1).change();
        $('#inputSN').val("");
        $('#inputDN').val("");
        $('#inputManufacturedDate').val("");
        $('#inputFirmwareVersion').val("");

    })
    function validateAddNewDevice(){
        let model = $('#selectModel').val()
        let serial_number = $('#inputSN').val()
        let device_number = $('#inputDN').val()
        let manufactured_date = $('#inputManufacturedDate').val()
        let firmware = $('#inputFirmwareVersion').val()

        let validated = true;
        if(model == -1){
            validated = false;
            $('#error_model').text("Please select one of the model").css('color','red')
        }else{
            $('#error_model').text("");
        }if(serial_number == "" || serial_number.length != 9){
            validated = false;
            $('#error_serial_number').text("Please enter 9 digit serial number").css('color','red')
        }else{
            $('#error_serial_number').text("");
        }if(device_number == ""){
            validated = false;
            $('#error_device_number').text("Please enter device number").css('color','red')
        }else{
            $('#error_device_number').text("");
        }
        if(manufactured_date == ""){
            validated = false;
            $('#error_manufactured_date').text("Please select the Date of Manufacture").css('color','red')
        }else{
            let splitted_date = manufactured_date.split("/");
            if(splitted_date.length !=3){
                $('#error_manufactured_date').text("Invalid date selecte").css('color','red')
                validated = false;
            }else{
                if(splitted_date[0] >12){ //month
                    $('#error_manufactured_date').text("Invalid month").css('color','red')
                    validated = false;
                }
                if(splitted_date[1] >31){ //day
                    $('#error_manufactured_date').text("Invalid day").css('color','red')
                    validated = false;
                }
                if(splitted_date[2] <2020){//year
                    $('#error_manufactured_date').text("Invalid year").css('color','red')
                    validated = false;
                }
            }

            $('#error_manufactured_date').text("");
        }
        return validated;
    }
    $('#btn_confirm_add_new_device').on('click', function(e){
        e.preventDefault();
        var formData = {
            'model':$('#selectModel').val(),
            'serial_number':$('#inputSN').val(),
            'device_number':$('#inputDN').val(),
            'manufactured_date':$('#inputManufacturedDate').val(),
            'firmware':$('#inputFirmwareVersion').val(),
        }
        if(validateAddNewDevice()){
            $.ajax({
                method: "POST",
                url: "/addNewDevice",
                data: formData,
                })
                .done(function( response ) {
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
                            $('tbody').prepend('<tr id="'+response.data.id+'" class="device"><td>'+response.data.serial_number + '</td>'
                                +'<td>'+ response.data.device_number
                                + '</td><td>-</td><td>'
                                + response.data.model.name +
                                '</td><td>-</td>'+
                                '<td>0</td>'
                                +'<td><a class="nav-link" data-toggle="dropdown"><i class="fas fa-angle-down"></i></a>'
                                    +'<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                        +'<a class="dropdown-item operation-update_firmware"><i class="fas fa-wrench"></i> Upgrade Firmware</a>'
                                        +'<a class="dropdown-item operation-edit_device">'
                                        +'<a class="dropdown-item operation-edit_device_name"><i class="fas fa-edit"></i> Edit Device Name</a>'
                                            +'<div class="dropdown-divider"></div>'
                                            +'<i class="fas fa-edit" id="edit_device" aria-hidden="true"> Edit Device</i>'
                                        +'</a>'
                                        +'<div class="dropdown-divider"></div>'
                                        +'<a class="dropdown-item view-device-users"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>'
                                        +'<div class="dropdown-divider"></div>'
                                        +'<a class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Device</a>'
                                    +'</div></td></tr>')
                            $('#modal-add-new-device').modal('hide')
                            Swal.fire(
                                'Added!',
                                'Device has been added',
                                'success'
                            );

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
        }
    })
    //Edit
    var edit_device_id = null;
    $('#device_lists').on('click','.operation-edit_device', function(){
        edit_device_id = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/device_detail/"+edit_device_id,
        })
        .done(function(response){
            $('#edit_selectModel').val(response.model.id).trigger('change');
            $('#inputSN_edit').val(response.serial_number);
            $('#inputDN_edit').val(response.device_number);
            $('#inputFirmwareVersion_edit').val(response.firmware);
            $('#inputManufacturedDate_edit').val(response.manufactured_date);
            $('#modal-edit-device').modal('show')
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
    $('#btn_confirm_save_edit_device').on('click',function(){
        if(validateEditDevice()){
            $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "PATCH",
                    url: "/saveEditedDevice/" + edit_device_id,
                    data: {
                        "model_id": $('#edit_selectModel').val(),
                        "serial_number":$('#inputSN_edit').val(),
                        "device_number":$('#inputDN_edit').val(),
                        "firmware":$('#inputFirmwareVersion_edit').val(),
                        "manufactured_date":$('#inputManufacturedDate_edit').val(),
                    },
                })
                .done(function(response){
                    console.log(response)
                    $('tr#'+response.id+" td:eq(0)").text(response.serial_number)
                    $('tr#'+response.id+" td:eq(1)").text(response.device_number)
                    $('tr#'+response.id+" td:eq(3)").text(response.model.name).change()
                    $('#modal-edit-device').modal('hide')
                    Swal.fire(
                        'Saved!',
                        'Device modified! ',
                        'success'
                    )
                })
        }
    })
    function validateEditDevice(){
        var is_valid = true;
        //clear previous errors
        $('#error_edit_sn').text("");
        $('#error_edit_dn').text("");
        //check serial number
        if($('#inputSN_edit').val()==""){
            $('#error_edit_sn').text("Serial number cannot be empty!").css("color","red");
            is_valid = false;
        }
        //check device number
        if($('#inputDN_edit').val()==""){
            $('#error_edit_dn').text("Device number cannot be empty!").css("color","red");
            is_valid = false;
        }
        //check firmware
        if($('#inputFirmwareVersion_edit').val() ==""){
            $('#error_edit_firmware').text("Firmware version cannot be empty!").css("color","red");
            is_valid = false;
        }
        return is_valid;

    }


    $('#btn_confirm_assign_user').on('click',function(e){
        e.preventDefault();
        var formData = {
            'user_type':$('#select_user_type').val(),
            'serial_number':$('#inputSN_verify').val(),
            'user_id':$('#select_user').val(),
        }
        $.ajax({
            method: "post",
            url: "/assignUserDevice",
            data: formData,
        })
        .done(function( msg ) {
            console.log(msg)
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
                        // footer: msg
                    })

            }
        });
    })

    $('#device_lists').on('click','.view-device-users', function(){
        var device_id = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "get",
            url: "/viewDeviceUsers/"+device_id,
        })
        .done(function(response){
            console.log(response)
            if($.trim(response)){
                $('#modal-view-device-users').modal('toggle');
                $('#user_device_table_body tr').remove();
                for(var i=0 ; i<response.length ; i++){
                $('#user_device_table_body').append('<tr id="'+response[i].id+'">'+
                    "<td>"+(i+1)+"</td>"+
                    "<td>"+response[i].user_details['name']+"</td>"+
                    "<td>"+response[i].user_details.email+"</td>"+
                    "<td>"+response[i].user_details.role+"</td>"+
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
        Swal.fire({
            title: 'Are you sure to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                let user_device_id = $(this).closest('tr').attr('id'); // table row ID
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "delete",
                    url: "/deleteUserAccessFromDevice/"+user_device_id,
                })
                .done(function(response){
                    console.log(response)
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
    $('#device_lists').on('click','.operation-delete', function(){
        Swal.fire({
            title: ' Are you sure to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var trid = $(this).closest('tr').attr('id'); // table row ID
                console.log(trid)
                deleteUserDevice(trid);
            }
        })

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
    $('#btn_confirm_add_reseller_device').on('click', function(e){
        e.preventDefault();
        var formData = {
            'serial_number': $('#inputSerialNumber').val(),
            'device_number': $('#inputDeviceNumber').val(),
            'device_name': $('#inputDeviceName').val()
        }
        console.log(formData)
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "POST",
            url: "/addResellerDevice",
            data: formData,
        })
        .done(function(response){
            console.log(response)
            switch(response['message']){
            case 'Error':
                Swal.fire({
                    title: 'Error!',
                    text: 'Device Not Found In Database!',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })
                break;
            case 'Already registered':
                Swal.fire({
                    title: 'Error!',
                    text: 'Device is already registered to a reseller',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })
                break;
            case 'Success':
                Swal.fire({
                    title: 'Hurray! Device Added!!!',
                    text: " Do you want to add another?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, I have more than one devices!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (!result.isConfirmed) {
                        // alert("thank you for adding")
                        $('#modal-add-user-device').modal('hide')
                    }

                })
                $('#device_lists .odd').remove();
                $('#device_lists').append('<tr id="'+response.data.id+'"><td>'+response.data.serial_number +'</td>'
                                            +'<td>'+response.data.device_number +'</td>'
                                            +'<td>'+response.data.model =='U'?"DiUSE" :"DiEntry" +'</td>'
                                            +'<td> 0 '+'</td>'
                                            +'<td> -'+'</td>'
                                            +'<td>'
                                                +'<a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>'
                                                +'<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                                    +'<a href="#" class="dropdown-item operation-edit_device">'
                                                        +'<i class="fas fa-edit" id="edit_device" aria-hidden="true"> Edit Device</i>'
                                                    +'</a>'
                                                    +'<a href="#" class="dropdown-item operation-assign_user">'
                                                        +'<i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>'
                                                    +'</a>'
                                                    +'<div class="dropdown-divider"></div>'
                                                    +'<a class="dropdown-item view-device-users" id="view_user_devices"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>'
                                                    +'<div class="dropdown-divider"></div>'
                                                    +'<a href="#" class="dropdown-item dropdown-footer operation-delete" id="operation-delete-device-"'+response.data.id+'><i class="far fa-trash-alt"></i> Delete Device</a>'
                                                +'</div>'
                                            +'</td>'
                                        +'</tr>'
                )
                break;
            default:
                Swal.fire({
                    title: 'Error!',
                    text: 'Unkown error occurred!',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })
        }
        })
    })

    $('#btn_confirm_add_device').on('click', function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "POST",
            url: "/addUserDevice/",
            data: {"id":id},
        })
        .done(function(response){
            switch(response['status']){
                case 200:
                    Swal.fire(
                        'Added!',
                        'Device has been added to your account.',
                        'success'
                    );
                    // $('tr#'+id).remove();
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
    })
    $('#device_lists').on('click', '.operation-update_firmware',function(){
        var device_id = $(this).closest('tr').attr('id'); // table row ID
        $('#selected_device_id').text(device_id);
        $('#firmware_select').html('<option></option>');
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "get",
            url: "/getFirmwares/"+device_id,
        })
        .done(function(response){
            $('#firmware_select').html('<option></option>');
            if(response.length > 0){
                response.forEach(function(data){
                    $('#firmware_select').append('<option value="'+data.id+'">'+data.file_name+'</option>');
                })
                $('#modal-view-firmwares').modal('show');
            }else{
                Swal.fire('Alert','No new firmware is available for this device','info')
            }
        })
    });
    $('#firmware_select').on('change',function(){
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "get",
            url: "/getFirmwareDescription/"+ $('#firmware_select option:selected').attr("value"),
        })
        .done(function(response){
            $('#firmware_description').val(response[0].description);
            $('#description_col').attr('hidden',false)
            $('#btn_update_firmware').attr('disabled',false)
        })
    })
    $('#btn_update_firmware').on('click', function(){
        let device_id = $('#selected_device_id').text();
        let firmware_id = $('#firmware_select option:selected').attr("value");
        Swal.fire({
        title: 'Upgrade Firmware?',
        text: "Device will stop during firmware upgrade! See LCD for status and maintain power during crucial step as mentioned in LCD",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Upgrade it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "post",
                    url: "/upgradeFirmware/"+ device_id+'/'+ firmware_id,
                })
                .done(function(response){
                    Swal.fire(
                    'Success!',
                    'Command Sent. Firmware upgrade in progress. Maintain power and check LCD for status!',
                    'success'
                    )
                })
            }
        })
    })
</script>
@endsection
