jQuery(document).ready(function($){

});

////////////////////////////////////////////////////////////////////////////
///////// AVATAR UPLOAD //////
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#preview_avatar').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#input_choose_file").change(function() {
  readURL(this);
});
////////////////////////////////////////////////////////////////////////////