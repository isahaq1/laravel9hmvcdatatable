@extends('layouts.backend')
@push('css')
@endpush

@section('content')
   
    
<div class="body-content">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

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

                @include('clientproject::modal.__project_modal')
                
                <div class="card-body">
                    <table class="table table-striped table-bordered dt-responsive nowrap bootstrap4-styling projectList">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Client Name</th>
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



<script>
        

    var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        $('.projectList').DataTable().draw();
    }

    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $('.addShowModal').on('click', function() {
            $('#project_name').val();
            $('#client_id').val();
            $('#id').val();
            $('.modal-title').text('Create New Project');
            $('.actionBtn').text('Add');
            $('.ajaxForm').removeClass('was-validated');
            $('#myModal').modal('show');
        });


        $('.projectList').on('click', '#deleteAction', function(e) {
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
                        $('.projectList').DataTable().draw();
                    },
                    error: function() {
                    }
                });
            }
        });


        $('.projectList').on('click', '#editAction', function(e) {
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

                    $('#project_name').val(res.data.project_name);
                    $('#client_id').val(res.data.client_id).trigger('change');;
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


        var projectList = $('.projectList').DataTable({

            processing: true,
            serverSide: true,
            ajax: {
                url : "{{route('getProjectList')}}",
                data : function(d) {
                    d.client_id = $('#client_ids').val();
                    d._token= "{{ csrf_token() }}";
                },
            },
            columns: [
                
                { data: 'project_name', name: 'project_name' },
                { data: 'client_name', name: 'channel_name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ]

            });

            $(".go").click(function(){
                projectList.draw();
            });

    });

</script>



@endsection

@push('js')
@endpush
