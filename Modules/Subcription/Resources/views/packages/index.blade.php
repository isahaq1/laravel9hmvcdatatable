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
                                <h6 class="fs-17 fw-semi-bold mb-0">Package</h6>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('packages.create') }}"  class="btn btn-success btn-sm mr-1"><i class="fas fa-plus mr-1"></i>Add New</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive1">
                            <table id="example" class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                                <thead>

                                    <tr>
                                        <th>SL.</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Offer</th>
                                        <th>Offer Price</th>
                                        <th>Offer Discount</th>
                                        <th>Offer Duration</th>
                                        <th>Offer Status</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packages as $key => $package)
                                        <tr>
                                            <td>#{{ $key + 1 }}</td>
                                            <td>{{ $package->title }}</td>
                                            <td>{{ $package->price }}</td>
                                            <td>{{ $package->duration }}</td>
                                            <td>{{ $package->offer??'---' }}</td>
                                            <td>{{ $package->offer_price??'---' }}</td>
                                            <td>{{ $package->offer_discount??'---' }}</td>
                                            <td>{{ $package->offer_duration??'---' }}</td>
                                            <td>
                                                @if($package->offer_status == 1)
                                                   <span class="badge bg-success">Active</span>
                                                @elseif ($package->offer_status == 0)
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($package->status == 1)
                                                <span class="badge bg-success">Active</span>
                                             @elseif ($package->status == 0)
                                                 <span class="badge bg-danger">Inactive</span>
                                             @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('packages.edit', $package->id) }}"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Edit package" class="text-primary">
                                                    <i class='far fa-edit'></i>
                                                </a>
                                                <a title="Delete" href="javascript:void(0)"  class="text-danger delete-confirm m-1" data-route="{{ route('packages.destroy',$package->id) }}" data-csrf="{{csrf_token()}}"><i class="far fa-trash-alt"></i></a>
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
