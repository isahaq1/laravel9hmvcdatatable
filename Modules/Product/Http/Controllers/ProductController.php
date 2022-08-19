<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Brand;
use Modules\Product\Entities\ProductCategory;

use Auth;

class ProductController extends Controller
{
    
    public function index()
    {
        $client = Client::pluck('client_name','id');
        $brand = Brand::pluck('brand_name','id');
        $category = ProductCategory::pluck('category_name','id');


        return view('product::__product_list',[
            'client'=>$client,
            'brand'=>$brand,
            'category'=>$category,
            'ptitle'=>'Product List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }


    public function store(Request $request)
    {

        $product = $request->all();
        $product['create_by']=Auth::user()->id;
        $product['p_type']=1;

        if ($request->file('product_image')) {
            $directory = '/uploads/product-images/';
            $file = $request->file('product_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $product['product_image'] = $directory.$filename;
        }

        Product::create($product);

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
        $data = Product::find($id);
        return response()->json(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {

        $product = $request->all();
        $product =$request->except(['_token','_method']);

        if ($request->file('product_image')) {
            $directory = '/uploads/product-images/';
            $file = $request->file('product_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $product['product_image'] = $directory.$filename;
        }

        Product::where('id',$id)->update($product);

        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );
        return json_encode($response);
    }


    public function destroy($id)
    {
        $products = Product::findOrFail($id);
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
        $brand_id = $request->brand_id;
        $category_id = $request->category_id;

        if ($request->ajax()) {

            $sql = Product::select("products.*","product_categories.category_name","brands.brand_name","clients.client_name");
            $sql->join("product_categories","product_categories.id","=","products.category_id");
            $sql->join("brands","brands.id","=","products.brand_id");
            $sql->join("clients","clients.id","=","products.client_id");
            
            if(!empty($client_id)){
                $sql->where('client_id', $client_id);
            }
            if(!empty($brand_id)){
                $sql->where('brand_id', $brand_id);
            }
            if(!empty($category_id)){
                $sql->where('category_id', $category_id);
            }
            
            $sql->where('p_type', 1);
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

                ->addColumn('product_short_code', function ($data) {
                    return $data->product_short_code;
                })

                ->addColumn('client_name', function ($data) {
                    return $data->client_name;
                })

                ->addColumn('brand_name', function ($data) {
                    return $data->brand_name;
                })

                ->addColumn('category_name', function ($data) {
                    return $data->category_name;
                })

                ->addColumn('action', function($data){
                    $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('products.update',$data->id).'" data-edit-route="'.route('products.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                    $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('products.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })

            ->rawColumns([ 'product_image', 'product_name','product_short_code','client_name','brand_name', 'category_name','action'])
            ->make(true);
        }

    }

}
