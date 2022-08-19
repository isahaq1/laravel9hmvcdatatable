<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('product-recive.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf
            <input type="hidden" name="_method" id="acmethod"  value="">
            <input type="hidden" name="id" id="id"  value="">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="receive_date" class="col-form-label fw-bold">Receive Date <i class="text-danger">*</i></label>
                            <input type="text"  name="receive_date" id="receive_date" class="form-control datepicker" placeholder="Receive Date"  required>
                        </div>

                        <div class="col-md-6">
                            <label for="mrr_no" class="col-form-label fw-bold"> MRR NO<i class="text-danger">*</i></label>
                            <input class="form-control " type="text"  name="mrr_no" id="mrr_no" readonly required>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label for="clientid" class="col-form-label fw-bold">Client <i class="text-danger">*</i></label>
                            <select class="form-control mySelect2Modal" id="client_id" name="client_id" required>      
                                <option value="">Select Client</option>
                                @foreach ($client as $item)
                                    <option value="{{$item->id}}">{{$item->client_name}}</option>
                                @endforeach   
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="store_id" class="col-form-label fw-bold"> Store<i class="text-danger">*</i></label>
                            <select class="form-control mySelect2Modal" id="store_id" name="store_id" required>      
                                <option value="">Select Store</option>
                                @foreach ($store as $item)
                                    <option value="{{$item->id}}">{{$item->store_name}}</option>
                                @endforeach   
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="receive_date" class="col-form-label fw-bold">Description </label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                    </div>

                    <br/>

                    <div id="details_preview"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success modal_action actionBtn"> Save schedule</button>
                </div>

            </div>
        </form>
    </div>
</div>



<div class="modal fade" id="previewAction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <div class="row">
                        <div class="col-sm-6">
                            <img src="assets/dist/img/mini-logo.png" class="img-fluid mb-3" alt="">
                            <br>
                            <address>
                                <strong>Receive Date :</strong> <span id="receivedate"></span><br>
                                <strong>MRR NO :</strong> <span id="mrrno"></span><br>
                                <strong>Client Name :</strong> <span id="clientname"></span><br>

                            </address>
                            <address>
                                <strong>Description </strong><br>
                                <p id="descriptionv"></p>
                            </address>
                        </div>
                        <div class="col-sm-6 text-end">
                            {{-- <h1 class="h3">Invoice #0044777</h1>
                            <div>Issued March 19th, 2017</div>
                            <div class="text-danger m-b-15">Payment due April 21th, 2017</div>
                            <address>
                                <strong>Twitter, Inc.</strong><br>
                                1355 Market Street, Suite 900<br>
                                San Francisco, CA 94103<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address> --}}
                        </div>
                    </div>
                    <br/>
                    
                    <div id="detailspreview"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success actionBtn" id="approve">Approve</button>
                </div>

            </div>
    </div>
</div>