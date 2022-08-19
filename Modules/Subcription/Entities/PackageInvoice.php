<?php

namespace Modules\Subcription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Role\Entities\Module;
use Modules\Client\Entities\Client;
class PackageInvoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['package_id',
                           'client_id',
                           'title',
                           'price',
                           'duration',
                           'offer',
                           'offer_price',
                           'offer_discount',
                           'offer_duration',
                           'offer_status',
                           'payment_status',
                           'bill_start_date',
                           'invoice_date',
                           'status'
                        ];

    public function modules(){
        return $this->belongsToMany(Module::class,'package_invoice_details','package_invoice_id','module_id');
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function packageInvoicePayment(){
        return $this->belongsTo(PackageInvoicePayment::class,'invoice_id','invoice_id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    protected static function boot(){
        parent::boot();
        if(Auth::check()){
            self::creating(function($model) {
                $model->created_by = Auth::id();
            });

            self::created(function($model) {
                $model->invoice_id = str_pad($model->id, 6,0,STR_PAD_LEFT);
                $model->save();
            });

            self::updating(function($model) {
                $model->updated_by = Auth::id();
            });
        }

        static::addGlobalScope('sortByLatest', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

}
