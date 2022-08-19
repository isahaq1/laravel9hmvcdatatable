<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('schedules.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf
            <input type="hidden" name="_method" id="acmethod"  value="">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 row">
                        <label for="schedule_date" class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold">Schedule Date <span class="text-danger">*</span></label>
                        <div class="col-xl-9 col-xxl-10">
                            <input class="form-control datepic" type="text"  name="schedule_date" id="schedule_date"  required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="schedule_time" class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold">Schedule Time <span class="text-danger">*</span></label>
                        <div class="col-xl-9 col-xxl-10">
                            <input class="form-control" type="time" name="schedule_time" id="schedule_time" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold ">User <span class="text-danger">*</span></label>
                        <div class="col-xl-9 col-xxl-10">
                            <select class="form-control mySelect2Modal" id="user_id" name="user_id">      
                                <option value="">Select Fieldstaff</option>
                                @foreach ($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach   
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-bold ">Location <span class="text-danger">*</span></label>
                        <div class="col-lg-7 col-xl-10" id="locationss">
                            <select class="form-control mySelect2Modal " id="location_id" name="location_id"
                            id="locationdata">                                       
                              
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-bold ">Outlet <span class="text-danger">*</span></label>
                        <div class="col-lg-7 col-xl-10" id="locationss">
                            <select class="form-control mySelect2Modal outletss" id="outlet_id" name="outlet_id">                                       
                                    
                            </select>
                        </div>
                    </div>

                    {{-- <div class="mb-3 row">
                        <label for="example-number-input" class="col-xl-3 col-xxl-2 col-form-label text-end fw-bold">Objectives *</label>
                        <div class="col-xl-9 col-xxl-10">
                            <input type="text" class="form-control" placeholder="Location" id="recipient-name">
                        </div>
                    </div> --}}

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success modal_action actionBtn"> Save schedule</button>
                </div>

            </div>
        </form>
    </div>
</div>
