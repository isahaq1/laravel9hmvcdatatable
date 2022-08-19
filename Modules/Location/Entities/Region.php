<?php

namespace Modules\Location\Entities;

use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    

    public function state(){
        return $this->belongsTo(State::class);
    }
    
    public function country(){
        return $this->belongsTo(Country::class);
    }
    
}
