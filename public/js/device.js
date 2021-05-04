function populateUser(type){
    $.ajax({
        url: "{{ route('') }}",
        type:'POST',
        data: {_token:_token, email:email, pswd:pswd,address:address},
        success: function(data) {
          printMsg(data);
        }
    });
}
