<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitOos extends Model
{
    use HasFactory;

    protected $fillable = [];


    public static function clientOos($request=null){

        $sql = VisitOos::select(
            "visit_oos.is_oos",
            "clients.client_name",
            "outlets.outlet_name",
            "products.product_name"
        );
        $sql->join("clients","clients.id","=","visit_oos.client_id");
        $sql->join("outlets","outlets.outlet_id","=","visit_oos.outlet_id");
        $sql->join("products","products.id","=","visit_oos.product_id");

        if(!empty($request->outlet_id)){
            $sql->where('visit_oos.outlet_id', $request->outlet_id);
        }
        if(!empty($request->client_id)){
            $sql->where('visit_oos.client_id', $request->client_id);
        }

        if(!empty($request->date)){

            $dateRange = explode("/",$request->date);
            $startdate = $dateRange[0];
            $enddate   = $dateRange[1];

            $sql->whereDate('visit_oos.created_at','>=', $startdate);
            $sql->whereDate('visit_oos.created_at','<=', $enddate);
        }

        $data = $sql->get();
        return $data;

    
    }
    
    
    
}
