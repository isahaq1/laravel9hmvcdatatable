<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">

        <form action="{{route('posms-item.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf

            <input type="hidden" name="_method" id="acmethod"  value="">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Client </label>
                        <div class="col-xl-9 col-xxl-10">
                            {!! Form::select('client_id', $client, '', ['id'=>'client_id','class' => 'mySelect2Modal','required'])!!}
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Brand </label>
                        <div class="col-xl-9 col-xxl-10">
                            {!! Form::select('brand_id', $brand, '', ['id'=>'brand_id','class' => 'mySelect2Modal','required'])!!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Category </label>
                        <div class="col-xl-9 col-xxl-10">
                            {!! Form::select('category_id', $category, '', ['id'=>'category_id','class' => 'mySelect2Modal','required'])!!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Outlet type </label>
                        <div class="col-xl-9 col-xxl-10">
                            {!! Form::select('outlet_type_id', $category, '', ['id'=>'outlet_type_id','class' => 'mySelect2Modal','required'])!!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-semi-bold ">Pos Item Name</label>
                        <div class="col-lg-7 col-xl-10">
                            <input class="form-control" type="text" id="product_name" name="product_name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-xxl-2  col-form-label text-end fw-semi-bold "> Pos Item Weight</label>
                        <div class="col-lg-7 col-xl-10">
                            <input class="form-control" type="text" id="product_weight" name="product_weight">
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



