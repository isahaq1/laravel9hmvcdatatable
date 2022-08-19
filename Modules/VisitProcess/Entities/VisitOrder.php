<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitOrder extends Model
{
    use HasFactory;

    protected $fillable = [];
    public function orderDetails(){
       return $this->hasMany(VisitOrderDetail::class,'order_id','id');
    }

    public function orderDetail(){
        return $this->hasOne(VisitOrderDetail::class,'order_id','id');
     }

     public $timestamps = false;
}
