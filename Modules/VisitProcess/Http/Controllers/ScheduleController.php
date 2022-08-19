<?php

namespace Modules\VisitProcess\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Client\Entities\Client;
use Modules\Outlet\Entities\Outlet;
use Modules\Location\Entities\Location;
use Modules\Outlet\Entities\OutletChannel;
use Illuminate\Contracts\Support\Renderable;
use Modules\VisitProcess\Entities\RoutePlan;
use Modules\VisitProcess\Entities\VisitSchedule;
use Modules\VisitProcess\Entities\RoutePlanDetail;


class ScheduleController extends Controller
{
    
    public function index()
    {

        $user = User::where(['user_type'=>3,'status'=>1])->get(['name','id']);

        return view('visitprocess::__schedule_list',[
            'locations' => Location::orderBy('id','desc')->cursor(),
            'clients' => Client::orderBy('id','desc')->cursor(),
            'outletChannels' => OutletChannel::orderBy('id','desc')->cursor(),
            'outlets' => Outlet::orderBy('id','desc')->cursor(),
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

        $schedule['schedule_id'] = uniqueId();
        $schedule['user_id'] = $request->user_id;
        $schedule['schedule_date']=$request->schedule_date;
        $schedule['schedule_time'] = $request->schedule_time;
        $schedule['location_id'] = $request->location_id;
        $schedule['outlet_id'] = $request->outlet_id;

        //return $schedule;

        if(VisitSchedule::create($schedule)){
            $response = array(
                'success'  =>true,
                'message'  => 'Add successfully'
            );
            return json_encode($response);
        }
        
       
    }


    public function show($id)
    {
        return view('visitprocess::show');
    }

   
    public function edit($id)
    {
        $schedules = VisitSchedule::findOrFail($id);

        $response = array(
            'success'  =>true,
            'data'  => $schedules
        );
        return json_encode($response);
    }


    public function update(Request $request, $id)
    {

        $schedule['schedule_id'] = uniqueId();
        $schedule['user_id']    = $request->user_id;
        $schedule['schedule_date']=$request->schedule_date;
        $schedule['schedule_time'] = $request->schedule_time;
        $schedule['location_id'] = $request->location_id;
        $schedule['outlet_id'] = $request->outlet_id;

        //return $schedule;
        if(VisitSchedule::where('id',$id)->update($schedule)){
            $response = array(
                'success'  =>true,
                'message'  => 'Update successfully'
            );
            return json_encode($response);
        }else{
            $response = array(
                'success'  =>false,
                'message'  => 'Somethink is worng'
            );
            return json_encode($response);
        }

    }


    public function destroy($id)
    {
        //
    }




    public function getRoutePlanLocation(Request $request){

        $day  = date_to_day($request->schedule_date);
        $rp = RoutePlan::where(['user_id'=>$request->user_id,'day_of_week'=>$day])->first();

        if($rp){
            $sql = RoutePlanDetail::select("route_plan_details.*","locations.location_name");
            $sql->join("locations","locations.id","=","route_plan_details.location_id");
            $sql->where('route_plan_details.route_plane_id',$rp->id);
            $details = $sql->get();

            $locations='';
            $locations.='<option value="">Select Location</option>';
            foreach ($details as $key => $val) {
                $locations.='<option value="'.$val->location_id.'">'.$val->location_name.'</option>';

            }
            $response = array(
                'success'  =>true,
                'message'  => $locations 
            );
            return json_encode($response);

        }else{
            $response = array(
                'success'  =>true,
                'message'  => 'not found' 
            );
            return json_encode($response);
        }
      
    }


    public function getRouteWaisOutlet(Request $request){

        //$day  = date_to_day($request->schedule_date);
        $rp = Outlet::where(['location_id'=>$request->location_id])->get();
        if($rp){
            
            $outlets='';
            $outlets.='<option value="">Select Outlet</option>';
            foreach ($rp as $key => $val) {
                $outlets.='<option value="'.$val->outlet_id.'">'.$val->outlet_name.'</option>';
            }
            $response = array(
                'success'  =>true,
                'message'  => $outlets 
            );
            return json_encode($response);

        }else{
            $response = array(
                'success'  =>true,
                'message'  => 'not found' 
            );
            return json_encode($response);
        }
      
    }



    
    public function get_schedule_list(Request $request)
    {
        
        $clientid = $request->clientid;
        $outletid = $request->outletid;
        $channelid = $request->channelid;
        $locationid = $request->locationid;
        $fieldstaff_id = $request->fieldstaff_id;
        $outlet_type = $request->outlet_type;
        
        

        if ($request->ajax()) {

            $sql = VisitSchedule::select("visit_schedules.*","users.name",'outlets.outlet_name','locations.location_name');
            $sql->join("users","users.id","=","visit_schedules.user_id");
            $sql->join("outlets","outlets.outlet_id","=","visit_schedules.outlet_id");
            $sql->join("locations","locations.id","=","visit_schedules.location_id");

            if(!empty($outlet_type)){
                $sql->where('outlet_type_id', $outlet_type);
            }
            if(!empty($channelid)){
                $sql->where('visit_schedules.outelet_channel_id', $channelid);
            }
            if(!empty($locationid)){
                $sql->where('visit_schedules.location_id', $locationid);
            }
            if(!empty($clientid)){
                $sql->where('visit_schedules.client_id', $clientid);
            }
            if(!empty($outletid)){
                $sql->where('visit_schedules.outlet_id', $outletid);
            }
            if(!empty($fieldstaff_id)){
                $sql->where('visit_schedules.user_id', $fieldstaff_id);
            }
            if(!empty($request->date)){
                $dateRange = explode("/",$request->date);
                $startdate = $dateRange[0];
                $enddate = $dateRange[1];

                $sql->whereDate('visit_schedules.created_at','>=', $startdate);
                $sql->whereDate('visit_schedules.created_at','<=', $enddate);
            }

            $data = $sql->get();


            return DataTables::of($data)->addIndexColumn()
                
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('location_name', function ($data) {
                    return $data->location_name;
                })

                ->addColumn('outlet_name', function ($data) {
                    return $data->outlet_name;
                })

                ->addColumn('schedule_date', function ($data) {
                    return $data->schedule_date;
                })
                
             
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="javascript:void(0)" id="editAction" data-update-route="'.route('schedules.update',$data->id).'" data-edit-route="'.route('schedules.edit',$data->id).'" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a> '; 
                    //$actionBtn .= '<a href="javascript:void(0)" id="actionDelete" data-route="'.route('schedules.destroy',$data->id).'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })

            ->rawColumns([ 'name', 'location_name','outlet_name','schedule_date', 'action'])
            ->make(true);
        }

    }



}
