<?php

namespace Modules\Inventory\Http\Controllers;

use Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Client\Entities\Client;
use Illuminate\Database\QueryException;
use Modules\Inventory\Entities\Checkout;
use Modules\Inventory\Entities\InvStock;
use Modules\Product\Entities\ProductAssign;
use Illuminate\Contracts\Support\Renderable;
use Modules\Inventory\Entities\CheckoutDetail;

class CheckoutController extends Controller
{
    
    public function index()
    {
        $client = Client::get(['client_name','id']);
        $user = User::where(['user_type'=>3,'status'=>1])->get(['name','id']);
        return view('inventory::__checkout_list',[
            'clients'=>$client,
            'users'=>$user
        ]);
    }

    
    public function create()
    {
        $client = Client::get(['client_name','id']);
        $user = User::where(['user_type'=>3,'status'=>1])->get(['name','id']);
        
        return view('inventory::__checkout_form',[
            'clients'=>$client,
            'users'=>$user
        ]);
    }

   
    public function store(Request $request)
    {
        
        // return $request->all();

            // try {
               // DB::transaction(function() use($data){ 


                    $checkoutdata['client_id']  = $request->client_id;
                    $checkoutdata['user_id']    = $request->user_id;
                    $checkoutdata['store_id']   = 1;
                    $checkoutdata['checkout_by']   = Auth::user()->id;
                    $checkoutdata['checkout_note'] = $request->checkout_note;
                
                    $checkout = Checkout::create($checkoutdata);

                    $checkout_id = $checkout->id;

                    $product_id     = $request->product_id;
                    $case_qty       = $request->case_qty;
                    $unit_qty       = $request->unit_qty;
                    $unit_price     = $request->unit_price;
                    $sales_price    = $request->sales_price;


                    if(!empty($case_qty) || !empty($unit_qty)){

                        foreach ($product_id as $key => $item) {
                            $checkDetails['checkout_id']    = $checkout_id;
                            $checkDetails['product_id']     = $item;
                            $checkDetails['case_qty']       = $case_qty[$key];
                            $checkDetails['unit_qty']       = $unit_qty[$key];
                            $checkDetails['unit_price']     = $unit_price[$key];
                            $checkDetails['trade_price']    = $sales_price[$key];
                            $checkout = CheckoutDetail::create($checkDetails);
                        }

                    }

                    $response = array(
                        'success'   =>  true,
                        'title'     =>  'Checkout',
                        'message'   =>  'Add successfully'
                    );
                    return json_encode($response);
                    
                // });
                
            // }catch (QueryException $e) {
            //     return sendErrorResponse('','Something Went Wrong!! Your transaction is Rolled Back',500);
            // }
    
    }

    
    public function show($id)
    {

        $sql = Checkout::select("checkouts.*","clients.client_name","stores.store_name","users.name");
        $sql->join("clients","clients.id","=","checkouts.client_id");
        $sql->join("stores","stores.id","=","checkouts.store_id");
        $sql->join("users","users.id","=","checkouts.user_id");
        $sql->where('checkouts.id', $id);
        $checkout = $sql->first();


        $sql = CheckoutDetail::select("checkout_details.*","products.product_name","products.product_short_code");
        $sql->join("products","products.id","=","checkout_details.product_id");
        $sql->where('checkout_details.checkout_id', $id);
        $details = $sql->get();


        $html = '<table class="table table-bordered w-100"><tr><th>SL.</th><th>Product Name</th><th class="text-right">Case QTY</th><th class="text-center">Unit QTY</th><th class="text-right">Unit Price</th><th class="text-right">Treade Price</th></tr>';
        $sl = 0;
        foreach($details as $item_row)
        {
            $sl++;
            $html .= '<tr>
                        <td>'.$sl.'</td>
                        <td>'.$item_row->product_name.' ('.$item_row->product_short_code.')
                            <input type="hidden" class="form-control" name="product_id[]" value="'.$item_row->product_id.'">
                        </td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->case_qty.'" readonly></td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->unit_qty.'" readonly></td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->unit_price.'" readonly></td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->trade_price.'" readonly></td>
                    </tr>';
        }
        $html .= '</table>';

        $response = array(
            'success'  =>true,
            'data'  => $checkout,
            'details'=> $html
        );
        return json_encode($response);
        
    }

    
    public function edit($id)
    {

        $sql = Checkout::select("checkouts.*","clients.client_name","stores.store_name","users.name");
        $sql->join("clients","clients.id","=","checkouts.client_id");
        $sql->join("stores","stores.id","=","checkouts.store_id");
        $sql->join("users","users.id","=","checkouts.user_id");
        $sql->where('checkouts.id', $id);
        $checkout = $sql->first();

        $sql = CheckoutDetail::select("checkout_details.*",
        "products.product_name",
        "products.sales_price",
        "products.unit_price",
        "products.product_image");
        $sql->join("products","products.id","=","checkout_details.product_id");
        $sql->where('checkout_details.checkout_id', $id);
        $details = $sql->get();


        $products = '';
        $i = 0;
        foreach($details as $val)
        {
            $stock = InvStock::where(['product_id'=>$val->product_id])->first();

            $products .= '<tr>
                <td>'.$i++.'</td>
                <td>'.$val->product_name.' 
                    <input type="hidden" name="product_id[]" class="form-control"  value="'.$val->product_id.'" readonly />
                    <input type="hidden" name="unit_price[]" class="form-control"  value="'.$val->unit_price.'" readonly />
                    <input type="hidden" name="sales_price[]" class="form-control"  value="'.$val->sales_price.'" readonly />
                </td>
                <td><input type="text" class="form-control text-end" min="1" value="'.$stock->stock_case_qty.'" readonly /></td>
                <td><input type="text" class="form-control text-end" min="1" value="'.$stock->stock_unit_qty.'" readonly /></td>
                <td><input type="number" name="case_qty[]" min="1" value="'.$val->case_qty.'" class="form-control text-end" autocomplete="off"/></td>
                <td><input type="number" name="unit_qty[]" min="1" value="'.$val->unit_qty.'" class="form-control text-end" autocomplete="off"/></td>
            </tr>';
           
        }


        $response = array(
            'success'  =>true,
            'data'  => $checkout,
            'details'=> $products
        );
        return json_encode($response);

        
    }

    
    public function update(Request $request, $id)
    {

        // return $request->all();

            // try {
               // DB::transaction(function() use($data){ 


                $checkoutdata['client_id']  = $request->client_id;
                $checkoutdata['user_id']    = $request->user_id;
                $checkoutdata['store_id']   = 1;
                $checkoutdata['checkout_note'] = $request->checkout_note;
            
                if(Checkout::where('id',$id)->update($checkoutdata)){
                    CheckoutDetail::where('checkout_id',$id)->delete();
                }

                $checkout_id    = $id;
                $product_id     = $request->product_id;
                $case_qty       = $request->case_qty;
                $unit_qty       = $request->unit_qty;
                $unit_price     = $request->unit_price;
                $sales_price    = $request->sales_price;


                if(!empty($case_qty) || !empty($unit_qty)){

                    foreach ($product_id as $key => $item) {

                        $checkDetails['checkout_id']    = $checkout_id;
                        $checkDetails['product_id']     = $item;
                        $checkDetails['case_qty']       = $case_qty[$key];
                        $checkDetails['unit_qty']       = $unit_qty[$key];
                        $checkDetails['unit_price']     = $unit_price[$key];
                        $checkDetails['trade_price']    = $sales_price[$key];

                        CheckoutDetail::create($checkDetails);
                    }

                }

                $response = array(
                    'success'   =>  true,
                    'title'     =>  'Checkout',
                    'message'   =>  'Update successfully'
                );
                return json_encode($response);
                
            // });
            
        // }catch (QueryException $e) {
        //     return sendErrorResponse('','Something Went Wrong!! Your transaction is Rolled Back',500);
        // }
        
    }

    
    public function destroy($id)
    {
        if(Checkout::where('id',$id)->delete()){
            CheckoutDetail::where('checkout_id',$id)->delete();
        }

        $response = array(
            'success'   =>  true,
            'title'     =>  'Checkout',
            'message'   =>  'Delete successfully'
        );
        return json_encode($response);
    }


    public function getCheckoutList(Request $request){

        $client_id = $request->client_id;

        if ($request->ajax()) {

            $sql = Checkout::select("checkouts.*","clients.client_name","stores.store_name","users.name");
            $sql->join("clients","clients.id","=","checkouts.client_id");
            $sql->join("stores","stores.id","=","checkouts.store_id");
            $sql->join("users","users.id","=","checkouts.user_id");
            $data = $sql->get();

            return DataTables::of($data)->addIndexColumn()
                
               
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })

                ->addColumn('store_name', function ($data) {
                    return $data->store_name;
                })

                ->addColumn('created_at', function ($data) {
                    return $data->created_at;
                })

                ->addColumn('status', function ($data) {

                    if(@$data->is_confirm==0){
                        $status = '<span class="badge bg-warning text-dark">Panding</span>';
                    }else{
                        $status = '<span class="badge bg-success">Confirm</span>';
                    }
                    return $status;
                    
                })

                ->addColumn('action', function($data){
                    $actionBtn= '<a href="javascript:void(0)" id="viewAction"  data-view-route="'.route('checkouts.show',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a> '; 
                    if(@$data->is_confirm==0){
                        $actionBtn .= '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('checkouts.update',$data->id).'" data-edit-route="'.route('checkouts.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                        $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('checkouts.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    }
                    return $actionBtn;
                })

            ->rawColumns([ 'name', 'client_name','store_name','created_at','status', 'action'])
            ->make(true);
        }

    }


    public function getUserProductList(Request $request){

        $sql = ProductAssign::select("product_assigns.*",
        "products.product_name",
        "products.sales_price",
        "products.unit_price",
        "products.product_image"
    );
        $sql->join("products","products.id","=","product_assigns.product_id");
        $sql->where(['product_assigns.client_id'=>$request->client_id,'product_assigns.user_id'=>$request->user_id]);
        $product = $sql->get();

        $products='';
        $i=1;

        foreach ($product as $key => $val) {

            $stock = InvStock::where(['product_id'=>$val->product_id])->first();

            $products .= '<tr>
                <td>'.$i++.'</td>
                <td>'.$val->product_name.' 
                    <input type="hidden" name="product_id[]" class="form-control"  value="'.$val->product_id.'" readonly />
                    <input type="hidden" name="unit_price[]" class="form-control"  value="'.$val->unit_price.'" readonly />
                    <input type="hidden" name="sales_price[]" class="form-control"  value="'.$val->sales_price.'" readonly />
                </td>
                <td><input type="text" class="form-control text-end" min="1" value="'.$stock->stock_case_qty.'" readonly /></td>
                <td><input type="text" class="form-control text-end" min="1" value="'.$stock->stock_unit_qty.'" readonly /></td>
                <td><input type="number" name="case_qty[]" min="1" class="form-control text-end" autocomplete="off"/></td>
                <td><input type="number" name="unit_qty[]" min="1" class="form-control text-end" autocomplete="off"/></td>
            </tr>';
        }

        $response = array(
            'success'  =>true,
            'message'  => $products 
        );
        return json_encode($response);


    }




}
