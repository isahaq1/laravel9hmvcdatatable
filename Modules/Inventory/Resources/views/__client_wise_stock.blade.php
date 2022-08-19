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
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">From Date</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">To Date</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                </div>
                            </div>
                            <div class="col-3 mb-3">
                                <button class="btn btn-success me-2">Go</button>
                                <button class="btn btn-danger">Reset</button>
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
                        <div class="text-end">
                            <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1 addShowModal"><i class="fas fa-plus mr-1"></i>Add New</a>
                            {{-- <a href="#" class="btn btn-primary w-auto me-2"> Export all plan</a> --}}
                        </div>
                    </div>
                </div>

                
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="reciveList" class="table display table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>MRR NO</th>
                                    <th>Client Name</th>
                                    <th>Store Name</th>
                                    <th>Receive Date</th>
                                    <th>Status</th>
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



@include('inventory::modal.__recive')


<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('#reciveList').DataTable().draw();
    }

    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.addShowModal').on('click', function() {

            var no = "MRR-{{getMAXID('inv_recives','id')}}";
            $('#category_name').val();
            $('#id').val();
            $('#mrr_no').val(no);
            $('.modal-title').text('Receive Product');
            $('.actionBtn').text('Receive');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');

        });


        $('#reciveList').on('click', '#viewAction', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr('data-view-route');
            $('#acmethod').val('PUT');

            $.ajax({

                type: 'GET',
                url: submit_url,
                data: {"_token": "{{ csrf_token() }}"},
                dataType: 'JSON',
                success: function(res) {

                    if(res.data.status=='1'){
                        $('#approve').hide();
                    }

                    $('#receivedate').text(res.data.receive_date);
                    $('#clientname').text(res.data.client_name);
                    $('#mrrno').text(res.data.mrr_no);
                    $('#descriptionv').text(res.data.description);
                    $('#detailspreview').html(res.details);

                    $('#client_id').val(res.data.client_id);
                    $('#id').val(res.data.id);
                    $('.modal-title').text('View Information');
                    $('#previewAction').modal('show');

                },

                error: function() {
                }

            });
        });



        $('#reciveList').on('click', '#editAction', function(e) {

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
                    $('#client_id').val(res.data.client_id).trigger('change');
                    $('#store_id').val(res.data.store_id).trigger('change');
                    $('#mrr_no').val(res.data.mrr_no);
                    $('#receive_date').val(res.data.receive_date);
                    $('#description').val(res.data.description);
                    if(res.data.status==='1'){
                        $('#approve').hide();
                    }
                    $("#ajaxForm").attr("action", action_url);
                    $('.modal-title').text('Update Information');
                    $('.actionBtn').text('Update');
                    $('#myModal').modal('show');

                },

                error: function() {
                }

            });
        });


        
        $('#reciveList').on('click', '#actionDelete', function(e) {
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
                        $('#reciveList').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });



        var reciveList = $('#reciveList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('get-receive-list')}}",
                data : function(d) {
                    d.client_id = $('#client_ids').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'mrr_no', name: 'mrr_no' },
                { data: 'client_name', name: 'client_name' },
                { data: 'store_name', name: 'store_name' },
                { data: 'receive_date', name: 'receive_date' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ]

        });

        $(".go").click(function(){
            reciveList.draw();
        });

    });

  




</script>



@endsection

@push('js')
@endpush
