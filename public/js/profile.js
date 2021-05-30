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

