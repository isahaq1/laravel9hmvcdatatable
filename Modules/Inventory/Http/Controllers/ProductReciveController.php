<?php

namespace Modules\Inventory\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Inventory\Entities\Store;
use Modules\Product\Entities\Product;
use Modules\Inventory\Entities\InvRecive;
use Illuminate\Contracts\Support\Renderable;
use Modules\Inventory\Entities\InvReciveDetail;
use Modules\Inventory\Entities\InvStock;

class ProductReciveController extends Controller
{

    public function index()
    {
        $client = Client::get(['client_name','id']);
        $Store = Store::get(['store_name','id']);
        return view('inventory::__product_recive',[
            'ptitle'=>'Product Receive List',
            'client'=>$client,
            'store'=>$Store
        ]);
    }

 
    public function create()
    {
        return view('inventory::create');
    }

    public function store(Request $request)
    {
        $receiveData['mrr_no'] = $request->mrr_no;
        $receiveData['receive_date'] = $request->receive_date;
        $receiveData['client_id'] = $request->client_id;
        $receiveData['store_id'] = $request->store_id;
        $receiveData['description'] = $request->description;

        $info = InvRecive::create($receiveData);

        $case_qty = $request->case_qty;
        $unit_qty = $request->unit_qty;
        $unit_price = $request->unit_price;
        $trade_price = $request->trade_price;
        $product_id = $request->product_id;

        $id = $info->id;


        foreach ($product_id as $key => $value) {
            $unitprice = $unit_price[$key];

            if($unitprice){
                $details['recive_id'] = $id;
                $details['product_id'] = $value;
                $details['case_qty'] = @$case_qty[$key];
                $details['unit_qty'] = @$unit_qty[$key];
                $details['unit_price'] = $unit_price[$key];
                $details['trade_price'] = $trade_price[$key];
                InvReciveDetail::create($details);

            }

        }

        $response = array(
            'success'  =>true,
            'message'  => 'Add successfully'
        );
        return json_encode($response);
    }


    public function show($id)
    {

        $sql = InvRecive::select("inv_recives.*","clients.client_name");
        $sql->join("clients","clients.id","=","inv_recives.client_id");
        $sql->where('inv_recives.id',$id);
        $data = $sql->first();

        $products = InvReciveDetail::where('recive_id',$id)->get();

        $html = '<table class="table table-bordered w-100"><tr><th>SL.</th><th>Product Name</th><th class="text-right">Case QTY</th><th class="text-center">Unit QTY</th><th class="text-right">Unit Price</th><th class="text-right">Treade Price</th></tr>';
        $sl = 0;
        foreach($products as $item_row)
        {
            $sl++;
            $html .= '<tr>
                        <td>'.$sl.'</td>
                        <td>'.$item_row->product->product_name.' ('.$item_row->product->product_short_code.')
                            <input type="hidden" class="form-control" name="product_id[]" value="'.$item_row->id.'">
                        </td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->unit_qty.'" readonly></td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->case_qty.'" readonly></td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->unit_price.'" readonly></td>
                        <td align="right"><input type="text" class="form-control" value="'.$item_row->trade_price.'" readonly></td>
                    </tr>';
               

        }
        $html .= '</table>';

        $response = array(
            'success'  =>true,
            'data'  => $data,
            'details'=> $html
        );
        return json_encode($response);


    }


    public function edit($id)
    {

        $sql = InvRecive::select("inv_recives.*","clients.client_name");
        $sql->join("clients","clients.id","=","inv_recives.client_id");
        $sql->where('inv_recives.id',$id);
        $data = $sql->first();

        $response = array(
            'success'  =>true,
            'data'  => $data
        );
        return json_encode($response);

    }


    public function update(Request $request, $id)
    {
        
        $receiveData['receive_date']    = $request->receive_date;
        $receiveData['client_id']       = $request->client_id;
        $receiveData['store_id']        = $request->store_id;
        $receiveData['description']     = $request->description;

        if(InvRecive::where('id',$id)->update($receiveData)){

            //delete deatails
            InvReciveDetail::where('recive_id',$id)->delete();

            $case_qty       = $request->case_qty;
            $unit_qty       = $request->unit_qty;
            $unit_price     = $request->unit_price;
            $trade_price    = $request->trade_price;
            $product_id     = $request->product_id;
    
    
            foreach ($product_id as $key => $value) {
                $unitprice = $unit_price[$key];
    
                if($unitprice){
                    $details['recive_id']   = $id;
                    $details['product_id']  = $value;
                    $details['case_qty']    = @$case_qty[$key];
                    $details['unit_qty']    = @$unit_qty[$key];
                    $details['unit_price']  = $unit_price[$key];
                    $details['trade_price'] = $trade_price[$key];
                    InvReciveDetail::create($details);
    
                }
    
            }

        }

        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );
        return json_encode($response);
    }


    public function destroy($id)
    {
        if(InvRecive::findOrFail($id)->delete()){
            InvReciveDetail::where('recive_id',$id)->delete();
            $response = array(
                'success'  =>true,
                'message'  => 'Delete successfully'
            );
        }
        return json_encode($response);
    }


    public function approveReceive(Request $request){

        $id = $request->id;
        $info = InvRecive::where(['id'=>$id,'status'=>0])->first();

        if($info){

            $productinfo = InvReciveDetail::where('recive_id',$info->id)->get();

            foreach($productinfo as $item){

                // return $info;

                $stockinfo = InvStock::where([
                    'client_id'=>$info->client_id,
                    'product_id'=>$item->product_id,
                    'store_id'=>$info->store_id
                    ])->first();
                
                
                if($stockinfo){

                    $updatedata['stock_case_qty'] = $stockinfo->stock_case_qty	+ $item->case_qty;
                    $updatedata['stock_unit_qty'] = $stockinfo->stock_unit_qty	+ $item->unit_qty;

                    InvStock::where(['client_id'=>$info->client_id,'store_id'=>$info->store_id,'product_id'=>$item->product_id])->update($updatedata);
                
                }else{

                    $data['client_id']  = $info->client_id;
                    $data['store_id']   = $info->store_id;
                    $data['product_id'] = $item->product_id;
                    $data['stock_case_qty'] = $item->case_qty;
                    $data['stock_unit_qty'] = $item->unit_qty;

                    InvStock::create($data);

                }
            }

            InvRecive::where('id',$id)->update(['status'=>1]);

            $response = array(
                'success'   =>  true,
                'title'     =>  'Receive Product',
                'message'   =>  'Approve successfully'
            );
            return json_encode($response);


        }else{
            $response = array(
                'success'  =>false,
                'title'=>'Receive Product',
                'message'  => 'Sorray Fail'
            );
            return json_encode($response);
        }
        

    }




    public function getProductByClient(Request $request){

        if($request->id!=''){

            $products = InvReciveDetail::where('recive_id',$request->id)->get();
            $html = '<table class="table table-bordered w-100"><tr><th>SL.</th><th>Product Name</th><th class="text-right">Case QTY</th><th class="text-center">Unit QTY</th><th class="text-right">Unit Price</th><th class="text-right">Treade Price</th></tr>';
            $sl = 0;
            foreach($products as $item_row)
            {
                $sl++;

                $html .= '<tr>
                            <td>'.$sl.'</td>
                            <td>'.$item_row->product->product_name.' ('.$item_row->product->product_short_code.')
                                <input type="hidden" class="form-control" name="product_id[]" value="'.$item_row->product_id.'">
                            </td>
                            <td align="right"><input type="text" class="form-control" name="case_qty[]" value="'.$item_row->case_qty.'"></td>
                            <td align="right"><input type="text" class="form-control" name="unit_qty[]" value="'.$item_row->unit_qty.'"></td>
                            <td align="right"><input type="text" class="form-control" name="unit_price[]" value="'.$item_row->unit_price.'" required></td>
                            <td align="right"><input type="text" class="form-control" name="trade_price[]" value="'.$item_row->trade_price.'" required></td>
                        </tr>';

            }
            $html .= '</table>';

            return $html;


        }else{

            $products = Product::where('client_id',$request->client_id)->get();
            $html = '<table class="table table-bordered w-100"><tr><th>SL.</th><th>Product Name</th><th class="text-right">Case QTY</th><th class="text-center">Unit QTY</th><th class="text-right">Unit Price</th><th class="text-right">Treade Price</th></tr>';
            $sl = 0;
            foreach($products as $item_row)
            {
                $sl++;
                $html .= '<tr>
                            <td>'.$sl.'</td>
                            <td>'.$item_row->product_name.' ('.$item_row->product_short_code.')
                                <input type="hidden" class="form-control" name="product_id[]" value="'.$item_row->id.'">
                            </td>
                            <td align="right"><input type="text" class="form-control" name="case_qty[]"></td>
                            <td align="right"><input type="text" class="form-control" name="unit_qty[]"></td>
                            <td align="right"><input type="text" class="form-control" name="unit_price[]" required></td>
                            <td align="right"><input type="text" class="form-control" name="trade_price[]" required></td>
                        </tr>';
                   
    
            }
            $html .= '</table>';
            return $html;
        }
        

    }


    
    public function getReceiveList(Request $request)
    {
        
        $client_id = $request->client_id;

        if ($request->ajax()) {

            $sql = InvRecive::select("inv_recives.*","clients.client_name","stores.store_name");
            $sql->join("clients","clients.id","=","inv_recives.client_id");
            $sql->join("stores","stores.id","=","inv_recives.store_id");
            $data = $sql->get();

            return DataTables::of($data)->addIndexColumn()
                
               
                ->addColumn('mrr_no', function ($data) {
                    return $data->mrr_no;
                })

                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })

                ->addColumn('store_name', function ($data) {
                    return $data->store_name;
                })

                ->addColumn('receive_date', function ($data) {
                    return $data->receive_date;
                })

                ->addColumn('status', function ($data) {

                    if(@$data->status==0){
                        $status = '<span class="badge bg-warning text-dark">Panding</span>';
                    }else{
                        $status = '<span class="badge bg-success">Received</span>';
                    }
                    return $status;
                    
                })

                ->addColumn('action', function($data){
                    $actionBtn= '<a href="javascript:void(0)" id="viewAction"  data-view-route="'.route('product-recive.show',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a> '; 
                    if(@$data->status=0){
                        $actionBtn .= '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('product-recive.update',$data->id).'" data-edit-route="'.route('product-recive.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                        $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('product-recive.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    }
                    return $actionBtn;
                })

            ->rawColumns([ 'mrr_no', 'client_name','store_name','receive_date','status', 'action'])
            ->make(true);
        }

    }

}
