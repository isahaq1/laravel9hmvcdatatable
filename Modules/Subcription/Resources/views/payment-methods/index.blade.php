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
                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">Location</label>
                                    <div class="col-12">
                                        <select class="form-control placeholder-single">
                                            <optgroup label="Central Time Zone">
                                                <option value="AL">Alabama</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">From date</label>
                                    <div class="col-12">
                                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                    </div>
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="col-form-label text-end fw-semi-bold">To date</label>
                                    <div class="col-12">
                                        <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                                    </div>
                                </div>

                                <div class="col-3 mb-3">
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
                                <h6 class="fs-17 fw-semi-bold mb-0">Payment Methods</h6>
                            </div>
                            <div class="text-end">
                                <a href="javascript:void(0)"  class="btn btn-success btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#payment"><i class="fas fa-plus mr-1"></i>Add New</a>
                                @include('subcription::modals.create-payment-methods')
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive1">
                            <table id="example" class="table display table-bordered table-striped table-hover bg-white m-0 card-table text-center">
                                <thead>

                                    <tr>
                                        <th width="10%">SL.</th>
                                        <th width="60%">Title</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paymentMethods as $key => $payment)
                                        <tr>
                                            <td>#{{ $key + 1 }}</td>
                                            <td>{{ $payment->title }}</td>
                                            <td>
                                                @if($payment->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($payment->status == 0)
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Edit Payment Method" data-bs-toggle="modal" data-bs-target="#payment-{{ $payment->id }}" class="text-primary">
                                                    <i class='far fa-edit'></i>
                                                </a>
                                                @include('subcription::modals.payment-methods')
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
    </div><!--/.body content-->

@endsection
@push('js')
<script src="{{ asset('public/sweetalert-script.js') }}"></script>
@endpush
