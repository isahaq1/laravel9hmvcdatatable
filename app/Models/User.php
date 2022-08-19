<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Modules\User\Entities\Employee;
use Modules\User\Entities\UserAccounts;
use Modules\User\Entities\UserGuarantor;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'device_id',
        'ip_address',
        'status',
        'user_type',
        'login_status',
        'login_address',
        'logout_address'
    ];

    public function employee(){
        return $this->hasOne(Employee::class);
    }
    public function account(){
        return $this->hasOne(UserAccounts::class);
    }
    public function guarantor(){
        return $this->hasOne(UserGuarantor::class);
    }

    // public function users(){
    //     $sql = User::select("users.*","employees.*","user_accounts.*","user_guarantors.*");
    //     $sql->join("employees","employees.user_id","=","users.id");
    //     $sql->join("user_accounts","user_accounts.user_id","=","users.id");
    //     $sql->join("user_guarantors","user_guarantors.user_id","=","users.id");
    //     $users = $sql->get();
    //     return $users;
    // }

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
