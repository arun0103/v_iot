@extends ('layouts.master')

@section('head')

@endsection

@section('content')
    <div class="content-header" id="app_user_devices">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Firmwares</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Firmwares</li>
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
                            <h2 class="card-title">List of Firmwares</h2>
                            <div class="card-tools">
                                <button type="button" id="btn_add_new_firmware" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-new-firmware">Add New</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover datatable" id="firmwareTable">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Model</th>
                                        <th>Description</th>
                                        <th>Uploaded At</th>
                                        <th>Uploader</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody id="firmwares_lists">
                                @foreach($firmwares as $firmware)
                                    <tr id="{{$firmware->id}}" class="firmware">
                                        <td>{{$firmware->file_name}}</td>
                                        <td>{{$firmware->model != null? $firmware->model->name: ""}}</td>
                                        <td>{{$firmware->description != null ?$firmware->description : "-"}}</td>
                                        <td>{{$firmware->created_at}}</td>
                                        <td>{{$firmware->uploader != null ? $firmware->uploader->name : "-"}}</td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item operation-edit_firmware">
                                                    <i class="fas fa-edit edit_firmware" aria-hidden="true"> Edit Firmware</i>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Firmware</a>
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
        <div class="modal fade" id="modal-add-new-firmware">
            <form id="form_addFirmware" class="form-horizontal" autocomplete="no">
                {{ csrf_field() }}
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title_newFirmware">Add New Firmware</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20" id="addNewFirmware">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="selectModel" class="control-label">Model</label>
                                                <select name="model_id" id="selectModel" class="form-control" title="Select Model" placeholder="Select Model" required>
                                                    <option value="" disabled selected hidden>Select Model</option>
                                                    @foreach($models as $model)
                                                        <option value="{{$model->id}}">{{$model->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="file_upload_box">Upload the firmware</label>
                                                <input name="file" type="file" class="form-control-file" id="file_upload_box">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="input_fileName" class="control-label">File Name</label>
                                                <input name="file_name" type="text" class="form-control" id="input_fileName" placeholder="File name" autocomplete="no" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="firmware_description">Description</label>
                                                <textarea name="description" class="form-control" id="firmware_description" rows="3" placeholder="Specify the bug fixes included in the firmware, or special purpose of the firmware"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_confirm_add_new_firmware" value="Add">Add</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->"
            </form>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-edit-firmware">
            <form id="form_editFirmware" class="form-horizontal" autocomplete="no">
                {{ csrf_field() }}
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Firmware</h4>
                            <span id="edit_firmware_id" hidden></span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20" id="editFirmware">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="input_fileName_edit" class="control-label">File Name</label>
                                                <input name="file_name" type="text" class="form-control" id="input_fileName_edit" placeholder="File name" autocomplete="no" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="selectModel_edit" class="control-label">Model</label>
                                                <select name="model_id" id="selectModel_edit" class="form-control" title="Select Model" placeholder="Select Model" required>
                                                    <option value="" disabled selected hidden>Select Model</option>
                                                    @foreach($models as $model)
                                                        <option value="{{$model->id}}">{{$model->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="firmware_description_edit">Description</label>
                                                <textarea name="description" class="form-control" id="firmware_description_edit" rows="3" placeholder="Specify the bug fixes included in the firmware, or special purpose of the firmware"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_confirm_save_edit_firmware" value="Add">Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->"
            </form>
        </div>
    </div>
    <!-- /.content -->

@endsection

@section('scripts')
    <script type="text/javascript">
    var table;
        $(document).ready(function(){
            $('.loader').hide();
            table = $('.datatable').dataTable();
        })
        ////////////////////////////////////////////////////////////////////////////
        ///////// Firmware upload check //////
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var file_name = input.files[0].name
                    // console.log(file_name);
                    var splitted_file_name = file_name.split('.')
                    var file_extension = splitted_file_name[splitted_file_name.length -1]
                     console.log(file_extension)
                    if(file_extension.toLowerCase() != "srec"){
                        Swal.fire('Error', "File is invalid. Please select file having extension .srec","error")
                        $('#file_upload_box').val('');
                        $('#input_fileName').val('');
                    }else{
                        $.ajax({
                            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            method: "get",
                            url: "/checkFirmware/"+file_name,
                            success: (response) => {
                                // console.log(response)
                                if(response.msg == 'ok')
                                    $('#input_fileName').val(file_name);
                                else{
                                    Swal.fire("Error","Firmware: "+file_name+" already uploaded",'error')
                                    $('#file_upload_box').val('');
                                }
                            }
                        })
                    }
                }
            }
            $("#file_upload_box").on('change',function() {
                readURL(this);
            });
            //// firmware upload
            $('#btn_confirm_add_new_firmware').on('click',function(e){
                e.preventDefault();
                // console.log("Add button clicked")
                var form = document.querySelector('form');
                let formData = new FormData(form);
                // for (var [key, value] of formData.entries()) {
                //     console.log(key, value);
                // }
                var file =$('#file_upload_box')[0].files[0]
                formData.append('file',file)
                formData.append('file_name',$('#input_fileName').val())
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    method: "post",
                    url: "/addNewFirmware",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        Swal.fire("Success", "Firmware uploaded!","success");
                        $('#firmwares_lists').prepend('<tr id="'+response.data.id+'"><td>'+response.data.file_name+'</td>'
                            +'<td>'+response.data.model.name+'</td>'
                            +'<td>'+response.data.description+'</td>'
                            +'<td>'+response.data.created_at+'</td>'
                            +'<td>'+response.data.uploader.name+'</td>'
                            +'<td>'
                                +'<a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-angle-down"></i></a>'
                                +'<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                    +'<a href="#" class="dropdown-item operation-edit_firmware">'
                                        +'<i class="fas fa-edit" id="edit_firmware" aria-hidden="true"> Edit Firmware</i>'
                                    +'</a>'
                                    +'<div class="dropdown-divider"></div>'
                                    +'<a href="#" class="dropdown-item dropdown-footer operation-delete"><i class="far fa-trash-alt"></i> Delete Firmware</a>'
                                +'</div>'
                            +'</td>'
                            )
                            $('#modal-add-new-firmware').modal('hide');
                            // table.DataTable().reload()
                            // $('.datatable').DataTable().ajax.reload();
                    },
                    error: function(response){
                        // console.log("error")
                        // console.log(response);
                        Swal.fire("Error","Something's wrong while uploading firmware","error")
                    }
                });
            });
        ////////////////////////////////////////////////////////////////////////////

    $('#firmwares_lists').on('click','.operation-edit_firmware', function(){
        var firmware_id = $(this).closest('tr').attr('id'); // table row ID
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "GET",
            url: "/firmware_detail/"+firmware_id,
        })
        .done(function(response){
            // console.log(response)
            $('#input_fileName_edit').val(response.file_name);
            $('#selectModel_edit').val(response.model_id).change();
            $('#firmware_description_edit').val(response.description);
            $('#edit_firmware_id').text(firmware_id);
            $('#modal-edit-firmware').modal('show')
        })

    })

    $('#firmwares_lists').on('click','.operation-delete', function(){
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
                deleteFirmware(trid);

            }
        })

    })
    function deleteFirmware(id){
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "delete",
            url: "/deleteFirmwware/"+id,
        })
        .done(function(response){
            console.log(response)
            $('tr#'+response.id).remove();
            // switch(response['status']){
            //     case 200:
            //         Swal.fire(
            //             'Deleted!',
            //             'Device has been deleted from your account.',
            //             'success'
            //         );
            //         $('tr#'+id).remove();
            //         break;
            //     case 405:
            //         Swal.fire(
            //             'Sorry',
            //             'This device is being used by users.',
            //             'error'
            //         );
            //         break;
            //     default:
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Oops...',
            //             text: 'Something went wrong!',
            //             footer: '<a href="">Why do I have this issue?</a>'
            //         })
            // }
        })
    }
    $('#btn_confirm_save_edit_firmware').on('click',function(){
        let formData = {
            'model_id' : $('#selectModel_edit').val(),
            'description' : $('#firmware_description_edit').val(),
            'firmware_id' : $('#edit_firmware_id').text()
        };
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            type: "PATCH",
            url: "/edit_firmware",
            data: formData
        })
        .done(function(response){
            // console.log(response)
            $('tr#'+response.id).find("td:eq(1)").text(response.model.name);
            $('tr#'+response.id).find("td:eq(2)").text(response.description);
            Swal.fire("Succes","Firmware edited!", 'success');
            $('#modal-edit-firmware').modal('hide')
        })

    })
    // $('#btn_add_new_firmware').on('click', function(){
    //     $('#selectModel').
    // })
</script>
@endsection
