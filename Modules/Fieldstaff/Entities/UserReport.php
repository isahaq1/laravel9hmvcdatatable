<?php

namespace Modules\Fieldstaff\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\VisitProcess\Entities\VisitSchedule;

class UserReport extends Model
{
    use HasFactory;

    protected $fillable = [];


    public static function user_report($request=null){

        
        $sql = VisitSchedule::select(
            "visit_schedules.*",
            "users.name",
            "outlets.outlet_name",
            "outlets.outlet_address",
            "outlets.cpf_name",
            "outlets.cpl_name",
            "outlet_types.type_name",
            "outlet_channels.channel_name");
        $sql->join("users","users.id","=","visit_schedules.user_id");
        $sql->join("outlets","outlets.outlet_id","=","visit_schedules.outlet_id");
        $sql->join("outlet_types","outlet_types.id","=","outlets.type_id");
        $sql->join("outlet_channels","outlet_channels.id","=","outlets.channel_id");
        

        if(!empty($request->outlet_type)){
            $sql->where('type_id', $request->outlet_type);
        }
        if(!empty($request->channel_id)){
            $sql->where('channel_id', $request->channel_id);
        }
        if(!empty($request->country_id)){
            $sql->where('outlets.country_id', $request->country_id);
        }
        if(!empty($request->state_id)){
            $sql->where('outlets.state_id', $request->state_id);
        }
        if(!empty($region_id)){
            $sql->where('outlets.region_id', $region_id);
        }
        if(!empty($request->location_id)){
            $sql->where('outlets.location_id', $request->location_id);
        }
        if(!empty($request->user_id)){
            $sql->where('visit_schedules.user_id', $request->user_id);
        }

        if(!empty($request->date)){

            $dateRange = explode("/",$request->date);
            $startdate = $dateRange[0];
            $enddate = $dateRange[1];
            $sql->whereDate('outlets.created_at','>=', $startdate);
            $sql->whereDate('outlets.created_at','<=', $enddate);
        }

        $sql->groupBy('user_id');
        $data = $sql->get();

        return $data;
    }
    
    
}
