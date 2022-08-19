<?php

namespace Modules\Subcription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackagePaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['title','status'];

}
