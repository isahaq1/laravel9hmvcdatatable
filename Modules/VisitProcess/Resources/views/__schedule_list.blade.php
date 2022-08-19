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

                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Field Staff</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single" id="fieldstaff_id">                                       
                                        <option value="">Select Fieldsataff</option>
                                            @foreach($user as $key => $item)
                                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                            @endforeach                                              
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Location</label>
                                <div class="col-12">
                                    <select name="location_id" id="locationid" class="form-control placeholder-single">
                                        
                                            <option value="">Select Location</option>
                                            @foreach($locations as $key => $location)
                                            <option value="{{ $location->id }}" >{{ $location->location_name }}</option>
                                            @endforeach
                                        
                                    </select>
                                </div>
                            </div>



                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Client</label>
                                <div class="col-12">
                                    <select name="client_id" id="clientid" class="form-control placeholder-single">
                                        
                                            <option value="">Select Client</option>
                                            @foreach($clients as $key => $client)
                                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                           
                            {{-- <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Channel</label>
                                <div class="col-12">
                                    <select name="outlet_channel_id" id="channelid" class="form-control placeholder-single">
                                            <option value="">Select Channel</option>
                                            @foreach($outletChannels as $key => $channel)
                                            <option value="{{ $channel->id }}" >{{ $channel->channel_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div> --}}


                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Outlet</label>
                                <div class="col-12">
                                    <select name="outlet_id" id="outletid" class="form-control placeholder-single">
                                        <option value="">Select Outlet</option>
                                        @foreach($outlets as $key => $outlet)
                                            <option value="{{ $outlet->outlet_id }}" >{{ $outlet->outlet_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            {{-- @dd(@$request->datefilter) --}}
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Date</label>
                                <div class="col-12">
                                    <input class="form-control mydaterenge" type="text"  name="" placeholder="Select Date Range"/>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2 go">Submit</button>
                                <button class="btn btn-danger" name="reset" value="1">Reset</button>
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
                            <h6 class="fs-17 fw-semi-bold mb-0">Schedule List</h6>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New</a>
                            {{-- <a href="#" class="btn btn-primary w-auto me-2"> Export all plan</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="scheduleList" class="table display table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Location Name</th>
                                    <th>Outlate</th>
                                    <th>Schedule Date</th>
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



@include('visitprocess::modal.__schedule_modal')


<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('#scheduleList').DataTable().draw();
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
            $('.modal-title').text('Create New Schedule');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');
        });



        $('#scheduleList').on('click', '#editAction', function(e) {
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

                    $('#id').val(res.data.id);
                    $('#user_id').val(res.data.user_id).trigger('change');
                    $('#schedule_date').val(res.data.schedule_date).trigger('change');
                    $('#schedule_time').val(res.data.schedule_time).trigger('change');

                    $("#ajaxForm").attr("action", action_url);
                    $('.modal-title').text('Update Information');
                    $('.actionBtn').text('Update');
                    $('#myModal').modal('show');

                },

                error: function() {
                }

            });
        });


        
        $('#scheduleList').on('click', '#deleteAction', function(e) {
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
                        $('#scheduleList').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });



        var scheduleList = $('#scheduleList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('getScheduleList')}}",
                data : function(d) {
                    d.clientid = $('#clientid').val();
                    d.fieldstaff_id = $('#fieldstaff_id').val();
                    d.outletid = $('#outletid').val();
                    d.locationid = $('#locationid').val();
                    d.channelid = $('#channelid').val();
                    d.date = $('.mydaterenge').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'location_name', name: 'location_name' },
                { data: 'outlet_name', name: 'outlet_name' },
                { data: 'schedule_date', name: 'schedule_date' },
                { data: 'action', name: 'action' }
            ]

        });

        $(".go").click(function(){
            scheduleList.draw();
        });


    });



  
    $('body').on('change', '#user_id', function(e) {

        var user_id = $(this).val();
        var schedule_date = $('#schedule_date').val();

        $.ajax({
            type: 'GET',
            url: "{{route('getRoutePlanLocation')}}",
            data: {"_token": "{{ csrf_token() }}","user_id":user_id,"schedule_date":schedule_date},
            dataType: 'JSON',
            success: function(res) {
                $('#location_id').html(res.message);
            },
            error: function() {
            }
        });
    });


    
  
    $('body').on('change', '#location_id', function(e) {

        var user_id = $(this).val();
        var location_id = $('#location_id').val();

        $.ajax({
            type: 'GET',
            url: "{{route('getRouteWaisOutlet')}}",
            data: {"_token": "{{ csrf_token() }}","location_id":location_id},
            dataType: 'JSON',
            success: function(res) {
                $('.outletss').html(res.message);
            },
            error: function() {
            }
        });
     });


</script>



@endsection

@push('js')
@endpush
