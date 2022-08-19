<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">

        <form action="{{route('projects.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf

            <input type="hidden" name="_method" id="acmethod"  value="">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Select Client <span class="text-danger">*</span></label>
                        <div class="col-xl-9 col-xxl-10">
                                <select class="mySelect2Modal" name="client_id" id="client_id" required>
                                    <option value="">Select Client</option>
                                    @foreach ($client as $item)
                                    <option value="{{$item->id}}">{{$item->client_name}}</option>
                                    @endforeach
                                </select>
                                
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-semi-bold ">Project Name <span class="text-danger">*</span></label>
                        <div class="col-lg-7 col-xl-10">
                            <input type="text" name="project_name" placeholder="Project Name" id="project_name" class="form-control" required>
                        </div>
                    </div>
                    
                   
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success modal_action actionBtn"> Save schedule</button>
                </div>
            </div>
        </form>
    </div>
</div>

