<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Entities\ProductCategory;

class ProductCategoryController extends Controller
{
  
    public function index()
    {

        return view('product::__category_list',[
            'categories' => ProductCategory::get()
        ]);

    }

   
    public function create()
    {
        return view('product::create');
    }


    public function store(Request $request)
    {
        if(ProductCategory::where('category_name', $request->category_name)->first()){
            $response = array(
                'success'  =>false,
                'title'=>'Product Category',
                'message'  => 'This name alredy exist'
            );
    
            return json_encode($response);
        }else{
            ProductCategory::create($request->all());
            $response = array(
                'success'  =>true,
                'title'=>'Product Category',
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
        $data = ProductCategory::find($id);
        return response()->json(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        ProductCategory::where('id',$id)->update(['category_name'=>$request->category_name]);
        $response = array(
            'success'  =>true,
            'title'=>'Product Category',
            'message'  => 'Update successfully'
        );

        return json_encode($response);
    }

    
    public function destroy($id)
    {
        if(Product::where('category_id',$id)->first()){
            $response = array(
                'success'  =>false,
                'title'=>'Product Category',
                'message'  => 'Category alredy exist in product'
            );
            return json_encode($response);
        }else{
            $categories = ProductCategory::findOrFail($id);
            $categories->delete();

            $response = array(
                'success'  =>true,
                'title'=>'Product Category',
                'message'  => 'Delete successfully'
            );
            return json_encode($response);
        }
        
    }

}
