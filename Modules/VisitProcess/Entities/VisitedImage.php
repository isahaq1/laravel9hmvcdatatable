<?php

namespace Modules\VisitProcess\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitedImage extends Model
{
    use HasFactory;

    protected $fillable = [];


    public static function visitedImages($request=null){

        $sql = VisitedImage::select(
            "visited_images.*",
            "outlets.outlet_name",
            "users.name",
        );
        $sql->join("outlets","outlets.outlet_id","=","visited_images.outlet_id");
        $sql->join("users","users.id","=","visited_images.user_id");
        $data = $sql->get();
        return $data;

    }
    
    
}
