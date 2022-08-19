<?php

namespace Modules\Subcription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageRecarringInvoicePayment extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Subcription\Database\factories\PackageRecarringInvoicePaymentFactory::new();
    }
}
