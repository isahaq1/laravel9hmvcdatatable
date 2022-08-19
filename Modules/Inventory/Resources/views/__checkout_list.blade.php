@extends('layouts.backend')
@push('css')
@endpush

@section('content')
  
<div class="body-content">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Checkout List</h6>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New Cheekout</a>
                        </div>
                    </div>
                </div>

                @include('inventory::modal.__checkout')

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table checkouList">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Client name</th>
                                    <th>User Name</th>
                                    <th>Store Name</th>
                                    <th>Checkout Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->




<script>

var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('.checkouList').DataTable().draw();
        //$("#assignList").load(" #assignList > *");
    }




    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.addShowModal').on('click', function() {

            $('#client_id').val();
            $('#id').val();
            $('#user_id').val();
            $('#checkout_note').val();

            $('.modal-title').text('Create New Checkout');
            $('.actionBtn').text('Checkout');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');

        });


        $('.checkouList').on('click', '#viewAction', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr('data-view-route');

            $.ajax({

                type: 'GET',
                url: submit_url,
                data: {"_token": "{{ csrf_token() }}"},
                dataType: 'JSON',
                success: function(res) {

                    if(res.data.is_confirm=='1'){
                        $('#approve').hide();
                    }

                    $('#username').text(res.data.name);
                    $('#clientname').text(res.data.client_name);
                    $('#checkoutdate').text(res.data.created_at);
                    $('#checkoutnote').text(res.data.checkout_note);

                    $('#detailspreview').html(res.details);
                    $('#id').val(res.data.id);

                    $('.modal-title').text('View Information');
                    $('#previewAction').modal('show');

                },

                error: function() {
                }

            });
        });



        $('.checkouList').on('click', '#editAction', function(e) {

            e.preventDefault();
            var submit_url = $(this).attr('data-edit-route');
            var action_url = $(this).attr('data-update-route');
            $('#acmethod').val('PUT');

            $.ajax({

                type: 'GET',
                url: submit_url,
                data: {"_token": "{{ csrf_token() }}"},
                dataType: 'JSON',
                success: function(res) {

                    $('#foredit').val(1);
                    $('#id').val(res.data.id);
                    $('#acmethod').val('PUT');
                    $('#client_id').val(res.data.client_id).trigger('change');
                    $('#store_id').val(res.data.store_id).trigger('change');
                    $('#user_id').val(res.data.user_id).trigger('change');
                    $('#checkout_note').val(res.data.checkout_note);

                    if(res.data.status==='1'){
                        $('#approve').hide();
                    }
                    $('#productlist').html(res.details);

                    $("#ajaxForm").attr("action", action_url);
                    $('.modal-title').text('Update Information');
                    $('.actionBtn').text('Update');
                    $('#myModal').modal('show');
                    $('#foredit').val(0);


                },

                error: function() {
                }

            });
        });


        
        $('.checkouList').on('click', '#actionDelete', function(e) {
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
                        $('.checkouList').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });



        var reciveList = $('.checkouList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('get-checkout-list')}}",
                data : function(d) {
                    d.client_id = $('#client_ids').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'client_name', name: 'client_name' },
                { data: 'store_name', name: 'store_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ]

        });

        $(".go").click(function(){
            reciveList.draw();
        });

    });

        
    $('body').on('change', '#client_id', function(e) {

        var foredit = $('#foredit').val();

        if(foredit==0){

            var user_id = $('#user_id').val();
            var client_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{route('getUserProductList')}}",
                data: {"_token": "{{ csrf_token() }}","client_id":client_id,'user_id':user_id},
                dataType: 'JSON',
                success: function(res) {
                    console.log(res.message);
                    $('#productlist').html(res.message);
                },
                error: function() {
                }
            });
        }
    });


    function checkCaseStock(id){
        var caseStock = parseInt($('#caseStock_'+id).parent().prev().prev().children().val());
        var check = parseInt($('#caseStock_'+id).val());
        if(check>caseStock){
            alert('You cannot checkout more then stock qty ');
            $('#caseStock_'+id).val(caseStock);
        }
    }


    function checkUnitStock(id){
        var unitStock = parseInt($('#uniteStock_'+id).parent().prev().prev().children().val());
        var check = parseInt($('#uniteStock_'+id).val());
        if(check>unitStock){
            alert('You cannot checkout more then stock qty ');
            $('#uniteStock_'+id).val(unitStock);
        }   
    }


</script>



@endsection

@push('js')
@endpush
