<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class VisitOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function product(){
       return $this->belongsTo(Product::Class,'product_id','id');
    }
    
    public $timestamps = false;
}
