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

                                {{-- <div class="col-4 mb-3">
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
                                </div> --}}

                                {{-- <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Fieldstaff</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="user_id" name="user_id">  
                                            <option value="">Select user</option>
                                            @foreach ($user as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
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
                                </div> --}}

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Client</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="clientid" name="clientid">  
                                            <option value="">Select client</option>
                                            @foreach ($client as $item)
                                            <option value="{{$item->id}}">{{$item->client_name}}</option>
                                            @endforeach      
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Outlet</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single" id="outletid" name="outletid">  
                                            <option value="">Select outlet</option>
                                            @foreach ($outlet as $item)
                                            <option value="{{$item->outlet_id}}">{{$item->outlet_name}}</option>
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
                        </div>
                    </div>
                   
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="ListReport" class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                                <thead>
                                    <tr>
                                        <th>Client name</th>
                                        <th>Outlet name</th>
                                        <th>Product name</th>
                                        <th>Status</th>
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
            $('#ListReport').DataTable().draw();
        }
      
        $(document).ready(function() {
            "use strict";
      
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            

            var userList = $('#ListReport').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{route('getClientOos')}}",
                    data : function(d) {
                        d.client_id = $('#clientid').val();
                        d.outlet_id = $('#outletid').val();
                        d.date = $('.mydaterenge').val();
                        d._token= "{{ csrf_token() }}";
                    },
                },
                columns: [
                    { data: 'client_name', name: 'client_name' },
                    { data: 'outlet_name', name: 'outlet_name' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'is_oos', name: 'is_oos' },
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
