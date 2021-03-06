var profession, institution;

$('#btn_edit_user_profile').on('click',function(){
    if($('#btn_edit_user_profile').text()=='Edit'){
        $('#info_member_since_edit').removeAttr('hidden');
        // $('#info_member_since_edit').text('You cannot go back to future!')
        $('#btn_change_avatar').removeAttr('hidden');
        $('#btn_cancel_edit_user_profile').removeAttr('hidden');
        $('#btn_edit_user_profile').text('Save');
        $('#btn_edit_user_profile').addClass('btn-success');

        profession = $('#user_profile_profession').text()!="Not Defined"?$('#user_profile_profession').text():"";
        institution = $('#user_profile_institution').text()!="Not Defined"?$('#user_profile_institution').text():"";

        $('#user_profile_profession').html('<input type="text" class="form-control form-control-sm col-md-4" id="input_user_profession" value="'+profession+'"><p class="edit_info" >Let us know your profession!</p>')
        $('#user_profile_institution').html('<input type="text" class="form-control form-control-sm col-md-4" id="input_user_institution" value="'+institution+'"><p class="edit_info" >In which company do you work?</p>')

    }
    else{ //Save button clicked
        // get new data
        profession = $('#input_user_profession').val();
        institution = $('#input_user_institution').val();
        // Perform databse operation and rename edit button
        $.ajax({
            headers: {'X-CSRF-Token': $('[name="_token"]').val()},
            url: "api/updateProfileDetails",
            type:'POST',
            data:{'profession': profession, 'institution': institution},

        }).done(function(response){
            console.log(response)
        })

        //change button text
        $('#btn_edit_user_profile').text('Edit');
        // remove inputs
        $('#input_user_profession').remove();
        $('#input_user_institution').remove();
        // hide buttons and edit informations
        $('#btn_cancel_edit_user_profile').attr('hidden','hidden')
        $('#info_member_since_edit').attr('hidden','hidden')
        $('.edit_info').attr('hidden','hidden')
        // replace data to view
        $('#user_profile_profession').html('<span id="txt_user_name">'+profession+'</span> ')
        $('#user_profile_institution').html('<span id="txt_user_name">'+institution+'</span> ')
    }
});

$('#btn_cancel_edit_user_profile').on('click',function(){
    //hide buttons
    $('#btn_change_avatar').attr('hidden','hidden')
    $('#btn_cancel_edit_user_profile').attr('hidden','hidden')
    // hide edit informations
    $('#info_member_since_edit').attr('hidden','hidden')
    $('.edit_info').attr('hidden','hidden')

    $('#btn_edit_user_profile').text('Edit');
    $('#btn_edit_user_profile').removeClass('btn-success');

    $('#input_user_profession').remove();
    $('#input_user_institution').remove();

    $('#user_profile_profession').html('<span id="txt_user_name">'+profession+'</span> ')
    $('#user_profile_institution').html('<span id="txt_user_name">'+institution+'</span> ')

});

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
var user_name,user_email,user_phone,user_mobile,user_address;
$('#btn_edit_user_info').on('click',function(){

    if($('#btn_edit_user_info').text()=="Edit"){
        $('#btn_cancel_edit_user_personal').removeAttr('hidden')
        user_name = $('#txt_user_name').text();
        user_email = $('#txt_user_email').text();
        user_phone = $('#txt_user_phone').text();
        user_mobile = $('#txt_user_mobile').text();
        user_address = $('#txt_user_address').text();

        $('#txt_user_name').html('<input class="form-control" type="text" value="'+user_name+'" id="user_name" placeholder="Your Full Name"/>')
        $('#txt_user_email').html('<input class="form-control" type="email" value="'+user_email+'" id="user_email" placeholder="Your e-mail address"/>')
        $('#txt_user_phone').html('<input class="form-control" type="text" value="'+user_phone+'" id="user_phone" placeholder="Your phone number"/>')
        $('#txt_user_mobile').html('<input class="form-control" type="text" value="'+user_mobile+'" id="user_mobile" placeholder="Your mobile number"/>')
        $('#txt_user_address').html('<input class="form-control" type="text" value="'+user_address+'" id="user_address" placeholder="Your Full Adress"/>')
        $('#btn_edit_user_info').text("Save");
        // $('#btn_edit_user_info').attr('disabled', true);
        console.log($('#btn_edit_user_info').text())
        $('#btn_edit_user_info').addClass("btn-success");
    }
    else{//Save changes
        //Check for the changes
        var changed = [];
        if(user_name != $('#user_name').val()){
            console.log(user_name);
            changed.push({"name":user_name});
            $('#btn_edit_user_info').attr('disabled', false);
        }if(user_email != $('#user_email').val()){
            changed.push({"email":user_email});
            $('#btn_edit_user_info').attr('disabled', false);
        }if(user_phone != $('#user_phone').val()){
            changed.push({"phone":user_phone});
            $('#btn_edit_user_info').attr('disabled', false);
        }if(user_mobile != $('#user_mobile').val()){
            changed.push({"mobile":user_mobile});
            $('#btn_edit_user_info').attr('disabled', false);
        }if(user_address != $('#user_address').val()){
            changed.push({"address":user_address});
            $('#btn_edit_user_info').attr('disabled', false);
        }
        user_phone = $('#user_phone').val();
        user_email = $('#user_email').val();
        user_name = $('#user_name').val();
        user_mobile = $('#user_mobile').val();
        user_address = $('#user_address').val();
        console.log(changed.length + " changes found");
        console.log(changed)
        var data = {
            'name':user_name,
            'email':user_email,
            'phone':user_phone,
            'mobile':user_mobile ,
            'address':user_address ,
        };

        if(changed.length >0){

            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                url: "api/updateProfilePersonalDetails",
                type:'POST',
                data: data,

            }).done(function(response){
                console.log(response)
            })
        }

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
$('#btn_cancel_edit_user_personal').on('click', function(){
    $('#btn_edit_user_info').text("Edit");
    $('#btn_cancel_edit_user_personal').attr('hidden',true)
    $('#btn_edit_user_info').removeClass('btn-success');

    $('#div_user_name').html('<span id="txt_user_name">'+user_name+'</span> ')
    $('#div_user_email').html('<span id="txt_user_email">'+user_email+'</span> ')
    $('#div_user_phone').html('<span id="txt_user_phone">'+user_phone+'</span> ')
    $('#div_user_mobile').html('<span id="txt_user_mobile">'+user_mobile+'</span> ')
    $('#div_user_address').html('<span id="txt_user_address">'+user_address+'</span> ')

})







