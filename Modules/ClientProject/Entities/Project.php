<?php

namespace Modules\ClientProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ClientProject\Entities\ClientProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public  function projectdetails(){
        return $this->hasOne(ClientProject::class);
    }
}
