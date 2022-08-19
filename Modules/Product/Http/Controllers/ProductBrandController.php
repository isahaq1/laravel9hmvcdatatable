<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Brand;
use Modules\Product\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Entities\ProductCategory;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('product::__brand_list',[
            'brand' => Brand::get()
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
        if(Brand::where('brand_name', $request->brand_name)->first()){
            $response = array(
                'success'  =>false,
                'title'=>'Product Brand',
                'message'  => 'This name alredy exist'
            );
    
            return json_encode($response);
        }else{
            Brand::create($request->all());
            $response = array(
                'success'  =>true,
                'title'=>'Product Brand',
                'message'  => 'Update successfully'
            );
    
            return json_encode($response);
        }
        
    }


    public function show($id)
    {
        return view('product::show');
    }


    public function edit($id)
    {
        $data = Brand::find($id);
        return response()->json(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        Brand::where('id',$id)->update(['brand_name'=>$request->brand_name]);
        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );

        return json_encode($response);
    }

    
    public function destroy($id)
    {

        if(Product::where('brand_id',$id)->first()){

            $response = array(
                'success'  =>false,
                'title'=>'Brand Category',
                'message'  => 'Brand alredy exist in product'
            );
            return json_encode($response);

        }else{

            $brand = Brand::findOrFail($id);
            $brand->delete();
            $response = array(
                'success'  =>true,
                'title'=>'Product Brand',
                'message'  => 'Delete successfully'
            );
            return json_encode($response);
        }
        
    }


}
