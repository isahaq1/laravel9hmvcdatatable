<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGuarantor extends Model
{
    use HasFactory;
    protected $guarded = [];
}
