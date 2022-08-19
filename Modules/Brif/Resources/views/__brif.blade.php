@extends('layouts.backend')
@push('css')
@endpush

@section('content')
<div class="body-content">
    <div class="row mb-4">
        <div class="col-12 col-lg-5">


            @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-bold mb-0">Add Bref</h6>
                        </div>
                    </div>
                </div>



                <form action="{{route('brifs.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
                        @csrf


                <div class="card-body">

                    <div class="mb-3 row">
                        <label class="col-lg-5 col-xl-3  col-form-label text-end fw-bold justify-content-start d-flex"> Brif Title *</label>
                        <div class="col-lg-7 col-xl-9">
                           <input type="text" class="form-control" name="title" id="title" required>
                           
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label class="col-lg-5 col-xl-3  col-form-label text-end fw-bold justify-content-start d-flex">Description</label>
                        <div class="col-lg-7 col-xl-9">
                            <textarea class="form-control" name="description" id="description" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-lg-5 col-xl-3  col-form-label text-end fw-bold justify-content-start d-flex">Brif File</label>
                        <div class="col-lg-7 col-xl-9">
                            <input type="file" class="form-control" name="file" >
                            @if ($errors->has('file'))
                                <div class="error text-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-3 col-form-label text-end fw-bold justify-content-start d-flex">Team <i class="text-danger">*</i></label>
                        <div class="col-xl-7 col-xxl-9">
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

                    <div class="mb-3 row justify-content-end">
                        <a href="#" class="btn btn-danger w-auto me-2"> Reset</a>
                        {{-- <button class="btn btn-success" id="submit">Submit</button> --}}
                        <button type="submit" class="btn btn-success w-auto me-2">Add</button>
                    </div>
                    
                </div>
                </form>
            </div>
        </div>


        <div class="col-12 col-lg-7">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-bold mb-0">Bref List</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Created date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($brifs as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <div id="purchaseOrderDetails_filePreview"><a href="{{url('/public/'.$item->file)}}" target="_blank" rel="noopener noreferrer" class="btn btn-primary"><i class="fa fa-download"></i> </a></div>
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <a href="javasecript:void(0)" id="actionDelete" data-route="{{route('brifs.destroy',$item->id)}}" class="btn btn-danger-soft btn-sm me-1"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

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
        $('#example').draw();
        $("#example").load(" #example > *");
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


        $('#example').on('click', '#actionDelete', function(e) {
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
                        $("#example").load(" #example > *");
                    },
                    error: function() {
                    }
                });
            }
        });


        $('#example').on('click', '#editAction', function(e) {
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




    });





</script>


@endsection

