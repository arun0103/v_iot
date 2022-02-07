@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{ asset('css/profile_body.css') }}">
@endsection
@section('content')
<div class="container" id='app' style="z-index: 99999 !important;">
@csrf
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content">
                <div class="profile">
                    <div class="profile-header">
                        <div class="profile-header-cover"></div>
                        <div class="profile-header-content">
                            <div class="profile-header-img" style="z-index: index 999999999999;">
                                <img id="img_avatar_preview" src="/uploads/avatars/{{Auth::user()->avatar != null? Auth::user()->avatar : 'default-avatar.png'}}"style="width:250px; height:150px;  margin-right:25px">
                                <button id="btn_change_avatar" hidden type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#avatar_edit_modal" style="position:absolute; left:0px;bottom:0px;">Change</button>
                            </div>
                            <div class="profile-header-info">
                                <h4 class="m-t-10 m-b-5">{{$user->name}}</h4>
                                <p class="m-b-10"><span><b>{{$user->role == 'U'?"User":($user->role == 'R'?"Reseller":($user->role == 'S'?"Super Admin":""))}} since  <i id="info_member_since">{{$user->created_at}}</i></b><i id="info_member_since_edit" hidden></i></span></p>
                                <span id="user_profile_profession">{{$user->profile!=null?$user->profile['profession']:" "}}</span>
                                <p class="m-b-10"><span id="user_profile_institution">{{$user->profile!=null?$user->profile['institution']:" "}}</span></p>
                                <button id="btn_cancel_edit_user_profile" hidden type="button" class="btn btn-sm btn-light" >Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button id="btn_edit_user_profile" type="button" class="btn btn-sm btn-primary" >Edit</button>
                            </div>
                        </div>
                        <ul class="profile-header-tab nav nav-tabs" style="margin-left:-140px">
                            <li class="nav-item"><a href="#profile-personal-info" class="nav-link active show " data-toggle="tab">General</a></li>
                            <li class="nav-item"><a id="nav_user_devices" href="#profile-devices" class="nav-link" data-toggle="tab">Devices</a></li>
                            <li class="nav-item"><a href="#profile-activities" class="nav-link" data-toggle="tab">Recent Activities</a></li>
                        </ul>
                    </div>
                </div>
                <div class="profile-content" style="margin:-10px -20px">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade active show" id="profile-personal-info">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <h3 class="card-header">
                                            <div class="card-title">Personal Information</div>
                                            <div class="card-tools">
                                                <button id="btn_edit_user_info" type="button" class="btn btn-sm btn-primary" >Edit</button>
                                                <button id="btn_cancel_edit_user_personal" hidden type="button" class="btn btn-sm btn-light" >Cancel</button>
                                            </div>
                                        </h3>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Full Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary" id="div_user_name"><span id="txt_user_name">{{Auth::user()->name}}</span> </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary" id="div_user_email"><span id="txt_user_email">{{$user->email}}</span></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Phone</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary" id="div_user_phone"><span id="txt_user_phone">{{$user->profile!=null?$user->profile->phone:""}}</span></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Mobile</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary" id="div_user_mobile"><span id="txt_user_mobile">{{$user->profile!=null?$user->profile->mobile:""}}</span></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Address</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary" id="div_user_address"><span id="txt_user_address"> {{$user->profile!=null?$user->profile->address:""}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <h3 class="card-header">
                                            <div class="card-title">Security</div>
                                        </h3>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Password</h6>
                                                </div>
                                                <div class="col-sm-9">
                                                    <button class="btn btn-primary" style="float:right" id="btn_change_password">Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade display-none" id="profile-devices">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Devices</div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <td>Serial Number</td>
                                                        <td>Device Number</td>
                                                        <td>Name</td>
                                                    </thead>
                                                    <tbody id="content_device"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade display-none" id="profile-activities">
                            <!-- begin timeline -->
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">today</span>
                                        <span class="time">04:20</span>
                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">
                                        <div class="timeline-header">
                                            <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""></span>
                                            <span class="username"><a href="javascript:;">{{Auth::user()->name}}</a> <small></small></span>
                                            <span class="pull-right text-muted">joined Voltea IOT</span>
                                        </div>
                                        <div class="timeline-content">
                                            <h3>Voltea IOT welcomes you !!!</h3><hr>
                                            <p>
                                                Welcome to Voltea IOT!<br/><br/>
                                                We are here to show you what the device is doing.<br/><br/>
                                                If you haven't added any devices yet, please click <a href="">here</a><br/><br/>
                                                Or view your devices in devices tab

                                            </p>
                                        </div>
                                        <!-- <div class="timeline-likes">
                                            <div class="stats-right">
                                            <span class="stats-text">259 Shares</span>
                                            <span class="stats-text">21 Comments</span>
                                            </div>
                                            <div class="stats">
                                            <span class="fa-stack fa-fw stats-icon">
                                            <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                            <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                                            </span>
                                            <span class="fa-stack fa-fw stats-icon">
                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                            <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                            </span>
                                            <span class="stats-total">4.3k</span>
                                            </div>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                                            <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>
                                            <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                        </div>
                                        <div class="timeline-comment-box">
                                            <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar3.png"></div>
                                            <div class="input">
                                            <form action="">
                                                <div class="input-group">
                                                    <input type="text" class="form-control rounded-corner" placeholder="Write a comment...">
                                                    <span class="input-group-btn p-l-10">
                                                    <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
                                                    </span>
                                                </div>
                                            </form>
                                            </div>
                                        </div> -->
                                    </div>
                                    <!-- end timeline-body -->
                                </li>
                            </ul>
                            <!-- end timeline -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="avatar_edit_modal">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change {{Auth::user()->name}}'s Avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_image_upload" class="image-upload" enctype="multipart/form-data" action="api/addUserAvatar" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                             @csrf
                            <img id="preview_avatar" src="/uploads/avatars/{{Auth::user()->avatar != null? Auth::user()->avatar : 'default-avatar.png'}}"style="width:150px; height:150px; float: left; border-radius:50%; margin-right:25px">
                            <input id="input_choose_file" type="file" name="avatar" style="position:absolute; left:170px;top:10px">
                        </div>
                        <div class="col-lg-12">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_upload_avatar">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>

</div>

<!-- might not need later -->
<div class="modal" tabindex="-1" role="dialog" id="profile_edit_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit {{Auth::user()->name}}'s Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="form_profile_info" action="api/updateProfile" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                    <h5 style="text-decoration:underline">Personal Information</h5>
                    <table class="table">
                        <tr><th>Name</th><td>&nbsp;:&nbsp;</td>  <td><input class="form-control" type="text" id="txt_name" value="{{Auth::user()->name}}"></td></tr>
                        <tr><th>Email</th><td>&nbsp;:&nbsp;</td>  <td><input class="form-control" type="email" id="txt_email" value="{{Auth::user()->email}}"></td></tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script type="module" src="{{asset('js/profile.js')}}"></script>
<script type="text/javascript">
    $(window).load(function() {
        // $('#profile-activities').addCSS('display-none');
        // $('#profile-devices').addCSS('display-none');
        $('#info_member_since').text($('#info_member_since').text().split(' ')[0])
        $('#user_name').on('change',function(){
            console.log("changed");
            $('#btn_edit_user_info').attr('disabled', false);
        })

        $(".loader").fadeOut("fast");

        $('#btn_confirm_add_device').on('click', function() {
            var serial = $('#inputSerialNumber').val();
            var device = $('#inputDeviceNumber').val();
            var name = $('#inputDeviceName').val();

            $.ajax({
                method: "POST",
                url: "api/addUserDevice",
                data: { "_token": "{{ csrf_token() }}","serial_number": serial, "device_number": device , "device_name":name}
            })
            .done(function( msg ) {
                console.log(msg)
                switch(msg['message']){
                    case 'Error':
                        Swal.fire({
                            title: 'Error!',
                            text: msg.description,
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                        break;
                    case 'Success':
                        Swal.fire({
                            title: 'Hurray',
                            text: "Device Added! \nDo you want to add another?",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, I have more than one devices!',
                            cancelButtonText: 'No'
                        }).then((result) => {
                            if (!result.isConfirmed) {
                                $('#modal-add-new-device').modal('toggle');
                                location.reload(true);
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
            });
        });
        $('#btn_change_password').on('click', function(){
            Swal.fire({
                    title: "Are you changing your password?",
                    text: "Provide your old password",
                    input: 'password',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        let formData = {
                            // Device Info
                            'old_password' : result.value
                        }
                        $.ajax({
                            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "get",
                            url: "/changeUserPasswordOld",
                            data: formData,
                        })
                        .done(function(response){
                            console.log(response)
                            if(response == "pass"){
                                let new_password_1, new_password_2;
                                if(response == "pass"){
                                    let new_password_1, new_password_2;
                                    Swal.fire({
                                        title: "Change Password",
                                        text: "Provide your new password",
                                        input: 'password',
                                        showCancelButton: true
                                    }).then((result) => {
                                        new_password_1 = result.value;
                                        console.log(new_password_1)
                                        Swal.fire({
                                        title: "Re-type Password",
                                            text: "Provide your new password",
                                            input: 'password',
                                            showCancelButton: true
                                        }).then((result) => {
                                            new_password_2 = result.value;
                                            if(new_password_1===new_password_2){
                                                $.ajax({
                                                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                                                    type: "get",
                                                    url: "/changeNewUserPassword",
                                                    data: {'data':new_password_2},
                                                })
                                                .done(function(response){
                                                    Swal.fire("Success","Password changed successfully!","success")
                                                })
                                            }else{
                                                Swal.fire('Error',"Confirm password doesn't match!",'error')
                                            }
                                        });

                                    });
                                }
                            }else{
                                Swal.fire("Error","Password doesn't match!","error")
                            }
                        });
                    }
                });
        })
    });
</script>
@endsection

