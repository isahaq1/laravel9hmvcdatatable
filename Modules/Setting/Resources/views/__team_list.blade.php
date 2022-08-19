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
                            <h6 class="fs-17 fw-bold mb-0">Team List</h6>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-success addShowModal" data-bs-toggle="modal" ><i class="glyphicon glyphicon-plus me-2"></i>Add</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover basic" id="teamList">

                            <thead>
                                <tr>
                                    <th>Team Name</th>
                                    <th>State Name</th>
                                    <th>Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Aba North, Aba South,</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm me-1 addShowModal"><i class="far fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Team</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                               
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3 row">
                                            <label for="example-number-input" class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold justify-content-start d-flex">Team Name <i class="text-danger">*</i></label>
                                            <div class="col-xl-9 col-xxl-10">
                                                <input type="text" class="form-control" placeholder="Team Name" id="recipient-name">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold justify-content-start d-flex">Client <i class="text-danger">*</i></label>
                                            <div class="col-xl-9 col-xxl-10">
                                                <select class="form-control placeholder-single">                                       
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                    </optgroup>                                              
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-number-input" class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold justify-content-start d-flex">Description</label>
                                            <div class="col-xl-9 col-xxl-10">
                                                <textarea class="form-control" placeholder="Description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold justify-content-start d-flex">Country Name</label>
                                            <div class="col-xl-9 col-xxl-10">
                                                <select class="form-control placeholder-single">                                       
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                    </optgroup>                                              
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold justify-content-start d-flex">State</label>
                                            <div class="col-xl-9 col-xxl-10">
                                                <select class="form-control placeholder-single">                                       
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                    </optgroup>                                              
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold justify-content-start d-flex">Area *</label>
                                            <div class="col-xl-9 col-xxl-10">
                                                <select class="form-control placeholder-single">                                       
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                    </optgroup>                                              
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success modal_action actionBtn"> Save </button>
                                </div>
                                

                            </form>
                        </div>
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
        $("#teamList").load(" #teamList > *");
    }


    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $('.addShowModal').on('click', function() {

            $('#type_name').val();
            $('#channel_name').val();

            $('#outlet_name').val();
            $('#outlet_address').val();
            $('#outlet_phone').val();
            $('#old_image').val();
            $('#id').val();

            $('.modal-title').text('Create New ');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#exampleModal').modal('show');
        });


        $('#teamList').on('click', '#deleteAction', function(e) {
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
                        $("#teamList").load(" #teamList > *");
                    },
                    error: function() {
                    }
                });
            }
        });


        $('#teamList').on('click', '#editAction', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr('data-update-route');

            var action_url = $(this).attr('data-edit-route');
            $.ajax({
                type: 'GET',
                url: submit_url,
                data: {"_token": "{{ csrf_token() }}"},
                dataType: 'JSON',
                success: function(res) {

                    $('#type_name').val(res.data.type_id).trigger('change');
                    $('#channel_name').val(res.data.channel_id).trigger('change');

                    $('#outlet_name').val(res.data.outlet_name);
                    $('#outlet_address').val(res.data.outlet_address);
                    $('#outlet_phone').val(res.data.outlet_phone);
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



    });

</script>


@endsection

@push('js')
@endpush
