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
                                <label class="col-form-label text-end fw-semi-bold">Location</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Field Staff</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>           
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Day Of Week *</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>

                            <div class="col-3 mb-3">
                                <button class="btn btn-primary me-2">Filter</button>
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
                            <h6 class="fs-17 fw-semi-bold mb-0">Route Plan List</h6>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New</a>
                        </div>
                    </div>
                </div>

                @include('visitprocess::modal.__route_plane')

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="routePlanList" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Day</th>
                                    <th>Date</th>
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




<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('#routePlanList').DataTable().draw();
    }

    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $('.addShowModal').on('click', function() {

            $('#user_id').val();
            $('#day_of_week').val();
            $('#state_id').val();
            $('#id').val();

            $('.modal-title').text('Create New Route Plane');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');
        });


        $('#routePlanList').on('click', '#actionDelete', function(e) {
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
                        $('#routePlanList').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });


        $('#routePlanList').on('click', '#editAction', function(e) {
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

                    // $('#locationdata').html(res.message);
                    $('#id').val(res.data.id);

                    $('#user_id').val(res.data.user_id).trigger('change');
                    $('#day_of_week').val(res.data.day_of_week).trigger('change');
                    $('#state_id').val(res.data.state_id).trigger('change');

                    

                    $("#ajaxForm").attr("action", action_url);
                    $('.modal-title').text('Update Information');
                    $('.actionBtn').text('Update');
                    $('#myModal').modal('show');
                },
                error: function() {
                }
            });
        });


        var productlist = $('#routePlanList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('routePlaneList')}}",
                data : function(d) {
                    d.client_id = $('#client_ids').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'day_of_week', name: 'day_of_week' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' }
            ]

        });

        $(".go").click(function(){
            productlist.draw();
        });



    });



    $('body').on('change', '#state_id', function(e) {

        var state_id = $(this).val();
        var id = $('#id').val();

        $.ajax({
            type: 'GET',
            url: "{{route('getLocationList')}}",
            data: {"_token": "{{ csrf_token() }}","state_id":state_id,"id":id},
            dataType: 'JSON',
            success: function(res) {
                console.log(res.message);
                $('#locationdata').html(res.message);
            },
            error: function() {
            }
        });
    });

</script>




@endsection

@push('js')
@endpush
