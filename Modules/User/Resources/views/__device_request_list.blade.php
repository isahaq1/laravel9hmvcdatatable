@extends('layouts.backend')
@push('css')
@endpush

@section('content')
    <!--/.Content Header (Page header)--> 
    <div class="body-content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 fw-semi-bold mb-0">Device Request</h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-striped table-bordered bootstrap4-styling" id="requestList">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Device id</th>
                                    <th>Request Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.body content-->

    

    <script>
        
        var showCallBackData = function() {
            $('#id').val('');
            $('.ajaxForm')[0].reset();
            $('#myModal').modal('hide');
            $('#requestList').DataTable().draw();
        }
    
        $(document).ready(function() {
            "use strict";
    
            var outletlist = $('#requestList').DataTable({
    
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{route('deviceRequestListAjax')}}",
                    data : function(d) {
                        d._token= "{{ csrf_token() }}";
                    },
                },
                columns: [
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'device_id', name: 'device_id' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
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
    @endpush
