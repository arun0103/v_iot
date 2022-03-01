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
                            <div class="card-title">HEADQUARTERS</div>
                        </h4>
                        <div class="card-body row">
                            <div class="col-5 text-center d-flex align-items-center justify-content-center">
                                <div class="">
                                    <h2>Voltea <strong>Inc</strong></h2>
                                    <p class="lead mb-5">
                                        1920 Hutton Court #300<br>
                                        Farmers Branch, TX 75234<br>
                                        +1 (469) 620-0133
                                    </p>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="inputSubject">Subject</label>
                                    <input type="text" id="inputSubject" class="form-control">
                                    <span id="error_subject"></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Message</label>
                                    <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                                    <span id="error_message"></span>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary" id="btn_send_message" value="Send message">
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
    $('#btn_send_message').on('click', function(){
       // validate inputs
       let subject = $('#inputSubject').val()
       let message = $('#inputMessage').val()
       let validated = true

       if(subject == ""){
            validated = false;
            $('#error_subject').text("Please enter the subject!").css('color','red')
       }else{
        $('#error_subject').text("")
       }
       if(message ==""){
           validated = false;
           $('#error_message').text("Please enter the message!").css('color','red')
       }else{
        $('#error_message').text("")
       }

       if(validated){
           console.log("Sending emails")
           $('#btn_send_message').attr('disabled',true)
           Swal.fire({
                title: 'Sending emails',
                html: '<b>Please Wait!</b>',
                // timer: 2000,
                timerProgressBar: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            })
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
                if(response.message == "sent")
                    Swal.fire("Success","Thank you for contacting","success")
                else
                    Swal.fire('Error',"Unable to contact",'error')
            })
       }
    })
</script>
@endsection

