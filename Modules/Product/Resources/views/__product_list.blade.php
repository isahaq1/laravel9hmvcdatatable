@extends('layouts.backend')
@push('css')
@endpush

@section('content')

<div class="body-content">
    <div class="row">
        <div class="col-12 pe-3">
            <div class="accordion accordion-flush px-0 mb-2" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex justify-content-end mb-3" id="flush-headingOne">
                        <button type="button" class="fs-17 filter-bt" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"><img  class="me-2 h-24" src="assets/dist/img/icons8-filter-30.png" alt="">Filter</button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse bg-white px-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="row">

                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-bold ">Client </label>
                                <div class="col-xl-9 col-xxl-10">
                                    {!! Form::select('client_ids', $client, '', ['id'=>'client_ids','class' => 'placeholder-single','required'])!!}
                                </div>
                            </div>


                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-bold ">Brand </label>
                                <div class="col-xl-9 col-xxl-10">
                                    {!! Form::select('brand_ids', $brand, '', ['id'=>'brand_ids','class' => 'placeholder-single','required'])!!}
                                </div>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-bold ">Category </label>
                                <div class="col-xl-9 col-xxl-10">
                                    {!! Form::select('category_ids', $category, '', ['id'=>'category_ids','class' => 'placeholder-single','required'])!!}
                                </div>
                            </div>


                            <div class="col-3 mb-3 align-items-end d-flex">
                                <button class="btn btn-success me-2 go">Go</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Product List</h6>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)" class="btn btn-primary w-auto me-2 addShowModal "> Add Product</a>
                            {{-- <a href="javascript:void(0)" class="btn btn-primary w-auto me-2"> Export all</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="table-responsive"> --}}
                        <table id="productList" class="table display table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Short Code</th>
                                    <th>Client Name</th>
                                    <th>Brand Name</th>
                                    <th>Category name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>

@include('product::modal.__product_modal')



<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('#productList').DataTable().draw();
        // $("#productList").load(" #productList > *");
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


        $('#productList').on('click', '#editAction', function(e) {
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

                    $('#category_id').val(res.data.category_id).trigger('change');
                    $('#brand_id').val(res.data.brand_id).trigger('change');
                    $('#client_id').val(res.data.client_id).trigger('change');
                    $('#product_name').val(res.data.product_name);
                    $('#product_short_code').val(res.data.product_short_code);
                    $('#product_description').val(res.data.product_description);
                    $('#rec_retail_price').val(res.data.rec_retail_price);

                    $('#unit_per_case').val(res.data.unit_per_case);
                    $('#unit_price').val(res.data.unit_price);
                    $('#sales_price').val(res.data.sales_price);
                    $('#case_discount').val(res.data.case_discount);
                    $('#reorder_level_qty').val(res.data.reorder_level_qty);
                    $('#mst_qty').val(res.data.mst_qty);
                    $('#outlet_type_id').val(res.data.outlet_type_id);

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


        $('#productList').on('click', '#deleteAction', function(e) {
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
                        $("#productList").load(" #productList > *");
                    },
                    error: function() {
                    }
                });
            }
        });


        var productlist = $('#productList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('productListAjax')}}",
                data : function(d) {
                    d.client_id = $('#client_ids').val();
                    d.brand_id = $('#brand_ids').val();
                    d.category_id = $('#category_ids').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'product_image', name: 'image' },
                { data: 'product_name', name: 'product_name' },
                { data: 'product_short_code', name: 'short_code' },
                { data: 'client_name', name: 'channel_name' },
                { data: 'brand_name', name: 'brand_name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'action', name: 'action' }
            ]

        });

        $(".go").click(function(){
            productlist.draw();
        });


    });

</script>

@endsection
@push('js')
{{-- <script src="{{ asset('Modules/product/resources/assets/js/product.js') }}"></script> --}}
@endpush
