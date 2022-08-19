<?php

namespace Modules\Outlet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outlet extends Model
{
    use HasFactory;
    protected $guarded = [];


    public static function getOutletList($request=null){

            $sql = Outlet::select("outlets.*","outlet_types.type_name","outlet_channels.channel_name");
            $sql->join("outlet_types","outlet_types.id","=","outlets.type_id");
            $sql->join("outlet_channels","outlet_channels.id","=","outlets.channel_id");
            

            if(!empty($request->outlet_type)){
                $sql->where('type_id', $request->outlet_type);
            }
            if(!empty($request->channel_id)){
                $sql->where('channel_id', $request->channel_id);
            }
            if(!empty($request->country_id)){
                $sql->where('country_id', $request->country_id);
            }
            if(!empty($request->state_id)){
                $sql->where('state_id', $request->state_id);
            }
            if(!empty($region_id)){
                $sql->where('region_id', $region_id);
            }
            if(!empty($request->location_id)){
                $sql->where('location_id', $request->location_id);
            }
            if(!empty($request->date)){
                $dateRange = explode("/",$request->date);
                $startdate = $dateRange[0];
                $enddate = $dateRange[1];
                $sql->whereDate('outlets.created_at','>=', $startdate);
                $sql->whereDate('outlets.created_at','<=', $enddate);
            }
            $data = $sql->get();
            return $data;
    }
    
}
