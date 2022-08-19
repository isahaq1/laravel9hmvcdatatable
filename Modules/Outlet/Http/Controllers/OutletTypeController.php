<?php

namespace Modules\Outlet\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Outlet\Entities\OutletType;
use Modules\Outlet\Entities\Outlet;

class OutletTypeController extends Controller
{
  
    public function index()
    {

        $OutletType = OutletType::withoutGlobalScopes([Asc::class])->get();

        return view('outlet::__outlet_type',[
            'ptitle'=>'Outlet Type List',
            'types' =>$OutletType
        ]);
    }

    
    public function create()
    {
        return view('outlet::create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'type_name' => 'required|unique:outlet_types'
        ]);
        
        $data['type_name']    = $request->type_name;
        $data['type_description'] = $request->type_description;
        //return $data;
        OutletType::create($data);
        $response = array(
            'success'  =>true,
            'message'  => 'Added successfully'
        );

        return json_encode($response);

    }

   
    public function show($id)
    {
        return view('outlet::show');
    }

 
    public function edit($id)
    {
        $data = OutletType::find($id);
        return response()->json(['data'=>$data]);

        //return view('outlet::edit');
    }


    public function update(Request $request)
    {
        $request->validate([
            'type_name' => 'required'
        ]);
        
        $data['type_name']    = $request->type_name;
        $data['type_description'] = $request->type_description;
        //return $data;
        OutletType::where('id',$request->id)->update($data);
        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );

        return json_encode($response);
    }

   

    public function destroy($id)
    {

        if(outlet::where('type_id',$id)->first()){

            $response = array(
                'success'  =>false,
                'message'  => 'Outlet Type Alredy Exist',
                'titlet'    =>'Outlet Type List'
            );

            echo json_encode($response);
          
           
        }else{
            

            OutletType::where('id',$id)->delete();
    
            $response = array(
                'success'  =>true,
                'message'  => 'Delete successfully',
                'titlet'    =>'Outlet Type List'
            );
            return json_encode($response);
        }
        

    }
}
