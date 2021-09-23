@extends('layouts.master')

@section('head')

@endsection
@section('content')
    @csrf
    <div id="app">
        <div class="content-header content-header-dashboard">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Security</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <h3 class="card-header">
                                <div class="card-title">Change Password</div>
                            </h3>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>Please change your password to something that you will never forget</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="input_newPassword" class="control-label">New Password</label>
                                            <input type="password" class="form-control" id="input_newPassword" name="input_newPassword" placeholder="Password you desire"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="input_newPassword_confirm" class="control-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="input_newPassword_confirm" name="input_newPassword_confirm" placeholder="Confirm your new password"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id="btn_change_password">Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<script>
    $(document).ready(function(){
        $('.loader').hide();
        $('#btn_change_password').attr('disabled', true);

        $('#input_newPassword_confirm').on('keyup', function(){
            let new_password = $('#input_newPassword').val();
            let confirm_password = $('#input_newPassword_confirm').val();
            console.log(new_password)
            if(new_password == confirm_password){
                $('#btn_change_password').attr('disabled', false);
            }else{
                $('#btn_change_password').attr('disabled', true);
            }
        })
        $('#input_newPassword').on('keyup', function(){
            let new_password = $('#input_newPassword').val();
            let confirm_password = $('#input_newPassword_confirm').val();
            console.log(new_password)
            if(new_password == confirm_password){
                $('#btn_change_password').attr('disabled', false);
            }else{
                $('#btn_change_password').attr('disabled', true);
            }
        })

        $('#btn_change_password').on('click', function(){
            let new_password = $('#input_newPassword').val();
            let confirm_password = $('#input_newPassword_confirm').val();
            if(new_password != ""){
                if(new_password != confirm_password){
                    Swal.fire('Error', "Password doesn't match",'error')
                }
                else{
                    $.ajax({
                        headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                            type: "POST",
                            url: "/changePassword",
                            data: {
                                'password': new_password
                            }
                    })
                    .done(function(response){
                        Swal.fire('Success', "Password changed",'success').then(function(){
                            location.reload();
                        })
                    })
                }
            }else{
                Swal.fire('Error', "Please type password you desire",'error')
            }
        })
    })
</script>

@endsection



