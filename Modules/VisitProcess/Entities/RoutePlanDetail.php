<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\Entities\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutePlanDetail extends Model
{
    use HasFactory;

    protected $fillable = ['route_plane_id','location_id'];


   
    public function locations(){
        return $this->hasMany(Location::class,'location_id','id');
    }

    public $timestamps=false;
    
   
}
