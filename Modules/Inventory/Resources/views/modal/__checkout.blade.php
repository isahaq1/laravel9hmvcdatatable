<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-xl">

        <form action="{{route('checkouts.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf

            <input type="hidden" name="_method" id="acmethod"  value="">
            <input type="hidden" name="" id="foredit"  value="0">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="foradd">
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

                    </div>
                    
                   
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success modal_action actionBtn"> Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>





<div class="modal fade" id="previewAction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-xl">

        {{-- <form action="{{route('checkouts.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8"> --}}
  
            @csrf

            <input type="hidden" name="_method" id="acmethod"  value="">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-12">
                            <address class="">
                                <strong>Checkout Date :</strong> <span id="checkoutdate"></span><br>
                                <strong>User Name :</strong> <span id="username"></span><br>
                                <strong>Client Name :</strong> <span id="clientname"></span><br>
                                <strong>Checkout Note : </strong> <span id="checkoutnote"></span>
                            </address>
                        </div>
                    </div>
                    <br/>

                    

                    <div class="col-12">
                        <h4>Product Information</h4>
                        <table class="table table-bordered table-hover">

                            <tbody id="detailspreview"> </tbody>
                            
                        </table>

                    </div>
                    
                   
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        {{-- </form> --}}
    </div>
</div>

