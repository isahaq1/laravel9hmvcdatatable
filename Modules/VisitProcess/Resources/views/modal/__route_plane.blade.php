<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">

        <form action="{{route('route-plane.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf

            <input type="hidden" name="_method" id="acmethod"  value="">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <input type="hidden" id="id" name="id">

                <div class="modal-body">

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">User </label>
                        <div class="col-xl-9 col-xxl-10">
                                <select class="form-control placeholder-single" id="user_id" name="user_id">  
                                    <option value="">Select user</option>
                                    @foreach ($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach      
                                </select>
                            {{-- {!! Form::select('user_id', $user, '', ['id'=>'user_id','class' => 'mySelect2Modal','required'])!!} --}}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-semi-bold ">Day Of Week</label>
                        <div class="col-lg-7 col-xl-10">
                            <select class="form-control placeholder-single" id="day_of_week" name="day_of_week">                                       
                                <optgroup label="Selet Day">
                                    <option value="Sun">Sun</option>
                                    <option value="Mon">Mon</option>
                                    <option value="Tue">Tue</option>
                                    <option value="Wed">Wed</option>
                                    <option value="Thu">Thu</option>
                                    <option value="Fri">Fri</option>
                                    <option value="Sat">Sat</option>        
                                </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-semi-bold ">State</label>
                        <div class="col-lg-7 col-xl-10">
                            <select class="form-control placeholder-single" id="state_id" name="state_id" required>  
                                <option value="">Select State</option>
                                    @foreach ($state as $item)
                                        <option value="{{$item->id}}">{{$item->state_name}}</option>
                                    @endforeach      
                            </select>
                            {{-- {!! Form::select('state_id', $state, '', ['id'=>'state_id','class' => 'mySelect2Modal','required'])!!} --}}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-semi-bold ">Location</label>
                        <div class="col-lg-7 col-xl-10" id="locationdata" style="margin-top:10px;">
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



