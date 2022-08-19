<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitProductAvailability extends Model
{
    use HasFactory;

    protected $fillable = [];


    public static function readyStock($request=null){

        $sql = VisitProductAvailability::select(
            "visit_product_availabilities.availability_qty",
            "outlets.outlet_name",
            "products.product_name"
        );
        $sql->join("outlets","outlets.outlet_id","=","visit_product_availabilities.outlet_id");
        $sql->join("products","products.id","=","visit_product_availabilities.product_id");

        if(!empty($request->outlet_id)){
            $sql->where('visit_product_availabilities.outlet_id', $request->outlet_id);
        }
        if(!empty($request->client_id)){
            $sql->where('visit_product_availabilities.client_id', $request->client_id);
        }

        if(!empty($request->date)){

            $dateRange = explode("/",$request->date);
            $startdate = $dateRange[0];
            $enddate   = $dateRange[1];

            $sql->whereDate('visit_product_availabilities.created_at','>=', $startdate);
            $sql->whereDate('visit_product_availabilities.created_at','<=', $enddate);
        }

        $data = $sql->get();
        return $data;

    
    }
    
    
}
