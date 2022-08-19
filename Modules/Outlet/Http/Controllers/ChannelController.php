<?php

namespace Modules\Outlet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Outlet\Entities\Outlet;
use Illuminate\Support\Facades\Validator;
use Modules\Outlet\Entities\OutletChannel;
use Illuminate\Contracts\Support\Renderable;
use Modules\Outlet\Http\Requests\ChannelRequest;

class ChannelController extends Controller
{
        /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $OutletChannel = OutletChannel::withoutGlobalScopes([Asc::class])->get();
        return view('outlet::__outlet_channel',[
            'ptitle'=>'Outlet Channel List',
            'types' =>$OutletChannel
        ]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('outlet::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        //return $request->all();
        $validator = Validator::make($request->all(), [
            'channel_name'      => 'required'
        ]);

        if ($validator->fails()) {

            return $validator->errors();

            $response = array(
                'success'  =>false,
                'message'  => $validator->errors(),
                'title'    => 'Outlet Channel'
            );
            return json_encode($response);
        }

        $data['channel_name']           = $request->channel_name;
        $data['channel_description']    = $request->channel_description;
        OutletChannel::create($data);

        $response = array(
            'success'  =>true,
            'message'  => 'Added successfully'
        );

        return json_encode($response);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('outlet::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = OutletChannel::find($id);
        return response()->json(['data'=>$data]);

        //return view('outlet::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate([
            'channel_name' => 'required'
        ]);
        
        $data['channel_name']    = $request->channel_name;
        $data['channel_description'] = $request->channel_description;
        //return $data;
        OutletChannel::where('id',$request->id)->update($data);
        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );

        return json_encode($response);
    }



    public function destroy($id)
    {

        if(outlet::where('channel_id',$id)->first()){
            $response = array(
                'success'  =>false,
                'message'  => 'Outlet Type Alredy Exist',
                'titlet'    =>'Outlet Type List'
            );

        }else{
            OutletChannel::where('id',$id)->delete();
            $response = array(
                'success'  =>true,
                'message'  => 'Delete successfully'
            );
        }
        return json_encode($response);
        
    }
}
