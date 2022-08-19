<?php

namespace Modules\Subcription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['title','price','duration','offer','offer_price','offer_discount','offer_duration','offer_status','status'];

}
