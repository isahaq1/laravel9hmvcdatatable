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
                            <h6 class="fs-17 fw-bold mb-0">Checkout</h6>
                        </div>
                        <div class="text-end">
                            <a href="{{route('checkouts.index')}}" class="btn btn-success"><i class="typcn typcn-th-list me-1"></i>Checkout List</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{route('checkouts.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
                   
                        @csrf
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="mb-3 row">
                                <label class="col-xl-2 col-form-label text-start fw-bold">Select user <span class="text-danger">*</span></label>
                                <div class="col-xl-6">
                                    <select class="form-control" name="user_id" id="user_id" required>
                                        <option value="">Select</option>
                                        @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="mb-3 row">
                                <label class="col-xl-2 col-form-label text-start fw-bold">Select Client <span class="text-danger">*</span></label>
                                <div class="col-xl-6">
                                    <select class="form-control" name="client_id" id="client_id" required>
                                        <option value="">Select</option>
                                        @foreach ($clients as $item)
                                        <option value="{{$item->id}}">{{$item->client_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="mb-3 row">
                                <label class="col-xl-2 col-form-label text-start fw-bold">Checkout Note</label>
                                <div class="col-xl-6">
                                    <textarea class="form-control" name="checkout_note" id="checkout_note"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h4>Product Information</h4>
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Stock Case</th>
                                        <th>Stock Unit</th>
                                        <th>Checkout Case Qty</th>
                                        <th>Checkout Unit Qty</th>
                                    </tr>
                                </thead>

                                <tbody id="productlist"> </tbody>
                                
                            </table>

                            <button  type="submit" class="btn btn-success modal_action actionBtn"> Add </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->


@endsection

@push('js')
@endpush
