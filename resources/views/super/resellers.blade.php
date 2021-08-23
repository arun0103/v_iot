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
            <h1 class="m-0">Resellers</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Resellers</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" id="add_edit_reseller">
                <div class="col-lg-12">
                    <form id="form_Reseller" class="form-horizontal" autocomplete="nope">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title" id="add_edit_title">Add Reseller</h2>
                                <div class="card-tools"><button type="button" class="btn btn-secondary" id="view_table">View Table</button></div>
                            </div>
                            <div class="card-body">
                                <div class="row roundPadding20" id="addNewReseller">
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
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="countires" class="control-label">Country <span class="flag" id="flag"></span></label>
                                                    <input type="text" class="form-control" id="countries" placeholder="Country" name="countires" autocomplete="no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="state-select" class="control-label">State</label>

                                                    <input type="text" class="form-control" id="state-select" placeholder="State" name="state" autocomplete="no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="city-input" class="control-label">City / Town</label>
                                                    <input type="text" class="form-control" id="city-input" placeholder="City/Town" name="city" autocomplete="no">
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-3">
                                                <div class="form-group">
                                                <label for="selectRole" class="control-label">Role</label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option>-- Select --</option>
                                                        <option value="R">Reseller</option>
                                                        @if(Auth::user()->role == 'S')
                                                            <option value="S">Super Admin</option>
                                                        @endif
                                                        <option value="U">User</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                                <button type="button" class="btn btn-primary" id="btn_confirm_add_reseller" value="Add">Add</button>
                                <button type="button" class="btn btn-primary" id="btn_edit_save_reseller" value="Save">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="row" id="resellers-table">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 bg-top-logo-color">
                            <h2 class="card-title">List of Resellers</h2>
                            <div class="card-tools">
                                <button type="button" id="btn_add" class="btn btn-primary" >Add New</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-2">
                            <table class="table table-striped table-valign-middle datatable" id="resellersTable">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th># Devices</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($resellers as $reseller)
                                    <tr id="{{$reseller['data']->id}}">
                                        <td>{{$reseller['data']->company_name}}
                                            @if($reseller['data']->created_at > today())
                                            <span class="badge bg-danger">NEW</span>
                                            @endif
                                        </td>
                                        <td>{{$reseller['data']->address['city']}}, {{$reseller['data']->address['state']}}, {{$reseller['data']->address['country']}}</td>
                                        <td>{{$reseller['data']->email}}</td>
                                        <td>{{$reseller['data']->phone}}</td>
                                        <td> {{$reseller['device_count']}}
                                        </td>
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <a href="#" class="dropdown-item btn-edit-reseller"><i class="fa fa-edit" aria-hidden="true"></i> Edit Reseller</a>
                                                <a href="#" class="dropdown-item btn-view-reseller-devices"><i class="fa fa-eye" aria-hidden="true"></i> View Devices</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item btn_delete"><i class="fas fa-trash"></i> Delete Reseller</a>
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
        <div class="modal fade" id="modal-view_reseller_device">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-reseller_device_list">Resellers' Device List</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20">
                            <div class="col-lg-12">
                                <table class="table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>PCB Serial #</th>
                                            <th>Device Serial #</th>
                                            <th>Model</th>
                                            <th># Users</th>
                                            <th>Last Data</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reseller_device_table_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary" id="btn_confirm_add_reseller_device" value="Add">Add</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->"
        </div>

    </div>

    <!-- /.content -->

    <!-- <script src="{{asset('js/user.js')}}">  -->
    <!-- <script>
        //Populate countries select on page load
        $(document).ready(function(){
            //Call restful countries country endpoint
            $.get('https://restfulcountries.com/api/v1/countries?fetch_type=slim',function(countries){

                //Loop through returned result and populate countries select
                $.each(countries.data,function(key,value){
                    $('#country-select')
                        .append($("<option></option>")
                            .attr("value", value.name)
                            .text(value.name));
                });
            });
        });

        //Function to fetch states
        function initStates(){
            //Get selected country name
            let country=$("#country-select").val();

            //Remove previous loaded states
            $('#state-select option:gt(0)').remove();
            $('#district-select option:gt(0)').remove();

            //Call restful countries states endpoint
            $.get('https://restfulcountries.com/api/v1/countries/'+country+'/states?fetch_type=slim',function(states){

                //Loop through returned result and populate states select
                $.each(states.data,function(key,value){
                    $('#state-select')
                        .append($("<option></option>")
                            .attr("value", value.name)
                            .text(value.name));
                });
            });
        }
    </script> -->

    <!-- Document Script -->
    <script type="text/javascript">
        var edit_id;
        // var reseller_table = $('#resellersTable').DataTable();
        $(function(){
            $('#add_edit_reseller').hide();
            var d_height = $(document).height();
            var d_width = $(document).width();

            $('.loader').hide();
            // alert(d_width +' X '+d_height)
        })
        $('#btn_confirm_add_reseller').on('click', function(e){
            e.preventDefault();
            var address = {
                'country': $('#countries').val(),
                'state': $('#state-select').val(),
                'city': $('#city-input').val()
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
                url: "/addNewReseller",
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
                            'Reseller has been added.',
                            'success'
                        );
                        $('#modal-add').hide();
                        location.reload(true);
                        // $.noConflict();
                        // var t = $('#resellersTable').Datatable();
                        // var address = msg.reseller['city']+ ', '+msg.reseller['state'] +', '+msg.reseller['country'];
                        // t.row.add([msg.reseller['company_name'],msg.reseller['address'],address,msg.reseller['email'],msg.reseller['phone'],msg.reseller_device_count]).draw(false);
                        break;
                    case 500: // Duplicate email found
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Email is already registered in our database',
                        })

                    default:
                        console.log(msg);

                }
                console.log( msg );
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
                    deleteReseller(trid);
                }
            })
        })

        $('#btn_add').on('click', function(){
            console.log("Add Reseller clicked")
            $('#inputCompanyName').val('');
            $('#inputCompanyEmail').val('');
            $('#inputCompanyPhone').val('');
            $('#countries').val('');
            $('#state-select').val('');
            $('#city-input').val('');
            $('#add_edit_reseller').show();
            $('#resellers-table').hide();

            $('#add_edit_title').text('Add Reseller');
            $('#btn_edit_save_reseller').hide();
            $('#btn_confirm_add_reseller').show();

        })
        $('#view_table').on('click', function(){
            $('#add_edit_reseller').hide();
            $('#resellers-table').show();
            console.log("View Table Reseller")
        })

        function deleteReseller(id){
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "delete",
                url: "/deleteReseller/",
                data: {"id":id},
            })
            .done(function(response){
                switch(response['status']){
                    case 200:
                        Swal.fire(
                            'Deleted!',
                            'Reseller has been deleted.',
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


        $('.btn-edit-reseller').on('click',function(){
            $('.loader').show();
            $('#add_edit_reseller').show();
            $('#btn_edit_save_reseller').show();
            $('#btn_confirm_add_reseller').hide();
            $('#resellers-table').hide();
            $('#add_edit_title').text('Edit Reseller');


            edit_id = $(this).closest('tr').attr('id'); // table row ID
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/reseller/"+edit_id,

            })
            .done(function(data) {
                //Change all input values to values from database
                $('#inputCompanyName').val(data.company_name);
                $('#inputCompanyEmail').val(data.email);
                $('#inputCompanyPhone').val(data.phone);
                $('#countries').val(data.address.country);
                $('#state-select').val(data.address.state);
                $('#city-input').val(data.address.city);
            });
            $('.loader').hide();
        })

        $('#btn_edit_save_reseller').on('click', function(){

            var address = {
                'country': $('#countries').val(),
                'state': $('#state-select').val(),
                'city': $('#city-input').val()
            }
            var  formData = {
                'reseller_id' : edit_id,
                'company_name' : $('#inputCompanyName').val(),
                'email' : $('#inputCompanyEmail').val(),
                'phone' : $('#inputCompanyPhone').val(),
                'address' : address
            }

            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "PUT",
                url: "/editReseller",
                data: formData,
            })
            .done(function( response ) {

                Swal.fire(
                    'Saved!',
                    response.company_name +'\'s details saved',
                    'success'
                );
                $('#add_edit_reseller').hide();
                $('#resellers-table').show();
                $('#'+response.id).find("td:eq(0)").text(response.company_name)
                $('#'+response.id).find("td:eq(1)").text(response.address.city+', '+response.address.state+', '+response.address.country)
                $('#'+response.id).find("td:eq(2)").text(response.email)
                $('#'+response.id).find("td:eq(3)").text(response.phone)
                //$('#'+response.id).find("td:eq(4)").text(response.devices_count)

            });
        })

        $('.btn-view-reseller-devices').on('click', function(){
            var trid = $(this).closest('tr').attr('id'); // table row ID
            $.ajax({
                headers: {'X-CSRF-Token': $('[name="_token"]').val()},
                type: "GET",
                url: "/resellerDevices/"+trid,
            })
            .done(function(data) {
                console.log(data)
                if(data.length == 0){
                    Swal.fire(
                        'Skipped!',
                        'No devices are registered by reseller',
                        'question'
                    )
                }else{
                    $('#reseller_device_table_body').empty();
                    for(var i=0; i<data.length; i++){
                        var device_model = data[i].model == 'U'?"DiUse":'DiEntry';
                        var last_data = data[i].latest_log!= null?data[i].lastest_log.created_at:"-";
                        $('#reseller_device_table_body').append('<tr><td>'+data[i].serial_number+ '</td>'+
                        '<td>'+ data[i].device_number+'</td>'+
                        '<td>'+device_model + '</td>'+
                        '<td>'+data[i].user_devices_count+'</td>'+ // no. of users
                        '<td>'+ last_data+'</td>'+ // last record received on
                        '<td><i class="fa fa-trash delete_device_from_reseller"></i>Delete</td></tr>'
                        )
                    }
                    $('#modal-view_reseller_device').modal('show');
                }
            });
        })
    </script>

@endsection

