<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvStock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;


    public static function getStockReport($request=null){
        $sql = InvStock::select(
            "inv_stocks.*",
            "clients.client_name",
            "stores.store_name",
            "products.product_name"
        );
        $sql->join("clients","clients.id","=","inv_stocks.client_id");
        $sql->join("stores","stores.id","=","inv_stocks.store_id");
        $sql->join("products","products.id","=","inv_stocks.product_id");

        if(!empty($request->client_id)){
            $sql->where('inv_stocks.client_id', $request->client_id);
        }
        if(!empty($request->store_id)){
            $sql->where('inv_stocks.store_id', $request->store_id);
        }

        $data = $sql->get();

        return $data;
    }
    
   
}
