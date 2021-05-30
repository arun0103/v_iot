@extends('layouts.master')

@section('content')
<div class="container" id='app'>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                        <h1 class="card-title">{{Auth::user()->name}}'s Profile</h1>
                        <div class="card-tools">
                        <span style="float:right; position:absolute; top:10px;right:10px">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_edit_modal">Edit</button>
                        </span>
                        </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 center">
                            <img id="img_avatar_preview" src="/uploads/avatars/{{Auth::user()->avatar != null? Auth::user()->avatar : 'default-avatar.png'}}"style="width:150px; height:150px;  border-radius:20%; margin-right:25px">
                            <button id="btn_change_avatar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#avatar_edit_modal" style="position:absolute; left:55px;bottom:-15px;">Change</button>
                        </div>

                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-4 col-sm-12 ">
                            <h5 style="text-decoration:underline">Personal Information</h5>
                            <table>
                                <tr><th>Name</th><td>&nbsp;:&nbsp;</td>  <td>{{Auth::user()->name}}</td></tr>
                                <tr><th>Email</th><td>&nbsp;:&nbsp;</td>  <td>{{Auth::user()->email}}</td></tr>
                                <tr><th>Mobile</th><td>&nbsp;:&nbsp;</td>  <td>{{'9841973742'}}</td></tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-4 center" id="membership_info">
                            <span><b>Member Since  <i id="info_member_since">01/01/2021</i></b></span>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <user_profile></user_profile> -->
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="module" src="{{asset('js/profile.js')}}"></script>
@endsection

