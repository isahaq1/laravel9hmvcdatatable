<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Entities\CheckoutDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function checkout_details(){
        return $this->hasMany(CheckoutDetail::class);
    }
}
