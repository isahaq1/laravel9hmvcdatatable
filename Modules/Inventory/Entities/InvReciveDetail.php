<?php

namespace Modules\Inventory\Entities;

use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvReciveDetail extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public $timestamps = false;
    
    
}
