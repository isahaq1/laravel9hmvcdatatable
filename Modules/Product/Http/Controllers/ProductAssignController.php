<?php

namespace Modules\Product\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAssign;
use Illuminate\Contracts\Support\Renderable;

class ProductAssignController extends Controller
{
    
    public function index()
    {

        $sql = ProductAssign::select("product_assigns.*","users.name","clients.client_name","products.product_name");
        $sql->join("users","users.id","=","product_assigns.user_id");
        $sql->join("clients","clients.id","=","product_assigns.client_id");
        $sql->join("products","products.id","=","product_assigns.product_id");
        $data = $sql->get();

        $client = Client::get(['client_name','id']);
        $user = User::where(['user_type'=>3,'status'=>1])->get(['name','id']);


        return view('product::__assign_list',[
            'assignlist'    =>  $data,
            'client'        =>  $client,
            'user'          =>  $user,
            'ptitle'        =>  'Product List'
        ]);

    }

   
    public function create()
    {
        return view('product::create');
    }


    public function store(Request $request)
    {
        
        foreach ($request->product_id as $value) {

            if(ProductAssign::where('product_id',$value)->where('user_id',$request->user_id)->first()){

            }else{
                $data['product_id'] = $value;
                $data['user_id'] = $request->user_id;
                $data['client_id'] = $request->client_id;
                ProductAssign::create($data);
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
        return view('product::show');
    }


    public function edit($id)
    {
        $data = ProductAssign::find($id);
        return response()->json(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
       
    }


    public function destroy($id)
    {

        $products = ProductAssign::findOrFail($id);
        $products->delete();
        $response = array(
            'success'  =>true,
            'message'  => 'Delete successfully'
        );
        return json_encode($response);

    }

    public function get_ajaxdata(Request $request)
    {
        
        $client_id = $request->client_id;

        if ($request->ajax()) {

            $sql = ProductAssign::select("product_assigns.*","users.name","clients.client_name","products.product_name","products.product_image");
            $sql->join("users","users.id","=","product_assigns.user_id");
            $sql->join("clients","clients.id","=","product_assigns.client_id");
            $sql->join("products","products.id","=","product_assigns.product_id");
            $data = $sql->get();
            
            if(!empty($client_id)){
                $sql->where('client_id', $client_id);
            }
            $data = $sql->get();


            return DataTables::of($data)->addIndexColumn()

                ->addColumn('product_image', function ($data) {
                    if($data->product_image){
                        $imag = url('/public/'.$data->product_image);
                    }else{
                        $imag = url('public/assets/dist/img/avatar-1.jpg');
                    }
                    $image = '<img src="'.$imag.'" width="50">';
                    return $image;
                })
                
                ->addColumn('product_name', function ($data) {
                    return $data->product_name;
                })


                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })

                ->addColumn('name', function ($data) {
                    return $data->name;
                })

             
                ->addColumn('action', function($data){
                    $actionBtn='';
                    $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('product-assign.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })

            ->rawColumns([ 'product_image', 'product_name','client_name','name', 'action'])
            ->make(true);
        }

    }


    public function productlist(Request $request){

        $product = Product::where('client_id',$request->client_id)->get();

        $products='';
        foreach ($product as $key => $val) {
            $products .= '<div class="form-check form-check-inline">
                <input class="form-check-input" name="product_id[]" type="checkbox" id="'.$val->id.'" value="'.$val->id.'">
                <label class="form-check-label" for="'.$val->id.'">'.$val->product_name.'</label>
            </div>';
        }
        $response = array(
            'success'  =>true,
            'message'  => $products 
        );
        return json_encode($response);
    }


}
