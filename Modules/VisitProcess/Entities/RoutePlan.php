<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutePlan extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function routePlaneList($request){
        $sql = RoutePlan::select("route_plans.*","users.name");
        $sql->join("users","users.id","=","route_plans.user_id");
        $data = $sql->get();
        return $data;
    }

    
   
}
