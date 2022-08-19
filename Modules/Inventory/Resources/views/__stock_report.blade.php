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
                                <label class="col-form-label text-end fw-semi-bold">Client</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single" id="clientid" name="clientid">  
                                        <option value="">Select Client</option>
                                        @foreach ($client as $item)
                                        <option value="{{$item->id}}">{{$item->client_name}}</option>
                                        @endforeach      
                                    </select>
                                </div>
                            </div>
                          

                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Store</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single" id="storeid" name="storeid">  
                                        <option value="">Select Store</option>
                                        @foreach ($store as $item)
                                        <option value="{{$item->id}}">{{$item->store_name}}</option>
                                        @endforeach      
                                    </select>
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
        <div class="col-12">
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

                        <table id="stockReport" class="table display table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Store Name</th>
                                    <th>Product Name</th>
                                    <th>Case Stock Qty</th>
                                    <th>Unit Stock Qty</th>
                                </tr>
                            </thead>

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
        $('#stockReport').DataTable().draw();
    }

    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var stockReport = $('#stockReport').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('getStockList')}}",
                data : function(d) {
                    d.client_id = $('#clientid').val();
                    d.store_id = $('#storeid').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'client_name', name: 'client_name' },
                { data: 'store_name', name: 'store_name' },
                { data: 'product_name', name: 'product_name' },
                { data: 'stock_case_qty', name: 'stock_case_qty' },
                { data: 'stock_unit_qty', name: 'stock_unit_qty' },
            ]

        });

        $(".go").click(function(){
            stockReport.draw();
        });

    });

  




</script>



@endsection

@push('js')
@endpush
