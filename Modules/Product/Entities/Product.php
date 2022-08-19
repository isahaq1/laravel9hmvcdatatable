<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'client_id',
        'create_by',
        'product_name',
        'product_weight',
        'product_description',
        'product_short_code',
        'product_image',
        'rec_retail_price',
        'unit_per_case',
        'unit_price',
        'sales_price',
        'case_discount',
        'p_type',
        'reorder_level_qty',
        'mst_qty',
        'outlet_type_id',
        'active_status',
        'created_at',
        'updated_at'
    ];
    
}
