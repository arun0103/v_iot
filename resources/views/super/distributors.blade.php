@extends ('layouts.master')

@section('head')

<style>
    .content-header{
        margin-top:55px;
    }
</style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header" id="app">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Distributors</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Distributors</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" id="add_edit_distributor" hidden>
                <div class="col-lg-12">
                    <form id="form_distributor" class="form-horizontal" autocomplete="nope">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title" id="add_edit_title">Add Distributor</h2>
                                <div class="card-tools"><button type="button" class="btn btn-secondary" id="view_table">View Table</button></div>
                            </div>
                            <div class="card-body">
                                <div class="row roundPadding20" id="addNewDistributor">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputCompanyName" class="control-label">Company Name</label>
                                                    <input type="text" class="form-control" id="inputCompanyName" placeholder="Company Name" name="company_name" autocomplete="no">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="inputCompanyEmail" class="control-label">Company Email</label>
                                                    <input type="email" class="form-control" id="inputCompanyEmail" placeholder="Company Email" name="company_email" autocomplete="no">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="inputCompanyPhone" class="control-label">Phone</label>
                                                    <input type="number" class="form-control" id="inputCompanyPhone" placeholder="Company Phone" name="company_phone" autocomplete="no">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row roundPadding20">
                                            <div class="col-sm-3">
                                                <label for="select_county" class="control-label"> Country</label><br/>
                                                <select class="form-control select2" id="select_country" name="select_country" style="width:100%" required>
                                                    <option selected hidden>-- Select --</option>
                                                </select>
                                                <span id="error_country"></span>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="select_state" class="control-label"> State/District</label><br/>
                                                <select class="form-control select2" id="select_state" name="select_state" style="width:100%" required>
                                                    <option hidden selected>-- Select --</option>
                                                </select>
                                                <span id="error_state"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="input_city" class="control-label">City</label>
                                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i>The city where user lives in</i></b></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="form-control" id="input_city" placeholder="City" name="city" autocomplete="no" required>
                                                    <span id="error_city"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="input_street_address" class="control-label">Street address </label>
                                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i>Name of the street</i></b></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="form-control" id="input_street_address" placeholder="Street address" name="street_address_1" autocomplete="no" required>
                                                    <span id="error_street"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="input_house_address" class="control-label">House address </label>
                                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i>House number, nearby landmarks</i></b></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="form-control" id="input_house_address" placeholder="House address" name="house_address_1" autocomplete="no" required>
                                                    <span id="error_house"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="input_zip_code" class="control-label">Zip Code </label>
                                                    <i id="info_serial" class="fas fa-info-circle f-r-info" data-toggle="dropdown" ></i>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right f-r">
                                                        <a href="#" class="dropdown-item">
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <p class="text-sm"><b><i>Zip Code / Postal Code</i></b></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <input type="text" class="form-control" id="input_zip_code" placeholder="Zip code" name="zip_code" autocomplete="no" required>
                                                    <span id="error_zip"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                                <button type="button" class="btn btn-primary" id="btn_confirm_add_distributor" value="Add">Add</button>
                                <button type="button" class="btn btn-primary" id="btn_edit_save_distributor" value="Save">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="row" id="distributors-table">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 bg-top-logo-color">
                            <h2 class="card-title">List of Distributors</h2>
                            <div class="card-tools">
                                <button type="button" id="btn_add" class="btn btn-primary" >Add New</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-2">
                            <table class="table table-striped table-valign-middle datatable" id="distributorsTable">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th># Resellers</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($distributors as $distributor)
                                    <tr id="{{$distributor['data']->id}}">
                                        <td>{{$distributor['data']->company_name}}
                                            @if($distributor['data']->created_at > today())
                                            <span class="badge bg-danger">NEW</span>
                                            @endif
                                        </td>
                                        <td>{{$distributor['data']->address['house_address']}},{{$distributor['data']->address['street_address']}},{{$distributor['data']->address['city']}}, {{$distributor['data']->address['state']}}, {{$distributor['data']->address['country']}}</td>
                                        <td>{{$distributor['data']->email}}</td>
                                        <td>{{$distributor['data']->phone}}</td>
                                        <td> {{$distributor['reseller_count']}}
                                        </td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item btn-edit-distributor"><i class="fa fa-edit" aria-hidden="true"></i> Edit distributor</a>
                                                <a href="#" class="dropdown-item btn-view-distributor-resellers"><i class="fa fa-eye" aria-hidden="true"></i> View Resellers</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item btn_delete"><i class="fas fa-trash"></i> Delete distributor</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <div class="modal fade" id="modal-view_distributor_device">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-distributor_device_list">Distributor's Reseller List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row roundPadding20">
                        <div class="col-lg-12">
                            <table class="table table-stripped ">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="distributor_device_table_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary" id="btn_confirm_add_distributor_device" value="Add">Add</button> -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->"
    </div>

    <!-- Document Script -->
    <script src="{{asset('js/countries.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datatable').dataTable();
            $('.select2').select2();
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
            for(var i =0; i<countries.length; i++)
                $('#select_country').append('<option id="option_country_'+i+'" value ="'+countries[i].country+'">'+countries[i].country+'</option>');

            $('#select_country').on('change',function(){
                var id = $(this).children(":selected").attr("value");
                var found = countries.filter(function(item) { return item.country === id; });

                $('#select_state').find('option').remove().end()
                        .append('<option>-- Select --</option>')
                for(var i =0;i<found[0]['states'].length;i++)
                    $('#select_state').append('<option value ="'+found[0].states[i]+'">'+found[0].states[i]+'</option>');
                $('#select_state').attr('disabled', false);

            })
        })

        var edit_id;
        // var distributor_table = $('#distributorsTable').DataTable();
        $(function(){
            var d_height = $(document).height();
            var d_width = $(document).width();

            $('.loader').hide();
            // alert(d_width +' X '+d_height)
        })
        $('#btn_confirm_add_distributor').on('click', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Please Wait!',
                html: 'Creating Distributor\'s Profile.',
                didOpen: () => {
                    Swal.showLoading()
                },
                allowOutsideClick: false
            })
            let address = {
                'country': $('#select_country').val(),
                'state': $('#select_state').val(),
                'city': $('#input_city').val(),
                'street_address': $('#input_street_address').val(),
                'house_address': $('#input_house_address').val(),
                'zip_code': $('#input_zip_code').val()
            }
            var  formData = {
                'company_name' : $('#inputCompanyName').val(),
                'email' : $('#inputCompanyEmail').val(),
                'phone' : $('#inputCompanyPhone').val(),
                'address' : address
            }
            //alert(address.city)
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "POST",
                url: "/addNewDistributor",
                data: formData,
            })
            .done(function( msg ) {
                switch(msg['status']){
                    case 'Error':
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something Went wrong! Sorry for trouble',
                        })
                        break;
                    case 201:
                        Swal.fire(
                            'Added!',
                            'Distributor has been added.',
                            'success'
                        );
                        $('#modal-add').hide();
                        location.reload(true);
                        // $.noConflict();
                        // var t = $('#distributorsTable').Datatable();
                        // var address = msg.distributor['city']+ ', '+msg.distributor['state'] +', '+msg.distributor['country'];
                        // t.row.add([msg.distributor['company_name'],msg.distributor['address'],address,msg.distributor['email'],msg.distributor['phone'],msg.distributor_device_count]).draw(false);
                        break;
                    case 500: // Duplicate email found
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Email is already registered in our database',
                        })

                    default:
                        // console.log(msg);

                }
                // console.log( msg );
            });

        })
        $('.btn_delete').on('click',function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var trid = $(this).closest('tr').attr('id'); // table row ID
                    deleteDistributor(trid);
                }
            })
        })

        $('#btn_add').on('click', function(){
            $('#inputCompanyName').val('');
            $('#inputCompanyEmail').val('');
            $('#inputCompanyPhone').val('');
            $('#select_country').val('');
            $('#select_state').val('');
            $('#input_city').val('');
            $('#input_street_address').val('');
            $('#input_house_address').val('');
            $('#input_zip_code').val('');
            $('#add_edit_distributor').attr('hidden',false);
            $('#distributors-table').attr('hidden',true);

            $('#add_edit_title').text('Add Distributor');
            $('#btn_edit_save_distributor').hide();
            $('#btn_confirm_add_distributor').show();

        })
        $('#view_table').on('click', function(){
            $('#add_edit_distributor').attr('hidden',true);
            $('#distributors-table').attr('hidden',false);
            $('#distributors-table').show();
            // console.log("View Table distributor")
        })

        function deleteDistributor(id){
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "delete",
                url: "/deleteDistributor/",
                data: {"id":id},
            })
            .done(function(response){
                switch(response['status']){
                    case 200:
                        Swal.fire(
                            'Deleted!',
                            'Distributor has been deleted.',
                            'success'
                        );
                        $('tr#'+id).remove();
                        break;
                    default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>'
                        })
                }
            })
        }

        $('.btn-edit-distributor').on('click',function(){
            $('.loader').show();
            $('#add_edit_distributor').attr('hidden',false);
            $('#btn_edit_save_distributor').show();
            $('#btn_confirm_add_distributor').hide();
            $('#distributors-table').hide();
            $('#add_edit_title').text('Edit Distributor');

            edit_id = $(this).closest('tr').attr('id'); // table row ID
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/distributor/"+edit_id,
            })
            .done(function(data) {
                //Change all input values to values from database
                $('#inputCompanyName').val(data.company_name);
                $('#inputCompanyEmail').val(data.email);
                $('#inputCompanyPhone').val(data.phone);
                $('#select_country').val(data.address.country).change();
                $('#select_state').val(data.address.state).change();
                $('#input_city').val(data.address.city);
                $('#input_street_address').val(data.address.street_address);
                $('#input_house_address').val(data.address.house_address);
                $('#input_zip_code').val(data.address.zip_code);
            });
            $('.loader').hide();
        })

        $('#btn_edit_save_distributor').on('click', function(){

            var address = {
                'country': $('#select_country').val(),
                'state': $('#select_state').val(),
                'city': $('#input_city').val(),
                'house_address': $('#input_house_address').val(),
                'street_address': $('#input_street_address').val(),
                'zip_code': $('#input_zip_code').val()
            }
            var  formData = {
                'distributor_id' : edit_id,
                'company_name' : $('#inputCompanyName').val(),
                'email' : $('#inputCompanyEmail').val(),
                'phone' : $('#inputCompanyPhone').val(),
                'address' : address
            }

            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "PUT",
                url: "/editDistributor",
                data: formData,
            })
            .done(function( response ) {
                Swal.fire(
                    'Saved!',
                    response.company_name +'\'s details saved',
                    'success'
                );
                $('#add_edit_distributor').hide();
                $('#distributors-table').show();
                $('#'+response.id).find("td:eq(0)").text(response.company_name)
                $('#'+response.id).find("td:eq(1)").text(response.address.house_address+', '+response.address.street_address+', '+response.address.city+', '+response.address.state+', '+response.address.country+', '+response.address.zip_code)
                $('#'+response.id).find("td:eq(2)").text(response.email)
                $('#'+response.id).find("td:eq(3)").text(response.phone)
                //$('#'+response.id).find("td:eq(4)").text(response.devices_count)

            });
        })

        $('.btn-view-distributor-resellers').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            let number_of_resellers = $('#'+trid).find("td:eq(4)").text();
            console.log(number_of_resellers)
            if(number_of_resellers >0){
                $.ajax({
                    headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                    type: "GET",
                    url: "/distributorResellers/"+trid,
                })
                .done(function(data) {
                    // console.log(data)
                    if(data.length == 0){
                        Swal.fire(
                            'Skipped!',
                            'No devices are registered by distributor',
                            'question'
                        )
                    }else{
                        console.log(data);
                        $('#distributor_device_table_body').empty();
                        for(var i=0; i<data.length; i++){
                            let created_date = Date(data[i].created_at)
                            let address = data[i].address.home_address + ", "+data[i].address.street_address +", "+data[i].address.city+", "+data[i].address.state+", "+data[i].address.country
                            $('#distributor_device_table_body').append('<tr><td>'+data[i].company_name+ '</td>'+
                            '<td>'+ data[i].email+'</td>'+
                            '<td>'+data[i].phone + '</td>'+
                            '<td>'+address+'</td>'+
                            '<td>'+ created_date+'</td>'+
                            '<td><i class="fa fa-trash delete_device_from_distributor"></i> Delete</td></tr>'
                            )
                        }
                        $('#modal-view_distributor_device').modal('show');
                    }
                });
            }else{
                Swal.fire("Error","Distributor has no reseller","error")
            }
        })
    </script>

@endsection

