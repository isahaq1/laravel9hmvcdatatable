<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Brand;
use Modules\Product\Entities\Product;
use Modules\Outlet\Entities\OutletType;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Entities\ProductCategory;

use Auth;

class PosmsController extends Controller
{
   
    public function index()
    {

        $sql = Product::select("products.*","product_categories.category_name","brands.brand_name","clients.client_name","outlet_types.type_name");
        $sql->join("product_categories","product_categories.id","=","products.category_id");
        $sql->join("brands","brands.id","=","products.brand_id");
        $sql->join("clients","clients.id","=","products.client_id");
        $sql->join("outlet_types","outlet_types.id","=","products.outlet_type_id");
        $data = $sql->get();


        $client = Client::pluck('client_name','id');
        $brand = Brand::pluck('brand_name','id');
        $category = ProductCategory::pluck('category_name','id');
        $outlet_type = OutletType::pluck('type_name','id');

        return view('product::__posms_item',[
            'products'=>$data,
            'client'=>$client,
            'brand'=>$brand,
            'category'=>$category,
            'outlet_type'=>$outlet_type,
            'ptitle'=>'Product List'
        ]);

    }


    public function create()
    {
        return view('product::create');
    }

 
    public function store(Request $request)
    {
        $product = $request->all();
        $product['create_by']=Auth::user()->id;
        $product['p_type']=2;

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
}
