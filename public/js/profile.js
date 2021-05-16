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

$('#btn_upload_avatar').on('click',function(e){
    e.preventDefault();
    console.log('Hi from upload')
    var form = $('#form_image_upload');

    console.log(form)
    $.ajax({
        method: "post",
        url: "api/addUserAvatar",
        headers: {'X-CSRF-Token': $('form.image-upload [name="_token"]').val()},
        data: form.serialize(),
        })
        .done(function( msg ) {
            switch(msg['message']){
                case 'Error':
                    alert('Device Not Found In Database. Please Call Voltea Office');
                    break;
                case 'Success':
                    alert('Device Added');
                    break;
                default:
                    console.log(msg);

            }
            console.log( msg );
    });
});
