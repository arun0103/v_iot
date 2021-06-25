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
                        @if(Auth::user()->role == 'S')
                        <li class="breadcrumb-item active">Users</li>
                        @endif
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
                                @if(Auth::user()->role == 'S')
                                    <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-new-device">Add New</button>
                                @else
                                    <button type="button" id="btn_add_users" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-user-device">Add New</button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover datatable" id="deviceTable">
                                <thead>
                                    <tr>
                                        <th>PCB Serial #</th>
                                        <th>Device Serial #</th>
                                        <th>Model</th>
                                        <th># Assigned Users</th>
                                        <th>Last Data Received Time</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($devices as $device)
                                    <tr id="{{$device->id}}" class="device">
                                        <td>{{$device->serial_number}}</td>
                                        <td>{{$device->device_number}}</td>
                                        <td>{{$device->model == 'U'?'DiUse':($device->model == 'E'?'DiEntry':'Unknown')}}</td>
                                        <td>{{count($device->userDevices)}}</td>
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
                                                <a href="#" class="dropdown-item view-device-users"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>
                                                <div class="dropdown-divider"></div>
                                                <a id="operation-delete-device-{{$device->id}}" href="#" class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Device</a>
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
                                                    <option value="U">DiUse</option>
                                                    <option value="E">DiEntry</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputSN" class="control-label">PCB Serial Number</label>
                                                <input type="number" class="form-control" id="inputSN" placeholder="Serial Number" name="serial_number" autocomplete="no">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputDN" class="control-label">Device Serial Number</label>
                                                <input type="text" class="form-control" id="inputDN" placeholder="Device Number" name="device_number" autocomplete="no">
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
                                            <label for="inputFirmwareVersion" class="control-label">Firmware Version</label>
                                                <input type="text" class="form-control" id="inputFirmwareVersion" name="firmware" width="234" placeholder="E.G. 2021.01.01_test"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label for="select_user_id" class="control-label">User</label><br>
                                                <select name="user_id" id="select_user_id" class="form-control" style="width:100%; height:100%">
                                                    <option></option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
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
                        <!-- <button type="button" class="btn btn-primary" id="btn_confirm_add_reseller_device" value="Add">Add</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </div>
    </div>
    <!-- /.content -->

@endsection

@section('scripts')
    <script src="{{asset('js/device.js')}}"></script>
    <script type="text/javascript">
    $('#btn_confirm_add_new_device').on('click', function(e){
        e.preventDefault();
        var formData = {
            'model':$('#selectModel').val(),
            'serial_number':$('#inputSN').val(),
            'device_number':$('#inputDN').val(),
            'manufactured_date':$('#inputManufacturedDate').val(),
            'firmware':$('#inputFirmwareVersion').val(),
            'reseller_id':$('#select_user_id').val(),
        }
        $.ajax({
            method: "post",
            url: "/addNewDevice",
            data: formData,
            })
            .done(function( response ) {
                console.log(response.data)
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
                        $('tbody').prepend('<tr id="'+response['data'].id+'" class="device"><td>'+response['data'].serial_number + '</td><td>'
                            + response['data'].device_number + '</td><td>'+ response['data'].model == 'U'? 'DiUse': 'DiEntry' +
                            '</td><td>0</td>'+
                            '<td>-</td>'
                            +'<td><a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>'
                                            +'<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                                +'<a href="#" class="dropdown-item">'
                                                    +'<i class="fa fa-user-plus" aria-hidden="true" data-toggle="modal" data-target="#modal-assign-user"> Assign Users</i>'
                                                +'</a>'
                                                +'<div class="dropdown-divider"></div>'
                                                +'<a href="#" class="dropdown-item view-device-users"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal-view-device-users"></i> View Users</a>'
                                                +'<div class="dropdown-divider"></div>'
                                                +'<a id="operation-delete-device-{{$device->id}}" href="#" class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Device</a>'
                                            +'</div></td></tr>')

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
                console.log( response );
        });
    })

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
            switch(msg['message']){
                case 'Error':
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text:  msg.desc,
                    });
                    break;
                case 'Success':
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
            console.log( msg );
        });
    })

    $('.view-device-users').on('click', function(){
        var device_id = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "get",
            url: "/viewDeviceUsers/"+device_id,
        })
        .done(function(response){
            $('#modal-view-device-users').modal('toggle');
            $('#user_device_table_body tr').remove();
            for(var i=0 ; i<response.length ; i++){
               $('#user_device_table_body').append("<tr id=\"+response.id+\">"+
                "<td>"+(i+1)+"</td>"+
                "<td>"+response[i].user_details['name']+"</td>"+
                "<td>"+response[i].user_details.email+"</td>"+
                "<td>"+response[i].user_details.role+"</td>"+
                "<td>"+response[i].user_details.created_at+"</td>"+
                "<td>"+"</td>"+

                "</tr>")
            }

        })

    })
    $('.operation-delete').on('click', function(){
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
</script>
@endsection
