

////////////////////////////////////////////////////////////////////////////
///////// AVATAR UPLOAD PREVIEW//////
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#preview_avatar').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#input_choose_file").on('change',function() {
  readURL(this);
});
////////////////////////////////////////////////////////////////////////////

$('#form_image_upload').on('submit',function(e){
    e.preventDefault();

    let form = new FormData(this);
    $.ajax({
        method: "post",
        url: "api/addUserAvatar",
        data: form,
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                console.log(response.imageName)
                this.reset();
                $("#avatar_edit_modal").modal('hide');
                $('#img_avatar_preview').attr('src','../uploads/avatars/'+response.imageName);
                $('#img_profile').attr('src','../uploads/avatars/'+response.imageName);
            //alert('Image has been uploaded successfully');
            }
        },
        error: function(response){
            console.log("error")
            console.log(response);
            $('#image-input-error').text(response.responseJSON.errors.avatar);
        }
    });
});

$('#form_profile_info').on("submit",function(e){
    e.preventDefault();
    let form = new FormData(this);
    console.log(form);
    var data = {
        'name' : $('#txt_name').val(),
        'email' : $('#txt_email').val()
    };
    $.ajax({
        headers: {'X-CSRF-Token': $('form#form_profile_info [name="_token"]').val()},
        type: "POST",
        url: 'api/updateProfile',
        data: data,
    })
    .done(function(response){
        console.log(response);
        $("#profile_edit_modal").modal('hide');
        alert("Data Saved");

    })
    .fail(function(response){
        console.log(response);
        alert("Error");
    });
})

$('#nav_user_devices').on('click',function(e){
    e.preventDefault();
    $.get({
        type: "GET",
        url: 'api/getDevices',
    })
    .done(function(response,status){
        console.log(response.data);
        console.log(status);
        $('#content_device').html('')
        for(var i = 0; i< response.data.length;i++){
            //console.log(device.serial_number)
            if(response.data[i].serial_number != null)
                $('#content_device').append('<tr><td>'+response.data[i]['serial_number']+'</td><td>'+(response.data[i]['device_number']!="null"?response.data[i]['device_number']:"-")+'</td><td>'+response.data[i]['model']+'</td></tr>')
            else
                $('#content_device').append('<tr><td>'+response.data[i].device_details['serial_number']+'</td><td>'+(response.data[i].device_details['device_number']!="null"?response.data[i].device_details['device_number']:"-")+'</td><td>'+response.data[i]['device_name']+'</td></tr>')
        }

    })
    .fail(function(response){
        console.log(response);
        alert("Error");
    });
})

$('#btn_edit_user_info').on('click',function(){

    if($('#btn_edit_user_info').text()=="Edit"){
        var user_name = $('#txt_user_name').text();
        var user_email = $('#txt_user_email').text();
        var user_phone = $('#txt_user_phone').text();
        var user_mobile = $('#txt_user_mobile').text();
        var user_address = $('#txt_user_address').text();
        $('#txt_user_name').html('<input class="form-control" type="text" value="'+user_name+'" id="user_name" placeholder="Your Full Name"/>')
        $('#txt_user_email').html('<input class="form-control" type="email" value="'+user_email+'" id="user_email" placeholder="Your e-mail address"/>')
        $('#txt_user_phone').html('<input class="form-control" type="text" value="'+user_phone+'" id="user_phone" placeholder="Your phone number"/>')
        $('#txt_user_mobile').html('<input class="form-control" type="text" value="'+user_mobile+'" id="user_mobile" placeholder="Your mobile number"/>')
        $('#txt_user_address').html('<input class="form-control" type="text" value="'+user_address+'" id="user_address" placeholder="Your Full Adress"/>')
        $('#btn_edit_user_info').text("Save");
        console.log($('#btn_edit_user_info').text())
        $('#btn_edit_user_info').addClass("btn-success");
    }
    else{
        var user_name = $('#user_name').val();
        var user_email = $('#user_email').val();
        var user_phone = $('#user_phone').val();
        var user_mobile = $('#user_mobile').val();
        var user_address = $('#user_address').val();


        $('#user_name').remove()
        $('#user_email').remove()
        $('#user_phone').remove()
        $('#user_mobile').remove()
        $('#user_address').remove()
        $('#div_user_name').html('<span id="txt_user_name">'+user_name+'</span> ')
        $('#div_user_email').html('<span id="txt_user_email">'+user_email+'</span> ')
        $('#div_user_phone').html('<span id="txt_user_phone">'+user_phone+'</span> ')
        $('#div_user_mobile').html('<span id="txt_user_mobile">'+user_mobile+'</span> ')
        $('#div_user_address').html('<span id="txt_user_address">'+user_address+'</span> ')
        $('#btn_edit_user_info').text("Edit");
        $('#btn_edit_user_info').removeClass("btn-success");
    }
})





