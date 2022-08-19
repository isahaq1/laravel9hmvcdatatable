<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutletRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\OutletModel;
use Outlet;

class OutletController extends Controller
{

    public function index()
    {
        try {
            $outlet = OutletModel::select("outlets.*","outlet_types.type_name","outlet_channels.channel_name")
                ->join("outlet_types","outlet_types.id","=","outlets.type_id")
                ->join("outlet_channels","outlet_channels.id","=","outlets.channel_id")
                ->get();
            return sendSuccessResponse('Data Retrive Successfull !', $outlet, 200);

        } catch( QueryException $e){

            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }
        
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {  

        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required',
            'outlet_image' => 'required',
            'type_id' => 'required',
            'channel_id' => 'required'
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Client Site Error!', $validator->errors(), 400);
        }

        if ($request->file('outlet_image')) {
            $directory = '/uploads/outlet-images/';
            $file = $request->file('outlet_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $data['outlet_image'] = $directory.$filename;
        }else{
            $data['outlet_image'] = $request->old_image;
        }

        $data['outlet_id'] = uniqueId() ;
        $data['type_id']        = $request->type_id;
        $data['channel_id']     = $request->channel_id;
        $data['outlet_name']    = $request->outlet_name;
        $data['outlet_phone']   = $request->outlet_phone;

        $data['region_id']      = $request->region_id;
        $data['location_id']    = $request->location_id;
        $data['street_no']      = $request->street_no;
        $data['street_name']    = $request->street_name;
        $data['gio_lat']        = $request->gio_lat;
        $data['gio_long']       = $request->gio_long;
        $data['cpf_name']       = $request->cpf_name;
        $data['cpl_name']       = $request->cpl_name;
        $data['cpp']            = $request->cpp;
        $data['is_bso']         = $request->is_bso;

        try {

            $outlets = OutletModel::create($data);
            return sendSuccessResponse('Created successfully !',$outlets,200);

        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }


    }

   
    public function show($id)
    {

        try {

            $outlet = OutletModel::select("outlets.*","outlet_types.type_name","outlet_channels.channel_name")
                ->join("outlet_types","outlet_types.id","=","outlets.type_id")
                ->join("outlet_channels","outlet_channels.id","=","outlets.channel_id")
                ->where('outlets.id',$id)
                ->get();

            return sendSuccessResponse('Data Retrive Successfull !', $outlet, 200);

        } catch( QueryException $e){

            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }
    }


    
    public function edit($id)
    {
        return "Edit";
    }

   
    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required',
            'outlet_image' => 'required',
            'type_id' => 'required',
            'channel_id' => 'required'
        ]);

        if ($validator->fails()) {
            return sendErrorResponse('Client Site Error!', $validator->errors(), 400);
        }

        if ($request->file('outlet_image')) {
            $directory = '/uploads/outlet-images/';
            $file = $request->file('outlet_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path().$directory, $filename);
            $data['outlet_image'] = $directory.$filename;
        }else{
            $data['outlet_image'] = $request->old_image;
        }

        $data['outlet_id'] = uniqueId() ;
        $data['type_id']        = $request->type_id;
        $data['channel_id']     = $request->channel_id;
        $data['outlet_name']    = $request->outlet_name;
        $data['outlet_phone']   = $request->outlet_phone;

        $data['region_id']      = $request->region_id;
        $data['location_id']    = $request->location_id;
        $data['street_no']      = $request->street_no;
        $data['street_name']    = $request->street_name;
        $data['gio_lat']        = $request->gio_lat;
        $data['gio_long']       = $request->gio_long;
        $data['cpf_name']       = $request->cpf_name;
        $data['cpl_name']       = $request->cpl_name;
        $data['cpp']            = $request->cpp;
        $data['is_bso']         = $request->is_bso;

        try {

            OutletModel::where('id',$id)->update($data);
            $outletinfo = OutletModel::findOrFail($id);
            
            return sendSuccessResponse('Updated successfully !',$outletinfo,200);

        } catch( QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }

    }


    public function destroy($id)
    {

        try{
            OutletModel::FindOrFail($id)->delete();
            return sendSuccessResponse([],'Delete successfully', 200);
        }catch(QueryException $e){
            return sendErrorResponse($e->getMessage,'Something Went Wrong!',500);
        }
       
    }

}
