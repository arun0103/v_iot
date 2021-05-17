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
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
$('#btn_confirm_add_device').on('click', function(e){
    e.preventDefault();
    var formData = {
        'name':$('#inputName').val(),
        'serial_number':$('#inputSN').val(),
        'device_number':$('#inputDN').val(),
        'reseller_id':$('#select_reseller_id').val(),
        'manufactured_date':$('#inputManufacturedDate').val(),
        'installation_date':$('#inputInstallationDate').val(),
        'warranty':$('#is_under_warranty').val(),
    }
    $.ajax({
        method: "post",
        url: "/addNewDevice",
        data: formData,
        })
        .done(function( msg ) {
            switch(msg['message']){
                case 'Error':
                    alert('Sorry unable to add device');
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
$('#btn_confirm_assign_user').on('click',function(e){
    e.preventDefault();
    $.ajaxSetup({

    });
    $.ajax({
        headers: {'X-CSRF-Token': $('form#form_assign_user [name="_token"]').val()},
        url: "/assignUserDevice",
        type:'POST',
        data:{'user_id': $('#select_user').val(), 'serial_number': $('#inputSN_verify').val()},
        success: function(data){
            console.log(data);
        }

    })
});
