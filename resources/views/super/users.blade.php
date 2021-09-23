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
                            <h2 class="card-title">List of Users</h2>
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
                                        <th>User Type</th>
                                        <th># Devices</th>
                                        <th>Reseller</th>
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
                                        <td id="{{$user->id}}_role">{{$user->role=='R'?'Reseller':($user->role=='U'?'User':($user->role=='S'?'Super Admin':'N/A'))}}</td>
                                        <td>{{$user->user_devices_count}}</td>
                                        <td>{{$user->reseller_id != null ? $user->reseller->company_name: '-'}}</td>
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
                                                <select name="role" id="selectRole" class="form-control"  style="width:100%; height:100%">
                                                <option value="" selected disabled>Select item...</option>
                                                <option value="R">Reseller</option>
                                                    @if(Auth::user()->role == 'S')
                                                        <option value="S">Super Admin</option>
                                                    @endif
                                                    <option value="U">User</option>
                                                </select>
                                                <div class="error" id ="error_user_role"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="div_reseller" hidden>
                                        @if(Auth::user()->role == 'S')
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="selectResellerCompany" class="control-label">Reseller's Company</label>
                                                <select name="resellerComapny" id="selectResellerCompany" class="form-control"  style="width:100%; height:100%"></select>
                                                <div class="error" id ="error_user_company"></div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputResellerPostition" class="control-label">Position</label>
                                                <input type="text" class="form-control" id="inputResellerPostition" placeholder="Position" name="position" autocomplete="no">
                                                <div class="error" id ="error_user_position"></div>
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
                            <h4 class="modal-title" id="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row roundPadding20">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputName_edit" class="control-label">User's Name</label>
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
                                                <select name="role" id="selectRole_edit" class="form-control" style="width:100%; height:100%">
                                                <option value="" selected disabled hidden>Select item...</option>
                                                <option value="R">Reseller</option>
                                                    @if(Auth::user()->role == 'S')
                                                        <option value="S">Super Admin</option>
                                                    @endif
                                                    <option value="U">User</option>
                                                </select>
                                                <div class="error" id ="error_user_role_edit"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="div_reseller_edit" hidden>
                                        @if(Auth::user()->role == 'S')
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="selectResellerCompany_edit" class="control-label">Reseller's Company</label>
                                                <select name="resellerComapny" id="selectResellerCompany_edit" class="form-control"  style="width:100%; height:100%"></select>
                                                <div class="error" id ="error_user_company_edit"></div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputResellerPostition_edit" class="control-label">Position</label>
                                                <input type="text" class="form-control" id="inputResellerPostition_edit" placeholder="Position" name="position" autocomplete="no">
                                                <div class="error" id ="error_user_position_edit"></div>
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
            $('#error_user_role_edit p').remove();
            $('#error_user_company_edit p').remove();
            $('#error_user_position_edit p').remove();
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
            switch($('#selectRole_edit').val()){
                case 'R':
                    // validate company and position
                    switch($('#selectResellerCompany_edit').val()){
                        case '0': // user has not selected any value
                            $('#error_user_company_edit').append('<p style="color:red"> Company cannot be empty!</p>');
                            error_count++;
                            break;
                    }
                    if($('#inputResellerPostition_edit').val() == ''){
                        $('#error_user_position_edit').append('<p style="color:red"> Position cannot be empty!</p>');
                        error_count++;
                    }break;
                case 'U':
                case 'S':
                    $('#error_user_role_edit p').remove();
                    break;
                default:
                    $('#error_user_role_edit p').remove();
                    $('#error_user_role_edit').append('<p style="color:red"> Role cannot be empty!</p>');
                    error_count++;
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
            $('#selectRole_edit').val($('tr#'+user_id+' td#'+user_id +'_role').text().charAt(0)).trigger('change')
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
                    console.log($('#inputName_edit').val())
                    console.log($('#inputEmail_edit').val())
                    console.log($('#selectRole_edit').val())
                    console.log($('#selectResellerCompany_edit').val())
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                        type: "PATCH",
                        url: "/super/editUser/" + user_id,
                        data: {
                            "user_name":$('#inputName_edit').val(),
                            "user_email":$('#inputEmail_edit').val(),
                            "user_role":$('#selectRole_edit').val(),
                            "user_reseller_id":$('#selectResellerCompany_edit').val(),
                            "user_position":$('#inputResellerPostition_edit').val(),
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
                                $('tr#'+response.user.id+" td:eq(0)").text(response.user.name)
                                $('tr#'+response.user.id+" td:eq(1)").text(response.user.email)
                                $('tr#'+response.user.id+" td:eq(2)").text(response.user.role == 'U'?'User':(response.user.role == 'R'? 'Reseller':'Voltea'))
                                $('tr#'+response.user.id+" td:eq(3)").text(response.user.user_devices_count)
                                $('tr#'+response.user.id+" td:eq(4)").text(response.user.reseller!=null?response.user.reseller.company_name: '-')
                                $('tr#'+response.user.id+" td:eq(5)").text(response.user.last_login!=null?response.user.last_login:'-')
                                Swal.fire(
                                    'Saved!',
                                    'User modified! ',
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
                            url:'/deleteUser/'+user_id,
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
                $('#error_user_role p').remove();
                $('#error_user_company p').remove();
                $('#error_user_position p').remove();
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
                switch($('#selectRole').val()){
                    case 'R':
                        // validate company and position
                        switch($('#selectResellerCompany').val()){
                            case '0': // user has not selected any value
                                $('#error_user_company').append('<p style="color:red"> Company cannot be empty!</p>');
                                error_count++;
                                break;
                        }
                        if($('#inputResellerPostition').val() == ''){
                            $('#error_user_position').append('<p style="color:red"> Position cannot be empty!</p>');
                            error_count++;
                        }break;
                    case 'U':
                    case 'S':
                        $('#error_user_role p').remove();
                        break;
                    default:
                        $('#error_user_role p').remove();
                        $('#error_user_role').append('<p style="color:red"> Role cannot be empty!</p>');
                        error_count++;
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
                        url: "/super/addUser",
                        data: {
                            "name":$('#inputName').val(),
                            "email":$('#inputEmail').val(),
                            "role":$('#selectRole').val(),
                            "reseller_id":$('#selectResellerCompany').val(),
                            "position":$('#inputResellerPostition').val(),
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
                                switch( response.user.role){
                                    case 'R':
                                        $('tbody').prepend('<tr id="'+response['user'].id+'"><td>'
                                        +response['user'].name+'</td><td>'+response['user'].email+'</td><td>'
                                        +'Reseller'+'</td><td>0</td><td>'
                                        +response['user'].reseller.company_name +'</td><td>'
                                        +response['user'].last_login+'</td><td><a class="nav-link" data-toggle="dropdown">'
                                        +'<i class="fas fa-angle-down"></i>'
                                        +'</a><div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                        +'<a class="dropdown-item option-edit-user" ><i class="fa fa-edit" aria-hidden="true"></i> Edit User</a>'
                                        +'<a class="dropdown-item option-view-user-devices" ><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>'
                                        +'<div class="dropdown-divider"></div>'
                                        +'<a class="dropdown-item option-delete-user"><i class="fas fa-trash"></i> Delete User</a></div></td></tr>')
                                        break;
                                    case 'U':
                                        $('tbody').prepend('<tr id="'+response['user'].id+'"><td>'
                                        +response['user'].name+'</td><td>'+response['user'].email+'</td><td>'
                                        +'User'+'</td><td>0</td><td>'
                                        +'-' +'</td><td>'+response['user'].last_login+'</td><td><a class="nav-link" data-toggle="dropdown">'
                                        +'<i class="fas fa-angle-down"></i>'
                                        +'</a><div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                        +'<a class="dropdown-item option-edit-user" ><i class="fa fa-edit" aria-hidden="true"></i> Edit User</a>'
                                        +'<a class="dropdown-item option-view-user-devices" ><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>'
                                        +'<div class="dropdown-divider"></div>'
                                        +'<a class="dropdown-item option-delete-user"><i class="fas fa-trash"></i> Delete User</a></div></td></tr>')
                                        break;
                                    case 'S':
                                        $('tbody').prepend('<tr id="'+response['user'].id+'"><td>'
                                        +response['user'].name+'</td><td>'+response['user'].email+'</td><td>'
                                        +'Super'+'</td><td>0</td><td>'
                                        +'-' +'</td><td>'+response['user'].last_login+'</td><td><a class="nav-link" data-toggle="dropdown">'
                                        +'<i class="fas fa-angle-down"></i>'
                                        +'</a><div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">'
                                        +'<a class="dropdown-item option-edit-user" ><i class="fa fa-edit" aria-hidden="true"></i> Edit User</a>'
                                        +'<a class="dropdown-item option-view-user-devices" ><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>'
                                        +'<div class="dropdown-divider"></div>'
                                        +'<a class="dropdown-item option-delete-user"><i class="fas fa-trash"></i> Delete User</a></div></td></tr>')
                                        break;
                                }

                                Swal.fire(
                                    'Added!',
                                    'User added successful! ',
                                    'success'
                                )
                        }

                        // switch(response['status']){
                        //     case 200:
                        //         Swal.fire(
                        //             'Deleted!',
                        //             'Reseller has been deleted.',
                        //             'success'
                        //         );
                        //         $('tr#'+id).remove();
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
            $('#selectRole').on('change', function(){
                switch($('#selectRole').val()){
                    case 'R':
                        $('#div_reseller').attr('hidden', false)
                        $('#error_user_role p').remove();
                        //popular list of resellers
                        $.ajax({
                            type: "GET",
                            url: "/getResellersList",
                        })
                        .done(function( response ) {
                            console.log(response)
                            $('#selectResellerCompany option').remove();
                            $('#selectResellerCompany').prepend('<option value="0" disabled selected>Select a company</option>')
                            for(var i = 0; i < response.length ; i++){
                                $('#selectResellerCompany').append('<option value=\"'+response[i].id+'\">'+response[i].company_name+'</option>')
                            }
                        });
                        break;
                    case 'U':
                    case 'S':
                        $('#error_user_role p').remove();
                        $('#div_reseller').attr('hidden', true)
                        break;
                    default:
                        $('#div_reseller').attr('hidden', true)

                }
            })
            $('#selectResellerCompany').on('change', function(){
                if($('#selectResellerCompany').val()=="0"){
                    $('#error_user_company').append('<p style="color:red"> Company cannot be empty!</p>');
                }
                else
                $('#error_user_company p').remove()

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
