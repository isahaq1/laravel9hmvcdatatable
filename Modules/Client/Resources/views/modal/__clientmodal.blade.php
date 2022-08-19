    
    <div class="modal fade " id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <div class="modal-dialog modal-xl">

            <form action="{{route('client_store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
      
                @csrf

                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row ">
                            <div class="col-md-6">
                                <label for="client_name" class="col-form-label fw-bold">Client name <i class="text-danger">*</i></label>
                                <input type="text"  name="client_name" id="client_name" class="form-control" placeholder="Client Name"  required>
                            </div>

                            <div class="col-md-6">
                                <label for="client_email" class="col-form-label fw-bold">Client Email<i class="text-danger">*</i></label>
                                <input type="text"  name="client_email" id="client_email" class="form-control" placeholder="Client Email" required>
                            </div>

                        </div>

                        <div class="row ">
                            <div class="col-md-6">
                                <label for="client_name" class="col-form-label fw-bold">Client phone <i class="text-danger">*</i></label>
                                <input class="form-control" type="text" name="client_phone" id="client_phone" placeholder="Client Phone" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="col-form-label fw-bold">Password<i class="text-danger">*</i></label>
                                <input type="password"  name="password" id="password" class="form-control" placeholder="*****" required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="client_address" class="col-form-label fw-semi-bold">Client Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="client_address" id="client_address" required ></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="client_email" class="col-form-label fw-bold">Client Logo<i class="text-danger">*</i></label>
                                <input class="form-control" type="file" name="client_logo" >
                                <input class="form-control" type="hidden" name="client_logo_image" id="client_logo_image">
                                <input class="form-control" type="hidden" name="id" id="id">
                            </div>

                            

                            <div class="col-md-6">
                                <label for="status" class="col-form-label fw-bold">Status <span class="text-danger">*</span></label>
                                <div class="radio">
                                    <input type="radio" name="status" id="radio1" value="1" checked="">
                                    <label for="radio1">Active</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="status" id="0" value="option2">
                                    <label for="radio2">InActive</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success modal_action actionBtn"></button>
                    </div>

                </div>

            </form>
        </div>
    </div>

