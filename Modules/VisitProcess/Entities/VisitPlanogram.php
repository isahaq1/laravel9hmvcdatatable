<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitPlanogram extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public $timestamps = false;
}
