<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-xl">

        <form action="" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
  
            @csrf

            <div class="modal-content">
                <input type="hidden" name="_method" id="acmethod"  value="">


                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">

                    <div class="row">


                        <div class="col-12 col-lg-6">

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Product Name </label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="text" placeholder="Product Name" id="product_name" name="product_name" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Short Code</label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="text" placeholder="Short Code" id="product_short_code" name="product_short_code">
                                </div>
                            </div>

                            
                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Product image</label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input type="file" class="form-control-file" id="" name="product_image">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold">Description </label>
                                <div class="col-xl-9 col-xxl-10">
                                    <textarea class="form-control" id="product_description" name="product_description"  rows="3"></textarea>
                                </div>
                            </div>

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

                        </div>
                        

                        <div class="col-12 col-lg-6">

                            

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Recommended Retail Price </label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input type="number" class="form-control" placeholder="Recommended Retail Price" id="rec_retail_price" name="rec_retail_price">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Unit Per Case </label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="number" placeholder="Unit Per Case" id="unit_per_case" name="unit_per_case">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Case Discount</label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="number" placeholder="Case Discount" id="case_discount" name="case_discount">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Unit Price </label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="number" placeholder="Unit Price *" id="unit_price" name="unit_price">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">Sales Price </label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="number" placeholder="Sales Price" id="sales_price" name="sales_price">
                                </div>
                            </div>

                    

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">ROL Qty</label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="number" id="reorder_level_qty" name="reorder_level_qty" >
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-xl-3 col-xxl-2 col-form-label text-end fw-semi-bold ">MST QTY</label>
                                <div class="col-xl-9 col-xxl-10">
                                    <input class="form-control" type="number" id="mst_qty" name="mst_qty">
                                </div>
                            </div>

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



