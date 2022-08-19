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
                            <h6 class="fs-17 fw-semi-bold mb-0">Assign Product List</h6>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New</a>
                        </div>
                    </div>
                </div>

                @include('product::modal.__assign_modal')

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="assignList" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Product Name</th>
                                    <th>Client</th>
                                    <th>Fieldstaff</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            {{--  --}}

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('#assignList').DataTable().draw();
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
            $('#category_name').val();
            $('#id').val();
            $('.modal-title').text('Assign New Product');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');
        });


        $('#assignList').on('click', '#actionDelete', function(e) {
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
                        $('#assignList').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });


        $('#assignList').on('click', '#editAction', function(e) {
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

                    $('#product_weight').val(res.data.product_weight);
                    $('#product_name').val(res.data.product_name);

                    $('#id').val(res.data.id);

                    $("#ajaxForm").attr("action", action_url);
                    $('.modal-title').text('Update Information');
                    $('.actionBtn').text('Update');
                    $('#myModal').modal('show');
                },
                error: function() {
                }
            });
        });


        var productlist = $('#assignList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('assignProducList')}}",
                data : function(d) {
                    d.client_id = $('#client_ids').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'product_image', name: 'image' },
                { data: 'product_name', name: 'product_name' },
                { data: 'client_name', name: 'channel_name' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' }
            ]

            });

            $(".go").click(function(){
            productlist.draw();
            });



    });



    $('body').on('change', '#client_id', function(e) {

    var client_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{route('getProductList')}}",
            data: {"_token": "{{ csrf_token() }}","client_id":client_id},
            dataType: 'JSON',
            success: function(res) {
                console.log(res.message);
                $('#productslist').html(res.message);
            },
            error: function() {
            }
        });
    });

</script>


@endsection
@push('js')
{{-- <script src="{{ asset('vendor/Outlet/assets/js/outlet.js') }}"></script> --}}
@endpush
