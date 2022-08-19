@extends('layouts.backend')
@push('css')
@endpush

@section('content')
    <!--/.Content Header (Page header)--> 
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
                                    <label class="col-form-label text-end fw-semi-bold">Outlet Type</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="outlet_type_id" name="outlet_type_id">  
                                            <option value="">Select Outlet Type</option>
                                            @foreach ($types as $item)
                                            <option value="{{$item->id}}">{{$item->type_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>
                              

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Outlet Channel</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="outlet_channel_id" name="outlet_channel_id">  
                                            <option value="">Select Channel</option>
                                            @foreach ($channels as $item)
                                            <option value="{{$item->id}}">{{$item->channel_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Country</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="countryid" name="countryid">  
                                            <option value="">Select Location</option>
                                            @foreach ($country as $item)
                                            <option value="{{$item->id}}">{{$item->country_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">State</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="stateid" name="stateid">  
                                            <option value="">Select State</option>
                                            @foreach ($state as $item)
                                                <option value="{{$item->id}}">{{$item->state_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Regiion</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="regionid" name="regionid">  
                                            <option value="">Select region</option>
                                            @foreach ($region as $item)
                                            <option value="{{$item->id}}">{{$item->region_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>


                           
                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Location</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="location_ids" name="location_ids">  
                                            <option value="">Select Location</option>
                                            @foreach ($location as $item)
                                            <option value="{{$item->id}}">{{$item->location_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Date Range</label>
                                    <div class="col-12">
                                        <input class="form-control mydaterenge" type="text" name="" placeholder="Select Date Range">
                                    </div>
                                </div>
                               

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold"></label>
                                    <div class="col-12 " style="margin-top:15px;">
                                        <button class="btn btn-primary me-2 go">Go</button>
                                        <button class="btn btn-danger">Reset</button>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        
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
                   
                    <div class="card-body">
                        <div class="table-responsive1">
                            <table id="outletList1" class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                                <thead>

                                    <tr>
                                        <th>Image</th>
                                        <th>Outlet Name</th>
                                        <th>Type name</th>
                                        <th>Channel Name</th>
                                        <th>Phone</th>
                                        <th>Contact person</th>
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


@include('outlet::modal.__outlet_modal')


<script>
        
    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('#outletList1').DataTable().draw();
        // $("#outletList1").load(" #outletList1 > *");
    }

    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $('.addShowModal').on('click', function() {
            
            $('#type_id').val();
            $('#channel_id').val();
            $('#region_id').val();
            $('#location_id').val();
            $('#outlet_name').val();
            $('#outlet_phone').val();
            $('#street_no').val();
            $('#street_name').val();
            $('#gio_lat').val();
            $('#gio_long').val();
            $('#cpf_name').val();
            $('#cpl_name').val();
            $('#cpp').val();
            $('#old_image').val();
            $('#id').val();
            $('.modal-title').text('Create New Outlet');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');
        });


        $('#outletList1').on('click', '#actionDelete', function(e) {
            e.preventDefault();

            $('#ajaxForm').removeClass('was-validated');
            var submit_url = $(this).attr('data-route');
            var check = confirm('Are you sure');
            
            if (check == true) {
                $.ajax({
                    type: 'POST',
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
                        $('#outletList1').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });


        $('#outletList1').on('click', '#editAction', function(e) {
            e.preventDefault();

            var submit_url = $(this).attr('data-edit-route');
            var action_url = $(this).attr('data-update-route');

            $.ajax({
                type: 'GET',
                url: submit_url,
                data: {"_token": "{{ csrf_token() }}"},
                dataType: 'JSON',
                success: function(res) {

                    $('#type_id').val(res.data.type_id).trigger('change');
                    $('#channel_id').val(res.data.channel_id).trigger('change');
                    $('#region_id').val(res.data.region_id).trigger('change');
                    $('#location_id').val(res.data.location_id).trigger('change');

                    $('#outlet_name').val(res.data.outlet_name);
                    $('#outlet_phone').val(res.data.outlet_phone);
                    $('#street_no').val(res.data.street_no);
                    $('#street_name').val(res.data.street_name);
                    $('#gio_lat').val(res.data.gio_lat);
                    $('#gio_long').val(res.data.gio_long);
                    $('#cpf_name').val(res.data.cpf_name);
                    $('#cpl_name').val(res.data.cpl_name);
                    $('#cpp').val(res.data.cpp);

                    $('#old_image').val(res.data.outlet_image);
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


        var outletlist = $('#outletList1').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('outletListAjax')}}",
                data : function(d) {
                    d.outlet_type = $('#outlet_type_id').val();
                    d.channel_id = $('#outlet_channel_id').val();
                    d.country_id = $('#countryid').val();
                    d.state_id = $('#stateid').val();
                    d.region_id = $('#regionid').val();
                    d.location_id = $('#location_ids').val();
                    d.date = $('.mydaterenge').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'image', name: 'image' },
                { data: 'outlet_name', name: 'outlet_name' },
                { data: 'type_name', name: 'type_name' },
                { data: 'channel_name', name: 'channel_name' },
                { data: 'outlet_phone', name: 'outlet_phone' },
                { data: 'outlet_cp', name:'outlet_cp'},
                { data: 'action', name: 'action' }
            ]

        });

        $(".go").click(function(){
            outletlist.draw();
        });


    });

</script>

@endsection
@push('js')
{{-- <script src="{{ asset('vendor/Outlet/assets/js/outlet.js') }}"></script> --}}
@endpush
