<?php

namespace Modules\User\Entities;
use App\Models\User;
use Modules\User\Entities\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeviceRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userinfo(){
        return $this->hasOne(User::class);
    }

    public function employees(){
        return $this->belongsTo(Employee::class,'user_id','user_id');
    }


    public function deviceRequests(){
        $sql = $this->select("device_requests.*","employees.*");
        $sql->join("employees","employees.user_id","=","device_requests.user_id");
        return $sql->get();
    }
    
   
}
