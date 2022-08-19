@extends('layouts.backend')
@push('css')
@endpush

@section('content')
    <!--/.Content Header (Page header)--> 
    <div class="body-content">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 fw-semi-bold mb-0">{{$ptitle}}</h6>
                            </div>
                            <div class="text-end">
                                <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New</a>
                            </div>
                        </div>
                    </div>
                    @include('fieldstaff::modal.__staff_modal')
                   
                    <div class="card-body">
                       
                        <div class="table-responsive">
                            <table id="userList" class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Status Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div><!--/.body content-->

  


    <script type="text/javascript">
        // delete items
      
        var showCallBackData = function() {
            $('#id').val('');
            $('.ajaxForm')[0].reset();
            $('#myModal').modal('hide');
            $('#userList').DataTable().draw();
            //$("#userList").load(" #userList > *");
        }
      
        $(document).ready(function() {
            "use strict";
      
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            
            $('.addShowModal').on('click', function() {

                $('#firstname').val('');
                $('#lastname').val('');
                $('#middlename').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#address').val('');
                $('#password').val('');
                $('#acmethod').val('');

                $('.modal-title').text('Add New Fieldstaff');
                $('.actionBtn').text('Add');
                $('.ajaxForm').removeClass('was-validated');
                $('#myModal').modal('show');
            });
    
    
            $('#userList').on('click', '#deleteAction', function(e) {
                e.preventDefault();

                $('#ajaxForm').removeClass('was-validated');
                var submit_url = $(this).attr('data-route');
                var check = confirm('Are you sure');
                if (check == true) {
                    $.ajax({
                        type: 'DELETE',
                        url: submit_url,
                        data: {"_token": "{{ csrf_token() }}"},
                        dataType: 'json',
                        success: function(response) {
                            if(response.success==true) {
                                toastr.success(response.message, response.title);
                            }else if(response.success=='exist'){
                                toastr.warning(response.message, response.title);
                            }else{
                                toastr.error(response.message, response.title);
                            }
                            $('#userList').DataTable().draw();
                        },
                        error: function() {
                        }
                    });
                }
            });


            $('#userList').on('click', '#statusChange', function(e) {
                e.preventDefault();

                $('#ajaxForm').removeClass('was-validated');
                var submit_url = $(this).attr('data-status-route');
                var check = confirm('Are you sure change the status');
                if (check == true) {
                    $.ajax({
                        type: 'Post',
                        url: submit_url,
                        data: {"_token": "{{ csrf_token() }}"},
                        dataType: 'json',
                        success: function(response) {
                            if(response.success==true) {
                                toastr.success(response.message, response.title);
                            }else if(response.success=='exist'){
                                toastr.warning(response.message, response.title);
                            }else{
                                toastr.error(response.message, response.title);
                            }
                            $('#userList').DataTable().draw();
                        },
                        error: function() {
                        }
                    });
                }
            });




            $('#userList').on('click', '#editAction', function(e) {

                e.preventDefault();
                var submit_url = $(this).attr('data-edit-route');
                var action_url = $(this).attr('data-update-route');

                $.ajax({
                    type: 'GET',
                    url: submit_url,
                    data: {"_token": "{{ csrf_token() }}"},
                    dataType: 'JSON',
                    success: function(res) {


                        $("#acmethod").val('PUT');
                        $('#firstname').val(res.employee.firstname);
                        $('#lastname').val(res.employee.lastname);
                        $('#middlename').val(res.employee.middlename);
                        $('#phone').val(res.employee.phone);
                        $('#image').val(res.employee.image_image);
                        $('#address').val(res.employee.address);
                        $('#id').val(res.employee.id);
                        $('#email').val(res.employee.email);
                        $('#user_id').val(res.employee.user_id);
                        $('#user_type').val(res.user.user_type).trigger('change');
                        $('#team_id').val(res.employee.team_id).trigger('change');

                        $('#lassra').val(res.employee.lassra);
                        $('#nin').val(res.employee.nin);
                        $('#bvn').val(res.employee.bvn);

                        $('#lga').val(res.employee.lga).trigger('change');
                        $('#education').val(res.employee.education).trigger('change');
                        $('#state_id').val(res.employee.state_id).trigger('change');
                        $('#country_id').val(res.employee.country_id).trigger('change');
                        $('#gender').val(res.employee.gender).trigger('change');

                        $('#lga').val(res.employee.lga).trigger('change');
                        $('#education').val(res.employee.education).trigger('change');
                        


                        $('#bank_id').val(res.account.bank_id).trigger('change');
                        $('#account_name').val(res.account.account_name);
                        $('#account_number').val(res.account.account_number);

                        $('#guarantor_name').val(res.guarantor.guarantor_name);
                        $('#guarantor_email').val(res.guarantor.guarantor_email);
                        $('#guarantor_phone').val(res.guarantor.guarantor_phone);
                        $('#guarantor_id_type').val(res.guarantor.guarantor_id_type).trigger('change');
                        $('#guarantor_id_old').val(res.guarantor.guarantor_id);
    
                        $("#ajaxForm").attr("action", action_url);
                        $('.modal-title').text('Update Information');
                        $('.actionBtn').text('Update');
                        $('#myModal').modal('show');

                    },

                    error:function (response) {
                        console.log(response);
                    }
                });
            });




            var userList = $('#userList').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{route('getFieldstaffList')}}",
                    data : function(d) {
                        d.client_id = $('#client_ids').val();
                        d._token= "{{ csrf_token() }}";
                    },
                },
                columns: [
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'address', name: 'address' },
                    { data: 'status', name: 'status' },
                    { data: 'changesatatus', name: 'changesatatus' },
                    { data: 'action', name: 'action' }
                ]

            });

            $(".go").click(function(){
                userList.draw();
            });



      
        });
      
      
      </script>




    @endsection

    @push('js')
    @endpush
