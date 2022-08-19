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
                                <h6 class="fs-17 fw-semi-bold mb-0">Add Invoice</h6>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('packages-invoices.index') }}"  class="btn btn-success btn-sm mr-1"><i class="fas fa-list mr-1"></i>Invoice List</a>
                            </div>
                        </div>
                    </div>
                        <form action="{{ route('packages-invoices.store') }}" method="POST">
                            @csrf

                            <div class="card-body row">
                                <div class="card-body col-md-6" style="border-right:2px solid #b2bdb5">
                                    <div class="mt-3 row">
                                        <label for="Client" class="col-sm-3 col-form-label fw-semi-bold">Client<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select name="client_id" class="form-select mySelect2First">
                                                <option value="">Select Client</option>
                                                 @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                                 @endforeach
                                               </select>
                                            @if($errors->has('client_id'))
                                            <div class="error text-danger">{{$errors->first('client_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="title" class="col-sm-3 col-form-label fw-semi-bold">Package<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select name="package_id" class="form-select mySelect2First">
                                                <option value="">Select package</option>
                                                 @foreach($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->title }}</option>
                                                 @endforeach
                                               </select>
                                            @if($errors->has('package_id'))
                                            <div class="error text-danger">{{$errors->first('package_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="title" class="col-sm-3 col-form-label fw-semi-bold">Module<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select name="module_id[]" class="form-select mySelect2First" multiple>
                                                <option value="">Select Module</option>
                                                 @foreach($modules as $module)
                                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                                 @endforeach
                                               </select>
                                            @if($errors->has('module_id'))
                                            <div class="error text-danger">{{$errors->first('module_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label class="col-sm-3 col-form-label fw-semi-bold">Invoice Date<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="invoice_date" type="date" value="{{old('invoice_date') ?? \Carbon\Carbon::now()->format('Y-m-d') }}" id="example-date-input">
                                            @if($errors->has('invoice_date'))
                                                <div class="error text-danger">{{$errors->first('invoice_date')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label class="col-sm-3 col-form-label fw-semi-bold">Bill Start Date<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="bill_start_date" type="date" value="{{old('bill_start_date') ?? \Carbon\Carbon::now()->format('Y-m-d') }}" id="example-date-input">
                                            @if($errors->has('bill_start_date'))
                                                <div class="error text-danger">{{$errors->first('bill_start_date')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="title" class="col-sm-3 col-form-label fw-semi-bold">Payment Method<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select name="package_payment_method_id" class="form-select">
                                                <option value="">Select a Option</option>
                                                @foreach($paymentMethods as $method)
                                                <option value="{{ $method->id }}" >{{ $method->title }}</option>
                                                @endforeach
                                               </select>
                                            @if($errors->has('package_payment_method_id'))
                                               <div class="error text-danger">{{$errors->first('package_payment_method_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="title" class="col-sm-3 col-form-label fw-semi-bold">Payment Status<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select name="payment_status" class="form-select">
                                                    <option value="">Select a Option</option>
                                                    <option value="0" >Pending</option>
                                                    <option value="1" >complete</option>
                                                    <option value="2" >Incomplete</option>
                                               </select>
                                            @if($errors->has('payment_status'))
                                               <div class="error text-danger">{{$errors->first('payment_status')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="price" class="col-sm-3 col-form-label">Total Amount</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="total_amount"  placeholder="Enter Total Amount">
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label class="col-sm-3 col-form-label fw-semi-bold">Received Date</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="received_date" type="date"  id="example-date-input">

                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="gio_long" class="col-sm-3 col-form-label fw-semi-bold"> </label>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input type="checkbox" name="status" id="status" value="1" class="form-check-input">
                                                <label class="form-check-label" for="status">Is Invoice Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body col-md-6">
                                    <div class="mt-3 row">
                                        <label for="title" class="col-sm-3 col-form-label fw-semi-bold">Package Title<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="title" id="title" value="" placeholder="Enter Title">
                                            @if($errors->has('title'))
                                            <div class="error text-danger">{{$errors->first('title')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="price" class="col-sm-3 col-form-label">Price<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="price" value="" placeholder="Enter Price">
                                            @if($errors->has('price'))
                                            <div class="error text-danger">{{ $errors->first('price') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="duration" class="col-sm-3 col-form-label">Duration<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="duration"  placeholder="Enter Duration">
                                            @if($errors->has('duration'))
                                            <div class="error text-danger">{{ $errors->first('duration') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="title" class="col-sm-3 col-form-label fw-semi-bold">Offer Title</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" name="offer" id="offer_title"  placeholder="Enter Offer Title">
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="price" class="col-sm-3 col-form-label">Offer Price</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="offer_price"  placeholder="Enter Offer Price">
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="duration" class="col-sm-3 col-form-label">Offer Discount</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="offer_discount"  placeholder="Enter Offer Discount">
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="duration" class="col-sm-3 col-form-label">Offer Duration</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number" name="offer_duration"  placeholder="Enter Offer Duration">
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="gio_long" class="col-sm-3 col-form-label fw-semi-bold"> </label>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input type="checkbox" name="offer_status" id="offer_status" value="1" class="form-check-input">
                                                <label class="form-check-label" for="offer_status">Is Offer Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div><!--/.body content-->

@endsection
@push('js')
{{-- <script src="{{ asset('vendor/Outlet/assets/js/outlet.js') }}"></script> --}}
@endpush
