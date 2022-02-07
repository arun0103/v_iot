@extends ('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header" id="app_users">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Super Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Super Users</li>
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
                            <h2 class="card-title">List of Super Users</h2>
                            <!-- <i class="btn fas fa-sync-alt"></i> -->
                            <div class="card-tools">
                                <!-- <input class="form-control" type="filter" placeholder="Filter User" aria-label="Filter"> -->
                                <button type="button" id="btn_add_user" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-new-user">Add New</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-2">
                            <table class="table table-striped table-valign-middle datatable" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th># Devices created</th>
                                        <th># Resellers created</th>
                                        <th>Last login</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr id="{{$user->id}}">
                                        <td><span class="user_name">{{$user->name}}</span>
                                            @if($user->last_login==null)
                                                <span class="badge bg-danger">NEW</span>
                                            @endif
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_devices != null ? count($user->created_devices): '0'}}</td>
                                        <td>{{$user->created_resellers != null ? count($user->created_resellers): '0'}}</td>
                                        <td>
                                            {{$user->last_login != null ? $user->last_login : '-'}}
                                        </td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" >
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a class="dropdown-item option-edit-user" ><i class="fa fa-edit" aria-hidden="true"></i> Edit User</a>
                                                <a class="dropdown-item option-view-user-devices" ><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item option-delete-user"><i class="fas fa-trash"></i> Delete User</a>
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
        <div class="modal fade" id="modal-add-new-user">
            <form id="form_addUser" class="form-horizontal" method="post" action="/addNewUser" autocomplete="nope">
                {{ csrf_field() }}
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">Add New Super User</h4>
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
                                                <div class="error" id ="error_user_name"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="inputEmail" class="control-label">Email</label>
                                                <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" autocomplete="no">
                                                <div class="error" id ="error_user_email"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <label for="selectRole" class="control-label">Role</label>
                                                <select name="role" id="selectRole" class="form-control"  style="width:100%; height:100%" disabled>
                                                    <option value="S" selected>Super Admin</option>
                                                </select>
                                                <div class="error" id ="error_user_role"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_confirm_addNewUser" value="Add">Add</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->"
            </form>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-edit-user" role="dialog">
            <form id="form_editUser" class="form-horizontal" autocomplete="nope">
                <div class="modal-dialog modal-lg" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title">Edit Super User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputName_edit" class="control-label">Name</label>
                                                <input type="text" class="form-control" id="inputName_edit" placeholder="Full Name" name="name_edit" autocomplete="no">
                                                <div class="error" id ="error_user_name_edit"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="inputEmail_edit" class="control-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmail_edit" placeholder="Email" name="email_edit" autocomplete="no">
                                                <div class="error" id ="error_user_email_edit"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <label for="selectRole_edit" class="control-label">Role</label>
                                                <select name="role" id="selectRole_edit" class="form-control" style="width:100%; height:100%" disabled>
                                                    <option value="S" selected>Super Admin</option>
                                                </select>
                                                <div class="error" id ="error_user_role_edit"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel & Close</button>
                            <button type="submit" class="btn btn-primary" id="btn_confirm_editUser" value="save">Save</button>
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
    @section('scripts')
    <!-- <script src="{{asset('js/user.js')}}"> -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datatable').dataTable();
        })
        var user_id = null;
        $(document).on('click','a.option-view-user-devices',function(){

            alert('In progress')
        })
        function validateEditUser(){
            //Remove previous validations
            $('#error_user_name_edit p').remove();
            $('#error_user_email_edit p').remove();

            var error_count = 0;
            //check inputs one by one
            if($('#inputName_edit').val() == ''){
                $('#error_user_name_edit').append('<p style="color:red"> Name cannot be empty!</p>');
                error_count++;
            }if($('#inputEmail_edit').val() == ''){
                $('#error_user_email_edit').append('<p style="color:red"> Email cannot be empty!</p>');
                error_count++;
            }else{
                const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(re.test($('#inputEmail_edit').val()))
                    $('#error_user_email_edit p').remove();
                else{
                    $('#error_user_email_edit').append('<p style="color:red"> Email is invalid!</p>');
                    error_count++;
                }
            }
            if(error_count >0){
                return false;
            }
            else{
                return true;
            }
        }
        $(document).on('click','a.option-edit-user',function(){
            $('.loader').show();
            user_id = $(this).closest('tr').attr('id'); // table row ID
            $('#inputName_edit').val($('tr#'+user_id+' td:eq(0) span.user_name').text())
            $('#inputEmail_edit').val($('tr#'+user_id+' td:eq(1)').text())
            $('#modal-edit-user').modal('show');
            $('.loader').hide();
        })
        $('#selectRole_edit').on('change', function(){
            switch($('#selectRole_edit').val()){
                case 'R':
                    $('#div_reseller_edit').attr('hidden', false)
                    $('#error_user_role p').remove();
                    //popular list of resellers
                    $.ajax({
                        type: "GET",
                        url: "/getResellersList",
                    })
                    .done(function( response ) {
                        console.log(response)
                        $('#selectResellerCompany_edit option').remove();
                        $('#selectResellerCompany_edit').prepend('<option value="0" disabled selected>Select a company</option>')
                        for(var i = 0; i < response.length ; i++){
                            $('#selectResellerCompany_edit').append('<option value=\"'+response[i].id+'\">'+response[i].company_name+'</option>')
                        }
                    });
                    break;
                case 'U':
                case 'S':
                    $('#error_user_role p').remove();
                    $('#div_reseller_edit').attr('hidden', true)
                    break;
                default:
                    $('#div_reseller_edit').attr('hidden', true)

            }
        })
        $('#btn_confirm_editUser').on('click', function(e){
            e.preventDefault();
            if(validateEditUser()){ //validation succeded
                $('#modal-edit-user').modal('hide');
                $('.loader').show()
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "PATCH",
                    url: "/super/editSuperUser/" + user_id,
                    data: {
                        "user_name":$('#inputName_edit').val(),
                        "user_email":$('#inputEmail_edit').val(),
                        "user_role":$('#selectRole_edit').val(),
                    },
                })
                .done(function(response){
                    switch(response.status){
                        case 'failed':
                            Swal.fire(
                                'Failed!',
                                response.description,
                                'error'
                            )
                            break;
                        case 'halted':
                            Swal.fire(
                                'Skipped!',
                                response.description,
                                'question'
                            )
                            break;
                        case 'success':
                            $('tr#'+response.user.id+" td:eq(0) span.user_name").text(response.user.name)
                            $('tr#'+response.user.id+" td:eq(1)").text(response.user.email)
                            $('tr#'+response.user.id+" td:eq(2)").text(response.user.created_devices)
                            $('tr#'+response.user.id+" td:eq(3)").text(response.user.created_resellers)
                            $('tr#'+response.user.id+" td:eq(4)").text(response.user.last_login!=null?response.user.last_login:'-')
                            Swal.fire(
                                'Saved!',
                                'Super User modified! ',
                                'success'
                            )
                    }
                })
            }else{
                $('#modal-edit-user').modal('show');
                Swal.fire(
                    'Validation Failed!',
                    'Please correct the errors first!',
                    'error'
                    )
            }
            $('.loader').hide();
        })

        $(document).on('click','a.option-delete-user', function(){
            var user_id = $(this).closest('tr').attr('id'); // table row ID
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type:'delete',
                        url:'/deleteSuperUser/'+user_id,
                    })
                    .done(function(response){
                        console.log(response)
                        $('#'+user_id).remove();
                        Swal.fire(
                            response.status,
                            response.desc,
                            'info'
                        )
                    })
                    .fail(function(response){
                        console.log(response);
                    })
                }
            })
        })

        $('#btn_add_user').on('click', function(){
            $('#error_user_name p').remove();
            $('#error_user_email p').remove();
            $('#error_user_role p').remove();
            $('#error_user_company p').remove();
            $('#error_user_position p').remove();
        })

        function validateNewUser(){
            //Remove previous validations
            $('#error_user_name p').remove();
            $('#error_user_email p').remove();
            var error_count = 0;
            //check inputs one by one
            if($('#inputName').val() == ''){
                $('#error_user_name').append('<p style="color:red"> Name cannot be empty!</p>');
                error_count++;
            }if($('#inputEmail').val() == ''){
                $('#error_user_email').append('<p style="color:red"> Email cannot be empty!</p>');
                error_count++;
            }else{
                const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(re.test($('#inputEmail').val()))
                    $('#error_user_email p').remove();
                else{
                    $('#error_user_email').append('<p style="color:red"> Email is invalid!</p>');
                    error_count++;
                }
            }
            if(error_count >0){
                return false;
            }
            else{
                return true;

            }
        }


        $('#btn_confirm_addNewUser').on('click', function(e){
            e.preventDefault();
            if(validateNewUser()){ //validation succeded
                $('#modal-add-new-user').modal('hide');
                $('.loader').show()
                console.log($('#selectResellerCompany').val())
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "POST",
                    url: "/super/addSuperUser",
                    data: {
                        "name":$('#inputName').val(),
                        "email":$('#inputEmail').val(),
                        "role":$('#selectRole').val(),
                    },
                })
                .done(function(response){
                    console.log(response)
                    $('.loader').hide()
                    switch(response.status){
                        case 'failed':
                            Swal.fire(
                                'Failed!',
                                response.description,
                                'error'
                            )
                            break;
                        case 'success':
                            $('tbody').prepend('<tr id="'+response['user'].id+'"><td>'
                                    +response['user'].name+'</td><td>'+response['user'].email+'</td><td>0</td><td>0</td><td>'
                                    +'-'+'</td><td><a class="nav-link" data-toggle="dropdown">'
                                    +'<i class="fas fa-angle-down"></i>'
                                    +'</a><div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                    +'<a class="dropdown-item option-edit-user" ><i class="fa fa-edit" aria-hidden="true"></i> Edit User</a>'
                                    +'<a class="dropdown-item option-view-user-devices" ><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>'
                                    +'<div class="dropdown-divider"></div>'
                                    +'<a class="dropdown-item option-delete-user"><i class="fas fa-trash"></i> Delete User</a></div></td></tr>')
                            Swal.fire(
                                'Added!',
                                'Super User added successfully! ',
                                'success'
                            )
                    }
                })
            }else{
                $('#modal-add-new-user').modal('show');
                Swal.fire(
                    'Validation Failed!',
                    'Please correct the errors first!',
                    'error'
                    )
            }
            $('#div.loader').hide();
        })
        $('#inputName').on('change',function(){
            if($('#inputName').val() != '')
                $('#error_user_name p').remove();
        })
        $('#inputEmail').on('change',function(){
            console.log($('#inputEmail').val())
            if($('#inputEmail').val() != '')
                $('#error_user_email p').remove();
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(re.test($('#inputEmail').val()))
                $('#error_user_email p').remove();
            else
            $('#error_user_email').append('<p style="color:red"> Email is invalid!</p>');

        })

        $(function () {
            // var test =json_encode(Session::get('role'))
            // console.log(test)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#selectRole').select2({
                placeholder: 'Select user role',
                width: 'resolve',
                theme: "classic"
            });
            $('#selectRole_edit').select2({
                placeholder: 'Select user role',
                width: 'resolve',
                theme: "classic"
            });
            $('#selectResellerCompany').select2({
                placeholder: 'Select a company',
                width: 'resolve',
                theme: "classic"
            });
            $('.loader').hide();
        });
    </script>
    @endsection
