<?php

namespace Modules\VisitProcess\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Location;
use Illuminate\Contracts\Support\Renderable;
use Modules\VisitProcess\Entities\RoutePlan;
use Modules\VisitProcess\Entities\RoutePlanDetail;

class RoutePlaneController extends Controller
{
   
    public function index()
    {
        $state = State::get(['state_name','id']);
        $client = Client::get(['client_name','id']);
        $user = User::where(['user_type'=>3,'status'=>1])->get(['name','id']);

        return view('visitprocess::__route_plane_list',[
            'state'=>$state,
            'client'=>$client,
            'user'=>$user,
            'ptitle'=>'Route Plane List'
        ]);
        
    }


    public function create()
    {
        return view('visitprocess::create');
    }


    public function store(Request $request)
    {

        $routeplane['user_id'] = $request->user_id;
        $routeplane['state_id']=$request->state_id;
        $routeplane['day_of_week'] = $request->day_of_week;

        if($inserdata = RoutePlan::create($routeplane)){

            foreach ($request->location_id as $value) {

                $data['route_plane_id'] = $inserdata->id;
                $data['location_id'] = $value;
                RoutePlanDetail::create($data);
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
        return view('visitprocess::show');
    }


    public function edit($id)
    {
        $routeplane = RoutePlan::findOrFail($id);
        $response = array(
            'success'  =>true,
            'data'  => $routeplane
        );
        return json_encode($response);

    }


    public function update(Request $request, $id)
    {

        if(RoutePlan::findOrFail($id)->delete()){
        }

        $routeplane['user_id'] = $request->user_id;
        $routeplane['state_id']=$request->state_id;
        $routeplane['day_of_week'] = $request->day_of_week;

        if($inserdata = RoutePlan::create($routeplane)){
            foreach ($request->location_id as $value) {
                $data['route_plane_id'] = $inserdata->id;
                $data['location_id'] = $value;
                RoutePlanDetail::create($data);
            }
        }
        
        $response = array(
            'success'  =>true,
            'message'  => 'Add successfully'
        );
        return json_encode($response);
    }


    public function destroy($id)
    {
        if(RoutePlan::where('id',$id)->delete()){
            RoutePlanDetail::where('route_plane_id',$id)->delete();
            $response = array(
                'success'  =>true,
                'message'  => 'Delete successfully'
            );
        }
        return json_encode($response);
    }



    public function getLocation(Request $request){

      
        $locationData = Location::where('state_id',$request->state_id)->get();

        $locations='';
        foreach ($locationData as $key => $val) {

            $checked ='';

            if($request->id!==''){
                $details = RoutePlanDetail::where('route_plane_id',$request->id)->where('location_id',$val->id)->first();

                if($details){
                    $checked = "checked";
                }else{
                    $checked = ""; 
                }
            }

            $locations .= '<div class="form-check form-check-inline">
                <input class="form-check-input" name="location_id[]" '.@$checked.' type="checkbox" id="'.$val->id.'" value="'.$val->id.'">
                <label class="form-check-label" for="'.$val->id.'">'.$val->location_name.'</label>
            </div>';
        }
        $response = array(
            'success'  =>true,
            'message'  => $locations 
        );
        return json_encode($response);
    }



    public function get_route_plane(Request $request)
    {
        
        $client_id = $request->client_id;

        if ($request->ajax()) {

            return DataTables::of($data=RoutePlan::routePlaneList($request))->addIndexColumn()
                
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('day_of_week', function ($data) {
                    return $data->day_of_week;
                })

                ->addColumn('created_at', function ($data) {
                    return $data->created_at;
                })
             
                ->addColumn('action', function($data){
                    $actionBtn= $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('route-plane.update',$data->id).'" data-edit-route="'.route('route-plane.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                    $actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('route-plane.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })

            ->rawColumns([ 'name', 'day_of_week','created_at', 'action'])
            ->make(true);
        }

    }


}
