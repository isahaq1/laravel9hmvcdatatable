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
                            <h6 class="fs-17 fw-semi-bold mb-0">Pos Item List</h6>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Pos item</th>
                                    <th>Post item Weight</th>
                                    <th>Client</th>
                                    <th>Brand</th>
                                    <th>Outlet type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($products as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->product_weight}}</td>
                                    <td>{{$item->client_name}}</td>
                                    <td>{{$item->brand_name}}</td>
                                    <td>{{$item->type_name}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-success-soft btn-sm me-1" id="editAction" data-update-route="{{ route('posms-item.update',$item->id) }}" data-edit-route="{{ route('posms-item.edit',$item->id) }}"  ><i class="far fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger-soft btn-sm" id="deleteAction" data-route="{{ route('posms-item.destroy',$item->id) }}"><i class="far fa-trash-alt"></i></a>
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

</div>

@include('product::modal.__posms_product')




<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        //$('#example').DataTable().ajax.reload(null, false);
        $("#example").load(" #example > *");
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
            $('.modal-title').text('Add New Product');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');
        });


        $('#example').on('click', '#deleteAction', function(e) {
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
                        $("#example").load(" #example > *");
                    },
                    error: function() {
                    }
                });
            }
        });


        $('#example').on('click', '#editAction', function(e) {
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



    });

</script>


@endsection
@push('js')
{{-- <script src="{{ asset('vendor/Outlet/assets/js/outlet.js') }}"></script> --}}
@endpush
