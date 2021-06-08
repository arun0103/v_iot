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
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#select_user_id').select2({
        placeholder: 'Select an option',
        width: 'resolve',
        theme: "classic"
      });

    // $('.selectpicker').selectpicker({
    //     style: 'btn-info',
    //     size: 4
    //   });

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
    $.ajax({
        headers: {'X-CSRF-Token': $('form#form_assign_user [name="_token"]').val()},
        url: "/assignUserDevice",
        type:'POST',
        data:{'user_id': $('#select_user').val(), 'serial_number': $('#inputSN_verify').val()},
    }).done(function(data){
        console.log(data)
        switch(data['message']){
            case "added":
                Swal.fire(
                    'Added!',
                    'Device is assigned to user',
                    'success'
                );
                $('#modal-assign-user').hide();
                $('#'+data.data.id).find("td:eq(3)").text(parseInt($('#'+data.id).find("td:eq(3)").text())+1)
                break;
            default:
                Swal.fire(
                    'Sorry!',
                    data['message'],
                    'error'
                );
        }
    })
});


// Assign User Device
$('#select_user_type').on('change', function(){
    switch($('#select_user_type').val()){
        case "U":
            $('#select_user option.R').css('display','none');
            $('#select_user option.S').css('display','none');
            $('#select_user option.U').css('display','block');
            break;
        case "R":
            $('#select_user option.R').css('display','block');
            $('#select_user option.S').css('display','none');
            $('#select_user option.U').css('display','none');
            break;
    }
})
