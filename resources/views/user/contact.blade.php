@extends ('layouts.master')

@section('head')

@endsection

@section('content')
<div class="content-header" id="app_user_devices">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Contact</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Contact</a></li>
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
                            <div class="card-title">RESELLER</div>
                        </h4>
                        <div class="card-body row">
                            <div class="col-lg-5 col-sm-12 text-center d-flex align-items-center justify-content-center">
                                <div class="">
                                    <h2><strong>{{$reseller->company_name}}</strong></h2>
                                    <p class="lead mb-5">
                                        {{$reseller->address['city']}}<br>
                                        {{$reseller->address['state']}},{{$reseller->address['country']}}<br>
                                        {{$reseller->phone}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12">
                                <div class="form-group">
                                    <label for="inputSubject_reseller">Subject</label>
                                    <input type="text" id="inputSubject_reseller" class="form-control">
                                    <span id="error_subject_reseller"></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage_reseller">Message</label>
                                    <textarea id="inputMessage_reseller" class="form-control" rows="4"></textarea>
                                    <span id="error_message_reseller"></span>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary" id="btn_send_message_reseller" value="Send message">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h4 class="card-header">
                            <div class="card-title">HEADQUARTERS</div>
                        </h4>
                        <div class="card-body row">
                            <div class="col-lg-5 col-sm-12 text-center d-flex align-items-center justify-content-center">
                                <div class="">
                                    <h2>Voltea <strong>Inc</strong></h2>
                                    <p class="lead mb-5">
                                        1920 Hutton Court #300<br>
                                        Farmers Branch, TX 75234<br>
                                        +1 (469) 620-0133
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12">
                                <div class="form-group">
                                    <label for="inputSubject_super">Subject</label>
                                    <input type="text" id="inputSubject_super" class="form-control">
                                    <span id="error_subject_super"></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage_super">Message</label>
                                    <textarea id="inputMessage_super" class="form-control" rows="4"></textarea>
                                    <span id="error_message_super"></span>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary" id="btn_send_message_super" value="Send message">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.loader').hide()
    })
    $('#btn_send_message_super').on('click', function(){
       // validate inputs
       let subject = $('#inputSubject_super').val()
       let message = $('#inputMessage_super').val()
       let validated = true

       if(subject == ""){
            validated = false;
            $('#error_subject_super').text("Please enter the subject!").css('color','red')
       }else{
        $('#error_subject_super').text("")
       }
       if(message ==""){
           validated = false;
           $('#error_message_super').text("Please enter the message!").css('color','red')
       }else{
        $('#error_message_super').text("")
       }

       if(validated){
            let formData = {
                'subject' : subject,
                'message' : message,
                '_token': '{{ csrf_token() }}'
            }
            $.ajax({
                type: "POST",
                url: "/sendQueryToSuperAdmins",
                data: formData
            })
            .done(function(response){
                console.log(response);
            })
       }
    })
    $('#btn_send_message_reseller').on('click', function(){
       // validate inputs
       let subject = $('#inputSubject_reseller').val()
       let message = $('#inputMessage_reseller').val()
       let validated = true

       if(subject == ""){
            validated = false;
            $('#error_subject_reseller').text("Please enter the subject!").css('color','red')
       }else{
        $('#error_subject_reseller').text("")
       }
       if(message ==""){
           validated = false;
           $('#error_message_reseller').text("Please enter the message!").css('color','red')
       }else{
        $('#error_message_reseller').text("")
       }

       if(validated){
        let formData = {
                'subject' : subject,
                'message' : message,
                '_token': '{{ csrf_token() }}'
            }
            $.ajax({
                type: "POST",
                url: "/sendQueryToResellers",
                data: formData
            })
            .done(function(response){
                console.log(response);
            })
       }
    })
</script>
@endsection

