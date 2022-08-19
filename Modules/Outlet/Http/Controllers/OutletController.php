<?php
namespace Modules\Outlet\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Outlet\Entities\Outlet;

use Modules\Location\Entities\State;
use Modules\Location\Entities\Region;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Location;
use Modules\Outlet\Entities\OutletType;
use Illuminate\Support\Facades\Validator;
use Modules\Outlet\Entities\OutletChannel;
use Illuminate\Contracts\Support\Renderable;

use Illuminate\Validation\ValidationException;
use Modules\Outlet\Http\Requests\OutletRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class OutletController extends Controller
{
    
    public function index()
    {

        $channels   = OutletChannel::get(['channel_name','id']);
        $OutletType = OutletType::get(['type_name','id']);

        $Location   = Location::get(['location_name','id']);
        $Region     = Region::get(['region_name','id']);
        $country   = Country::get(['country_name','id']);
        $state     = State::get(['state_name','id']);


        //cdd($OutletType);
        return view('outlet::__outletlist',[
            'channels'  => $channels,
            'types'     => $OutletType,
            'country'    => $country,
            'state'    => $state,
            'region'    => $Region,
            'location'  => $Location,
            'ptitle'    => 'Outlet List'
        ]);
        
    }

    
    public function create()
    {
        $channels = OutletChannel::pluck('channel_name','id');
        $OutletType = OutletType::pluck('type_name','id');
        $Location = Location::pluck('type_name','id');
        $Region = Region::pluck('type_name','id');

        $ptitle = 'Create Outlet';
        return view('outlet::__create_outlet',[
            'ptitle'=>$ptitle,
            'channels'=>$channels,
            'types'=>$OutletType
        ]);

    }

    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required',
            'outlet_phone' => 'required',
        ]);

        if ($validator->fails()) {

            $response = array(
                'success'  =>false,
                'message'  => $validator->errors()->all()
            );
            return json_encode($response);
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
        $data['type_id']    = $request->type_id;
        $data['channel_id']    = $request->channel_id;
        $data['outlet_name'] = $request->outlet_name;
        $data['outlet_phone'] = $request->outlet_phone;

        $data['region_id']    = $request->region_id;
        $data['location_id'] = $request->location_id;
        $data['street_no'] = $request->street_no;
        $data['street_name'] = $request->street_name;
        $data['gio_lat'] = $request->gio_lat;
        $data['gio_long'] = $request->gio_long;
        $data['cpf_name'] = $request->cpf_name;
        $data['cpl_name'] = $request->cpl_name;
        $data['cpp'] = $request->cpp;
        $data['is_bso'] = $request->isbso;

        Outlet::create($data);
    
        $response = array(
            'success'  =>true,
            'title'    =>'Outlet',
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
        $data = Outlet::find($id);
        return response()->json(['data'=>$data]);
    }

    

    public function outletUpdate(Request $request, $id)
    {
        
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
        $data['is_bso']         = $request->isbso;


        //return $data;
        Outlet::where('id',$request->id)->update($data);

        $response = array(
            'success'  =>true,
            'message'  => 'Update successfully'
        );

        return json_encode($response);
    }

    
    public function destroy($id)
    {
        $OutletChannel = Outlet::findOrFail($id);
        $OutletChannel->delete();
        $response = array(
            'success'  =>true,
            'message'  => 'Delete successfully'
        );
        return json_encode($response);
    }


    public function get_ajaxdata(Request $request)
    {
     

        if ($request->ajax()) {

            
            return DataTables::of($data = Outlet::getOutletList($request))->addIndexColumn()

                    ->addColumn('image', function ($data) {
                        if($data->outlet_image){
                            $imag = url('/public/'.$data->outlet_image);
                        }else{
                            $imag = url('public/assets/dist/img/avatar-1.jpg');
                        }
                        $image = '<img src="'.$imag.'" width="50">';
                        return $image;
                    })
                    
                    ->addColumn('outlet_name', function ($data) {
                        return $data->outlet_name;
                    })

                    ->addColumn('type_name', function ($data) {
                        return $data->type_name;
                    })

                    ->addColumn('channel_name', function ($data) {
                        return $data->channel_name;
                    })

                    ->addColumn('outlet_phone', function ($data) {
                        return $data->outlet_phone;
                    })

                    ->addColumn('outlet_cp', function ($data) {
                        return $data->cpf_name.' '.$data->cpl_name;
                    })

                    ->addColumn('action', function($data){
                        $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('update_outlet',$data->id).'" data-edit-route="'.route('outlet_edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                        $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('delete_outlet',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                        return $actionBtn;
                    })

                ->rawColumns([ 'image', 'outlet_name','type_name','channel_name','outlet_cp', 'outlet_phone','action'])
                ->make(true);
        }

    }

}
